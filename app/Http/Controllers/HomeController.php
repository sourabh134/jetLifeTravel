<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\APIService;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.index');
    }



    public function searchAirport(Request $request)
    {
        $name = $request->input('searchairport');
        $list = APIService::airportList($name);
        return response()->json($list);
    }

    public function flightSearchResult(Request $request)
    {
        $journeyType = $request->trip;
        if ($journeyType == "oneway") {
            $options = $request->options;
            $passengers = $request->passengers;

            $leg1 = $request->leg1;
            $pairs = explode(',', $leg1);

            $extracted = [];
            foreach ($pairs as $pair) {
                list($key, $value) = explode(':', $pair);
                $extracted[$key] = $value;
            }

            // Access individual values
            $from = $extracted['from'];
            $to = $extracted['to'];
            $departure = date('Y-m-d', strtotime($extracted['departure']));
            $fromType = $extracted['fromType'];
            $toType = $extracted['toType'];


            $passengerData = [];
            foreach (explode(',', $passengers) as $item) {
                [$key, $value] = explode(':', $item);
                $passengerData[$key] = (int)$value; // Convert to integer
            }

            // Access values
            $adults = $passengerData['adults'];       // 1
            $children = $passengerData['children'];   // 1
            $infantInLap = $passengerData['infantinlap']; // 0
            $optionData = [];
            [$key, $value] = explode(':', $options);
            $optionData[$key] = $value;
            // Access the value
            $cabinClass = $optionData['cabinclass'];
            $flightsearchoneway = APIService::flightsearchoneway($journeyType, $departure, $to, $from, $cabinClass, $adults, $children, $infantInLap);
            $totalFlight = $flightsearchoneway['AirSearchResponse']['AirSearchResult']['FareItineraries'];
            $flightsession = $flightsearchoneway['AirSearchResponse']['session_id'];
            $airlineStats = [];
            $stopStats = [];
            $refundStats = [
                'Yes' => 0,
                'No' => 0
            ];

            foreach ($totalFlight as $flightvalue) {
                // Get total stops and fare info
                $FareSourceCode = $flightvalue['FareItinerary']['AirItineraryFareInfo']['FareSourceCode'];
                $IsPassportMandatory = $flightvalue['FareItinerary']['IsPassportMandatory'];
                $IsRefundable = $flightvalue['FareItinerary']['AirItineraryFareInfo']['IsRefundable'];
                $totalStops = $flightvalue['FareItinerary']['OriginDestinationOptions'][0]['TotalStops'];
                $totalFare = $flightvalue['FareItinerary']['AirItineraryFareInfo']['ItinTotalFares']['TotalFare']['Amount'];
                $currency = $flightvalue['FareItinerary']['AirItineraryFareInfo']['ItinTotalFares']['TotalFare']['CurrencyCode'];

                // Get fare breakdown, cabin baggage, cabin class code
                $fareBreakdown = $flightvalue['FareItinerary']['AirItineraryFareInfo']['FareBreakdown'];
                $cabinBaggageList = [];
                foreach ($fareBreakdown as $fare) {
                    $cabinBaggageList[] = $fare['CabinBaggage'][0] ?? 'N/A';
                }
                $cabinClassCode = $flightvalue['FareItinerary']['OriginDestinationOptions'][0]['OriginDestinationOption'][0]['FlightSegment']['CabinClassCode'] ?? 'N/A';

                // Process segments
                $segments = $flightvalue['FareItinerary']['OriginDestinationOptions'][0]['OriginDestinationOption'];
                $lastSegment = end($segments);

                // Calculate journey duration
                $journeyDuration = 0;
                foreach ($segments as $segment) {
                    $journeyDuration += $segment['FlightSegment']['JourneyDuration'];
                }
                $hours = floor($journeyDuration / 60);
                $minutes = $journeyDuration % 60;
                $formattedDuration = $hours . "h " . $minutes . "m";

                // Store flight details
                $air = [];
                $air['flightsession'] = $flightsession;
                $air['FareSourceCode'] = $FareSourceCode;
                $air['IsPassportMandatory'] = $IsPassportMandatory;
                $air['IsRefundable'] = $IsRefundable;
                $air['from'] = $request->fromname;
                $air['fromcode'] = $from;
                $air['to'] = $request->toname;
                $air['tocode'] = $to;
                $air['totalStops'] = $totalStops;
                $air['totalStopsName'] =  ($totalStops == 0) ? 'Non-Stop' : $totalStops . ' Stop';
                $air['totalJourneyDuration'] = $formattedDuration;
                $air['totalFare'] = '$' . $totalFare;
                $air['currency'] = $currency;
                $air['airport'] = $lastSegment['FlightSegment']['ArrivalAirportLocationCode'];
                $air['dateTime'] = $lastSegment['FlightSegment']['ArrivalDateTime'];
                $air['cabinClassCode'] = $cabinClassCode;
                $air['cabinBaggage'] =  current($cabinBaggageList); // in case multiple passengers with different values

                // Segment details
                $segmatArray = [];
                foreach ($segments as $i => $segment) {
                    $fs = $segment['FlightSegment'];

                    $seg['Segment'] = ($i + 1);
                    $seg['Airline'] = $fs['MarketingAirlineName'] . " (" . $fs['MarketingAirlineCode'] . ")";
                    $seg['AirlineName'] = $fs['MarketingAirlineName'];
                    $seg['Route'] = $fs['DepartureAirportLocationCode'] . " → " . $fs['ArrivalAirportLocationCode'];
                    $seg['DepartureAirportLocationCode'] = $fs['DepartureAirportLocationCode'];
                    $seg['ArrivalAirportLocationCode'] = $fs['ArrivalAirportLocationCode'];
                    $seg['Departure'] = $fs['DepartureDateTime'];
                    $seg['DepartureTime'] = date('H:i', strtotime($fs['DepartureDateTime']));
                    $seg['Arrival'] = $fs['ArrivalDateTime'];
                    $seg['ArrivalTime'] = date('H:i', strtotime($fs['ArrivalDateTime']));
                    $seg['Duration'] = floor($fs['JourneyDuration'] / 60) . "h " . ($fs['JourneyDuration'] % 60) . "m";
                    $seg['FlightNumber'] = $fs['FlightNumber'];
                    $seg['AirLineLogo'] = "https://travelnext.works/api/airlines/" . $fs['MarketingAirlineCode'] . ".gif";
                    $seg['SeatsRemaining'] = $segment['SeatsRemaining']['Number'] ?? 'N/A';
                    $seg['MealCode'] = $fs['MealCode'] ?? 'Not specified';

                    $segmatArray[] = $seg;
                }

                $air['Segment'] = $segmatArray;
                // Add FareBreakdown
                $fareBreakdown = $flightvalue['FareItinerary']['AirItineraryFareInfo']['FareBreakdown'];
                $fareDetails = [];
                foreach ($fareBreakdown as $fare) {
                    $details = [
                        'PassengerType' => $fare['PassengerTypeQuantity']['Code'],
                        'Quantity' => $fare['PassengerTypeQuantity']['Quantity'],
                        'BaseFare' => $fare['PassengerFare']['BaseFare']['Amount'],
                        'TotalFare' => $fare['PassengerFare']['TotalFare']['Amount'],
                        'TotalFarePerPassenger' => $fare['PassengerFare']['TotalFare']['Amount'] / $fare['PassengerTypeQuantity']['Quantity'],
                        'Baggage' => current($fare['Baggage']),
                        'CabinBaggage' => current($fare['CabinBaggage'])
                    ];
                    $fareDetails[] = $details;
                }
                $air['FareBreakdown'] = $fareDetails;
                $flightSearch[] = $air;
                // === Airline summary ===
                foreach ($segmatArray as $segIndex => $segment) {
                    $airline = $segment['AirlineName'];
                    $price = floatval(str_replace('$', '', $air['totalFare']));

                    if (!isset($airlineStats[$airline])) {
                        $airlineStats[$airline] = [
                            'count' => 1,
                            'lowest_price' => $price
                        ];
                    } else {
                        $airlineStats[$airline]['count']++;
                        $airlineStats[$airline]['lowest_price'] = min($airlineStats[$airline]['lowest_price'], $price);
                    }

                    break; // Count only first segment for airline
                }

                // === Stop summary ===
                $stops = $air['totalStops'];
                $stopCategory = ($stops == 0) ? 'Non-Stop' : 'Stops';
                if (!isset($stopStats[$stopCategory])) {
                    $stopStats[$stopCategory] = [
                        'count' => 1,
                        'lowest_price' => $price
                    ];
                } else {
                    $stopStats[$stopCategory]['count']++;
                    $stopStats[$stopCategory]['lowest_price'] = min($stopStats[$stopCategory]['lowest_price'], $price);
                }

                // === Refundability summary ===
                $isRefundable = ucfirst(strtolower(trim($IsRefundable))); // will be 'Yes' or 'No'

                // Ensure the key exists
                if (!isset($refundStats[$isRefundable])) {
                    $refundStats[$isRefundable] = 0;
                }

                $refundStats[$isRefundable]++;
            }
            // echo "<pre>";
            // print_r($airlineStats);
            // print_r($stopStats);
            // print_r($refundStats);
            // print_r($flightSearch);
            // die;
        }
        return view('front.flight-search-result', compact('flightSearch', 'from', 'to', 'airlineStats', 'stopStats', 'refundStats'));
    }
}
