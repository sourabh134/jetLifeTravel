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

    public function flightSearchResult(Request $request){
        echo $trip = $request->trip;
        echo $leg1 = $request->leg1;
        echo $options = $request->options;
        echo $fromDate = $request->fromDate;
        echo $passengers = $request->passengers;
        die;

        //  "journeyType": "OneWay",
        //         "OriginDestinationInfo": [
        //             {
        //                 "departureDate": "2025-06-22",
        //                 "airportOriginCode": "AMS",
        //                 "airportDestinationCode": "LON"
        //             }
        //         ],
        //         "class": "Economy",
        //         "adults": 2,
        //         "childs": 1,
        //         "infants": 1
        $flightsearchoneway = APIService::flightsearchoneway();
        echo "<pre>";
        print_r($flightsearchoneway);
        die;
        return view('front.flight-search-result');
    }
}
