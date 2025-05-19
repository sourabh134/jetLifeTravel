<?php

namespace App\Services;

class APIService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function airportList($name = null)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://travelnext.works/api/aeroVE5/airport_list',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "user_id": "jetlifeglobal_testAPI",
                "user_password": "jetlifeglobalTest@2025",
                "access": "Test",
                "ip_address": "122.161.48.174"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer 1917d4d2-1373-4191-8fbc-da123a254808',
                'Cookie: ci_session=b5e9bbb183e682fe8d60b027ee170533cc8ea36c'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $airports = json_decode($response, true);
        // print_r($airports);
        // die;

        // Filter if $name is provided
        // if ($name && isset($airports) && is_array($airports)) {
        //     $name = strtolower($name);
        //     $filtered = array_filter($airports, function ($airport) use ($name) {
        //         return stripos($airport['AirportCode'], $name) !== false ;
        //     });
        //     return array_values($filtered);
        // }
        if (!empty($name) && is_array($airports)) {
            $filtered = array_filter($airports, function ($airport) use ($name) {
                return isset($airport['AirportCode']) && stripos($airport['AirportCode'], $name) !== false;
            });
            return array_values($filtered);
        }

        return $airports ?? [];
    }

    public static function airlineList()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://travelnext.works/api/aeroVE5/airline_list',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "user_id": "jetlifeglobal_testAPI",
    "user_password": "jetlifeglobalTest@2025",
    "access": "Test",
    "ip_address": "122.161.53.34"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public static function flightsearchoneway($journeyType, $departure, $to, $from, $cabinClass, $adults, $children, $infantInLap)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://travelnext.works/api/aeroVE5/availability',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "user_id": "jetlifeglobal_testAPI",
                "user_password": "jetlifeglobalTest@2025",
                "access": "Test",
                "ip_address": "122.161.52.193",
                "requiredCurrency": "USD",
                "journeyType": "OneWay",
                "OriginDestinationInfo": [
                    {
                        "departureDate": "'.$departure.'",
                        "airportOriginCode": "'.$from.'",
                        "airportDestinationCode": "'.$to.'"
                    }
                ],
                "class": "'.ucfirst(strtolower($cabinClass)).'",
                "adults": '.$adults.',
                "childs": '.$children.',
                "infants": '.$infantInLap.'
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        // echo"<pre>";
        // print_r($response);
        // die;
        return json_decode($response, true);
    }

    public static function flightsearchreturn()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://travelnext.works/api/aeroVE5/availability',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "user_id": "jetlifeglobal_testAPI",
                "user_password": "jetlifeglobalTest@2025",
                "access": "Test",
                "ip_address": "122.161.49.156",
                "requiredCurrency": "USD",
                "journeyType": "OneWay",
                "OriginDestinationInfo": [
                    {
                        "departureDate": "2025-06-22",
                        "airportOriginCode": "AMS",
                        "airportDestinationCode": "LON"
                    }
                ],
                "class": "Economy",
                "adults": 2,
                "childs": 1,
                "infants": 1
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer 1917d4d2-1373-4191-8fbc-da123a254808',
                'Cookie: ci_session=b5e9bbb183e682fe8d60b027ee170533cc8ea36c'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $airports = json_decode($response, true);
    }
}
