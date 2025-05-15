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
            foreach ($totalFlight as $flightvalue) {
                // Get basic itinerary info
                $totalStops = $flightvalue['OriginDestinationOptions'][0]['TotalStops'];
                $totalFare = $flightvalue['ItinTotalFares']['TotalFare']['Amount'];
                $currency = $flightvalue['ItinTotalFares']['TotalFare']['CurrencyCode'];

                // Process flight segments
                $segments = $flightvalue['OriginDestinationOptions'][0]['OriginDestinationOption'];
                $lastSegment = end($segments);

                // Calculate total journey duration
                $journeyDuration = 0;
                foreach ($segments as $segment) {
                    $journeyDuration += $segment['FlightSegment']['JourneyDuration'];
                }
                $hours = floor($journeyDuration / 60);
                $minutes = $journeyDuration % 60;
                $formattedDuration = $hours . "h " . $minutes . "m";

                // Output header
                echo "================================\n";
                echo "FLIGHT ITINERARY SUMMARY\n";
                echo "================================\n\n";

                // Output basic info
                echo "Total Stops: " . $totalStops . "\n";
                echo "Total Journey Duration: " . $formattedDuration . "\n";
                echo "Total Fare: " . $totalFare . " " . $currency . "\n\n";

                // Output final arrival info
                echo "Final Arrival:\n";
                echo "- Airport: " . $lastSegment['FlightSegment']['ArrivalAirportLocationCode'] . "\n";
                echo "- Date/Time: " . $lastSegment['FlightSegment']['ArrivalDateTime'] . "\n\n";

                // Output detailed flight segments
                echo "Flight Segments:\n";
                echo "----------------\n";

                foreach ($segments as $i => $segment) {
                    $fs = $segment['FlightSegment'];
                    echo "Segment " . ($i + 1) . ":\n";
                    echo "Airline: " . $fs['MarketingAirlineName'] . " (" . $fs['MarketingAirlineCode'] . ")\n";
                    echo "Route: " . $fs['DepartureAirportLocationCode'] . " → " . $fs['ArrivalAirportLocationCode'] . "\n";
                    echo "Departure: " . $fs['DepartureDateTime'] . "\n";
                    echo "Arrival: " . $fs['ArrivalDateTime'] . "\n";
                    echo "Duration: " . floor($fs['JourneyDuration'] / 60) . "h " . ($fs['JourneyDuration'] % 60) . "m\n";
                    echo "Flight Number: " . $fs['FlightNumber'] . "\n";
                    echo "----------------\n";
                }

                die;
            }
            die;
            // echo "<pre>";
            // print_r($flightsearchoneway['AirSearchResponse']['AirSearchResult']['FareItineraries']);
            // die;
        }
        return view('front.flight-search-result', compact('totalFlight'));
    }
}
