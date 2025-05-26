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
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://travelnext.works/api/aeroVE5/availability',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => '{
        //         "user_id": "jetlifeglobal_testAPI",
        //         "user_password": "jetlifeglobalTest@2025",
        //         "access": "Test",
        //         "ip_address": "122.161.52.193",
        //         "requiredCurrency": "USD",
        //         "journeyType": "OneWay",
        //         "OriginDestinationInfo": [
        //             {
        //                 "departureDate": "' . $departure . '",
        //                 "airportOriginCode": "' . $from . '",
        //                 "airportDestinationCode": "' . $to . '"
        //             }
        //         ],
        //         "class": "' . ucfirst(strtolower($cabinClass)) . '",
        //         "adults": ' . $adults . ',
        //         "childs": ' . $children . ',
        //         "infants": ' . $infantInLap . '
        //     }',
        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json'
        //     ),
        // ));

        // $response = curl_exec($curl);
        // $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // curl_close($curl);
        // print_r($response);
        // die;
        $http_status = 200;
        $response = '{
  "AirSearchResponse": {
    "session_id": "MTc0Nzk4NjQxMV8xNDg2OTUw",
    "AirSearchResult": {
      "FareItineraries": [
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB42[TBO]r2pMbnaarVk6qzaublSma7weUangH7JSA3jBpYU5wkJCLjT37oTyoLrQ2CQUF/VnHRL4ZFacY4K/UQq/IWv0xI6mn1RAyzKeUwXQMF74eY8KMwj3iGzqh6t4bjqKRwkRp1WAyMow1sTykphy9TTwVGjXbQr0A5LIs2y1i/gqvbEXQHxftxR7R8FuxC0UV+lmRp1EBdQORKFXCSpGo1rnXbsQvNfa5qDvcHincdFFZcgOVXX+hiOhYm8txV6q39TCKpgIVeWtLMNjRrAiAy1Ll3dMoRUhU+OniowWYKGSJfV+Vs17S5VgOlEFLKWmIPp/nY3EJ8b3kRNlNaGcLdX4QHXbz0wZqWUkwQUsAM6z//Ojf78j3aQoPxmjyOiW3tyYmyws2n5Hhv9ZYzMD5IdMN2gDMMNsdxbIhCXVLoOOFGxF5/43zqFXmaqe3ahB1DNQCGMz31cFQ/xTy9Yoj195+eCUtkxSBHkbIxfuG7Qo8Ktn8Dr6c/PnvnGRf/LzsdPbpKe42LQkAqTto9rblO3UsA==-RI-MQ==",
              "FareInfos": [],
              "FareType": "WebFare",
              "ResultIndex": "OB42[TBO]r2pMbnaarVk6qzaublSma7weUangH7JSA3jBpYU5wkJCLjT37oTyoLrQ2CQUF/VnHRL4ZFacY4K/UQq/IWv0xI6mn1RAyzKeUwXQMF74eY8KMwj3iGzqh6t4bjqKRwkRp1WAyMow1sTykphy9TTwVGjXbQr0A5LIs2y1i/gqvbEXQHxftxR7R8FuxC0UV+lmRp1EBdQORKFXCSpGo1rnXbsQvNfa5qDvcHincdFFZcgOVXX+hiOhYm8txV6q39TCKpgIVeWtLMNjRrAiAy1Ll3dMoRUhU+OniowWYKGSJfV+Vs17S5VgOlEFLKWmIPp/nY3EJ8b3kRNlNaGcLdX4QHXbz0wZqWUkwQUsAM6z//Ojf78j3aQoPxmjyOiW3tyYmyws2n5Hhv9ZYzMD5IdMN2gDMMNsdxbIhCXVLoOOFGxF5/43zqFXmaqe3ahB1DNQCGMz31cFQ/xTy9Yoj195+eCUtkxSBHkbIxfuG7Qo8Ktn8Dr6c/PnvnGRf/LzsdPbpKe42LQkAqTto9rblO3UsA==",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "50.7",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "50.7",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "69.46",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "120.16",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0KG"
                  ],
                  "CabinBaggage": [
                    "7Kg"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "50.7",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "50.7",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "67.4",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "69.46",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "120.16",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T07:40:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T23:20:00",
                      "Eticket": true,
                      "FlightNumber": "183",
                      "JourneyDuration": "350",
                      "MarketingAirlineCode": "D7",
                      "MarketingAirlineName": "Air Asia X",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "D7",
                        "Name": "Air Asia X",
                        "Equipment": "330",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "X",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "350",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 0
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "D7",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB12[TBO]aTo0ojPO7FvfzmBI20N1UjC32qmJhmYJsY6mgTBWXsfupZ/o4hNsJUhWxxB0GGwpZQU1mYXr1HpGB80Pgv7HlG6gSN0YDgJlGr/5Z8Wq6cukGPN16OdlhMsaf044ZkitvN8x77dl9zO/byOLFrbYAMSpoxRNkAnNCZHykU9teTXFhE2zqjbouJhfbWR4rLx3DoSTM0H4O8rHJnNVS9q8MiOiaOYT7/EFo0pzpWTxrJOLDTO4xFXbO7xcM962lYRCnD9xsOVNISPfO3CM5+tkz73QwT8twPX95ljjckzr0iaqmOS7foW7xosNz6TtX0dc7xSEu+byMSN28Pc18C0F9qx9W7Mr23SUZlTEhA6yxOpvMSJN4Ci+pjQeCa5+8cCjG50p9+g+lttm2HSPPnH4UT9s4ndvb9AlqvaTcHHc/Aiyd19gXicajO2iCP+x4/N1AwmFYmwbVsxXZjQ48Ka+BUY2zshCKBwL4/DJz/6ib2HP3UIv+Rkgsg8Bk4g1q0Al0r14++mDKCrvZB6J96Lj7/ZkBL0V7R8GXM7jFUv4kOcH+P83n/4JHBUincEQ8/51gmhrqsQG9tbLey+3540IsTTcErY6MqRIIT81dZ3ve/xmaodU2Gs+IabVva890p7uRiYSepjp0lQsSwdxtTj23Z385ehys2/ME8zaStuFPbh38iWJtINcliORmk4BM1nzMacC1xzEqmLFFKE2zwjSOQ==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB12[TBO]aTo0ojPO7FvfzmBI20N1UjC32qmJhmYJsY6mgTBWXsfupZ/o4hNsJUhWxxB0GGwpZQU1mYXr1HpGB80Pgv7HlG6gSN0YDgJlGr/5Z8Wq6cukGPN16OdlhMsaf044ZkitvN8x77dl9zO/byOLFrbYAMSpoxRNkAnNCZHykU9teTXFhE2zqjbouJhfbWR4rLx3DoSTM0H4O8rHJnNVS9q8MiOiaOYT7/EFo0pzpWTxrJOLDTO4xFXbO7xcM962lYRCnD9xsOVNISPfO3CM5+tkz73QwT8twPX95ljjckzr0iaqmOS7foW7xosNz6TtX0dc7xSEu+byMSN28Pc18C0F9qx9W7Mr23SUZlTEhA6yxOpvMSJN4Ci+pjQeCa5+8cCjG50p9+g+lttm2HSPPnH4UT9s4ndvb9AlqvaTcHHc/Aiyd19gXicajO2iCP+x4/N1AwmFYmwbVsxXZjQ48Ka+BUY2zshCKBwL4/DJz/6ib2HP3UIv+Rkgsg8Bk4g1q0Al0r14++mDKCrvZB6J96Lj7/ZkBL0V7R8GXM7jFUv4kOcH+P83n/4JHBUincEQ8/51gmhrqsQG9tbLey+3540IsTTcErY6MqRIIT81dZ3ve/xmaodU2Gs+IabVva890p7uRiYSepjp0lQsSwdxtTj23Z385ehys2/ME8zaStuFPbh38iWJtINcliORmk4BM1nzMacC1xzEqmLFFKE2zwjSOQ==",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "31.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "31.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "103.98",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "135.62",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "31.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "31.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "103.98",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "74.60",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "29.38",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "135.62",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "CMB",
                      "ArrivalDateTime": "2025-05-30T08:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T05:15:00",
                      "Eticket": true,
                      "FlightNumber": "192",
                      "JourneyDuration": "215",
                      "MarketingAirlineCode": "UL",
                      "MarketingAirlineName": "Srilankan Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "UL",
                        "Name": "Srilankan Airlines",
                        "Equipment": "320",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "215",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T14:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "CMB",
                      "DepartureDateTime": "2025-05-31T07:40:00",
                      "Eticket": true,
                      "FlightNumber": "314",
                      "JourneyDuration": "230",
                      "MarketingAirlineCode": "UL",
                      "MarketingAirlineName": "Srilankan Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "UL",
                        "Name": "Srilankan Airlines",
                        "Equipment": "32B",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "230",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "UL",
            "TicketAdvisory": "TICKETS ARE NON-REFUNDABLE \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB11[TBO]M95PPTzZBHi/hrk+Vp8m07IPNPgk3ob9cA18O2sh6tBPH56bJi8aCJ2XAbAwiKWFhzb40DHFWZMb7WHTzBw6Wj6nG17s/38DyJb54JKZWcA4irUQ8uo1u2Igufsg/7OlASYqVP8C982M/cimkBBuacaP9udZs38NJ1MbAtbSM0DUzB3iNilQCW8zQC++9wjJqM7FWOXCeaNOJ+j11HNou4a/fLRhsFEUkypYjf6ha4keQOSOxskYf0NG9Xab/g2dcoLmE+d8HF2Xrjl9K0OE42JnKQzxOLIgUwNXzrVjEuDtG1dvGNFY6cFPs7tjRoCWX+/ln0HOIWZULEQ3eb4QUg+KP2sJR84nY5URVvU5XofT1n18hPhUymArpmnRy5GgW2KwjkTSdem3RpREyXvWuNDPdJdXg2BJ4Td99mJeiU95BKCD1laHO459itrjBRi4bV4U+YjkDNX5Ue8pLmIJTsz9i6b7XvruXXlDfteg0ldSF7U+4D8oxNzmA6/T4mgnxV2Vv7fg5tvwpqSs6fhs1C08relj/HskCwp9IrLJcbIXQA36YNUawrTZQHYQasGwoFGG3phR7ISvuR/shVpI3rjH39b6ahO0jv6y+mzzMjehWhkTKySl9E0U3UGpF5uohPZrpL8+3Ij9AH7uoeoQ2j8Cjxolf4fmI6HqAiO/shrDZRTBEyPC3TL4+MOKBadqouJB0r+McKIyeaeHDpoA4A==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB11[TBO]M95PPTzZBHi/hrk+Vp8m07IPNPgk3ob9cA18O2sh6tBPH56bJi8aCJ2XAbAwiKWFhzb40DHFWZMb7WHTzBw6Wj6nG17s/38DyJb54JKZWcA4irUQ8uo1u2Igufsg/7OlASYqVP8C982M/cimkBBuacaP9udZs38NJ1MbAtbSM0DUzB3iNilQCW8zQC++9wjJqM7FWOXCeaNOJ+j11HNou4a/fLRhsFEUkypYjf6ha4keQOSOxskYf0NG9Xab/g2dcoLmE+d8HF2Xrjl9K0OE42JnKQzxOLIgUwNXzrVjEuDtG1dvGNFY6cFPs7tjRoCWX+/ln0HOIWZULEQ3eb4QUg+KP2sJR84nY5URVvU5XofT1n18hPhUymArpmnRy5GgW2KwjkTSdem3RpREyXvWuNDPdJdXg2BJ4Td99mJeiU95BKCD1laHO459itrjBRi4bV4U+YjkDNX5Ue8pLmIJTsz9i6b7XvruXXlDfteg0ldSF7U+4D8oxNzmA6/T4mgnxV2Vv7fg5tvwpqSs6fhs1C08relj/HskCwp9IrLJcbIXQA36YNUawrTZQHYQasGwoFGG3phR7ISvuR/shVpI3rjH39b6ahO0jv6y+mzzMjehWhkTKySl9E0U3UGpF5uohPZrpL8+3Ij9AH7uoeoQ2j8Cjxolf4fmI6HqAiO/shrDZRTBEyPC3TL4+MOKBadqouJB0r+McKIyeaeHDpoA4A==",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "31.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "31.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "103.98",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "135.62",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "31.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "31.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "103.98",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "74.60",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "29.38",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "135.62",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "CMB",
                      "ArrivalDateTime": "2025-05-30T22:20:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T18:45:00",
                      "Eticket": true,
                      "FlightNumber": "196",
                      "JourneyDuration": "215",
                      "MarketingAirlineCode": "UL",
                      "MarketingAirlineName": "Srilankan Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "UL",
                        "Name": "Srilankan Airlines",
                        "Equipment": "320",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "215",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T14:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "CMB",
                      "DepartureDateTime": "2025-05-31T07:40:00",
                      "Eticket": true,
                      "FlightNumber": "314",
                      "JourneyDuration": "230",
                      "MarketingAirlineCode": "UL",
                      "MarketingAirlineName": "Srilankan Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "UL",
                        "Name": "Srilankan Airlines",
                        "Equipment": "32B",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "230",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "UL",
            "TicketAdvisory": "TICKETS ARE NON-REFUNDABLE \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB10[TBO]86D8Vm0undwNF/OYjeNB1TFk5F//gWD05pHyI2fAWBUDbQx49wQzmlCXaccVMJLJoNH8Uz5p+koK5fOKeAZeSFOtLslMz67nPKQ4W4GfPqDkGXgAuQP3X/UyRnEh0VKLkO39YTrtrwEQGgnHekP6Yemd400n0+37n3G0qx5/U0WLyt5P5cFfnMN39OhLg8DMYbPWZbKAlHbnNWGX4mv/xUV/2kp0uqawCxtoLFzxu7MzF0jBl6VCq6NxklGGEa/vcv4I5nKEr6I1VQEvHwnLQ7LtlRj2iYJ2SEHAis0VuZh8mDaOPHdBI0ayAbgRA+YMo29OmcxHMHcc/kmwXOS/bmiT+JAi84S4ZTWYB5SkvaBN6H606rkOXFttWPDWneJKPbLZAR+68OKE1/gEtIsML2LEPc3i4ApRU4H5QOivbPv7eITlbjfmpDhom2jm2bNXparxK2FSi/xMIF7X3T0UYcDWI9elkdNzYmhvUTHIZYbcWXmDq2kTOaKESXdN1w55iiY0PMZwfTgvRgGuACalzA==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB10[TBO]86D8Vm0undwNF/OYjeNB1TFk5F//gWD05pHyI2fAWBUDbQx49wQzmlCXaccVMJLJoNH8Uz5p+koK5fOKeAZeSFOtLslMz67nPKQ4W4GfPqDkGXgAuQP3X/UyRnEh0VKLkO39YTrtrwEQGgnHekP6Yemd400n0+37n3G0qx5/U0WLyt5P5cFfnMN39OhLg8DMYbPWZbKAlHbnNWGX4mv/xUV/2kp0uqawCxtoLFzxu7MzF0jBl6VCq6NxklGGEa/vcv4I5nKEr6I1VQEvHwnLQ7LtlRj2iYJ2SEHAis0VuZh8mDaOPHdBI0ayAbgRA+YMo29OmcxHMHcc/kmwXOS/bmiT+JAi84S4ZTWYB5SkvaBN6H606rkOXFttWPDWneJKPbLZAR+68OKE1/gEtIsML2LEPc3i4ApRU4H5QOivbPv7eITlbjfmpDhom2jm2bNXparxK2FSi/xMIF7X3T0UYcDWI9elkdNzYmhvUTHIZYbcWXmDq2kTOaKESXdN1w55iiY0PMZwfTgvRgGuACalzA==",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "91.42",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "91.42",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "40.85",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "132.27",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "20 KG"
                  ],
                  "CabinBaggage": [
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "91.42",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "91.42",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "40.85",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "11.63",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "29.22",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "132.27",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T04:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T19:55:00",
                      "Eticket": true,
                      "FlightNumber": "208",
                      "JourneyDuration": "335",
                      "MarketingAirlineCode": "OD",
                      "MarketingAirlineName": "Batik Air",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "OD",
                        "Name": "Batik Air",
                        "Equipment": "738",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "X",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "335",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 0
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "OD",
            "TicketAdvisory": "TICKETS ARE NON-REFUNDABLE \nLAST TKT DTE 24MAY25 - SEE ADV PURCHASE \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB9[TBO]y2W7pvjKZujJLRBTw0g7Wt95SLJsUcFrVeLpAyUrUYecNffnpzvBs3l6bdpO9miQKpw4uI4PQVI2T7dcn44emj0l+ZazuKRBU9wdiP0sgi12HFFej3zeUs9CjZDq42b/ylKiyFm42jT/2NO26gN50akG+mrl0ozsSiLAO7BNGMI8r4yManL7ZnCOhnMC9kqNB8OPaTpTMSDPS4N2r9zXPmXGbgU78GyUKpBdFo6p1qoG1IJ7Y/BMVroPaILw+6pzDwFxagyNfgMoRlA2oPHrRP+eCpYdLV5U4E9OGv8FQMrRuh1svvyHy99iCfArXBktCe7Pqa7zkTHNWxtIuWPkB6Q+//bcPRdOsnVAlOa198lmhRiV9z82Vo6yzP7XHP8mOQDNHTr56+w/3/hm8rbOO4nnm35zCzaUIWBABZgPAXR5AcJ1pSoZIlbCO3up/TloKc+cVntm80ztQsFOqFAMF7AhnvtchEI74+9GM22yLG3HUNIGJFuIUOiiDaRginr1ngzUl6XQgRSrfglqi1ZAaQ==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB9[TBO]y2W7pvjKZujJLRBTw0g7Wt95SLJsUcFrVeLpAyUrUYecNffnpzvBs3l6bdpO9miQKpw4uI4PQVI2T7dcn44emj0l+ZazuKRBU9wdiP0sgi12HFFej3zeUs9CjZDq42b/ylKiyFm42jT/2NO26gN50akG+mrl0ozsSiLAO7BNGMI8r4yManL7ZnCOhnMC9kqNB8OPaTpTMSDPS4N2r9zXPmXGbgU78GyUKpBdFo6p1qoG1IJ7Y/BMVroPaILw+6pzDwFxagyNfgMoRlA2oPHrRP+eCpYdLV5U4E9OGv8FQMrRuh1svvyHy99iCfArXBktCe7Pqa7zkTHNWxtIuWPkB6Q+//bcPRdOsnVAlOa198lmhRiV9z82Vo6yzP7XHP8mOQDNHTr56+w/3/hm8rbOO4nnm35zCzaUIWBABZgPAXR5AcJ1pSoZIlbCO3up/TloKc+cVntm80ztQsFOqFAMF7AhnvtchEI74+9GM22yLG3HUNIGJFuIUOiiDaRginr1ngzUl6XQgRSrfglqi1ZAaQ==",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "91.42",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "91.42",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "40.85",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "132.27",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "20 KG"
                  ],
                  "CabinBaggage": [
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "91.42",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "91.42",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "40.85",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "11.63",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "29.22",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "132.27",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T06:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T22:05:00",
                      "Eticket": true,
                      "FlightNumber": "206",
                      "JourneyDuration": "325",
                      "MarketingAirlineCode": "OD",
                      "MarketingAirlineName": "Batik Air",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "OD",
                        "Name": "Batik Air",
                        "Equipment": "738",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "X",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "325",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 0
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "OD",
            "TicketAdvisory": "TICKETS ARE NON-REFUNDABLE \nLAST TKT DTE 24MAY25 - SEE ADV PURCHASE \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB13[TBO]MpM4ylahAoGJ3g6N2TCrKHkvOoaxEkg/LjI77UHwFhz/i3dPrcc+l3/h9OYgY7zbZSnL+v5yr6JUafpbnzsnPFQLTE+RgDVZL8BVPR9lB0ItTv2qvtl2JROU+VMdGG+dDQXJ2ChYuSVL1K3UboZ/rKErUO63i6loYIJJB9zQj2VHoIiN5cDEZYFZziTOyS9jgyRjV/EPXd2F6yRIOMXHB11SccgvVwsSnKPZwYf+AVBwaWMReBfVy10ClipCYef5QBDg4UBxezTqihhbbEmgbmeCwiJlQaL1FQXkqZ87AJtezZJAFpnCSg87K2i1ebVSoI10DX+pqjmexNtZOAWgLME6TjzE2SJ4WuKJ17VyrWXy2/RmLRr1c5xOwbGB/YyT6v73EvAsRn2cIsl1bgI6UJCUWjI3lUk7aRllwBhrD9sW/fabVdroDXroTBFDzoyYdjlXl/cwg+T+qjZ/p7vT1rHlvAhF1+PN8Wpv1hxDSN0KER3mM3DXGM4qvVtpCh/T3DmfjqL5ySRuZElCElDqFexnvsSOKf8/Wx8CjMZtseUV40xjn/Yu+3/DSWwwn/Rgtm3lq7ORH37EhvCj97dgYMmcy4OGHJuEfbLCcRysVjIxzPVxTCP7Kf/cB5E0z/10-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB13[TBO]MpM4ylahAoGJ3g6N2TCrKHkvOoaxEkg/LjI77UHwFhz/i3dPrcc+l3/h9OYgY7zbZSnL+v5yr6JUafpbnzsnPFQLTE+RgDVZL8BVPR9lB0ItTv2qvtl2JROU+VMdGG+dDQXJ2ChYuSVL1K3UboZ/rKErUO63i6loYIJJB9zQj2VHoIiN5cDEZYFZziTOyS9jgyRjV/EPXd2F6yRIOMXHB11SccgvVwsSnKPZwYf+AVBwaWMReBfVy10ClipCYef5QBDg4UBxezTqihhbbEmgbmeCwiJlQaL1FQXkqZ87AJtezZJAFpnCSg87K2i1ebVSoI10DX+pqjmexNtZOAWgLME6TjzE2SJ4WuKJ17VyrWXy2/RmLRr1c5xOwbGB/YyT6v73EvAsRn2cIsl1bgI6UJCUWjI3lUk7aRllwBhrD9sW/fabVdroDXroTBFDzoyYdjlXl/cwg+T+qjZ/p7vT1rHlvAhF1+PN8Wpv1hxDSN0KER3mM3DXGM4qvVtpCh/T3DmfjqL5ySRuZElCElDqFexnvsSOKf8/Wx8CjMZtseUV40xjn/Yu+3/DSWwwn/Rgtm3lq7ORH37EhvCj97dgYMmcy4OGHJuEfbLCcRysVjIxzPVxTCP7Kf/cB5E0z/10",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "89.44",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "89.44",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "72.28",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "161.72",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "89.44",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "89.44",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "72.28",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "39.79",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "1.86",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "30.62",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "161.72",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T20:55:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T12:55:00",
                      "Eticket": true,
                      "FlightNumber": "384",
                      "JourneyDuration": "330",
                      "MarketingAirlineCode": "AI",
                      "MarketingAirlineName": "Air India",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "AI",
                        "Name": "Air India",
                        "Equipment": "32N",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "U",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "330",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 0
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "AI",
            "TicketAdvisory": "TICKETS ARE NON-REFUNDABLE \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB14[TBO]gLjcmgBswySJacHpnMpSWuQJQyQxc6Va3a38PP3KzetdEd+OexGv2Qi86M7T1kopp67CLYiLI2XJUE9Vbo64VNSJplQSJozw6x5ha2f4SMGkyM9+z3X2QzuCxW2uz5s6vAdZHIFfDkxKewKlTV6zo9lwNWbOUEqsSMuTY2o+Mh7D0TWtrBCL3NJl/eX3amwjjShNwVAzSFAKBI0WOp4wxhM8APN2dk8j4kd7dIrhILXggVo81Qa6i1uji+XtQTe/VTK0YyK9tBAnXwpusS2msucPoYT2ambdq7delZAfr65ZGl6YjFrJY1QxgJKvBmLbPn8InPjs49ytHs4tQIs3jb8kRlI1XApLvlXz0+2pkWCR1BHZ5FB9jhPYUMWyEOQLarusMLrVb5l8YLT5eCVJlCN8LAKzlXYxU0PY9lCxKWbeydwHBxF03H0LMhSTH9T486QdDDfETM0ckVpfwklLeqcgwzQZas8iSnvjuMmWN2+10cwSchl3Lsex3V3sY3AHSok8sN03uMG9oBngc1aFXbhkAszqHehEguGvuzWLzWAdKjex8zq7MzLSbm+RQTI4BH+1lq38Mqtj9/50EQ/L6Y+dlzlOiESwOBfeeTLoAj4=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB14[TBO]gLjcmgBswySJacHpnMpSWuQJQyQxc6Va3a38PP3KzetdEd+OexGv2Qi86M7T1kopp67CLYiLI2XJUE9Vbo64VNSJplQSJozw6x5ha2f4SMGkyM9+z3X2QzuCxW2uz5s6vAdZHIFfDkxKewKlTV6zo9lwNWbOUEqsSMuTY2o+Mh7D0TWtrBCL3NJl/eX3amwjjShNwVAzSFAKBI0WOp4wxhM8APN2dk8j4kd7dIrhILXggVo81Qa6i1uji+XtQTe/VTK0YyK9tBAnXwpusS2msucPoYT2ambdq7delZAfr65ZGl6YjFrJY1QxgJKvBmLbPn8InPjs49ytHs4tQIs3jb8kRlI1XApLvlXz0+2pkWCR1BHZ5FB9jhPYUMWyEOQLarusMLrVb5l8YLT5eCVJlCN8LAKzlXYxU0PY9lCxKWbeydwHBxF03H0LMhSTH9T486QdDDfETM0ckVpfwklLeqcgwzQZas8iSnvjuMmWN2+10cwSchl3Lsex3V3sY3AHSok8sN03uMG9oBngc1aFXbhkAszqHehEguGvuzWLzWAdKjex8zq7MzLSbm+RQTI4BH+1lq38Mqtj9/50EQ/L6Y+dlzlOiESwOBfeeTLoAj4=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "158.01",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "158.01",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.42",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "200.43",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "158.01",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "158.01",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.42",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "9.96",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "32.46",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "200.43",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T21:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T13:15:00",
                      "Eticket": true,
                      "FlightNumber": "173",
                      "JourneyDuration": "340",
                      "MarketingAirlineCode": "MH",
                      "MarketingAirlineName": "Malaysia Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "MH",
                        "Name": "Malaysia Airlines",
                        "Equipment": "7M8",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "340",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 0
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "MH",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB15[TBO]CKZJ7nDf+fTnb81MZGymtfS1VpwR/6yPRVyGLgnlgUxqObwr7SWp03A8nOAxkIOMcmbD2BIcZvYkR2xNne7U/VOrlxy2cE/1vEUZoTDrdCmMhf5zh4E+cc7TK7nwU3hIuPOg7pW6zDpovvgG6FbQm4HqlYMSPQTJGT50fmQzIxkkbnoH55JhIaL7ZHPvQ6KkSv8/Ud+3MXsNsOB6TXfOzi3ZgFBv1pLMUzrc0D8n4n+EHm1ABax38skAuiOi2emfCCRiuFvUgmIDLdI96eu+8S989IHs6I5WcK6eubluUnY6s+H64RZNdzTSoQJpThq9BCzRxj/aoidLvEDn+A6oi5Fg0mGxDYVXPs8dmc9ewsewb+i87UQkDVSjwkRK/DbugVGWW1QmOcCFo2JGoa/Vxwtqt0uFuxu6Q7aF/Cpd3GmNSDEX34w+Tr2SGAn5TkweUKkf5+o5KEgfCIg/VLErxfsU9Pet0AXfRh1Ck/ytXk7IkV011rFHg+5zRToXlkTmTS+TjOoBqnGhNNvZKHHU9sreac66Kpf55odaruQI/+x6QBHa/YlphR8QeFa7E2Vzktnlb2CG2f3OZ0gOe69OFucuoc/tuWi18dF1ioIvEOe9GNHAZOWBPr7Brt+r4RQCw2kMrRJwRTq2gu6B/WcgwoPbfUDS1kGo/3biEXSidZQ2Bn6vohO2VBTCWcQDnt4KBA3ycgnNI2QCapU8tyleDVm0Fzvrq0L0oHCdz6MiSdo=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB15[TBO]CKZJ7nDf+fTnb81MZGymtfS1VpwR/6yPRVyGLgnlgUxqObwr7SWp03A8nOAxkIOMcmbD2BIcZvYkR2xNne7U/VOrlxy2cE/1vEUZoTDrdCmMhf5zh4E+cc7TK7nwU3hIuPOg7pW6zDpovvgG6FbQm4HqlYMSPQTJGT50fmQzIxkkbnoH55JhIaL7ZHPvQ6KkSv8/Ud+3MXsNsOB6TXfOzi3ZgFBv1pLMUzrc0D8n4n+EHm1ABax38skAuiOi2emfCCRiuFvUgmIDLdI96eu+8S989IHs6I5WcK6eubluUnY6s+H64RZNdzTSoQJpThq9BCzRxj/aoidLvEDn+A6oi5Fg0mGxDYVXPs8dmc9ewsewb+i87UQkDVSjwkRK/DbugVGWW1QmOcCFo2JGoa/Vxwtqt0uFuxu6Q7aF/Cpd3GmNSDEX34w+Tr2SGAn5TkweUKkf5+o5KEgfCIg/VLErxfsU9Pet0AXfRh1Ck/ytXk7IkV011rFHg+5zRToXlkTmTS+TjOoBqnGhNNvZKHHU9sreac66Kpf55odaruQI/+x6QBHa/YlphR8QeFa7E2Vzktnlb2CG2f3OZ0gOe69OFucuoc/tuWi18dF1ioIvEOe9GNHAZOWBPr7Brt+r4RQCw2kMrRJwRTq2gu6B/WcgwoPbfUDS1kGo/3biEXSidZQ2Bn6vohO2VBTCWcQDnt4KBA3ycgnNI2QCapU8tyleDVm0Fzvrq0L0oHCdz6MiSdo=",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "106.48",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "106.48",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "102.52",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "209",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "1 PC(s)",
                    "1 PC(s)"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "106.48",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "106.48",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "102.52",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "69.63",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "32.88",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "209",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "HAN",
                      "ArrivalDateTime": "2025-05-31T05:20:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T23:35:00",
                      "Eticket": true,
                      "FlightNumber": "980",
                      "JourneyDuration": "255",
                      "MarketingAirlineCode": "VN",
                      "MarketingAirlineName": "Vietnam Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "VN",
                        "Name": "Vietnam Airlines",
                        "Equipment": "787",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "A",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "255",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T19:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "HAN",
                      "DepartureDateTime": "2025-05-31T14:45:00",
                      "Eticket": true,
                      "FlightNumber": "681",
                      "JourneyDuration": "195",
                      "MarketingAirlineCode": "VN",
                      "MarketingAirlineName": "Vietnam Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "VN",
                        "Name": "Vietnam Airlines",
                        "Equipment": "321",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "T",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "195",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "VN",
            "TicketAdvisory": "TICKETS ARE NON REFUNDABLE AFTER DEPARTURE \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB16[TBO]awCuOmdHrk0ZAJ4aZ3Qr/uXYcycrarMOAb7WOn5dKuu15UbnyPLEK/secYxFu1gqfqtEfHbhBmoBVyZBzOFry9YES1iwF+P+2xoGv3jDGT5j05eCGi0kZe+KIpGRc8I0ofGtQUus1+edX2qypKNTKPnkDgUwPGCZEiIFT/CgIL7YxDyPn9r7OootwsRewtWwIfOe0jQ42cKQfOmddHsdKapuMpeohzXc+0rJ8jJuttbhTt5C2/L7s8fcSFGZzkukEi5xcWxhnNriv701/SvVYaH8bXE//WGhm+0kzIRRyHJnGd7XE1N7daGtpumWuMYBe+YBStr4NQ6Rx2asUL3FhfNHt0wfmlHSN6mJ0uVgudtv7G7xAcauGlTuYEskIDVcVMIeX0lg46BeL05lWnfy9NkWYGv0D53aKn5bsUJj8LmP36foVqfSxPryjrHKXPs7t+kWoBNeOd3K757NfAmf+tdgEId9XEQ10oiipDjH80BnD4m80/VjZLV77T3JAI567AET7Hs7NSrf/QVjt9WIvg4Uf9dNAWDkeJJBbf2Qlf68lslM+jbeg9EZCpp6UzUbvomxbeBMb97efNHa9E6FU76wTq/VwoSW9d+vQuGqwnV7Q7UNcGl00RwGtA8aJcrVpHwjpxqWIsdb3sfp3ZsW5tM8mqnw+jLAlTjO2fiLtcqj1wEsnDv/7CKe017yncsX8RO1YiSUvPDrGMSG0Tg8wg==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB16[TBO]awCuOmdHrk0ZAJ4aZ3Qr/uXYcycrarMOAb7WOn5dKuu15UbnyPLEK/secYxFu1gqfqtEfHbhBmoBVyZBzOFry9YES1iwF+P+2xoGv3jDGT5j05eCGi0kZe+KIpGRc8I0ofGtQUus1+edX2qypKNTKPnkDgUwPGCZEiIFT/CgIL7YxDyPn9r7OootwsRewtWwIfOe0jQ42cKQfOmddHsdKapuMpeohzXc+0rJ8jJuttbhTt5C2/L7s8fcSFGZzkukEi5xcWxhnNriv701/SvVYaH8bXE//WGhm+0kzIRRyHJnGd7XE1N7daGtpumWuMYBe+YBStr4NQ6Rx2asUL3FhfNHt0wfmlHSN6mJ0uVgudtv7G7xAcauGlTuYEskIDVcVMIeX0lg46BeL05lWnfy9NkWYGv0D53aKn5bsUJj8LmP36foVqfSxPryjrHKXPs7t+kWoBNeOd3K757NfAmf+tdgEId9XEQ10oiipDjH80BnD4m80/VjZLV77T3JAI567AET7Hs7NSrf/QVjt9WIvg4Uf9dNAWDkeJJBbf2Qlf68lslM+jbeg9EZCpp6UzUbvomxbeBMb97efNHa9E6FU76wTq/VwoSW9d+vQuGqwnV7Q7UNcGl00RwGtA8aJcrVpHwjpxqWIsdb3sfp3ZsW5tM8mqnw+jLAlTjO2fiLtcqj1wEsnDv/7CKe017yncsX8RO1YiSUvPDrGMSG0Tg8wg==",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "62.81",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "62.81",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "156.15",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "218.95",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "23 KG",
                    "23 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "62.81",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "62.81",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "156.15",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "111.41",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "9.96",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "34.78",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "218.95",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "BKK",
                      "ArrivalDateTime": "2025-05-31T05:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T23:30:00",
                      "Eticket": true,
                      "FlightNumber": "316",
                      "JourneyDuration": "265",
                      "MarketingAirlineCode": "TG",
                      "MarketingAirlineName": "Thai Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "TG",
                        "Name": "Thai Airways",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "L",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "265",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T12:15:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "BKK",
                      "DepartureDateTime": "2025-05-31T09:05:00",
                      "Eticket": true,
                      "FlightNumber": "415",
                      "JourneyDuration": "130",
                      "MarketingAirlineCode": "TG",
                      "MarketingAirlineName": "Thai Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "TG",
                        "Name": "Thai Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "L",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "130",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "TG",
            "TicketAdvisory": "TICKETS ARE NON-REFUNDABLE \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB50[TBO]oZvNyG9oF3fzigjpPnSShCIk4c+KOIz03YTpENo6VTTcKpjFvFHOjXanLvg4UTqx/KA8W6FNxLZBAeu4VrJ1YXvjcw0rpbqGiQLQJOD+OqyagYpPIC6F8V5UslBvraVAPZrzudD8t+e9B1QANLc8v7HNyvqvbasHnvICSEyTdx0ssUG5s9n86OHsfP+bDdKR7vBRj1ztuGP5ZmXlVDHtnEqaXY4a4tIUfbZU+c7CucjGebIojKnbyY5fNmQyPWq4BROSDbefT0TCijh6LJqoY5GaR/CZ/YKvgQ8U5sqk2L7N2dXyNexs2uk8/hECQrPW0q+mbLq4koQA4hdZiTs8kpcL0seNtH4BoJzscTGohwRzatreue83O0/QDE4VrHhsKxamlu32iiWJwvzbY6x0NxlDPgI9CL/np67vI+hbl2Oo5WgxVP4SVts7tSR5vi25HajtzmDKJ3pYLngHc4h4rgL6zkw0dfaRe/4Wwv35G2YTbkjkzj7P1xQ/J1vY5tmEe66lp6zyHQ9EI5MJz1iEykOSQoS5T+2mAd2hqk/tBIp3Ud606dGmuhpYo20+HZA33TViLExz9PgOgXZhzfA3J3k7H+kKUM73HtMT4J9qdiA3veiixTAR5dPmB/POfAq125RMg8lwrh2Tci7aE/dDa29aPzUs9Ce8kBjK68CcPN8=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB50[TBO]oZvNyG9oF3fzigjpPnSShCIk4c+KOIz03YTpENo6VTTcKpjFvFHOjXanLvg4UTqx/KA8W6FNxLZBAeu4VrJ1YXvjcw0rpbqGiQLQJOD+OqyagYpPIC6F8V5UslBvraVAPZrzudD8t+e9B1QANLc8v7HNyvqvbasHnvICSEyTdx0ssUG5s9n86OHsfP+bDdKR7vBRj1ztuGP5ZmXlVDHtnEqaXY4a4tIUfbZU+c7CucjGebIojKnbyY5fNmQyPWq4BROSDbefT0TCijh6LJqoY5GaR/CZ/YKvgQ8U5sqk2L7N2dXyNexs2uk8/hECQrPW0q+mbLq4koQA4hdZiTs8kpcL0seNtH4BoJzscTGohwRzatreue83O0/QDE4VrHhsKxamlu32iiWJwvzbY6x0NxlDPgI9CL/np67vI+hbl2Oo5WgxVP4SVts7tSR5vi25HajtzmDKJ3pYLngHc4h4rgL6zkw0dfaRe/4Wwv35G2YTbkjkzj7P1xQ/J1vY5tmEe66lp6zyHQ9EI5MJz1iEykOSQoS5T+2mAd2hqk/tBIp3Ud606dGmuhpYo20+HZA33TViLExz9PgOgXZhzfA3J3k7H+kKUM73HtMT4J9qdiA3veiixTAR5dPmB/POfAq125RMg8lwrh2Tci7aE/dDa29aPzUs9Ce8kBjK68CcPN8=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-31T06:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T21:55:00",
                      "Eticket": true,
                      "FlightNumber": "403",
                      "JourneyDuration": "345",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "388",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 8
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "345",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T13:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T12:40:00",
                      "Eticket": true,
                      "FlightNumber": "114",
                      "JourneyDuration": "70",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "7M8",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 8
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "70",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB49[TBO]Bg77mX+M3nFJ1CDhWvl3YUxldH6361/nfj0C72SKFqJNjUo0eYZ7MOZu391T3Ole00uy1hGjAV+XOV6t/0H/u4DtdlEZO6TDSGL8aN7Dqz7yJp+P/MiVtRFbtkYQ5+GdQZb/AO2VGrDESxwQRzIBy5HqroyHT78h/6gdbSMt3tkETM50M4Pcv7GTnPEccAv9DNXzHLVRAusZIAx7IzmqftuKKV+EHBUh7lLJOaZCGGHa5TdvQHXxTZGhKZsLuXpcxOHXc66y83OS9Wv8Gec3fQwvBuO3yCuLcE85xrEcKzYq1EjpM6IwQHGbbo3UZH5UqyVcgWRrV4CYFwVa/ZW20YuYHzY5OiUx4VfGGIuC8unFgiu//6ST2En3umBOujmQkpVyjU2ILiZxcWYyrZ0mSZhSD2+dTVcOYM87VJeE7wI8A0xbl/vQ5jk5SOzVIy4Z2hHYL2+REaHoyyA1WNNLOsSSBWcjwX1IWYZIRs7tnZ3it0boR1GTFVWHstbcngQbxMYpu5BrlkRdS24uiA2I+GNe8UUvjq604kFOgzh84BQmXDvGQEAYGm/KocCy+8ZH+kckQ+BL214OWnG21vK7QgHmhXbWrWk7OAb6NjlBWXTh49oV54gFa8cypwxgiMBTRQcqGyazBD3rxmNTJiW/4YfBb7Uy8EODKLZSrl28kuI=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB49[TBO]Bg77mX+M3nFJ1CDhWvl3YUxldH6361/nfj0C72SKFqJNjUo0eYZ7MOZu391T3Ole00uy1hGjAV+XOV6t/0H/u4DtdlEZO6TDSGL8aN7Dqz7yJp+P/MiVtRFbtkYQ5+GdQZb/AO2VGrDESxwQRzIBy5HqroyHT78h/6gdbSMt3tkETM50M4Pcv7GTnPEccAv9DNXzHLVRAusZIAx7IzmqftuKKV+EHBUh7lLJOaZCGGHa5TdvQHXxTZGhKZsLuXpcxOHXc66y83OS9Wv8Gec3fQwvBuO3yCuLcE85xrEcKzYq1EjpM6IwQHGbbo3UZH5UqyVcgWRrV4CYFwVa/ZW20YuYHzY5OiUx4VfGGIuC8unFgiu//6ST2En3umBOujmQkpVyjU2ILiZxcWYyrZ0mSZhSD2+dTVcOYM87VJeE7wI8A0xbl/vQ5jk5SOzVIy4Z2hHYL2+REaHoyyA1WNNLOsSSBWcjwX1IWYZIRs7tnZ3it0boR1GTFVWHstbcngQbxMYpu5BrlkRdS24uiA2I+GNe8UUvjq604kFOgzh84BQmXDvGQEAYGm/KocCy+8ZH+kckQ+BL214OWnG21vK7QgHmhXbWrWk7OAb6NjlBWXTh49oV54gFa8cypwxgiMBTRQcqGyazBD3rxmNTJiW/4YfBb7Uy8EODKLZSrl28kuI=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-31T06:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T21:55:00",
                      "Eticket": true,
                      "FlightNumber": "403",
                      "JourneyDuration": "345",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "388",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 7
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "345",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T10:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T09:10:00",
                      "Eticket": true,
                      "FlightNumber": "108",
                      "JourneyDuration": "60",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "359",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "60",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB48[TBO]E+suf35HLWPvbH9ntdwQ5s5CviTzKrL55UwSolu7g4C1ztv2OdmdzJpJ3MRSG+XzzRYQKE5b8/yMYe/ccXp/fk7WWqIzz3UP6HB54KlLXAZaq0Zh4rHoWK0f4Yxu3tWLxf/YXRqXN4viDxl8vXrCYp7cxf9um8ysbMVYzba9HJkXOp8DKP6q9xF1irPD8Xus2cP6DEUuOn8uFvw6fzZJysz7BwlPIrRDlEIBZddBYOkVeztMJD5Bsi5joyYoLicaOe5GOdn0AgBnf6toc3XscsrlY/GPDOCLHX1epBOVGOK+3yK2X0OxUL7XgmntZn54Iz9Sp2iWdXOWIy524lLXdM9cmQ9rwYZMqhhXH29FGpLPPUI7fCOkPw1PCBk4Pnlfv73yQ0jicfKilNg7q5/nUw1h5MekqKWeAnF1468wn24q8k2Uvu8b7V3gtsanBigoILV3pxNl3Zp8fmkyUIHEPUhxgUQj9cI86Od2qVsgeyXjMTK3U8WWCEEjJcz5rQBQRhSJf1cadwmUgv/WnYboI+nENgK4hb3vIWecJSnjyxa63EQErdte1RZis6LZ4vWEt5B3NedqGnttx25sXq0qf4UZKQk+Vil7GuWuvz7jZgmw4U5HMpfbCO3+BqP6NPJLzFXfYSX2bEPfODj96EekIxiDGeFXlcQo/9u/dxlrx+M=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB48[TBO]E+suf35HLWPvbH9ntdwQ5s5CviTzKrL55UwSolu7g4C1ztv2OdmdzJpJ3MRSG+XzzRYQKE5b8/yMYe/ccXp/fk7WWqIzz3UP6HB54KlLXAZaq0Zh4rHoWK0f4Yxu3tWLxf/YXRqXN4viDxl8vXrCYp7cxf9um8ysbMVYzba9HJkXOp8DKP6q9xF1irPD8Xus2cP6DEUuOn8uFvw6fzZJysz7BwlPIrRDlEIBZddBYOkVeztMJD5Bsi5joyYoLicaOe5GOdn0AgBnf6toc3XscsrlY/GPDOCLHX1epBOVGOK+3yK2X0OxUL7XgmntZn54Iz9Sp2iWdXOWIy524lLXdM9cmQ9rwYZMqhhXH29FGpLPPUI7fCOkPw1PCBk4Pnlfv73yQ0jicfKilNg7q5/nUw1h5MekqKWeAnF1468wn24q8k2Uvu8b7V3gtsanBigoILV3pxNl3Zp8fmkyUIHEPUhxgUQj9cI86Od2qVsgeyXjMTK3U8WWCEEjJcz5rQBQRhSJf1cadwmUgv/WnYboI+nENgK4hb3vIWecJSnjyxa63EQErdte1RZis6LZ4vWEt5B3NedqGnttx25sXq0qf4UZKQk+Vil7GuWuvz7jZgmw4U5HMpfbCO3+BqP6NPJLzFXfYSX2bEPfODj96EekIxiDGeFXlcQo/9u/dxlrx+M=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-30T17:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:00:00",
                      "Eticket": true,
                      "FlightNumber": "401",
                      "JourneyDuration": "355",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "787",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 7
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "355",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T21:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-30T20:00:00",
                      "Eticket": true,
                      "FlightNumber": "128",
                      "JourneyDuration": "70",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "7M8",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 6
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "70",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB47[TBO]zLlIIIwRUVsnhn9AwoID+Wz/HRWO0BEMwwZHhGVsnBL/gWhHwta3fXn9KHUQzPELqSiD08faseeuA2jhBQWq/IJqY+ZML/FUyzA/jWKFW0WpAZC+AhjUAqRHsAS+g5np3EQ/7aZ/AZkqX6RTWlZN3qp0uuWwD2obxAWcfWOdWGLtpZjXccwXTm020uTOkSYE7+S25X8pVBLop6ht9xMw18qbiyd01xUy4gkr8LjbwMxNaTVxvLUo5ff7MfrIWZ1ITOevcc98StgJP9UTtGg5hr2wtUPtCH961BcfC5pxG1KkuTCJBCGmBsZIBMuYgNZhvlB+NMgrr3Yl7jTuUvMi/ZgItPNwrSCb+5J+1VYQZaZ4Ra7uDcT8kbkzKgxVecKvWAFKhM4P3XhoyoGLTKmvs421Kpf2469FQMvHw2t8C8uogh7hoJGfcSpvVAaBFfvD7XkrH0qImjuV/r8lk5ySW/mN2ZFIjfbBELnYxXDVeluhFGlrrrLagok3e+JmeV9Gv9QlKw6wfdcw3NBdAOi37LFm1Xo0v93nKrQ/lfNgGrJRQnPDxDZmJYB8uKGb65/BRcta3htR+N6pRzBrdfwjH9kzVHC2N4iTU8rmjqm6TZKaHyiaPSnDDYJoDVms6ZSrqHPTzbYAUnv7RFjL4jwQ70NcuqzD1wt9HJp02CBjv2o=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB47[TBO]zLlIIIwRUVsnhn9AwoID+Wz/HRWO0BEMwwZHhGVsnBL/gWhHwta3fXn9KHUQzPELqSiD08faseeuA2jhBQWq/IJqY+ZML/FUyzA/jWKFW0WpAZC+AhjUAqRHsAS+g5np3EQ/7aZ/AZkqX6RTWlZN3qp0uuWwD2obxAWcfWOdWGLtpZjXccwXTm020uTOkSYE7+S25X8pVBLop6ht9xMw18qbiyd01xUy4gkr8LjbwMxNaTVxvLUo5ff7MfrIWZ1ITOevcc98StgJP9UTtGg5hr2wtUPtCH961BcfC5pxG1KkuTCJBCGmBsZIBMuYgNZhvlB+NMgrr3Yl7jTuUvMi/ZgItPNwrSCb+5J+1VYQZaZ4Ra7uDcT8kbkzKgxVecKvWAFKhM4P3XhoyoGLTKmvs421Kpf2469FQMvHw2t8C8uogh7hoJGfcSpvVAaBFfvD7XkrH0qImjuV/r8lk5ySW/mN2ZFIjfbBELnYxXDVeluhFGlrrrLagok3e+JmeV9Gv9QlKw6wfdcw3NBdAOi37LFm1Xo0v93nKrQ/lfNgGrJRQnPDxDZmJYB8uKGb65/BRcta3htR+N6pRzBrdfwjH9kzVHC2N4iTU8rmjqm6TZKaHyiaPSnDDYJoDVms6ZSrqHPTzbYAUnv7RFjL4jwQ70NcuqzD1wt9HJp02CBjv2o=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-31T06:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T21:55:00",
                      "Eticket": true,
                      "FlightNumber": "403",
                      "JourneyDuration": "345",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "388",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "345",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T09:30:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T08:30:00",
                      "Eticket": true,
                      "FlightNumber": "106",
                      "JourneyDuration": "60",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "359",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 6
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "60",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB46[TBO]d3dZSZRkYxC5u1VLhx/hvA6kF3IE8kJUj7gpLJkYTtDazM2UfX24Wn0wCs0LeYpGemEDtsBTN3NELqtEt+swdiA+xhY40IuKg7i+u+4Tec+LqpQq0L0buNShLWqfVa5eGjBPp2iLtDtW2Mz/MYcgXTBtxZCDUzImaqA1z1712SXyWJXt0HCqplT5h9HCpg6aaPhFP9lgLQMc0BfIA2KcyvHS5WNLPVTNwOko12qyU/oJiM4bh8Npr0PIDtGJwmiO7DZjLWtrDmSfqHh6JmeIUeYnoKVL5UevHarBSZ2LNjiOxsDlQDBkqoDAy2EuPb3sVzhiBTxMiBGD56KnHpiWh09Ku0Aib7X6L38nC0cpkUaOZlylxvKl7dymHuDbGHgsNeTqrPWSFPHuV2JlvDkBG7zeWDX4bmrjtlhTC8z3A2EwlLkRGZWj0DOe/xdQk2moNVUb3N0akLm283pxk0n9T5rmjAws5wwmI9SDyl10cc5Gq5+gPeDxo80N1bT9cZj89/6VqjAFKthrXDatQGfLZNc7JtLOZBlsv3WZ9aBlMMFh+8QLvrExba0tBW0aram4NtAIjh9BBh9useJiAdzgRhJbrlDGe4TQVe8bf+Lx8TYNj1zZxCdFagnxKz9UDuio0f1t3s1UzIK5v/3Uf141U9C4gDBQlDR36vaiaYLesLU=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB46[TBO]d3dZSZRkYxC5u1VLhx/hvA6kF3IE8kJUj7gpLJkYTtDazM2UfX24Wn0wCs0LeYpGemEDtsBTN3NELqtEt+swdiA+xhY40IuKg7i+u+4Tec+LqpQq0L0buNShLWqfVa5eGjBPp2iLtDtW2Mz/MYcgXTBtxZCDUzImaqA1z1712SXyWJXt0HCqplT5h9HCpg6aaPhFP9lgLQMc0BfIA2KcyvHS5WNLPVTNwOko12qyU/oJiM4bh8Npr0PIDtGJwmiO7DZjLWtrDmSfqHh6JmeIUeYnoKVL5UevHarBSZ2LNjiOxsDlQDBkqoDAy2EuPb3sVzhiBTxMiBGD56KnHpiWh09Ku0Aib7X6L38nC0cpkUaOZlylxvKl7dymHuDbGHgsNeTqrPWSFPHuV2JlvDkBG7zeWDX4bmrjtlhTC8z3A2EwlLkRGZWj0DOe/xdQk2moNVUb3N0akLm283pxk0n9T5rmjAws5wwmI9SDyl10cc5Gq5+gPeDxo80N1bT9cZj89/6VqjAFKthrXDatQGfLZNc7JtLOZBlsv3WZ9aBlMMFh+8QLvrExba0tBW0aram4NtAIjh9BBh9useJiAdzgRhJbrlDGe4TQVe8bf+Lx8TYNj1zZxCdFagnxKz9UDuio0f1t3s1UzIK5v/3Uf141U9C4gDBQlDR36vaiaYLesLU=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-30T17:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:00:00",
                      "Eticket": true,
                      "FlightNumber": "401",
                      "JourneyDuration": "355",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "787",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "355",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T19:45:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-30T18:30:00",
                      "Eticket": true,
                      "FlightNumber": "126",
                      "JourneyDuration": "75",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "359",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 10
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "75",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB55[TBO]0pgrktdt/VtICIi+qXQ6VO5iBT8LlOyWiAOKFmWp0nEMT7fCBCnntMGwoOMCfCLSRxNC49a5gqRb9Vpvh032wy5xpgpqjICuru/TGaUKr3vBYYOThN/vAlyKNiRSL+rurfmGw/kvu23n72zojYI1DV8AMdDGH/I9eAv031jRFw58NTrP2fdKs99B/SdYcrpeeyhzdyXbSCTQNmbAx+X4vk/kJiqceewLsqy2iLBl/xsazuEThUjOCfBLoFcRwW23ipXX0wBzzR0wwMYuzQnrekKJqds575NWqsnuz86tjhC+Eam0mAuWKTHJy4awxMh0VU/BRGBa2+wMhavemWiEXgb92ySjwb7ntftdSzjiNGfovCsQStUskjFkRgy7nO2ab70irPmD4s6+w4wMZUQGiA6DEGwXzLkA3ckaaz+/qP9GUUVwRJVurSYnkxc1uA0hGDRwqREClgHRzenrpBITKvPZuFF6f5Pweh4IZKcG7v2RxUKfnJsawCwIGm5DKY0JXd+qE3zYfQ5HbDV8JwVG5czcNwGKc0KNlf4q0BQ2eOK0vK0ifLOTKSWwRyghsTfbK2lOkiK+0oJYb6gcRp66UIC7BUbOpD7P6K6Nw+XySx6hBL3OOoGXDKGN1scuQXoFq3u1jzqUYd1c55/11j7sc8dXARHTztxUnpYwnvZV+CM=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB55[TBO]0pgrktdt/VtICIi+qXQ6VO5iBT8LlOyWiAOKFmWp0nEMT7fCBCnntMGwoOMCfCLSRxNC49a5gqRb9Vpvh032wy5xpgpqjICuru/TGaUKr3vBYYOThN/vAlyKNiRSL+rurfmGw/kvu23n72zojYI1DV8AMdDGH/I9eAv031jRFw58NTrP2fdKs99B/SdYcrpeeyhzdyXbSCTQNmbAx+X4vk/kJiqceewLsqy2iLBl/xsazuEThUjOCfBLoFcRwW23ipXX0wBzzR0wwMYuzQnrekKJqds575NWqsnuz86tjhC+Eam0mAuWKTHJy4awxMh0VU/BRGBa2+wMhavemWiEXgb92ySjwb7ntftdSzjiNGfovCsQStUskjFkRgy7nO2ab70irPmD4s6+w4wMZUQGiA6DEGwXzLkA3ckaaz+/qP9GUUVwRJVurSYnkxc1uA0hGDRwqREClgHRzenrpBITKvPZuFF6f5Pweh4IZKcG7v2RxUKfnJsawCwIGm5DKY0JXd+qE3zYfQ5HbDV8JwVG5czcNwGKc0KNlf4q0BQ2eOK0vK0ifLOTKSWwRyghsTfbK2lOkiK+0oJYb6gcRp66UIC7BUbOpD7P6K6Nw+XySx6hBL3OOoGXDKGN1scuQXoFq3u1jzqUYd1c55/11j7sc8dXARHTztxUnpYwnvZV+CM=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-30T17:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:00:00",
                      "Eticket": true,
                      "FlightNumber": "401",
                      "JourneyDuration": "355",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "787",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 5
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "355",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T09:30:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T08:30:00",
                      "Eticket": true,
                      "FlightNumber": "106",
                      "JourneyDuration": "60",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "359",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 10
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "60",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB54[TBO]OhETvM4t0/0tCwcwtKsOseT+WshcMS3mdkZqmgPm0YzoAFnS+poBFvQ5ESu4kdlsuY6Z/K/GNVJ9FKl0anT37LZL4oIIVsXF0RvqLj5tYV6lMuRBWEntksZSfrFNjhpK10Ht/8a3+CSGGgZhStVwX83BVpkGxqKb+tbTEVXxaEGDa2yiiKT/3ZpY4j+IdXfSwiau8kNMPR4Sjp9SbcNuspgC7cMzmwDlvKTMNpWUNvJM30Sux3SheCSP+4ks2S14kgzaYWLKwwh756UpXnpRK/a9iTn6dCXpWL+7+VFt5/wjZn6pszoWRvgTofz85zWEhXHKp/y/vewKElnYPRgsCNGjM5fHTKO8VwuiXMNRtxg5LnUdSkRYlc59uL7sGkkFbW1lI+NxEK9dsleAN0k13ItnY3iiZ9+XAkxFg3uAOjvteqepLQSjUtT0Ibip8fD955bH06+4/vPtHiqfZR/pObeogMX3FMcohu2FmlIW6z+je3Ta/7Wy06/2KdnqgvQl6/dLxAn7yTFv6zO2MD/JWXpvyBvveCm79Xho4UX+ZaWLrQCNYXNltpU5Am7KpdhYTLzUCmkSLKJNpSSaU+Su35yPID7Yik/alDJbyO5gEGeo1NuVO8qJoNsIxH+xLeBAcNNEj5hw0ZQY55aZN6wIIKiddGIT00ii520NHfM/Ttc=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB54[TBO]OhETvM4t0/0tCwcwtKsOseT+WshcMS3mdkZqmgPm0YzoAFnS+poBFvQ5ESu4kdlsuY6Z/K/GNVJ9FKl0anT37LZL4oIIVsXF0RvqLj5tYV6lMuRBWEntksZSfrFNjhpK10Ht/8a3+CSGGgZhStVwX83BVpkGxqKb+tbTEVXxaEGDa2yiiKT/3ZpY4j+IdXfSwiau8kNMPR4Sjp9SbcNuspgC7cMzmwDlvKTMNpWUNvJM30Sux3SheCSP+4ks2S14kgzaYWLKwwh756UpXnpRK/a9iTn6dCXpWL+7+VFt5/wjZn6pszoWRvgTofz85zWEhXHKp/y/vewKElnYPRgsCNGjM5fHTKO8VwuiXMNRtxg5LnUdSkRYlc59uL7sGkkFbW1lI+NxEK9dsleAN0k13ItnY3iiZ9+XAkxFg3uAOjvteqepLQSjUtT0Ibip8fD955bH06+4/vPtHiqfZR/pObeogMX3FMcohu2FmlIW6z+je3Ta/7Wy06/2KdnqgvQl6/dLxAn7yTFv6zO2MD/JWXpvyBvveCm79Xho4UX+ZaWLrQCNYXNltpU5Am7KpdhYTLzUCmkSLKJNpSSaU+Su35yPID7Yik/alDJbyO5gEGeo1NuVO8qJoNsIxH+xLeBAcNNEj5hw0ZQY55aZN6wIIKiddGIT00ii520NHfM/Ttc=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-31T06:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T21:55:00",
                      "Eticket": true,
                      "FlightNumber": "403",
                      "JourneyDuration": "345",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "388",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 7
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "345",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T21:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T20:00:00",
                      "Eticket": true,
                      "FlightNumber": "128",
                      "JourneyDuration": "70",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "7M8",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 5
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "70",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB45[TBO]dQMuWWHPhu7jxL1n8oFcSR/maNKHEKmv51CUbxu8qadFoYqix5r6t7hi5IA91hOawfv3AHZXvhUWt8a74FrfdnePZLPs1HRvok4A9IQvNx/MJsmCL4QNA8StykdH9q+I4BJLGP6TSmcSExRoYe63avs5u5I/sbzhJPFTXRiiSXHvKgAZl8p31/6t24hO2DvAoHtuJj7DHjIeikZMq3d660Mmn4Ei9wvwCJv2hFzYijPRtq7K+z5zjUPHtsO/z+vOYsY9qipHjyQ+msTa2azyzcZHdiQNVbrUmX6KZ6t57C2e45Y1rB4UV4HKYWNe0804a8kOctZwHb+dnNimkSlcWr4rufNrvvCsTw0vVxtFKxNA8XfNWN+mAcPH+qp/p4cM3e1XCvEgswNWkaVoYwjPTlslLj9RUAALMH3BNAeTbE+T8LrRBdiIhUZ6YT1KhGR3CfhaM1VplI7N4HxMqdthI2Wsunf1Egf+bNz4eV8eu+C9iKX5RP7oIDqHjY6BarfpfFx/Hoyw/kjGcQqdFxVsBR/vq9N3WtShn4usbGT0mAU2nz/wo3u3H47o/f8C9N/tOUfRESdcvxNMEGGsvFg82vBLOg0M3HOGP88L5MDYpb6/sFNvvbvXY6bMfZVSn7Tc3IOxMpTsUyesoDmiP3Az5jSf03vx5qIZNwLdX0LyvFQ=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB45[TBO]dQMuWWHPhu7jxL1n8oFcSR/maNKHEKmv51CUbxu8qadFoYqix5r6t7hi5IA91hOawfv3AHZXvhUWt8a74FrfdnePZLPs1HRvok4A9IQvNx/MJsmCL4QNA8StykdH9q+I4BJLGP6TSmcSExRoYe63avs5u5I/sbzhJPFTXRiiSXHvKgAZl8p31/6t24hO2DvAoHtuJj7DHjIeikZMq3d660Mmn4Ei9wvwCJv2hFzYijPRtq7K+z5zjUPHtsO/z+vOYsY9qipHjyQ+msTa2azyzcZHdiQNVbrUmX6KZ6t57C2e45Y1rB4UV4HKYWNe0804a8kOctZwHb+dnNimkSlcWr4rufNrvvCsTw0vVxtFKxNA8XfNWN+mAcPH+qp/p4cM3e1XCvEgswNWkaVoYwjPTlslLj9RUAALMH3BNAeTbE+T8LrRBdiIhUZ6YT1KhGR3CfhaM1VplI7N4HxMqdthI2Wsunf1Egf+bNz4eV8eu+C9iKX5RP7oIDqHjY6BarfpfFx/Hoyw/kjGcQqdFxVsBR/vq9N3WtShn4usbGT0mAU2nz/wo3u3H47o/f8C9N/tOUfRESdcvxNMEGGsvFg82vBLOg0M3HOGP88L5MDYpb6/sFNvvbvXY6bMfZVSn7Tc3IOxMpTsUyesoDmiP3Az5jSf03vx5qIZNwLdX0LyvFQ=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-31T06:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T21:55:00",
                      "Eticket": true,
                      "FlightNumber": "403",
                      "JourneyDuration": "345",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "388",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 7
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "345",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T08:05:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T07:00:00",
                      "Eticket": true,
                      "FlightNumber": "104",
                      "JourneyDuration": "65",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "7M8",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "65",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB58[TBO]0bUWEP7Pwcl4TVt0ONyOV+4oY4X5w6ZkBFs19wrCVZn4stKROH5T+cN3Cw28dVJ5mG1z8i9/fQnh5wKDDD/QHi7+8AvT4MdEcoa8Z3H0fbl4aZJ2tsTLErwnTCgGn4FAaftzZqsu+Hx0bu+uRMIbbrQ3+bogv4vxugmIK3PDlit+Uk4ubCSSdv8MvA8pj5Iuq1NoqlRVTykWqJxefRCZ4x740s2w2X0nSEN1iz2lIUGYn0kt77VCITHL8uc5DrmfpnQJdqbRwZpOXwVOQoHcqYSxupCNyK7hVJMV+v6Vu8iHCvktu/d+1RpBWdlaVgKZJAwRSIMgQJjzxjz/gWTYlQq2fHxEaICAoFnGw/nxOTOYDMQnaOV7gsD15RDibX4OL0Qfi49VQxVy5RSVuOxumtQwS9zOhQnKfMHJ4drjklfe4UYKkkAraJrLZ/Avf2K+Ag58zkyCKqkifDHbSFWIbE6K6jBHO8iHTAAvTS/SdfeW3MP7kEjhy/dpzAkCvE68V54grvqF+pb4zurY3hrMsHvt0vH7d+LKg0XMVa3IxTP3vbyoIAfsF1tD6VBOJGdJbDWanCK5nbz8qvSf/0ewzjhd/Cb3EstwxkRq8LALhfMofLLH5XlOBywcqURlEwy44+p/mm636SmY1wSj4bjQkkC2ITSFRnuFSDjGaJBV7/s=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB58[TBO]0bUWEP7Pwcl4TVt0ONyOV+4oY4X5w6ZkBFs19wrCVZn4stKROH5T+cN3Cw28dVJ5mG1z8i9/fQnh5wKDDD/QHi7+8AvT4MdEcoa8Z3H0fbl4aZJ2tsTLErwnTCgGn4FAaftzZqsu+Hx0bu+uRMIbbrQ3+bogv4vxugmIK3PDlit+Uk4ubCSSdv8MvA8pj5Iuq1NoqlRVTykWqJxefRCZ4x740s2w2X0nSEN1iz2lIUGYn0kt77VCITHL8uc5DrmfpnQJdqbRwZpOXwVOQoHcqYSxupCNyK7hVJMV+v6Vu8iHCvktu/d+1RpBWdlaVgKZJAwRSIMgQJjzxjz/gWTYlQq2fHxEaICAoFnGw/nxOTOYDMQnaOV7gsD15RDibX4OL0Qfi49VQxVy5RSVuOxumtQwS9zOhQnKfMHJ4drjklfe4UYKkkAraJrLZ/Avf2K+Ag58zkyCKqkifDHbSFWIbE6K6jBHO8iHTAAvTS/SdfeW3MP7kEjhy/dpzAkCvE68V54grvqF+pb4zurY3hrMsHvt0vH7d+LKg0XMVa3IxTP3vbyoIAfsF1tD6VBOJGdJbDWanCK5nbz8qvSf/0ewzjhd/Cb3EstwxkRq8LALhfMofLLH5XlOBywcqURlEwy44+p/mm636SmY1wSj4bjQkkC2ITSFRnuFSDjGaJBV7/s=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-30T17:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:00:00",
                      "Eticket": true,
                      "FlightNumber": "401",
                      "JourneyDuration": "355",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "787",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "355",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T16:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T14:50:00",
                      "Eticket": true,
                      "FlightNumber": "116",
                      "JourneyDuration": "70",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "7M8",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 5
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "70",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB57[TBO]penVo6dT44DsxBzcs8ZGJDrh+VDTz+42eLFrHy3KsJ8AJ6uE9j7oLkWvNWvenrBkPNAlnrW2DU5dPq0Y8VqiGGwcLcDH3n7NhfwJbdGq9tseJHaaFEWkrip/ODM0kQTQqbOcHRit6n9BS+izwf32zDzP+Pqah8c21OgRVcFmb5WfrveAyiGTPzsadfPMCPRSEPSWWC2kvtcd12hPk5SRvKzatUFlyNqGFX18V2edOhEWAdDr4TezRS9kYkXn66LVtNv3MxsAZhi7jTVPmMi4tKCfvNqXZJHV5DsfWEPqA4V2f6gh/VxzbPu9UN8VeI7Y1ji/6o7Qg0zv/nNFjiQFNbWN1/+W4m8qKn6DKkXtU/Ilr9iON1fAtZMbsjYncFMiHtDJH8DXMO4pllfBLINTwZ/k21z3rO54WfMiRycL5Z9yL8e6ZJXJN7/Ejb9xattAn4yzFQqcIS7EgEt2X/7v2F97bq3aJC0LL5lY6NWzHmQJ2vaN6j/13yVLh2BbJpzfZB8vtiRQORoQQIFFpA2Y7vqxoBno7NBZqO8evVqeGZSFhCfg5CKNBvCNVu7IXUE1RdqQBIrgXLKvslHBxM28+t6BCx1PmInY4el7NLuY2NSPr+qxbhohkaUSDhudmo/ZOij5H3rqilb4xbLyOReioNQMkg3b5f6acKI8ugISOPM=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB57[TBO]penVo6dT44DsxBzcs8ZGJDrh+VDTz+42eLFrHy3KsJ8AJ6uE9j7oLkWvNWvenrBkPNAlnrW2DU5dPq0Y8VqiGGwcLcDH3n7NhfwJbdGq9tseJHaaFEWkrip/ODM0kQTQqbOcHRit6n9BS+izwf32zDzP+Pqah8c21OgRVcFmb5WfrveAyiGTPzsadfPMCPRSEPSWWC2kvtcd12hPk5SRvKzatUFlyNqGFX18V2edOhEWAdDr4TezRS9kYkXn66LVtNv3MxsAZhi7jTVPmMi4tKCfvNqXZJHV5DsfWEPqA4V2f6gh/VxzbPu9UN8VeI7Y1ji/6o7Qg0zv/nNFjiQFNbWN1/+W4m8qKn6DKkXtU/Ilr9iON1fAtZMbsjYncFMiHtDJH8DXMO4pllfBLINTwZ/k21z3rO54WfMiRycL5Z9yL8e6ZJXJN7/Ejb9xattAn4yzFQqcIS7EgEt2X/7v2F97bq3aJC0LL5lY6NWzHmQJ2vaN6j/13yVLh2BbJpzfZB8vtiRQORoQQIFFpA2Y7vqxoBno7NBZqO8evVqeGZSFhCfg5CKNBvCNVu7IXUE1RdqQBIrgXLKvslHBxM28+t6BCx1PmInY4el7NLuY2NSPr+qxbhohkaUSDhudmo/ZOij5H3rqilb4xbLyOReioNQMkg3b5f6acKI8ugISOPM=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-30T17:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:00:00",
                      "Eticket": true,
                      "FlightNumber": "401",
                      "JourneyDuration": "355",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "787",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 10
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "355",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T13:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T12:40:00",
                      "Eticket": true,
                      "FlightNumber": "114",
                      "JourneyDuration": "70",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "7M8",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 6
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "70",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB56[TBO]WUWgoPgMNGPMQfT5vfvPmfnD0ngwprr/nKG8hsOaxG/AHTAQA7V2gJCIiZROuseIeAPZtm6sSWVYrRqy0KOnzvYnsDYTkK2CdiErSSvUflMAQVDd6YpMODkCwaEcwePpoufmBNBRQdOQHAfRoUSS65V75BexryT9vGeFVHWRLZ4ygv8rJI5dRrZfRCoy58LQshVe+Ds5Na1uHwpdoeK7Blee16J7egvhLil2CGWh9weVSUvzl//0k7vA+pfunJsogDnkCQXRZ8k9fkZ+2p1BLtINZCXsBuzVyQgXYRv87U2tNp5C/u/qGjhpAOTiTub8B3uHNlaBoa5vTdGbCmeGf7NfCU0boklsVwIh/ASFnz7sw01poImRtinDL0f4Bn0DXjpiDAsZCFF4enQu8K1zLAYpc4wrPxs40P0FQUzrtnbxdmzXRxkNQiDDlZHiH1fVfSFmazze8sqbSgB8Pb5sPvdy88zoBpK6TowaBLBxWjyi1XVHZLITNf0cADWkggHRK8F3vK0JUe6cyrqDSLbFsjtZBwO13opcmi/3bkLoWLArbXIFvnxU3GmwVRzw65MFyy49gbdLAEFzxI3RqAjSGAr5MK+GiaOnml0Zd+RcyPjoVIaqfU/TBd7W2PmLEX622lzwzUB4Y6BhpJ6r/v8YJVrbdO18f5otXSs4Ho3/V70=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB56[TBO]WUWgoPgMNGPMQfT5vfvPmfnD0ngwprr/nKG8hsOaxG/AHTAQA7V2gJCIiZROuseIeAPZtm6sSWVYrRqy0KOnzvYnsDYTkK2CdiErSSvUflMAQVDd6YpMODkCwaEcwePpoufmBNBRQdOQHAfRoUSS65V75BexryT9vGeFVHWRLZ4ygv8rJI5dRrZfRCoy58LQshVe+Ds5Na1uHwpdoeK7Blee16J7egvhLil2CGWh9weVSUvzl//0k7vA+pfunJsogDnkCQXRZ8k9fkZ+2p1BLtINZCXsBuzVyQgXYRv87U2tNp5C/u/qGjhpAOTiTub8B3uHNlaBoa5vTdGbCmeGf7NfCU0boklsVwIh/ASFnz7sw01poImRtinDL0f4Bn0DXjpiDAsZCFF4enQu8K1zLAYpc4wrPxs40P0FQUzrtnbxdmzXRxkNQiDDlZHiH1fVfSFmazze8sqbSgB8Pb5sPvdy88zoBpK6TowaBLBxWjyi1XVHZLITNf0cADWkggHRK8F3vK0JUe6cyrqDSLbFsjtZBwO13opcmi/3bkLoWLArbXIFvnxU3GmwVRzw65MFyy49gbdLAEFzxI3RqAjSGAr5MK+GiaOnml0Zd+RcyPjoVIaqfU/TBd7W2PmLEX622lzwzUB4Y6BhpJ6r/v8YJVrbdO18f5otXSs4Ho3/V70=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-30T17:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:00:00",
                      "Eticket": true,
                      "FlightNumber": "401",
                      "JourneyDuration": "355",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "787",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 7
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "355",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T10:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T09:10:00",
                      "Eticket": true,
                      "FlightNumber": "108",
                      "JourneyDuration": "60",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "359",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 7
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "60",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB53[TBO]sfNaD0nNO+uN9fIQQh5DsoUfMsOM4IbKQl3EDzx6DNNxoVCfqoLCkBZKXLtHTbrvLe4llQcZa2aLju+S6idZQeJeWLaE1vAEnp9P2bPAqYaAFSN9f0slgssA0KmFQ3iaC+ojVkqgFNelQVSkzz43yRrdRGcwwGabFdvuUmSDrdAGQSdtihFGwWtsEDf8LZRC7JD7iHvobYHZbr8bEre1g1g1kUNOuXwLfuCpyFCipPdbrNKOS4CTWounZ7XIffrWDiSLD+psT2zERx69PJI0Ac7xwnBkQ3HoBiCNr2k6EFA1P1D2WrFCGRiTmYVCDU6WI1FrWccmkDtl/l+GyRRZku6zSb6EEp6i9ml8Z3JZhXtREmM1vqAobuSpdoAF8v4/hKT2HU0t436D2JBAff90lYoLL3sv5jcKkpkjCWIEV1C4383h/S1poGdpk8o4/5Ob03IJJlT8GM+VvHB+tLcqxbkXoQQxMiDjnur0h0HPG9IX3vlnRfucfxhsrbpoWnlr/mhoUNlrUNMHEWQBgoqa5Q5ziHqg8QNkbf2tcqb1BbB3ZNPmJkfeRoe73Zfyn/ekWwvWaCSovQW1DCi8f3L356WY1k2t6hczFl5iHPYkzW6+hOflribmFsoW9ckkAWZ2esKlr9LKdqm+lMJaq6u2ywnhmg29ONVG8JyO3nffbZ0=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB53[TBO]sfNaD0nNO+uN9fIQQh5DsoUfMsOM4IbKQl3EDzx6DNNxoVCfqoLCkBZKXLtHTbrvLe4llQcZa2aLju+S6idZQeJeWLaE1vAEnp9P2bPAqYaAFSN9f0slgssA0KmFQ3iaC+ojVkqgFNelQVSkzz43yRrdRGcwwGabFdvuUmSDrdAGQSdtihFGwWtsEDf8LZRC7JD7iHvobYHZbr8bEre1g1g1kUNOuXwLfuCpyFCipPdbrNKOS4CTWounZ7XIffrWDiSLD+psT2zERx69PJI0Ac7xwnBkQ3HoBiCNr2k6EFA1P1D2WrFCGRiTmYVCDU6WI1FrWccmkDtl/l+GyRRZku6zSb6EEp6i9ml8Z3JZhXtREmM1vqAobuSpdoAF8v4/hKT2HU0t436D2JBAff90lYoLL3sv5jcKkpkjCWIEV1C4383h/S1poGdpk8o4/5Ob03IJJlT8GM+VvHB+tLcqxbkXoQQxMiDjnur0h0HPG9IX3vlnRfucfxhsrbpoWnlr/mhoUNlrUNMHEWQBgoqa5Q5ziHqg8QNkbf2tcqb1BbB3ZNPmJkfeRoe73Zfyn/ekWwvWaCSovQW1DCi8f3L356WY1k2t6hczFl5iHPYkzW6+hOflribmFsoW9ckkAWZ2esKlr9LKdqm+lMJaq6u2ywnhmg29ONVG8JyO3nffbZ0=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-30T17:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:00:00",
                      "Eticket": true,
                      "FlightNumber": "401",
                      "JourneyDuration": "355",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "787",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 8
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "355",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T08:05:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T07:00:00",
                      "Eticket": true,
                      "FlightNumber": "104",
                      "JourneyDuration": "65",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "7M8",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 7
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "65",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB51[TBO]q9uHOVkV6kq1IR7/uYS45lLJMH1WW0gXM04uW2eVD+RbEXJJXV7HujTeR8/LnkOwq6pCIfu/oT5dOU99cXF6Y0+xnhcKWhLjJacKrYmxTRUWImpV3RYC+6UbrYZCRgyEsWLs5XsCKwCkuBW7biK6pv4HWpDUVjNLeEyWVqjdtfYjkdcsTTXA/aK+/GCarP0YE7/PqI0y2bDsvdyZO7YEnKrGxpmmnXInruESPEu2rWjc5MuKlUGEGq47gDvzZb2yMUamai6Qm2bYWgV2oqbKV5TaDdjh9vBSrx4fGQIYh1yrlADCrf2FJq2kvHpRWht6075ZSxd6ufPPeGQMkoyVkNnDPTM2Jy3yISrD3QY7mVfiCuPaLZrbTKqcltdW5HEST2RPX9M9toDCXbeFYqRei2BzO41MeQ43OOwea1x00QHG6JbByQ40WaYBwdX++PXHwjF8WVCtaU4wnJ5fG1vzdIIFA51JsyDg7sIuZ8ChtedSNMnvylKxHIKWQ0J1JtA7/Uu4DVHuj8GiwhcMHqfYhxF9NJmnRdaXB2szao/2hYUdUofkWaSCCG3UvrTR5YdTUTFOqjA5yl8Cba1Eomq577gRnuBAUJsCuvEd8lEG10bgVs/lfeoGHq+AlHl9vOsmOFbIUZvJZRHk3NZa4Zojfi/HSPUrAUQrPtgrOeI9DkVC3BxFWfQs0zi93UmIhW8o-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB51[TBO]q9uHOVkV6kq1IR7/uYS45lLJMH1WW0gXM04uW2eVD+RbEXJJXV7HujTeR8/LnkOwq6pCIfu/oT5dOU99cXF6Y0+xnhcKWhLjJacKrYmxTRUWImpV3RYC+6UbrYZCRgyEsWLs5XsCKwCkuBW7biK6pv4HWpDUVjNLeEyWVqjdtfYjkdcsTTXA/aK+/GCarP0YE7/PqI0y2bDsvdyZO7YEnKrGxpmmnXInruESPEu2rWjc5MuKlUGEGq47gDvzZb2yMUamai6Qm2bYWgV2oqbKV5TaDdjh9vBSrx4fGQIYh1yrlADCrf2FJq2kvHpRWht6075ZSxd6ufPPeGQMkoyVkNnDPTM2Jy3yISrD3QY7mVfiCuPaLZrbTKqcltdW5HEST2RPX9M9toDCXbeFYqRei2BzO41MeQ43OOwea1x00QHG6JbByQ40WaYBwdX++PXHwjF8WVCtaU4wnJ5fG1vzdIIFA51JsyDg7sIuZ8ChtedSNMnvylKxHIKWQ0J1JtA7/Uu4DVHuj8GiwhcMHqfYhxF9NJmnRdaXB2szao/2hYUdUofkWaSCCG3UvrTR5YdTUTFOqjA5yl8Cba1Eomq577gRnuBAUJsCuvEd8lEG10bgVs/lfeoGHq+AlHl9vOsmOFbIUZvJZRHk3NZa4Zojfi/HSPUrAUQrPtgrOeI9DkVC3BxFWfQs0zi93UmIhW8o",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-31T06:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T21:55:00",
                      "Eticket": true,
                      "FlightNumber": "403",
                      "JourneyDuration": "345",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "388",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 6
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "345",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T16:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T14:50:00",
                      "Eticket": true,
                      "FlightNumber": "116",
                      "JourneyDuration": "70",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "7M8",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 5
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "70",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB52[TBO]lIXfhGNGlKOIUa9+wlBHaiyuSyKfIwnAdg2uKe0lX4qSEFL7R5GVAEH31M2leg8+OqfwDlkeKqlUrE8uK9ZmXOTDdThK+7KUTOrewbHwsRgPApNVu4s98rNEYx9p8b7H39gJ/p51yeBX7ecMRKXqnLDYIyyB8YX5Oev8dLKDuYwLdZnjtzpl1NywqXF2NNcQk5wYZ/6w67fVo8oMzLh9jHwUE4/bf2ZAKCWTB2UMr4JiFFk2aQ2QKcUE18kXPCudG1XFXAD7IUJbid6jdRaIwWt1RsDdvAM68+eGKHyvsuXZbbw6ACYu4tAQ60o2ZADDlaQbo0ExOBA5UXaEkqPugV5rGFJYFfraYyEPWE7IikHPA1lSPdfXV9EdyR2FpPX3CqgLjVSUyPj9WX3kbLDlx/7t1gF+yVwFfb0x59cVXD/kzbeeq9OILdeYgGeTrhTL7rPC2MEq5e7ghI5h29awPsvl5cOufeJqSExwc/DO3G9gYbwH5sLmzvYLVaFDG8PmLW6BR24dc/lybwoBqqBN19h0yxdy/ykQmx2uDtEC69MtEiPc84H75Upmh0nHpYdyiMvKHySqdWkcuofb4TPAlzUMxxgtyyONbLIWi5zoagFljy6LM7RPnxsXHrfik9/0cKjl4Op/4e35VXRnvAyGPLMSNpqJ8wM+/9nkNW1ta7P6Y9+iDhEJROv7ABg/XN2R-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB52[TBO]lIXfhGNGlKOIUa9+wlBHaiyuSyKfIwnAdg2uKe0lX4qSEFL7R5GVAEH31M2leg8+OqfwDlkeKqlUrE8uK9ZmXOTDdThK+7KUTOrewbHwsRgPApNVu4s98rNEYx9p8b7H39gJ/p51yeBX7ecMRKXqnLDYIyyB8YX5Oev8dLKDuYwLdZnjtzpl1NywqXF2NNcQk5wYZ/6w67fVo8oMzLh9jHwUE4/bf2ZAKCWTB2UMr4JiFFk2aQ2QKcUE18kXPCudG1XFXAD7IUJbid6jdRaIwWt1RsDdvAM68+eGKHyvsuXZbbw6ACYu4tAQ60o2ZADDlaQbo0ExOBA5UXaEkqPugV5rGFJYFfraYyEPWE7IikHPA1lSPdfXV9EdyR2FpPX3CqgLjVSUyPj9WX3kbLDlx/7t1gF+yVwFfb0x59cVXD/kzbeeq9OILdeYgGeTrhTL7rPC2MEq5e7ghI5h29awPsvl5cOufeJqSExwc/DO3G9gYbwH5sLmzvYLVaFDG8PmLW6BR24dc/lybwoBqqBN19h0yxdy/ykQmx2uDtEC69MtEiPc84H75Upmh0nHpYdyiMvKHySqdWkcuofb4TPAlzUMxxgtyyONbLIWi5zoagFljy6LM7RPnxsXHrfik9/0cKjl4Op/4e35VXRnvAyGPLMSNpqJ8wM+/9nkNW1ta7P6Y9+iDhEJROv7ABg/XN2R",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "186.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "42.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "228.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "186.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "42.57",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "42.7",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "228.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-31T06:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T21:55:00",
                      "Eticket": true,
                      "FlightNumber": "403",
                      "JourneyDuration": "345",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "388",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 10
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "345",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T19:45:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T18:30:00",
                      "Eticket": true,
                      "FlightNumber": "126",
                      "JourneyDuration": "75",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "359",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 7
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "75",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB17[TBO]Rzb7BKkfb/D5Mnao6Ib3IngtolyEtRfeVD1vocqc++zGf4bhbPt6/o4qRAwJU2RKq/RKuTFmU4QahXsAJqu0W0lCcLOB4qiFSlSYk2ZfIxHDvBD18ngVsY6Imfq+k6XkbTqp2W+SSN1fFHcnh/qdt3x/Z628bf6v6qgnKAa1puRlasDrXwwI5VwJ9agp75dfFzqsheikeuf/tzcTATzx0nORMw2pRwt2JhdK75l1+KkZtLHp0IhibWdMmX8b5sMpJi05zHmcQjbmHyQhlkGeaSolxF1D/8MTqO1CaKuF1fbEWBsFBXvg/XTRNZA1W4wibkL4QNeZgNlbIYBEagBRkfhyRJithwEH17En7mfPdhLmiHXaUrFoui0cTYWQoMXgqjaTcS7Q8mDOUx0wLEbiTKY94GOXM/BkuHqpAz3cDhYZe3IPenQCbyfP5xq6LqiZ/R8p95A17cLjEjJbyxryOO44aIYJzXKn3dhy+60kiypqft5yupcGgnDUvXa0yX2RmBo4gxkX3lvbBSHTFyE+lhqdxXIYd+IKZgml+1RFAJkC3mif3gSHU+nRCKrENpEpVUetLFapRoh3Lkh4bGtWPg==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB17[TBO]Rzb7BKkfb/D5Mnao6Ib3IngtolyEtRfeVD1vocqc++zGf4bhbPt6/o4qRAwJU2RKq/RKuTFmU4QahXsAJqu0W0lCcLOB4qiFSlSYk2ZfIxHDvBD18ngVsY6Imfq+k6XkbTqp2W+SSN1fFHcnh/qdt3x/Z628bf6v6qgnKAa1puRlasDrXwwI5VwJ9agp75dfFzqsheikeuf/tzcTATzx0nORMw2pRwt2JhdK75l1+KkZtLHp0IhibWdMmX8b5sMpJi05zHmcQjbmHyQhlkGeaSolxF1D/8MTqO1CaKuF1fbEWBsFBXvg/XTRNZA1W4wibkL4QNeZgNlbIYBEagBRkfhyRJithwEH17En7mfPdhLmiHXaUrFoui0cTYWQoMXgqjaTcS7Q8mDOUx0wLEbiTKY94GOXM/BkuHqpAz3cDhYZe3IPenQCbyfP5xq6LqiZ/R8p95A17cLjEjJbyxryOO44aIYJzXKn3dhy+60kiypqft5yupcGgnDUvXa0yX2RmBo4gxkX3lvbBSHTFyE+lhqdxXIYd+IKZgml+1RFAJkC3mif3gSHU+nRCKrENpEpVUetLFapRoh3Lkh4bGtWPg==",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "201.22",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "201.22",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "44.58",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "245.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "201.22",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "201.22",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "44.58",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "9.96",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "34.63",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "245.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T06:55:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T23:00:00",
                      "Eticket": true,
                      "FlightNumber": "191",
                      "JourneyDuration": "325",
                      "MarketingAirlineCode": "MH",
                      "MarketingAirlineName": "Malaysia Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "MH",
                        "Name": "Malaysia Airlines",
                        "Equipment": "333",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "N",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "325",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 0
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "MH",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB60[TBO]dv3WblLUY0LAVLY7/FjYbKDbkSIdyo4lxLxwsBBm3O4dCKqC0H/MRUW6q7m4UwUDJPIx/1xGjUiX0tJrj4fIaO9XLPDGJ6rlL8qKazujnQ0y/t7x8MCgGaxqIgC7ovEEK2upbQ2G0waO594VHQ2ku3F8yEAGjA9sRidMKDI8tlJA/ccRHdonJ4oeXFUsN5T6bH0zb8ETaKtqlhhBTi3KIsDiisqCgQzpul2sgR2JOC429SXVkQNVDOTZ0p41gvli5Pcz7wm9ldIhIMmGz6FxMcrtiA7KvGTSX5IhzQ8QrV+1beiqoGl/xgzGoXXvclZIJllnrKkzBaIj41j+Jhu5p+HtPiXJ9YZWvk1PST4PLDv3X7M+LAlevRB9zZt8Lv1N7Q0UUKGJ5RxRcc5XF8AJ6AGAWGdKjO16oSbGkE0o4wbmUxbHcIPbgWnODSHzjqSGY6/I2krQrqB8KhcRmzSeAZjBEGwruH69QECP5skD+zLuCDStsgJE0KVqHIx1B3HMwso5Cbl2lXgK5nf7s8VZxbLzInzuVVj38E4Pc5o9jTNZHLaHgpagP00Xt6rR1FWWDZtqBJ+LdQwRky5LD+eLTlX2pkCyj6eYqxPoJoxGCjDMyvqpDt1IEzcCm8tqJ07+M6TcDeJbtRrpo/eIAFqRj+sNbQlJSOv+AiEjPSc/se1WsoDwXTlNxRQLM26QX7cn-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB60[TBO]dv3WblLUY0LAVLY7/FjYbKDbkSIdyo4lxLxwsBBm3O4dCKqC0H/MRUW6q7m4UwUDJPIx/1xGjUiX0tJrj4fIaO9XLPDGJ6rlL8qKazujnQ0y/t7x8MCgGaxqIgC7ovEEK2upbQ2G0waO594VHQ2ku3F8yEAGjA9sRidMKDI8tlJA/ccRHdonJ4oeXFUsN5T6bH0zb8ETaKtqlhhBTi3KIsDiisqCgQzpul2sgR2JOC429SXVkQNVDOTZ0p41gvli5Pcz7wm9ldIhIMmGz6FxMcrtiA7KvGTSX5IhzQ8QrV+1beiqoGl/xgzGoXXvclZIJllnrKkzBaIj41j+Jhu5p+HtPiXJ9YZWvk1PST4PLDv3X7M+LAlevRB9zZt8Lv1N7Q0UUKGJ5RxRcc5XF8AJ6AGAWGdKjO16oSbGkE0o4wbmUxbHcIPbgWnODSHzjqSGY6/I2krQrqB8KhcRmzSeAZjBEGwruH69QECP5skD+zLuCDStsgJE0KVqHIx1B3HMwso5Cbl2lXgK5nf7s8VZxbLzInzuVVj38E4Pc5o9jTNZHLaHgpagP00Xt6rR1FWWDZtqBJ+LdQwRky5LD+eLTlX2pkCyj6eYqxPoJoxGCjDMyvqpDt1IEzcCm8tqJ07+M6TcDeJbtRrpo/eIAFqRj+sNbQlJSOv+AiEjPSc/se1WsoDwXTlNxRQLM26QX7cn",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "253.67",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "253.67",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "46.09",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "299.76",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "253.67",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "253.67",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "45.95",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "46.08",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "299.76",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-31T06:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T21:55:00",
                      "Eticket": true,
                      "FlightNumber": "403",
                      "JourneyDuration": "345",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "388",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "W",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 6
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "345",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T10:55:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-31T09:45:00",
                      "Eticket": true,
                      "FlightNumber": "8508",
                      "JourneyDuration": "70",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "TR",
                        "Name": "Scoot",
                        "Equipment": "788",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "W",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 5
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "70",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB61[TBO]pP5TO20h8Nn7v5ngKYMR9xRla10KgYtsLRzIRf0oW0aM5jcqHDgr9NP5dKyZiLruJyFPm5q/kHyXGdZOFfWbmUrN8YPVJlrifJjw7EaoMxf5aIQ4glSpxQQuf76tWrVPACQhEItrXRs5qFzdNa2/oTg42or4jgmXzFvut6eY4G6dOwdl7TQgKdZLV1LgmGHRbJzmObqW1NhkUi0quVpv0BAbr92P7Ef78UznVQihZrmdTk0WN4E+NAleEmIS1bMiRi+XGn/9tAf93rbaAC1SG1kCrqkgyMZ/72eHZCqyM+jAVVb0PgghbeRRQA7R2ZncRVKXp19gS3D9tsa2/RdopDO/+6QTJXIzAuNqlLA0AdbALzg78QdkX13SG/Po1m0rQqGn8unH91kuIwn1FXg4PyKu0GEbqv4MtL8wg9UcTPrDeKR3yFQewcHQbZOup+BPVgMeJSJdQFlcMCReK3uljsHYOPv6nt1SpQv41JxvDRLxPTCIMf7ipituqD0CvQU4bA19K6Sp6oXXs28gG3dLR+la3HeTHdQzoKGeuE1jQXA/UImAOE2k7RjmSIT8slKjXzWyoc6C/xe6eCmGx3/wHJe2Q5t9AJyDRo2hhyZ22IAfCVH7tixM/tlRfZxGWIziQnPjckFyfUiEqB4icXAt55XP5wwqVVtBCkYw6C8w0zs=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB61[TBO]pP5TO20h8Nn7v5ngKYMR9xRla10KgYtsLRzIRf0oW0aM5jcqHDgr9NP5dKyZiLruJyFPm5q/kHyXGdZOFfWbmUrN8YPVJlrifJjw7EaoMxf5aIQ4glSpxQQuf76tWrVPACQhEItrXRs5qFzdNa2/oTg42or4jgmXzFvut6eY4G6dOwdl7TQgKdZLV1LgmGHRbJzmObqW1NhkUi0quVpv0BAbr92P7Ef78UznVQihZrmdTk0WN4E+NAleEmIS1bMiRi+XGn/9tAf93rbaAC1SG1kCrqkgyMZ/72eHZCqyM+jAVVb0PgghbeRRQA7R2ZncRVKXp19gS3D9tsa2/RdopDO/+6QTJXIzAuNqlLA0AdbALzg78QdkX13SG/Po1m0rQqGn8unH91kuIwn1FXg4PyKu0GEbqv4MtL8wg9UcTPrDeKR3yFQewcHQbZOup+BPVgMeJSJdQFlcMCReK3uljsHYOPv6nt1SpQv41JxvDRLxPTCIMf7ipituqD0CvQU4bA19K6Sp6oXXs28gG3dLR+la3HeTHdQzoKGeuE1jQXA/UImAOE2k7RjmSIT8slKjXzWyoc6C/xe6eCmGx3/wHJe2Q5t9AJyDRo2hhyZ22IAfCVH7tixM/tlRfZxGWIziQnPjckFyfUiEqB4icXAt55XP5wwqVVtBCkYw6C8w0zs=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "253.67",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "253.67",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "46.09",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "299.76",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "253.67",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "253.67",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "45.95",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "46.08",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "299.76",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-30T17:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:00:00",
                      "Eticket": true,
                      "FlightNumber": "401",
                      "JourneyDuration": "355",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "787",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "W",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 7
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "355",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T22:15:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-30T21:00:00",
                      "Eticket": true,
                      "FlightNumber": "8610",
                      "JourneyDuration": "75",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "TR",
                        "Name": "Scoot",
                        "Equipment": "320",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "W",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 10
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "75",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB59[TBO]e+3Lu3EYqbj1dnz/uoEmOcUDY+noGFWB3OFSeukEBm4mB8B9jbW1MUxQC4uc6KvQ1t5cpXh/DH8nbzK/vqfhK92tUy0O0IzNz5/i25smY+uTEW9tp4OpUqMFW3UhUNnR9781dR08/dh0xMMgO8ELdskec0SaIaR89YzH8/khVK3t1G2i/UR8f49vgQ67Psp6+9ILgdtcVh98RJ6KxcoCU+/3gJdmjkNZhuwjvqOjfjXFItqFF2IYMgflxmOINiRNB2SVhW4cZqLZgro3sNaFiW6R3TPrexGpMxl8LTlh4gSH8675x2d8mPCqdQz+A28WgcPN94Wdoy3rIcDrXoYg7p0x5OOAR5I8Q7KAbxA7DWCMfc9NyjTn+jrrXPNyxPw62TkozDNFL6R4wm8jUkHznMtI1NM3OTFFJ5Xe0ENfhXDZJw6yIssBe4Ov4lSw4wk33iKDlVsM5SdCdSqv0HuQXBrdz4IA75hvrJ0NKZXvNXc/KbCPBhYR5xZm1STTVCqTZHszp/Jn58RdD3pxdcvBVy+q5y7OAIcoLPymqKCyzg1s+HMxZ25za8vQD5OQz6JdbIa8f5sKJCVgroeW09E3tocYzyhbygZy+B+bxT/9de9bH7zKPTuDSOTWIfOu4oFehvWRnSKuPI0X620sCe3HYF7EccEVcDAXuoxM51NZyqs=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB59[TBO]e+3Lu3EYqbj1dnz/uoEmOcUDY+noGFWB3OFSeukEBm4mB8B9jbW1MUxQC4uc6KvQ1t5cpXh/DH8nbzK/vqfhK92tUy0O0IzNz5/i25smY+uTEW9tp4OpUqMFW3UhUNnR9781dR08/dh0xMMgO8ELdskec0SaIaR89YzH8/khVK3t1G2i/UR8f49vgQ67Psp6+9ILgdtcVh98RJ6KxcoCU+/3gJdmjkNZhuwjvqOjfjXFItqFF2IYMgflxmOINiRNB2SVhW4cZqLZgro3sNaFiW6R3TPrexGpMxl8LTlh4gSH8675x2d8mPCqdQz+A28WgcPN94Wdoy3rIcDrXoYg7p0x5OOAR5I8Q7KAbxA7DWCMfc9NyjTn+jrrXPNyxPw62TkozDNFL6R4wm8jUkHznMtI1NM3OTFFJ5Xe0ENfhXDZJw6yIssBe4Ov4lSw4wk33iKDlVsM5SdCdSqv0HuQXBrdz4IA75hvrJ0NKZXvNXc/KbCPBhYR5xZm1STTVCqTZHszp/Jn58RdD3pxdcvBVy+q5y7OAIcoLPymqKCyzg1s+HMxZ25za8vQD5OQz6JdbIa8f5sKJCVgroeW09E3tocYzyhbygZy+B+bxT/9de9bH7zKPTuDSOTWIfOu4oFehvWRnSKuPI0X620sCe3HYF7EccEVcDAXuoxM51NZyqs=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "253.67",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "253.67",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "46.09",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "299.76",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "253.67",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "253.67",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "45.95",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "46.08",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "299.76",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "SIN",
                      "ArrivalDateTime": "2025-05-30T17:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:00:00",
                      "Eticket": true,
                      "FlightNumber": "401",
                      "JourneyDuration": "355",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "SQ",
                        "Name": "Singapore Airlines",
                        "Equipment": "787",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "W",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 6
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "355",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T21:35:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "SIN",
                      "DepartureDateTime": "2025-05-30T20:15:00",
                      "Eticket": true,
                      "FlightNumber": "8510",
                      "JourneyDuration": "80",
                      "MarketingAirlineCode": "SQ",
                      "MarketingAirlineName": "Singapore Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "TR",
                        "Name": "Scoot",
                        "Equipment": "320",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "W",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 6
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "80",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "SQ",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB43[TBO]9imUO2yaLbcUBBDgc4kXJJZezsV0hmzgS81/XpBf2JCRr0bHnxrKl+UAsBW9zFeZzraQtjhbq3A7Ws+ydj2q9QrDm5aW4O96242lH5eb2bXcp9Ba98rPnUo4ArSAsRTYiMdkYMsHW/Mr+P0Pet9Abexpw+NP0ZogJtH/2QkCci/ReIOn8tkGIC9qOuzdQMj1UZjnUPI1+Sz0gwEK4n+zRm5qGFETIOz6j9C5g9njaJiP8lTIr9lrt60238XAFtEmAt+VUJ9BIHgqZFB+TPuepTi/cxL+z9f/0Wg2VK4YJPH++NZDwBb2woH3pBSqVFfVgU89cvIoWpASLy4HCzsoyy/I+IXv9TiR7X92K+ZJspoOnXdlwN4vTFLR6fv8J942BO1MljB481D4sP7qB6/vEPilDRevmSLzceUNhyEwCVz+ZvmkJqHbgZ7bslxw973XiuCYS2UmjS91nCtEYOYJ/YJGEfiqaaPjIOdUcrArPZ1cX6oTxQRW+c8MU77o/i4/-RI-MQ==",
              "FareInfos": [],
              "FareType": "WebFare",
              "ResultIndex": "OB43[TBO]9imUO2yaLbcUBBDgc4kXJJZezsV0hmzgS81/XpBf2JCRr0bHnxrKl+UAsBW9zFeZzraQtjhbq3A7Ws+ydj2q9QrDm5aW4O96242lH5eb2bXcp9Ba98rPnUo4ArSAsRTYiMdkYMsHW/Mr+P0Pet9Abexpw+NP0ZogJtH/2QkCci/ReIOn8tkGIC9qOuzdQMj1UZjnUPI1+Sz0gwEK4n+zRm5qGFETIOz6j9C5g9njaJiP8lTIr9lrt60238XAFtEmAt+VUJ9BIHgqZFB+TPuepTi/cxL+z9f/0Wg2VK4YJPH++NZDwBb2woH3pBSqVFfVgU89cvIoWpASLy4HCzsoyy/I+IXv9TiR7X92K+ZJspoOnXdlwN4vTFLR6fv8J942BO1MljB481D4sP7qB6/vEPilDRevmSLzceUNhyEwCVz+ZvmkJqHbgZ7bslxw973XiuCYS2UmjS91nCtEYOYJ/YJGEfiqaaPjIOdUcrArPZ1cX6oTxQRW+c8MU77o/i4/",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "223.55",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "223.55",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "78.09",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "301.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "20KG"
                  ],
                  "CabinBaggage": [
                    "7Kg"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "223.55",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "223.55",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "76.03",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "78.09",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "301.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T07:40:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T23:20:00",
                      "Eticket": true,
                      "FlightNumber": "183",
                      "JourneyDuration": "350",
                      "MarketingAirlineCode": "D7",
                      "MarketingAirlineName": "Air Asia X",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "D7",
                        "Name": "Air Asia X",
                        "Equipment": "330",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "ZF",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 18
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "350",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 0
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "D7",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB21[TBO]UxmMiD1ZpHHrh8NbGUVFFgolhlaY3NWMGHi1Y5VH6+J0DfPuLCXH5FUAeiDY0vgxq3B+AhkrsQAxeqe/9KnPArAUQbDb/MD86NAOiIqoZapnbMz28bCb/RmK4R6ux97wMZr+g6zZtzZmtNoq7yOv+bnvbhYeNSwPfTKRg69q1VNs4byISRGiygq54py7qfJvTYZwioiYjKquICOs69/69YvCW3iXXj4MmXXCkXRWzsgn2FQdHwYMgdJx7O06G9OLf14AiyV4y4tc4o1BxjyPL4/lBno3WPJhW1M62WQC6O0HUNOAJLdRu6ccVD8v+XtXFQ5lvrVMsOYWirNR7QqmcUD3DtEyXUzB69bBO0fo0174Ooh1RRigDrtazYCkff2iRQUcQCNkdDB/UH3EiI0JJfKqZ09j2f7+4cBGTj9t7t4KXdZ9NYRUiZHARLaOsk8Jdm7sZLlVO71bAdpEb6rQE1u2ixGjDpHDCEaOrqYwVjpheA7R2O3vDYMcU2QjCv2lQIxCtkf8P+V1m2CnMmn64RVv0ylKqwLu+vnFiIlqQqYOyOkQEDdl/zh5fnGp3rl2i7QJ3Cx3TIk+wF6ALIO3Z3WtvV+Io6EjQsONItgQcTmBp8wZJfpk1I1gZDA3y9aECZa/sbFG/ml8+E/YDF7pRQkERMcLHmBxIbL+of0E4rg=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB21[TBO]UxmMiD1ZpHHrh8NbGUVFFgolhlaY3NWMGHi1Y5VH6+J0DfPuLCXH5FUAeiDY0vgxq3B+AhkrsQAxeqe/9KnPArAUQbDb/MD86NAOiIqoZapnbMz28bCb/RmK4R6ux97wMZr+g6zZtzZmtNoq7yOv+bnvbhYeNSwPfTKRg69q1VNs4byISRGiygq54py7qfJvTYZwioiYjKquICOs69/69YvCW3iXXj4MmXXCkXRWzsgn2FQdHwYMgdJx7O06G9OLf14AiyV4y4tc4o1BxjyPL4/lBno3WPJhW1M62WQC6O0HUNOAJLdRu6ccVD8v+XtXFQ5lvrVMsOYWirNR7QqmcUD3DtEyXUzB69bBO0fo0174Ooh1RRigDrtazYCkff2iRQUcQCNkdDB/UH3EiI0JJfKqZ09j2f7+4cBGTj9t7t4KXdZ9NYRUiZHARLaOsk8Jdm7sZLlVO71bAdpEb6rQE1u2ixGjDpHDCEaOrqYwVjpheA7R2O3vDYMcU2QjCv2lQIxCtkf8P+V1m2CnMmn64RVv0ylKqwLu+vnFiIlqQqYOyOkQEDdl/zh5fnGp3rl2i7QJ3Cx3TIk+wF6ALIO3Z3WtvV+Io6EjQsONItgQcTmBp8wZJfpk1I1gZDA3y9aECZa/sbFG/ml8+E/YDF7pRQkERMcLHmBxIbL+of0E4rg=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "226.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "226.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "120.09",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "346.89",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "1 PC(s)",
                    "1 PC(s)"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "226.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "226.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "120.09",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "0.00",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "64.26",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "55.83",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "346.89",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "HKG",
                      "ArrivalDateTime": "2025-05-30T09:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T01:00:00",
                      "Eticket": true,
                      "FlightNumber": "694",
                      "JourneyDuration": "340",
                      "MarketingAirlineCode": "CX",
                      "MarketingAirlineName": "Cathay Pacific Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "CX",
                        "Name": "Cathay Pacific Airways",
                        "Equipment": "359",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "340",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T18:30:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "HKG",
                      "DepartureDateTime": "2025-05-30T14:35:00",
                      "Eticket": true,
                      "FlightNumber": "6001",
                      "JourneyDuration": "235",
                      "MarketingAirlineCode": "CX",
                      "MarketingAirlineName": "Cathay Pacific Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "MH",
                        "Name": "Malaysia Airlines",
                        "Equipment": "73H",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 4
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "235",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "CX",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB20[TBO]9++LaPdHzhJD+2GKAAYv7fxaZjVSytRuvkhwWCQXiY69Xr65Hh/JQtgAvjRte0WwwBbmfg64JDx4/bImzTg/b410TOt7izcwx3DycuolrVrg2wQX9h2dUw72LmgMq5O35NU8mkmhOfWqRYUp9t61gYuZSdKF7/40WZD1YolSajszdFVyJRanwMMbklQKCWCqa8XRVlujDrq9J58XkO0+NgO9fD0x2aZ4eOIRfiOwI5hulPzFQgPHc6MlDToKn0XEM9JTifgllRW9d79c8UqRVijJNy9XZLWFhgwYhc8g50Jxl53Kc0j4yRxcxfzEMU5oc/EVl/0gU2kIvjw7cmvwPknJRTrWP5cLt+I/3jN89ESPh20qX7aYyKvYgZ6ZsB1/8kJJ1nRdZSXdSfSISLKLI3DTZ0SM7vk0VFn1tRokXz5btojc+a1/YAocdD3tuhMnFel0gUh/Vp9xEQ40s9plJjAvN/O5/xlsdL7w+8JbVxlE1+XWfMF4zizktP3D9Y/C7f0lrPS14kZHRswV1F+ZZoEUIipuoMVSqIw9z8EAtdKtVeDBKToToeK5NBgAGqxoyFj4pe++HY6hAdQed3lTbT0YboVG/GyJif4OB6ecTF5zYztPz2IhUOkW0S+P6oNBu1A377JzjvXNV9XEk6lqoMxHAnHnEyRRzpmqYu0DU6HvslihtMGwH260oOfokmg4-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB20[TBO]9++LaPdHzhJD+2GKAAYv7fxaZjVSytRuvkhwWCQXiY69Xr65Hh/JQtgAvjRte0WwwBbmfg64JDx4/bImzTg/b410TOt7izcwx3DycuolrVrg2wQX9h2dUw72LmgMq5O35NU8mkmhOfWqRYUp9t61gYuZSdKF7/40WZD1YolSajszdFVyJRanwMMbklQKCWCqa8XRVlujDrq9J58XkO0+NgO9fD0x2aZ4eOIRfiOwI5hulPzFQgPHc6MlDToKn0XEM9JTifgllRW9d79c8UqRVijJNy9XZLWFhgwYhc8g50Jxl53Kc0j4yRxcxfzEMU5oc/EVl/0gU2kIvjw7cmvwPknJRTrWP5cLt+I/3jN89ESPh20qX7aYyKvYgZ6ZsB1/8kJJ1nRdZSXdSfSISLKLI3DTZ0SM7vk0VFn1tRokXz5btojc+a1/YAocdD3tuhMnFel0gUh/Vp9xEQ40s9plJjAvN/O5/xlsdL7w+8JbVxlE1+XWfMF4zizktP3D9Y/C7f0lrPS14kZHRswV1F+ZZoEUIipuoMVSqIw9z8EAtdKtVeDBKToToeK5NBgAGqxoyFj4pe++HY6hAdQed3lTbT0YboVG/GyJif4OB6ecTF5zYztPz2IhUOkW0S+P6oNBu1A377JzjvXNV9XEk6lqoMxHAnHnEyRRzpmqYu0DU6HvslihtMGwH260oOfokmg4",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "226.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "226.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "120.09",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "346.89",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "1 PC(s)",
                    "1 PC(s)"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "226.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "226.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "120.09",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "0.00",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "64.26",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "55.83",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "346.89",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "HKG",
                      "ArrivalDateTime": "2025-05-31T06:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T22:40:00",
                      "Eticket": true,
                      "FlightNumber": "678",
                      "JourneyDuration": "340",
                      "MarketingAirlineCode": "CX",
                      "MarketingAirlineName": "Cathay Pacific Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "CX",
                        "Name": "Cathay Pacific Airways",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "340",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T16:45:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "HKG",
                      "DepartureDateTime": "2025-05-31T12:40:00",
                      "Eticket": true,
                      "FlightNumber": "725",
                      "JourneyDuration": "245",
                      "MarketingAirlineCode": "CX",
                      "MarketingAirlineName": "Cathay Pacific Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "CX",
                        "Name": "Cathay Pacific Airways",
                        "Equipment": "333",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "245",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "CX",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB18[TBO]pBHqBQiyRXzpkWYxikMWO7s68dY4Pm6pwmj4wv+VQ7o1JxxOE8ornc+u6AhV6XWcT27NlLyNLdw/1IsdhBHd1kvVvzj8C3Wean5aky47XOSI54Zzipp0EW/P4Q13H2u/YUGpOKoc3pgvq1aO7PdP1bw0hqM4olgqyP0cjkMEeBDOCY61cSr2FOj8GU3E6E9Z2dKEItdT9BCAJilbAseOmXJcqW+//vd2c7NbAk7qQG7m1bp7Nm02esstVXp6COp9WeBnkeErLEwQEwq4XL4EDFv+c1y+MYe1x3yNDl/L0B7k1qnNhq84lU8a8Z5E/EJsB008uUaYhJN1nwKgaBQra4pMs+Taq+ab0fp/DYvQ7T0kps6ahGTnCz2WNGilS/hQw3xOblnMTKULmRtAgWtOy4bq3fsSyOW9+u3ogvjC0fWiep5fdkywnMpX6vzHf9dTddWUOI+9iZSi5lyQBflMiMJ2TAsFlncGx1Vc/GOiuEaMPsDaDlhUcjmY+7XhCUK7Y75YoKjuLR7L6j958UN2Trd4sFKCbBZTy3Uj1XZp1upBIV0y33yCiEvI7YiwqhrBrrCQ/hD+FpHjJ9ETso2KPcrY9o/u1QWh3UMPU9b3jcYFt+KcHQG3sseASNCn4y8hMl0xBHCytlahxF378OH6Hd3Gph6HPwnSWQirdZQtPP4=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB18[TBO]pBHqBQiyRXzpkWYxikMWO7s68dY4Pm6pwmj4wv+VQ7o1JxxOE8ornc+u6AhV6XWcT27NlLyNLdw/1IsdhBHd1kvVvzj8C3Wean5aky47XOSI54Zzipp0EW/P4Q13H2u/YUGpOKoc3pgvq1aO7PdP1bw0hqM4olgqyP0cjkMEeBDOCY61cSr2FOj8GU3E6E9Z2dKEItdT9BCAJilbAseOmXJcqW+//vd2c7NbAk7qQG7m1bp7Nm02esstVXp6COp9WeBnkeErLEwQEwq4XL4EDFv+c1y+MYe1x3yNDl/L0B7k1qnNhq84lU8a8Z5E/EJsB008uUaYhJN1nwKgaBQra4pMs+Taq+ab0fp/DYvQ7T0kps6ahGTnCz2WNGilS/hQw3xOblnMTKULmRtAgWtOy4bq3fsSyOW9+u3ogvjC0fWiep5fdkywnMpX6vzHf9dTddWUOI+9iZSi5lyQBflMiMJ2TAsFlncGx1Vc/GOiuEaMPsDaDlhUcjmY+7XhCUK7Y75YoKjuLR7L6j958UN2Trd4sFKCbBZTy3Uj1XZp1upBIV0y33yCiEvI7YiwqhrBrrCQ/hD+FpHjJ9ETso2KPcrY9o/u1QWh3UMPU9b3jcYFt+KcHQG3sseASNCn4y8hMl0xBHCytlahxF378OH6Hd3Gph6HPwnSWQirdZQtPP4=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "226.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "226.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "120.09",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "346.89",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "1 PC(s)",
                    "1 PC(s)"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "226.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "226.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "120.09",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "0.00",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "64.26",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "55.83",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "346.89",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "HKG",
                      "ArrivalDateTime": "2025-05-30T09:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T01:00:00",
                      "Eticket": true,
                      "FlightNumber": "694",
                      "JourneyDuration": "340",
                      "MarketingAirlineCode": "CX",
                      "MarketingAirlineName": "Cathay Pacific Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "CX",
                        "Name": "Cathay Pacific Airways",
                        "Equipment": "359",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "340",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T16:45:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "HKG",
                      "DepartureDateTime": "2025-05-30T12:40:00",
                      "Eticket": true,
                      "FlightNumber": "725",
                      "JourneyDuration": "245",
                      "MarketingAirlineCode": "CX",
                      "MarketingAirlineName": "Cathay Pacific Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "CX",
                        "Name": "Cathay Pacific Airways",
                        "Equipment": "333",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "245",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "CX",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB19[TBO]s5P+z2WGpTRONOrMsjq6QAJ/dUONC/3Jz/7E8zGNeec0iSmEr+1a1XZOFZ3d6CRe9TxWXu+ljMxLsJeuczu/+PHvo32SBg80a0pRTHrICLt/nfSqoNjndu/P0ku3Y2ej0pVbXbyq4G75KHN8lQwnUDqlkPRVG3w4fWtRBC79uwEUqqCjfYu9sH9CR/XVUvYDOeYlhzSLW8cvvaL2XSlwsuyme9luy8ZX32kxlUNV/AS7qIIdiOnwAbM5uaJwGNaoVAw/uBLRG8wmZ8vdeTatrgphOVfO/QaggyC0EjO78Tzh5GYf/sb97uqNhH02iHaX9nnnMtxfi4VFpMGbUw0FF8ihGXObHGxjzErqCQqVoVjNUlMRuwiiKjGxfP5qnWrHFtIQBzSQIl5P2JKjebZbXzVG7GrQU4/3eyA79v/ao2IgNPwy8B+8p9hZwyzuNhaH1CKQDT6LPKFW8ZRpzl2brtSnufPmy2ijLlHF4gphw8XJMPL+EjzlplCiaEfMD29Xs6UBrQFwPCXb8hp6WNni2zhiOWsT8gnUzxfiNdvsAL3Ft1JhTj+dm0ArBomasZfNssLHjKUeX1a96IyBc3d9NbGsnBvWZOETPWoKELxsKRglFrqn7xBR18AqCMIccP6qwFSAAIQPB9NXgGyNqKMpBikeUL4yELWDP43+dyjd+o8=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB19[TBO]s5P+z2WGpTRONOrMsjq6QAJ/dUONC/3Jz/7E8zGNeec0iSmEr+1a1XZOFZ3d6CRe9TxWXu+ljMxLsJeuczu/+PHvo32SBg80a0pRTHrICLt/nfSqoNjndu/P0ku3Y2ej0pVbXbyq4G75KHN8lQwnUDqlkPRVG3w4fWtRBC79uwEUqqCjfYu9sH9CR/XVUvYDOeYlhzSLW8cvvaL2XSlwsuyme9luy8ZX32kxlUNV/AS7qIIdiOnwAbM5uaJwGNaoVAw/uBLRG8wmZ8vdeTatrgphOVfO/QaggyC0EjO78Tzh5GYf/sb97uqNhH02iHaX9nnnMtxfi4VFpMGbUw0FF8ihGXObHGxjzErqCQqVoVjNUlMRuwiiKjGxfP5qnWrHFtIQBzSQIl5P2JKjebZbXzVG7GrQU4/3eyA79v/ao2IgNPwy8B+8p9hZwyzuNhaH1CKQDT6LPKFW8ZRpzl2brtSnufPmy2ijLlHF4gphw8XJMPL+EjzlplCiaEfMD29Xs6UBrQFwPCXb8hp6WNni2zhiOWsT8gnUzxfiNdvsAL3Ft1JhTj+dm0ArBomasZfNssLHjKUeX1a96IyBc3d9NbGsnBvWZOETPWoKELxsKRglFrqn7xBR18AqCMIccP6qwFSAAIQPB9NXgGyNqKMpBikeUL4yELWDP43+dyjd+o8=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "226.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "226.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "120.09",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "346.89",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "1 PC(s)",
                    "1 PC(s)"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "226.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "226.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "120.09",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "0.00",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "64.26",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "55.83",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "346.89",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "HKG",
                      "ArrivalDateTime": "2025-05-30T14:30:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T03:30:00",
                      "Eticket": true,
                      "FlightNumber": "992",
                      "JourneyDuration": "510",
                      "MarketingAirlineCode": "CX",
                      "MarketingAirlineName": "Cathay Pacific Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "CX",
                        "Name": "Cathay Pacific Airways",
                        "Equipment": "333",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "510",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T20:15:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "HKG",
                      "DepartureDateTime": "2025-05-30T16:10:00",
                      "Eticket": true,
                      "FlightNumber": "729",
                      "JourneyDuration": "245",
                      "MarketingAirlineCode": "CX",
                      "MarketingAirlineName": "Cathay Pacific Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "CX",
                        "Name": "Cathay Pacific Airways",
                        "Equipment": "32Q",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "S",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "245",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "CX",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB44[TBO]jDEdNvIs4BV1vY/M/XagyAbIrIS3wu9mPa/jqqVSe5Psn1PWfC8/5IXGy/gSdPsUH79M/PUADO2u3LT0wn3mgLjBAuufzWDjExinKEfsQZB1yixBY/8xICLJJhQFjIU6FbrHZv53xAKZuIzM2O+SkKrlENqAu6+3MgfbBIL6n7oKkuBeKDXUXBCYP7ibim4d7mY4cA/7crhLa8TgMRK3mZQyJyMxL69whgtbBeeX+J5uubOVw37LkAiB0uUiS9KEzbRztJG48y0bd9IHAa9zdyuPLRII/OYp29HOBK1SuVF/jG5CtoJSW/HdK2YbPHoWizaxKL2faqEjwXMzPaQk1Sf/1cEcNlLz9/iKtx3EzfAQseyJzBneQdW4gHwFQuxOb2Baxbfjv6ODBkXUF9TBLP6VyK6VpCeo09nLNhn9W8eF62ofrQrnF7hTcpkfG7u5p6vs/OVU/qXQMnLatxj4vhncUgZeS9OxzGAU2XMQBLTmuVYy0ABFyx/oRXMscDOv-RI-MQ==",
              "FareInfos": [],
              "FareType": "WebFare",
              "ResultIndex": "OB44[TBO]jDEdNvIs4BV1vY/M/XagyAbIrIS3wu9mPa/jqqVSe5Psn1PWfC8/5IXGy/gSdPsUH79M/PUADO2u3LT0wn3mgLjBAuufzWDjExinKEfsQZB1yixBY/8xICLJJhQFjIU6FbrHZv53xAKZuIzM2O+SkKrlENqAu6+3MgfbBIL6n7oKkuBeKDXUXBCYP7ibim4d7mY4cA/7crhLa8TgMRK3mZQyJyMxL69whgtbBeeX+J5uubOVw37LkAiB0uUiS9KEzbRztJG48y0bd9IHAa9zdyuPLRII/OYp29HOBK1SuVF/jG5CtoJSW/HdK2YbPHoWizaxKL2faqEjwXMzPaQk1Sf/1cEcNlLz9/iKtx3EzfAQseyJzBneQdW4gHwFQuxOb2Baxbfjv6ODBkXUF9TBLP6VyK6VpCeo09nLNhn9W8eF62ofrQrnF7hTcpkfG7u5p6vs/OVU/qXQMnLatxj4vhncUgZeS9OxzGAU2XMQBLTmuVYy0ABFyx/oRXMscDOv",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "245.73",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "245.73",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "102.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "348.27",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "40KG"
                  ],
                  "CabinBaggage": [
                    "7Kg"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "245.73",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "245.73",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "100.48",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "102.54",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "348.27",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T07:40:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T23:20:00",
                      "Eticket": true,
                      "FlightNumber": "183",
                      "JourneyDuration": "350",
                      "MarketingAirlineCode": "D7",
                      "MarketingAirlineName": "Air Asia X",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "D7",
                        "Name": "Air Asia X",
                        "Equipment": "330",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "D",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 12
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "350",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 0
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "D7",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB24[TBO]QHMPpZcEJzGeNgczriGA8+abmHoVyj8tnXZM6CsPT7PHLxjq/C+Uy0jUF/EdIWsEms33thikF4lcvOU0Cr0/NH4cH2c9hAMsmJPHp2JXhtGL9LrmpnEERn/cNmQzQlEB9oiBxLSow90Rp76xBaxS13aWmMvtJT7CdszjejiEfBUyGZqrQDla2mSLp9a0f3cajN+wuYAB8usptnjUKHgSyQ11yhALQPU+LXT0mrVmTXXg7M5nDFTgAwJPGPVzyOG6YdxH7YjdkJbJHPjXltHBjaTmsOh/vecOPRhi94ybHtFtwSGTLOdTVtR1zb9NqcIDlTPmV5aiDLsxdmUgE6O6vK87p72yIqBh53O2uvET+Thu08cRo4CczcMQ/VsgOJe4eMrdk8+c5Y7OYef37OFYn1vrhAtblRHBoKwO4ffIOAoYIbpL9KKuM+Hrt4Cq1sBvhCGZA7kasoOVuQPGQQnlrWR1ldrwm1p3bzvjuP81p9YSubg8l2BScPBDeXbb83cogzDmBdmroIKdRBGDxCAeTA2IVzP74SxFDDa/9zH3Y+Ag/bAK1Oqe219MKbei/c5POuTW9KhVpmfEERhMIsLXe5l0WgszbSFypzabltKr/es=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB24[TBO]QHMPpZcEJzGeNgczriGA8+abmHoVyj8tnXZM6CsPT7PHLxjq/C+Uy0jUF/EdIWsEms33thikF4lcvOU0Cr0/NH4cH2c9hAMsmJPHp2JXhtGL9LrmpnEERn/cNmQzQlEB9oiBxLSow90Rp76xBaxS13aWmMvtJT7CdszjejiEfBUyGZqrQDla2mSLp9a0f3cajN+wuYAB8usptnjUKHgSyQ11yhALQPU+LXT0mrVmTXXg7M5nDFTgAwJPGPVzyOG6YdxH7YjdkJbJHPjXltHBjaTmsOh/vecOPRhi94ybHtFtwSGTLOdTVtR1zb9NqcIDlTPmV5aiDLsxdmUgE6O6vK87p72yIqBh53O2uvET+Thu08cRo4CczcMQ/VsgOJe4eMrdk8+c5Y7OYef37OFYn1vrhAtblRHBoKwO4ffIOAoYIbpL9KKuM+Hrt4Cq1sBvhCGZA7kasoOVuQPGQQnlrWR1ldrwm1p3bzvjuP81p9YSubg8l2BScPBDeXbb83cogzDmBdmroIKdRBGDxCAeTA2IVzP74SxFDDa/9zH3Y+Ag/bAK1Oqe219MKbei/c5POuTW9KhVpmfEERhMIsLXe5l0WgszbSFypzabltKr/es=",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "203.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "800.5",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "203.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.30",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "73.95",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "800.5",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T23:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T21:15:00",
                      "Eticket": true,
                      "FlightNumber": "217",
                      "JourneyDuration": "220",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "220",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T20:15:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-31T08:55:00",
                      "Eticket": true,
                      "FlightNumber": "416",
                      "JourneyDuration": "440",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "440",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": "TICKETS ARE NON-REFUNDABLE \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB23[TBO]3ZUFOKOxwS/TKd9YFdV00M7V1un2BiKwhPidnOo3WQ8aPJFcj9320bdPwpioG3KKIJGU0nxHON4bPseLrWQw3Mnqv/4aobNf/0Mjl51Yxi2jiYOlEU7JngB8ShVgE73mqJ8GIOUb1sj2JIWo/q2ZDaxbx+ovqkmWvuHcZnhJRo/dBlUZm8j0Ehmu9JaIhqGI+/zAwfJmuZ4xG/HIO0KLK+OsQhlTjU/QDeh0t9QKt9WYfdReZxTOX/Gz3X5hNlj4CfwBODmLYM0WfYOuBGlmGYB9BSidT+OaCjP6+uRdRx/h1aydyIdLbyvr/IqPW1ibqkvcoXs0MtmiHoPBochI+QIrbzqwazMDgty0g+1MDeZ/j4rXPkXs8y2BCAmIB+yDUjwUhZx/ykozMIr4RnjMBMZTiPnjDhO8ozInQdjNJcvXbtse+kYxnesuG16AkA88j7Wn96ljpwgDcjCOrnC8wJaVPwYtEItnH8P7KrPXf6eHalc1v2O68IZ4IiAI27pcotC7/kIpqLzVh7LccuAGzIbTE1TPPj8svl0xdrUwt7h/BadqfAjdOgjY0qg5Btxo/dpZDkakNSIW45pqIBklRpo2EE3ZYtEWBRu97E0Vc3Y=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB23[TBO]3ZUFOKOxwS/TKd9YFdV00M7V1un2BiKwhPidnOo3WQ8aPJFcj9320bdPwpioG3KKIJGU0nxHON4bPseLrWQw3Mnqv/4aobNf/0Mjl51Yxi2jiYOlEU7JngB8ShVgE73mqJ8GIOUb1sj2JIWo/q2ZDaxbx+ovqkmWvuHcZnhJRo/dBlUZm8j0Ehmu9JaIhqGI+/zAwfJmuZ4xG/HIO0KLK+OsQhlTjU/QDeh0t9QKt9WYfdReZxTOX/Gz3X5hNlj4CfwBODmLYM0WfYOuBGlmGYB9BSidT+OaCjP6+uRdRx/h1aydyIdLbyvr/IqPW1ibqkvcoXs0MtmiHoPBochI+QIrbzqwazMDgty0g+1MDeZ/j4rXPkXs8y2BCAmIB+yDUjwUhZx/ykozMIr4RnjMBMZTiPnjDhO8ozInQdjNJcvXbtse+kYxnesuG16AkA88j7Wn96ljpwgDcjCOrnC8wJaVPwYtEItnH8P7KrPXf6eHalc1v2O68IZ4IiAI27pcotC7/kIpqLzVh7LccuAGzIbTE1TPPj8svl0xdrUwt7h/BadqfAjdOgjY0qg5Btxo/dpZDkakNSIW45pqIBklRpo2EE3ZYtEWBRu97E0Vc3Y=",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "203.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "800.5",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "203.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.30",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "73.95",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "800.5",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T19:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T16:55:00",
                      "Eticket": true,
                      "FlightNumber": "215",
                      "JourneyDuration": "225",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "320",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "225",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T08:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-30T21:05:00",
                      "Eticket": true,
                      "FlightNumber": "418",
                      "JourneyDuration": "440",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "440",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": "TICKETS ARE NON-REFUNDABLE \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB22[TBO]FiuZSYk47ntcMEAlfUKbI7fTuvbJGurWmJ6ctZKbQwoZp7gTx1X47vvZsqzJ6T5cVZCBBT3Xk5s9yHkk0pHq8l0Axte4t9zD6Batm4cWyY2Q8jaJnxMwgJCUImEbKc6SPNewzTmdsPYGcdnTN1YiQncE9Kgmn6QLTaAjfhdVDIKYP9YhxzesE87aLYxqDjrz4jcH0a4tMvYCfs4aNLXqFSNmExWOlEH3EUr2YrpOF2j1y16HgJLlnPyo2VD6zNirYlXSigrcaoGccUXjJtjYryB9sI2dTS9ga0NVPWqzT3UHhbUpigcT3UWH+9fa7QPbLacY16v4jL5O8poZM/+lVhzc8HYfAPLhbW3kDQahPLJICP838RrpwYaFugYq151vka+Ieov0qYMlZPLqgu/vrx2Vilkf3F1NqO+GmfC/+aTRGP9saj2nSFSFrxD7l7O/+F7cf7mq+59fALYY9jFeSXYzV7ju4BDK8HrtCFUxqbHjX0TwTJ7IgZSO6Gle1YQnrTF4sg1/hZjivrJyRoM/wdNP3mO49TMbuoIZwGVXS1PacJqzESObTXGMMsxVa8JtUOwdMmh07Pr5z7RlVC5anwXjkpUvW9oNoIV+dBb6YaY=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB22[TBO]FiuZSYk47ntcMEAlfUKbI7fTuvbJGurWmJ6ctZKbQwoZp7gTx1X47vvZsqzJ6T5cVZCBBT3Xk5s9yHkk0pHq8l0Axte4t9zD6Batm4cWyY2Q8jaJnxMwgJCUImEbKc6SPNewzTmdsPYGcdnTN1YiQncE9Kgmn6QLTaAjfhdVDIKYP9YhxzesE87aLYxqDjrz4jcH0a4tMvYCfs4aNLXqFSNmExWOlEH3EUr2YrpOF2j1y16HgJLlnPyo2VD6zNirYlXSigrcaoGccUXjJtjYryB9sI2dTS9ga0NVPWqzT3UHhbUpigcT3UWH+9fa7QPbLacY16v4jL5O8poZM/+lVhzc8HYfAPLhbW3kDQahPLJICP838RrpwYaFugYq151vka+Ieov0qYMlZPLqgu/vrx2Vilkf3F1NqO+GmfC/+aTRGP9saj2nSFSFrxD7l7O/+F7cf7mq+59fALYY9jFeSXYzV7ju4BDK8HrtCFUxqbHjX0TwTJ7IgZSO6Gle1YQnrTF4sg1/hZjivrJyRoM/wdNP3mO49TMbuoIZwGVXS1PacJqzESObTXGMMsxVa8JtUOwdMmh07Pr5z7RlVC5anwXjkpUvW9oNoIV+dBb6YaY=",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "203.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "800.5",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "203.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.30",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "73.95",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "800.5",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T07:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T04:50:00",
                      "Eticket": true,
                      "FlightNumber": "219",
                      "JourneyDuration": "220",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "220",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T20:15:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-30T08:55:00",
                      "Eticket": true,
                      "FlightNumber": "416",
                      "JourneyDuration": "440",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "781",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "440",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": "TICKETS ARE NON-REFUNDABLE \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB25[TBO]1mTZjGmBkNDoZ7PIV2M00rMV0S5yTyzs7ukn1LZEtBycbEmoWb0M6AnJZKyz0yLls+5xtt3PbAg2ceW3ywtu0tChjJnPY728Fi8skk7fdqEq7Kccn4O/rjKChskafFUmvmMF0+9pIngq5Rf4T2x/Xws5rfB5Wv9Y0hrNepl4d4pM8rNsvs5BbEgpiFVVvEtf2WkUDFhmQZC2ZCHUeBMl54MaJt1rNKGJ1D7oqpHVyuCEf+eTM6nxiR8zrwnbu96+8Ypq8+DrEIog9Vs2/7Szc9zgZZpaBLQV4TDRyQia+mQmXVJ37vzh8mgBZJOGNc+CRFL6Sh5b0X1R9l/xnjTfifo6UV9ubOJfb7VPALbEajXaLmT3CnhzXZWdRzYI4xrb3RoK+WH+C8cEvrQRcSbJqvGAWdlLor4SvgSZQjXVaLjqnG+cRCb0a4iRqDdir3UY/WIj9/zDMxsd5CWTchGhf4jDVJ8bqTLLnb7wQ808mXHNMLYenbM/DMypcnTmuOrEzKE4RU63iBzYBD4+5NWmpqnsAN1+0J7ej7x3AAaHugyEeePO6rdS5TYswS5n685A3Yzw3zIt5GYw9B5r4S9GUJwTYc9zMwL6qzlghktDT9xmXj43OvSFOo6U+pwE/VHT-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB25[TBO]1mTZjGmBkNDoZ7PIV2M00rMV0S5yTyzs7ukn1LZEtBycbEmoWb0M6AnJZKyz0yLls+5xtt3PbAg2ceW3ywtu0tChjJnPY728Fi8skk7fdqEq7Kccn4O/rjKChskafFUmvmMF0+9pIngq5Rf4T2x/Xws5rfB5Wv9Y0hrNepl4d4pM8rNsvs5BbEgpiFVVvEtf2WkUDFhmQZC2ZCHUeBMl54MaJt1rNKGJ1D7oqpHVyuCEf+eTM6nxiR8zrwnbu96+8Ypq8+DrEIog9Vs2/7Szc9zgZZpaBLQV4TDRyQia+mQmXVJ37vzh8mgBZJOGNc+CRFL6Sh5b0X1R9l/xnjTfifo6UV9ubOJfb7VPALbEajXaLmT3CnhzXZWdRzYI4xrb3RoK+WH+C8cEvrQRcSbJqvGAWdlLor4SvgSZQjXVaLjqnG+cRCb0a4iRqDdir3UY/WIj9/zDMxsd5CWTchGhf4jDVJ8bqTLLnb7wQ808mXHNMLYenbM/DMypcnTmuOrEzKE4RU63iBzYBD4+5NWmpqnsAN1+0J7ej7x3AAaHugyEeePO6rdS5TYswS5n685A3Yzw3zIt5GYw9B5r4S9GUJwTYc9zMwL6qzlghktDT9xmXj43OvSFOo6U+pwE/VHT",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "203.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "800.5",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "203.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.30",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "73.95",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "800.5",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T11:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:10:00",
                      "Eticket": true,
                      "FlightNumber": "213",
                      "JourneyDuration": "225",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "32A",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "225",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T08:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-30T21:05:00",
                      "Eticket": true,
                      "FlightNumber": "418",
                      "JourneyDuration": "440",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "440",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": "TICKETS ARE NON-REFUNDABLE \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB1[TBO]COOo6azGiNYga5E6c9ETHL6jrJdRuwjPLWxy8bSrPhIQgAeWai0QTY6xfv2jhc5bzbeIMOlDhDVL0pB7GqyjatXVNauuKosmiOZEQhvRoBoqxhXGGGOPtKnRZEjKrCZD8Fkl3YaIKbGG5ajUiAHhju8Ot2R1UPnadIyfwn8bYqgGNB4tSoGExa1MDYVYTfxHjnLbFsNlHLSJo9biJD/MSYNVLiDQlw6VyKjjiMBCtQqLOpUt46LVc1g1mWrUEj3Tcyf0p5d8jFse0h6rZoXbdO3EACTUXm38tGesD0C5JDmJBnU0IIteKuZmUscigidTeov2WgO3J4WNQhgQZOiAfgpo2hm99qGw5JYtqx7mXaEfGqf7UfJ8iN3SuVOwupSuLkb9VGDioqYUJT0kJnj2TQIkQZOEdX6Hpkhznhq0OvzBa6DBNFIVYmr9WBJcj8Ns/eKPitSja/JeTibzyUY5TDFWKmwOOCS9+uK3vcNmH1vSysU/13g7RPSRX9/baADV71eykUloRcDncx8oN31TXQ4lSVFU/Y7JEj1vKpZPlywqtJ+dq2BqaPIEjOKzt8OaAcTvCNUNC1P0rAk276aEd3bzl4rhkFs/tsy3gpt+6jjdktvVbMJ0QqNlGsK9WjoI2dpLL5GztiddBU5kyLOp9ceT5OoVsUv4AUuXGda5Q0o=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB1[TBO]COOo6azGiNYga5E6c9ETHL6jrJdRuwjPLWxy8bSrPhIQgAeWai0QTY6xfv2jhc5bzbeIMOlDhDVL0pB7GqyjatXVNauuKosmiOZEQhvRoBoqxhXGGGOPtKnRZEjKrCZD8Fkl3YaIKbGG5ajUiAHhju8Ot2R1UPnadIyfwn8bYqgGNB4tSoGExa1MDYVYTfxHjnLbFsNlHLSJo9biJD/MSYNVLiDQlw6VyKjjiMBCtQqLOpUt46LVc1g1mWrUEj3Tcyf0p5d8jFse0h6rZoXbdO3EACTUXm38tGesD0C5JDmJBnU0IIteKuZmUscigidTeov2WgO3J4WNQhgQZOiAfgpo2hm99qGw5JYtqx7mXaEfGqf7UfJ8iN3SuVOwupSuLkb9VGDioqYUJT0kJnj2TQIkQZOEdX6Hpkhznhq0OvzBa6DBNFIVYmr9WBJcj8Ns/eKPitSja/JeTibzyUY5TDFWKmwOOCS9+uK3vcNmH1vSysU/13g7RPSRX9/baADV71eykUloRcDncx8oN31TXQ4lSVFU/Y7JEj1vKpZPlywqtJ+dq2BqaPIEjOKzt8OaAcTvCNUNC1P0rAk276aEd3bzl4rhkFs/tsy3gpt+6jjdktvVbMJ0QqNlGsK9WjoI2dpLL5GztiddBU5kyLOp9ceT5OoVsUv4AUuXGda5Q0o=",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "205.46",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "802.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "205.46",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.31",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "36.34",
                        "TaxCode": "K3",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "39.81",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "802.71",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T07:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T04:50:00",
                      "Eticket": true,
                      "FlightNumber": "219",
                      "JourneyDuration": "220",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "781",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "220",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T19:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-30T08:35:00",
                      "Eticket": true,
                      "FlightNumber": "416",
                      "JourneyDuration": "435",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "781",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "435",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB2[TBO]6r6rk2pdSXbrHhHWFps8wnPhDIoveTcwrFpcZgpCAR9/lYwOdxHPKp9QUIVKbpog6NJq2aAtioIsKnFOKespZ9Wt19pz9vd/ZT5IKqwJXGHKMFvKLrI0wEeoD98p1EHtH9nOzDco57LiV43z8Ss2dtbknG6RvvzsT1oQhzXRL6Rzmnas93A36UUlj4TG0v6uGYTlR4F1MHo/o9ZB3iBWi9rs3A9KAIT342zds0japDiRrFUdwF0dFRse0Z/Zv8GvDqj154Pp5XjKyJdX55z3qtixpXseuNuMSA8nsV6i4g9q+m9XY9LiksMBej8TKPij+6ovN0IJwCDcaZsIFOim97gc+OpghMH+Lo4o7RWzwR7smP51bdCDFjwXtYCFQqmL6Y7TflCz3JtNJ61wqUwpnZGjvGsydjQlOHAOYt9MxZAbSn1mdLWu2jaB1HBTDf03Ry0A83YbDiLvbZdNA3rlLwK/Wq/FnnBr0wuDXZ6TNDYOERPTgJkAZJCQh0sXQAUhG/H9+RSP9y0PTpewbIpNWzVgB18HL0JRRdX9xYwxM47d/nrbkxiuAlw/taeW7RUM+kTNV2umdugnw8QFmMo89qMmmO8fsC94UoFJoSm8G5nYJ48rsi9LFVJz+/TdifUmqhn+anXP33dxiFLYFpDRFawUfo7iNFbmXnruOnr8ysg=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB2[TBO]6r6rk2pdSXbrHhHWFps8wnPhDIoveTcwrFpcZgpCAR9/lYwOdxHPKp9QUIVKbpog6NJq2aAtioIsKnFOKespZ9Wt19pz9vd/ZT5IKqwJXGHKMFvKLrI0wEeoD98p1EHtH9nOzDco57LiV43z8Ss2dtbknG6RvvzsT1oQhzXRL6Rzmnas93A36UUlj4TG0v6uGYTlR4F1MHo/o9ZB3iBWi9rs3A9KAIT342zds0japDiRrFUdwF0dFRse0Z/Zv8GvDqj154Pp5XjKyJdX55z3qtixpXseuNuMSA8nsV6i4g9q+m9XY9LiksMBej8TKPij+6ovN0IJwCDcaZsIFOim97gc+OpghMH+Lo4o7RWzwR7smP51bdCDFjwXtYCFQqmL6Y7TflCz3JtNJ61wqUwpnZGjvGsydjQlOHAOYt9MxZAbSn1mdLWu2jaB1HBTDf03Ry0A83YbDiLvbZdNA3rlLwK/Wq/FnnBr0wuDXZ6TNDYOERPTgJkAZJCQh0sXQAUhG/H9+RSP9y0PTpewbIpNWzVgB18HL0JRRdX9xYwxM47d/nrbkxiuAlw/taeW7RUM+kTNV2umdugnw8QFmMo89qMmmO8fsC94UoFJoSm8G5nYJ48rsi9LFVJz+/TdifUmqhn+anXP33dxiFLYFpDRFawUfo7iNFbmXnruOnr8ysg=",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "205.46",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "802.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "205.46",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.31",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "36.34",
                        "TaxCode": "K3",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "39.81",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "802.71",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T18:15:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T15:55:00",
                      "Eticket": true,
                      "FlightNumber": "215",
                      "JourneyDuration": "230",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "320",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "230",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T08:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-30T20:50:00",
                      "Eticket": true,
                      "FlightNumber": "418",
                      "JourneyDuration": "440",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "440",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB3[TBO]A84B+WmbvrxK6Dy66/OWDPf4nBwCEA1wgeqjF1ysdG+5HTub/i+xwpk1tXX8IT0jv+3K1awn4d2AfF1ixmIMXrvexguSYCvblcfi9UhYGv3/deYGkNQM0DW0dA5VwmgiOOW44fpsVoFyp4Tn+FdaP42d7Zr7R3IDgGgbMRzIPUUWy+QdChfvhSMNrHdSPmbrBWKRfbqXt+IeVl+YtUEUrn+L71EBHHkrJc+TQbipm/1SyVTV3mQR/2fnQ5f8VmcLetwWONaIoC9yXokL6zDJcn6ihcmW6Uhm9yOC2XW/GnYGIaompWLLziz6Op7sg0RwrB8WWB6K/JY11sYfnPJSlk9mttCsgO79kTfEvyXUfZugZo0jSMZfdfjx7IIpHucVlm5qRQZnC0kXoZYnjAje2bnUpkjhTVoH6cwnznYpIOy6zvMB/D/m5OFoyz31IdxjG5nlJ55HDsaOZZdIpkrJeevoDCBJtmVSoa5kX06NxPycZ7FlJNZjcShQyJyprYlwJmM25qELQ9zG2GMjKWU5edFMY87Jen1zU/DoVQ6vi3NCukXOdrT6PApFxwSlfh916zOmCRwTrI5kWN7ZLACT8F1CjifwQhSO1t8wOUI2xMH/lQMji0vmrZtbOYD6TLB5nxVAGjTc2lKdiXsD2Pz8TsQ3R9wNKCHhbF6k/KUMrVI=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB3[TBO]A84B+WmbvrxK6Dy66/OWDPf4nBwCEA1wgeqjF1ysdG+5HTub/i+xwpk1tXX8IT0jv+3K1awn4d2AfF1ixmIMXrvexguSYCvblcfi9UhYGv3/deYGkNQM0DW0dA5VwmgiOOW44fpsVoFyp4Tn+FdaP42d7Zr7R3IDgGgbMRzIPUUWy+QdChfvhSMNrHdSPmbrBWKRfbqXt+IeVl+YtUEUrn+L71EBHHkrJc+TQbipm/1SyVTV3mQR/2fnQ5f8VmcLetwWONaIoC9yXokL6zDJcn6ihcmW6Uhm9yOC2XW/GnYGIaompWLLziz6Op7sg0RwrB8WWB6K/JY11sYfnPJSlk9mttCsgO79kTfEvyXUfZugZo0jSMZfdfjx7IIpHucVlm5qRQZnC0kXoZYnjAje2bnUpkjhTVoH6cwnznYpIOy6zvMB/D/m5OFoyz31IdxjG5nlJ55HDsaOZZdIpkrJeevoDCBJtmVSoa5kX06NxPycZ7FlJNZjcShQyJyprYlwJmM25qELQ9zG2GMjKWU5edFMY87Jen1zU/DoVQ6vi3NCukXOdrT6PApFxwSlfh916zOmCRwTrI5kWN7ZLACT8F1CjifwQhSO1t8wOUI2xMH/lQMji0vmrZtbOYD6TLB5nxVAGjTc2lKdiXsD2Pz8TsQ3R9wNKCHhbF6k/KUMrVI=",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "205.46",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "802.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "205.46",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.31",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "36.34",
                        "TaxCode": "K3",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "39.81",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "802.71",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T23:20:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T21:15:00",
                      "Eticket": true,
                      "FlightNumber": "217",
                      "JourneyDuration": "215",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "351",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "215",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T19:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-31T08:35:00",
                      "Eticket": true,
                      "FlightNumber": "416",
                      "JourneyDuration": "435",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "435",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB4[TBO]xZgDk1lUaU2qQSCAaPOV9UDkoDEspEzQriR/rW4bdGdgvJJobLLRAGBJT1a/utoXU5RRVxl7C3I8dNCN2OsQPZA5o1GE4heLxKQL2emMQ7IT69LGWuelD2au0fqa8gAghV551j/9DwmdRwhk2UuW5Cir68kTaFcDDC3L/ay728KLks1XYraIpPkRDITd/hM/bjmj7ju0VkG4puPME1hzZs0YscCs7uDs6bymvyaQ2aLP79p63ipkpf0HV1Y+lI8ZnVeuqgAj41Zvnluoq5oZQ4KmbNcd63gDf9edmKP5AWptoCafXXT7+TNAIGW6U2cutb6ZDBaWNeuuvKu5YcLfGqvS2XArWcmL5qAf/FDlbnSdWD7cquFpL0YZAyBFco1oEVwyflfwKQk6fh/wkHGO9vtTdnTllgbd30ibpJivNvQlRB5R7OyubRMVWcVoRKIczBxlCrFY1/EmIsghYT1B538ofqDBFppCnbII2yJ6+HGrX/zqstad/TpUdN+zsF2e6XvQIGPgZBN/+/xKioXd6WikF1i3NZSxo0ej2LwMpPaDtLNrYA0kury2DMpqQYzfX3NKTuDPAquVamvXscusmTSjpa0OsWgo6+aL+nLzeBh7UffISK3Wj8BeSnsXZ7tnQq+DEYkjCluI3FiuDVKAHQif6KD3sSzCBF4LopQfA7w=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB4[TBO]xZgDk1lUaU2qQSCAaPOV9UDkoDEspEzQriR/rW4bdGdgvJJobLLRAGBJT1a/utoXU5RRVxl7C3I8dNCN2OsQPZA5o1GE4heLxKQL2emMQ7IT69LGWuelD2au0fqa8gAghV551j/9DwmdRwhk2UuW5Cir68kTaFcDDC3L/ay728KLks1XYraIpPkRDITd/hM/bjmj7ju0VkG4puPME1hzZs0YscCs7uDs6bymvyaQ2aLP79p63ipkpf0HV1Y+lI8ZnVeuqgAj41Zvnluoq5oZQ4KmbNcd63gDf9edmKP5AWptoCafXXT7+TNAIGW6U2cutb6ZDBaWNeuuvKu5YcLfGqvS2XArWcmL5qAf/FDlbnSdWD7cquFpL0YZAyBFco1oEVwyflfwKQk6fh/wkHGO9vtTdnTllgbd30ibpJivNvQlRB5R7OyubRMVWcVoRKIczBxlCrFY1/EmIsghYT1B538ofqDBFppCnbII2yJ6+HGrX/zqstad/TpUdN+zsF2e6XvQIGPgZBN/+/xKioXd6WikF1i3NZSxo0ej2LwMpPaDtLNrYA0kury2DMpqQYzfX3NKTuDPAquVamvXscusmTSjpa0OsWgo6+aL+nLzeBh7UffISK3Wj8BeSnsXZ7tnQq+DEYkjCluI3FiuDVKAHQif6KD3sSzCBF4LopQfA7w=",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "205.46",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "802.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "205.46",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.31",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "36.34",
                        "TaxCode": "K3",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "39.81",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "802.71",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T11:30:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:10:00",
                      "Eticket": true,
                      "FlightNumber": "213",
                      "JourneyDuration": "230",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "320",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "230",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T08:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-30T20:50:00",
                      "Eticket": true,
                      "FlightNumber": "418",
                      "JourneyDuration": "440",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "440",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB5[TBO]jvNYemXaA/0oNhAeb3AmaVK03eyCuctO7MSSFvYbmmkw7wd2UuMNzSxk03o1leKkJl5SRAZcTYIhVvEITNAaIn8nK59eqmXQX6LsLT217HWE5B7UTh5E/yV/jzNtRqDRmyo5kVrYWdyhQEi8dZBCy5CNTVYA0HlM++rqMLiGTAeseQ+2hAsg7a7AkgGi2GXOfzLCKnW4iHklU8POhXOrgVa/Yo/feauMtu+g9vdrm9/UgvzXo1X19ggkpKa/EWprAk3L4M8DtAKMTeiHGqHwmZYObSehfHaKLW74CtRw53CcXpBL8Qt2LFY1STlmQWOTvHINdQT+X40F8KbTIZQGQ1S8JIMnT1N8mv7IvBEcv7wfErNxTaQ3DoWe3rFlvPTQkXNsH4YfWw7RSOsowkcqppD2CgnPaSSliIJgbRG2fPLmCbFEfaxExzKOysDDybwqGdwY0zg+CRW1F5od5AvdbVDfl4eVOQqk9Tfg413XmVuhZG8b6QHtEuWxg1UszLk6jpHL4gLx2Okgg75ERIl7R01obGPUKLR6/gB5o+DucgoKP+BP/TRAc8krl/uemLxwiqNr5IpD/8q6/ZYElr0pavE2M3WNL+Vxbj80Ri+ybtXLuH1/MCa2qHGYcxuWJlc+qKY/CKqXloACoDSS1bvHx2QwaDldCdz2O9JXAqBmSQ4=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB5[TBO]jvNYemXaA/0oNhAeb3AmaVK03eyCuctO7MSSFvYbmmkw7wd2UuMNzSxk03o1leKkJl5SRAZcTYIhVvEITNAaIn8nK59eqmXQX6LsLT217HWE5B7UTh5E/yV/jzNtRqDRmyo5kVrYWdyhQEi8dZBCy5CNTVYA0HlM++rqMLiGTAeseQ+2hAsg7a7AkgGi2GXOfzLCKnW4iHklU8POhXOrgVa/Yo/feauMtu+g9vdrm9/UgvzXo1X19ggkpKa/EWprAk3L4M8DtAKMTeiHGqHwmZYObSehfHaKLW74CtRw53CcXpBL8Qt2LFY1STlmQWOTvHINdQT+X40F8KbTIZQGQ1S8JIMnT1N8mv7IvBEcv7wfErNxTaQ3DoWe3rFlvPTQkXNsH4YfWw7RSOsowkcqppD2CgnPaSSliIJgbRG2fPLmCbFEfaxExzKOysDDybwqGdwY0zg+CRW1F5od5AvdbVDfl4eVOQqk9Tfg413XmVuhZG8b6QHtEuWxg1UszLk6jpHL4gLx2Okgg75ERIl7R01obGPUKLR6/gB5o+DucgoKP+BP/TRAc8krl/uemLxwiqNr5IpD/8q6/ZYElr0pavE2M3WNL+Vxbj80Ri+ybtXLuH1/MCa2qHGYcxuWJlc+qKY/CKqXloACoDSS1bvHx2QwaDldCdz2O9JXAqBmSQ4=",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "205.46",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "802.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "205.46",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.31",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "36.34",
                        "TaxCode": "K3",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "39.81",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "802.71",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T07:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T04:50:00",
                      "Eticket": true,
                      "FlightNumber": "219",
                      "JourneyDuration": "220",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "781",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "220",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T08:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-30T20:50:00",
                      "Eticket": true,
                      "FlightNumber": "418",
                      "JourneyDuration": "440",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "440",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB6[TBO]AeIVX2f8mRHxcdTMnDIsJ0Oz8h//ynod8zKclvzpCEfIH5nPjlUXccUh58GwHSYX2EZIdVQI5qUm8jwbBkcWLmDZ3ilWW+ey+qdGP8aEcpyc2+YAErcl6Prqkck4mvhBT8y//XlTTZazsibvu31x5uKb3fM6fFkH2j9V02CvDZ8nAwQnob4mgbPDnXZV9RJg/rprTtdvsKA3XFABU7LWo9JBTYXy9Ujw4JSaJPbsu4WAjoqJVhfVuxIrmTZVF1rNMM0Y8dsAXP/lRzUUzBMl3Ep74QPxyO+Tv9535Qv7+YutlbXV84VIhUeN9hSP7+tI3VuU/KMH4mT4mefOvFMXwWbzxr5jk53EQkYw1TroS2wpr/MkIE0z47vFNYtq8Dwpmi4y/b0kLHw9Du4AArg6GpUQWYj0TWw46QZQF9lmZyk4YyZo0UIKmMylQqugFXC0N5p2hygNCyXDzf0Cqnk52MVS8nwDPZdXrhql+Tcu5AoX2pC18y2daPI0+9W0CVhiDDwsX70KaN4j8MetCXyjUw5Ru+FRFC1hG3ISlDh49NST9uNvuUubeCGrsMjdSCs7MMyhqhEtq3Ca7FUUvq2unkjSE84/wWkWtzf5vRYVp3amrA1XfosYHxv1pAOeQ1OIZ8oBxsoly8vk/hAKch7+UFCga0TFhpgEKHVMM7PYsEI=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB6[TBO]AeIVX2f8mRHxcdTMnDIsJ0Oz8h//ynod8zKclvzpCEfIH5nPjlUXccUh58GwHSYX2EZIdVQI5qUm8jwbBkcWLmDZ3ilWW+ey+qdGP8aEcpyc2+YAErcl6Prqkck4mvhBT8y//XlTTZazsibvu31x5uKb3fM6fFkH2j9V02CvDZ8nAwQnob4mgbPDnXZV9RJg/rprTtdvsKA3XFABU7LWo9JBTYXy9Ujw4JSaJPbsu4WAjoqJVhfVuxIrmTZVF1rNMM0Y8dsAXP/lRzUUzBMl3Ep74QPxyO+Tv9535Qv7+YutlbXV84VIhUeN9hSP7+tI3VuU/KMH4mT4mefOvFMXwWbzxr5jk53EQkYw1TroS2wpr/MkIE0z47vFNYtq8Dwpmi4y/b0kLHw9Du4AArg6GpUQWYj0TWw46QZQF9lmZyk4YyZo0UIKmMylQqugFXC0N5p2hygNCyXDzf0Cqnk52MVS8nwDPZdXrhql+Tcu5AoX2pC18y2daPI0+9W0CVhiDDwsX70KaN4j8MetCXyjUw5Ru+FRFC1hG3ISlDh49NST9uNvuUubeCGrsMjdSCs7MMyhqhEtq3Ca7FUUvq2unkjSE84/wWkWtzf5vRYVp3amrA1XfosYHxv1pAOeQ1OIZ8oBxsoly8vk/hAKch7+UFCga0TFhpgEKHVMM7PYsEI=",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "205.46",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "802.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "205.46",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.31",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "36.34",
                        "TaxCode": "K3",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "39.81",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "802.71",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T18:15:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T15:55:00",
                      "Eticket": true,
                      "FlightNumber": "215",
                      "JourneyDuration": "230",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "320",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "230",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T19:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-31T08:35:00",
                      "Eticket": true,
                      "FlightNumber": "416",
                      "JourneyDuration": "435",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "435",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB7[TBO]XeTCuLeh2h4jD93JR30GhBnNPIqM4TVQO+YZ+T4y9f9paadJmn47CHOxLoQhb+xu3mIP92MQ717vsWIZEASBwXIGm+vtwsLcUvcJHXmA7hLlUC4uvJl4mBoIeDS24g2UY3cVDBEybQoySxpndcKzbYIcZ+A973vMAi1dbgnn4letS7Fnnwh3cgH77xJrW6pJ5k5pi3epf8NAyjnpHh0T55pc3n0JmrY5ZFjPECa81N75w4Ad55VmRDSuFZSJbHuHvIe9jxr/W0iTYih9qPGS4t8HagCWxiUAIqi/c41bQHlvDN83WogVx6O5FqSGK3imNmMYKUiYr2rB+wVctnj/qNCHTzJbExKyZuphvq2FcvRMG0T+pj+ARfzBBwVmaUDX5epBMMgJMksFpLSJVAM+hnLZGlm5zY9GLeSuuD13s3kEYIOvQZRfFjVs8qJffPFs9/95+/wKnQCcxAYVYaAUCOM4PtBZPQPgwhiA5uMHxer+tMR01mYyr7gMrHOy7vkg10rXtVz2KVdcRIMPmIClzoGPpGOgGdryElCdHC18ZlFyV5W+mt7gJBHYTZcVAdGp8GyLSs+JKzNtCLNK9dbfHIh05QAsgkSGVVQVqUEHj7elE3kVcRe+ekZevckgjbe5O1hNbxyY77NDEqt3/3ET+a+5zPeRxIM5TPl0h9ilij8ijjHG/BIjyuJCCA/3gj4b-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB7[TBO]XeTCuLeh2h4jD93JR30GhBnNPIqM4TVQO+YZ+T4y9f9paadJmn47CHOxLoQhb+xu3mIP92MQ717vsWIZEASBwXIGm+vtwsLcUvcJHXmA7hLlUC4uvJl4mBoIeDS24g2UY3cVDBEybQoySxpndcKzbYIcZ+A973vMAi1dbgnn4letS7Fnnwh3cgH77xJrW6pJ5k5pi3epf8NAyjnpHh0T55pc3n0JmrY5ZFjPECa81N75w4Ad55VmRDSuFZSJbHuHvIe9jxr/W0iTYih9qPGS4t8HagCWxiUAIqi/c41bQHlvDN83WogVx6O5FqSGK3imNmMYKUiYr2rB+wVctnj/qNCHTzJbExKyZuphvq2FcvRMG0T+pj+ARfzBBwVmaUDX5epBMMgJMksFpLSJVAM+hnLZGlm5zY9GLeSuuD13s3kEYIOvQZRfFjVs8qJffPFs9/95+/wKnQCcxAYVYaAUCOM4PtBZPQPgwhiA5uMHxer+tMR01mYyr7gMrHOy7vkg10rXtVz2KVdcRIMPmIClzoGPpGOgGdryElCdHC18ZlFyV5W+mt7gJBHYTZcVAdGp8GyLSs+JKzNtCLNK9dbfHIh05QAsgkSGVVQVqUEHj7elE3kVcRe+ekZevckgjbe5O1hNbxyY77NDEqt3/3ET+a+5zPeRxIM5TPl0h9ilij8ijjHG/BIjyuJCCA/3gj4b",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "205.46",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "802.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "205.46",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.31",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "36.34",
                        "TaxCode": "K3",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "39.81",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "802.71",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T11:30:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T09:10:00",
                      "Eticket": true,
                      "FlightNumber": "213",
                      "JourneyDuration": "230",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "320",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "230",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T19:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-31T08:35:00",
                      "Eticket": true,
                      "FlightNumber": "416",
                      "JourneyDuration": "435",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "435",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB8[TBO]gfnRZ1ZK3h7TLuOQG2xm6M3VjE/1k7gaU9+Le8dpOigsuW1bZAXDJgK+TZyMgsjqGOpdN2HzL4H7djug9hWO4t3B+k+x0IAwyWw8ChhA/0wPnffuXLufKWJ1VbKLrIHFZ6UJqWYBtmU8UqIxfjMt4wAeuvPjIRRQ3bwpCyyBOfT7KSD/gG+Fd2Ij1uXaly0JRn8dcMKCO6idGvTKmEvR+gXTEec3SC8pOQSVbJKcbz4E8fmjfQYTlHDHrHtnHsZdObNnnISdfZ9XldDHGeodEysQIVmeegCi7uAjZ/8nLCxG/+j2wUlhgHMonDQmMlv9BoPxwrX7ZbLZXBuO+YdOnOwvhz0adgUHScMw4ZYktE6coEhVwbH2oCZTToesOWDQd1OfWlSmVdXa5g2PHY29pxZaewBzJ6OFUI50Iuu2R2X7vRqxvD0EYxj7avkQNMjPYFwn7ua2LNO+oQFFJzGvzicRvGsT2K0wKPZaIDK1Em8o4oXCQJpF0nsamVSHo6FNjshqg+H9B/HFBvQUWDwpGXOJo173j1ickavenvPeKaqdd2F1VuRaARyoOOqUPFZh6dlmwi4yh5YljiRlZ23jZhiSNsLrZLt6rBEdDcKu5A1whVC369UvL5Te5v9PZPeyqD/YLZD1ihhO6P3soXM0AeyDtDFuJKACTUk6mNPTmhE=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB8[TBO]gfnRZ1ZK3h7TLuOQG2xm6M3VjE/1k7gaU9+Le8dpOigsuW1bZAXDJgK+TZyMgsjqGOpdN2HzL4H7djug9hWO4t3B+k+x0IAwyWw8ChhA/0wPnffuXLufKWJ1VbKLrIHFZ6UJqWYBtmU8UqIxfjMt4wAeuvPjIRRQ3bwpCyyBOfT7KSD/gG+Fd2Ij1uXaly0JRn8dcMKCO6idGvTKmEvR+gXTEec3SC8pOQSVbJKcbz4E8fmjfQYTlHDHrHtnHsZdObNnnISdfZ9XldDHGeodEysQIVmeegCi7uAjZ/8nLCxG/+j2wUlhgHMonDQmMlv9BoPxwrX7ZbLZXBuO+YdOnOwvhz0adgUHScMw4ZYktE6coEhVwbH2oCZTToesOWDQd1OfWlSmVdXa5g2PHY29pxZaewBzJ6OFUI50Iuu2R2X7vRqxvD0EYxj7avkQNMjPYFwn7ua2LNO+oQFFJzGvzicRvGsT2K0wKPZaIDK1Em8o4oXCQJpF0nsamVSHo6FNjshqg+H9B/HFBvQUWDwpGXOJo173j1ickavenvPeKaqdd2F1VuRaARyoOOqUPFZh6dlmwi4yh5YljiRlZ23jZhiSNsLrZLt6rBEdDcKu5A1whVC369UvL5Te5v9PZPeyqD/YLZD1ihhO6P3soXM0AeyDtDFuJKACTUk6mNPTmhE=",
              "IsRefundable": "No",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "597.25",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "205.46",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "802.71",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "0 KG",
                    "0 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "597.25",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "205.46",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "129.31",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "36.34",
                        "TaxCode": "K3",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "39.81",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "802.71",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "AUH",
                      "ArrivalDateTime": "2025-05-30T23:20:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T21:15:00",
                      "Eticket": true,
                      "FlightNumber": "217",
                      "JourneyDuration": "215",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "351",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "215",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-06-01T08:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "AUH",
                      "DepartureDateTime": "2025-05-31T20:50:00",
                      "Eticket": true,
                      "FlightNumber": "418",
                      "JourneyDuration": "440",
                      "MarketingAirlineCode": "EY",
                      "MarketingAirlineName": "Etihad Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EY",
                        "Name": "Etihad Airways",
                        "Equipment": "781",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "0001-01-01T00:00:00",
                      "DepartureDateTime": "0001-01-01T00:00:00",
                      "Duration": "440",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EY",
            "TicketAdvisory": ""
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB26[TBO]FytsY97yrZb1+gU/CZE0f/Ux76q5RInp6KT+PU7rM3xCTxKEbengLF57NZ1x1KlP3cPAXZrzVDKKSj6PhIPbv85FwXWspXZ0MH1ffoTzw3uWiBgU8myrpc2c5oXf71koDQe43RKj405g69D/ZYUXztU9M/YKePqqZ474zkpb4bnoYMMSeiaipbGI78OLkOrk2E1UyJ/BctjWWuGnxdGNMQHhUSL2s8n3HeNUvb3g9ox3oSsLSRZuQ8/pIAc89Uc509RIKCcFiLP3RK/NEElJEWIFEuHXvBL5ks3e/8mkjC6+68std/eusVTSD6G8OI1zhJr4ZIMa0/Su0DUHpnzmpc8BPttexyphI8CO1k58liasizRjVon+nBrCUOwJ72Xz0JpFA55DnBLXwSknftF0JcmGQsAC1Cn836rZgz47PnWm3zM1AFhE5k3mZ0ysGY9bQr26XeXJ6IbKyIFlhlTjG02GQt7QZODEL3c6OWTA9o9i/sF3yFT4+tRcEAUg/Mt/dzeGni368QCBkCbTLUWQUBJor7wVEdcPD8Kc8c8aWNb3gLM0GKlSioIzTZtxJX8nkXZ369HoaNZJL4fQFbCDN13fnCEfOaAkFCWmHPyAf0ssf7kfxDqZU6QBFyXj/LUAIHQDacd+4lqGQCmnIeoGEFpL5EF2hb9cNXrkoj+ijWg=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB26[TBO]FytsY97yrZb1+gU/CZE0f/Ux76q5RInp6KT+PU7rM3xCTxKEbengLF57NZ1x1KlP3cPAXZrzVDKKSj6PhIPbv85FwXWspXZ0MH1ffoTzw3uWiBgU8myrpc2c5oXf71koDQe43RKj405g69D/ZYUXztU9M/YKePqqZ474zkpb4bnoYMMSeiaipbGI78OLkOrk2E1UyJ/BctjWWuGnxdGNMQHhUSL2s8n3HeNUvb3g9ox3oSsLSRZuQ8/pIAc89Uc509RIKCcFiLP3RK/NEElJEWIFEuHXvBL5ks3e/8mkjC6+68std/eusVTSD6G8OI1zhJr4ZIMa0/Su0DUHpnzmpc8BPttexyphI8CO1k58liasizRjVon+nBrCUOwJ72Xz0JpFA55DnBLXwSknftF0JcmGQsAC1Cn836rZgz47PnWm3zM1AFhE5k3mZ0ysGY9bQr26XeXJ6IbKyIFlhlTjG02GQt7QZODEL3c6OWTA9o9i/sF3yFT4+tRcEAUg/Mt/dzeGni368QCBkCbTLUWQUBJor7wVEdcPD8Kc8c8aWNb3gLM0GKlSioIzTZtxJX8nkXZ369HoaNZJL4fQFbCDN13fnCEfOaAkFCWmHPyAf0ssf7kfxDqZU6QBFyXj/LUAIHQDacd+4lqGQCmnIeoGEFpL5EF2hb9cNXrkoj+ijWg=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "640.93",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "640.93",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "345.87",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "986.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "640.93",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "640.93",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "345.87",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "218.83",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "21.89",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "105.16",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "986.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "DOH",
                      "ArrivalDateTime": "2025-05-30T19:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T17:00:00",
                      "Eticket": true,
                      "FlightNumber": "4781",
                      "JourneyDuration": "280",
                      "MarketingAirlineCode": "QR",
                      "MarketingAirlineName": "Qatar Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "6E",
                        "Name": "Indigo Airlines",
                        "Equipment": "737",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "280",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T15:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DOH",
                      "DepartureDateTime": "2025-05-31T02:35:00",
                      "Eticket": true,
                      "FlightNumber": "852",
                      "JourneyDuration": "455",
                      "MarketingAirlineCode": "QR",
                      "MarketingAirlineName": "Qatar Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "QR",
                        "Name": "Qatar Airways",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "455",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "QR",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 25MAY25 - SEE SALES RSTNS \nFARE VALID FOR E TICKET ONLY \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB28[TBO]oLoo/2IEnCOGZxUD98kS1CxReGYHbx3MJVOPaOC4MIIdsh8rcoMyWTo3ia4U9MzkaIl2ha6o5CMNt8W/Dgm8APMo9H5J5+qs7DkWgC9la4IWW3RVpe9iOkX6TlzzjCULdqqnwOHno7h8amuqe0yaOYDIP/YxD4FZIS4yhEsg7o2xVWSFy+GfE07r7N6GD4Bdm8cxH+HVpUZmwzoVaEoGgR03L/GB36lrWmqrOiW6akBbXi60psb5YGJ09SuHXpcA0MoZ4GjicSGY3/n9VWxDmgGls+5SVQFFaOOJ25/X9NllV7Cj7u8V4bA7H7WmoHcZBKd9MxrJFLl9D4TJc778/H8ujgXKhBSpQRy71Anjk5drbVCYo+rO9C+KDfTS+LbEMmeL/rkmLKX1sMNf2lprpY5aqJc6c8zfk2nKrIz11/p+BiWSvPhM2qO0qiYhVAbbLRbzuNG1repX33m598wI98Lz6681bOVOOclaoLwraP8FOQSj6p+fLt2ebHMRzX1kyYJEpDRCBi2CvguIC8wJ4x+BsZXjUi+M1vSBZrT3LA3oANHKusSpEcy6vlEEOwqoFPVMSFhppvQCSRx6XHWzGNzjFzwKsU73lwNaLEpUi+JfBps6beN8nSHFMUXMbOWa8UqjdJbBBQWnVkLhVskKz/KVrebW8XyCn92RwEh1/ldiiV5mae3Sn2+EYKiBQdyn-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB28[TBO]oLoo/2IEnCOGZxUD98kS1CxReGYHbx3MJVOPaOC4MIIdsh8rcoMyWTo3ia4U9MzkaIl2ha6o5CMNt8W/Dgm8APMo9H5J5+qs7DkWgC9la4IWW3RVpe9iOkX6TlzzjCULdqqnwOHno7h8amuqe0yaOYDIP/YxD4FZIS4yhEsg7o2xVWSFy+GfE07r7N6GD4Bdm8cxH+HVpUZmwzoVaEoGgR03L/GB36lrWmqrOiW6akBbXi60psb5YGJ09SuHXpcA0MoZ4GjicSGY3/n9VWxDmgGls+5SVQFFaOOJ25/X9NllV7Cj7u8V4bA7H7WmoHcZBKd9MxrJFLl9D4TJc778/H8ujgXKhBSpQRy71Anjk5drbVCYo+rO9C+KDfTS+LbEMmeL/rkmLKX1sMNf2lprpY5aqJc6c8zfk2nKrIz11/p+BiWSvPhM2qO0qiYhVAbbLRbzuNG1repX33m598wI98Lz6681bOVOOclaoLwraP8FOQSj6p+fLt2ebHMRzX1kyYJEpDRCBi2CvguIC8wJ4x+BsZXjUi+M1vSBZrT3LA3oANHKusSpEcy6vlEEOwqoFPVMSFhppvQCSRx6XHWzGNzjFzwKsU73lwNaLEpUi+JfBps6beN8nSHFMUXMbOWa8UqjdJbBBQWnVkLhVskKz/KVrebW8XyCn92RwEh1/ldiiV5mae3Sn2+EYKiBQdyn",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "640.93",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "640.93",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "348.46",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "989.39",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "640.93",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "640.93",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "348.46",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "218.83",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "21.89",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "107.75",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "989.39",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "DOH",
                      "ArrivalDateTime": "2025-05-30T05:55:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T04:20:00",
                      "Eticket": true,
                      "FlightNumber": "4771",
                      "JourneyDuration": "245",
                      "MarketingAirlineCode": "QR",
                      "MarketingAirlineName": "Qatar Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "6E",
                        "Name": "Indigo Airlines",
                        "Equipment": "737",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "245",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T15:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DOH",
                      "DepartureDateTime": "2025-05-31T02:35:00",
                      "Eticket": true,
                      "FlightNumber": "852",
                      "JourneyDuration": "455",
                      "MarketingAirlineCode": "QR",
                      "MarketingAirlineName": "Qatar Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "QR",
                        "Name": "Qatar Airways",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "455",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "QR",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 25MAY25 - SEE SALES RSTNS \nFARE VALID FOR E TICKET ONLY \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB27[TBO]BjSX2QPnUCQw59O5v8F1UrKhdL51XY7RGanvslAG58blcvuTikvvTbv/DjyQeYstpoSWrHER+A/xTim9C9t51+5s+m1SRyzzb2SdBhZGLcsE9RyzFWRo1tPzn7FK1PH/kUud84V8XrNHerCP5eWyqwnc6vqDCmWaOHyIaXeqiCvujS09Ijegd8kfAxOaFw/2QzN/smUlg7+J9dR5C+GqrD0AbZdoBWXtzuiWLj/IT9ekxaEJJtO0mDDy9/23cyflJe3JiSIj3YpRq/iXKYr+zodcvm0V7aHN8jbq5xHMXeIw4sx9r2pa5TXyj3fAv0kcPLr9RPNsojhqeLMce8uvXXEJ6j6+sDDRUTbWF+9pktCt5jWg/o6rwwQM7xi1ZelWxKppQRdRHnQBwpfEyh9T5qK3axAQXyw7xZyCt4PtXFWuSBbf2vOG7V/ypH5jZSN9b1IpGEwD0zG85yrp4f17X5apsDJYMmV4IUjokD4FWW4nIz4rjrkAULGRYn1NJuonKcfL8oixCK7sHW+Yr3JGGd0tU5h3T24fgFwbSUL1vEsHDMJvqF0bJEKMSl0f47TXeJxbRW2lmzTIsp+Flk7tTzR6MiFpt7PbdLD3yjkwBBtQec0iwExYJpT17MvuASBOEceYTZ/z/fsQ6X9S+wSh6L1PkDgF8RBPILiU+FP+dTDcdhUdF8AOM6syYMmU6VYX-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB27[TBO]BjSX2QPnUCQw59O5v8F1UrKhdL51XY7RGanvslAG58blcvuTikvvTbv/DjyQeYstpoSWrHER+A/xTim9C9t51+5s+m1SRyzzb2SdBhZGLcsE9RyzFWRo1tPzn7FK1PH/kUud84V8XrNHerCP5eWyqwnc6vqDCmWaOHyIaXeqiCvujS09Ijegd8kfAxOaFw/2QzN/smUlg7+J9dR5C+GqrD0AbZdoBWXtzuiWLj/IT9ekxaEJJtO0mDDy9/23cyflJe3JiSIj3YpRq/iXKYr+zodcvm0V7aHN8jbq5xHMXeIw4sx9r2pa5TXyj3fAv0kcPLr9RPNsojhqeLMce8uvXXEJ6j6+sDDRUTbWF+9pktCt5jWg/o6rwwQM7xi1ZelWxKppQRdRHnQBwpfEyh9T5qK3axAQXyw7xZyCt4PtXFWuSBbf2vOG7V/ypH5jZSN9b1IpGEwD0zG85yrp4f17X5apsDJYMmV4IUjokD4FWW4nIz4rjrkAULGRYn1NJuonKcfL8oixCK7sHW+Yr3JGGd0tU5h3T24fgFwbSUL1vEsHDMJvqF0bJEKMSl0f47TXeJxbRW2lmzTIsp+Flk7tTzR6MiFpt7PbdLD3yjkwBBtQec0iwExYJpT17MvuASBOEceYTZ/z/fsQ6X9S+wSh6L1PkDgF8RBPILiU+FP+dTDcdhUdF8AOM6syYMmU6VYX",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "640.93",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "640.93",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "348.46",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "989.39",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "25 KG",
                    "25 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "640.93",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "640.93",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "348.46",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "218.83",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "21.89",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "107.75",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "989.39",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "DOH",
                      "ArrivalDateTime": "2025-05-30T05:55:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T04:20:00",
                      "Eticket": true,
                      "FlightNumber": "4771",
                      "JourneyDuration": "245",
                      "MarketingAirlineCode": "QR",
                      "MarketingAirlineName": "Qatar Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "6E",
                        "Name": "Indigo Airlines",
                        "Equipment": "737",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "245",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T07:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DOH",
                      "DepartureDateTime": "2025-05-30T19:15:00",
                      "Eticket": true,
                      "FlightNumber": "844",
                      "JourneyDuration": "455",
                      "MarketingAirlineCode": "QR",
                      "MarketingAirlineName": "Qatar Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "QR",
                        "Name": "Qatar Airways",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Q",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "455",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "QR",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 25MAY25 - SEE SALES RSTNS \nFARE VALID FOR E TICKET ONLY \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB31[TBO]aTo0ojPO7FvfzmBI20N1UtgKleSf8ETWfb6mYZ3grbzVoxFIEJekq9qO5kGJcRE9aruCfBs6h3YkMnZnD8iSdJm+OEL2lqPnt1Jetb5bD7m5ZruVnhVigDOQ6pVd7w0Hgb01VSCdsUpvdYxSPCGEUEDlk9/zsVFnI9ElG5aRjMIPIREE8NNUwG2W4BmRPyhuJIKWSL+n2aZmEzyfPUTv6p41JCQjylL8K8Mk1s2nOHl6kOLS8AnrH2Oa0YoYMFjUHyXStwYhcW00nwRHOn6mkhgHI1KQZSSqN+7yFqUaWracJHnnFrdmyFfiMMy43ZZ8SlbXJVbOnxUi2dgyCYWkdlvwKuAUu2/Jcx/Y8YeHNAtpaitM8azV3qMX4KBKz7Fctf/F4cAWs/ppXpG6Dy0ryvBhsDKP6AQkx+b8FxqiaXVYjdbbez1yfIw44DazDBSkARPjj5zXXuFhBlSy6k9MdSLSbEWjzyb+gri+i1Lq1KcX7mCy1qnOgZj3M/IJYyaRztfA7MgsVSuQFFaM8fDj0LEhnuSMBlzARPi/cbvf/eB767cEYnDA1jM1UkD56jfa54F4ilHSIYRH2YQQsMBMj/bdoZ/Qk6mIluywk8D5SDwLPKgFVHh/Gp/JMv+6hJD9nIZXHtO+aY3UvKIFu2IkZu+5/JTEZDgop7gkf4eu8M55VaOReQ0p1f2qIXgyHnBEdmlhrL7zleHN8mpAIvd3Og==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB31[TBO]aTo0ojPO7FvfzmBI20N1UtgKleSf8ETWfb6mYZ3grbzVoxFIEJekq9qO5kGJcRE9aruCfBs6h3YkMnZnD8iSdJm+OEL2lqPnt1Jetb5bD7m5ZruVnhVigDOQ6pVd7w0Hgb01VSCdsUpvdYxSPCGEUEDlk9/zsVFnI9ElG5aRjMIPIREE8NNUwG2W4BmRPyhuJIKWSL+n2aZmEzyfPUTv6p41JCQjylL8K8Mk1s2nOHl6kOLS8AnrH2Oa0YoYMFjUHyXStwYhcW00nwRHOn6mkhgHI1KQZSSqN+7yFqUaWracJHnnFrdmyFfiMMy43ZZ8SlbXJVbOnxUi2dgyCYWkdlvwKuAUu2/Jcx/Y8YeHNAtpaitM8azV3qMX4KBKz7Fctf/F4cAWs/ppXpG6Dy0ryvBhsDKP6AQkx+b8FxqiaXVYjdbbez1yfIw44DazDBSkARPjj5zXXuFhBlSy6k9MdSLSbEWjzyb+gri+i1Lq1KcX7mCy1qnOgZj3M/IJYyaRztfA7MgsVSuQFFaM8fDj0LEhnuSMBlzARPi/cbvf/eB767cEYnDA1jM1UkD56jfa54F4ilHSIYRH2YQQsMBMj/bdoZ/Qk6mIluywk8D5SDwLPKgFVHh/Gp/JMv+6hJD9nIZXHtO+aY3UvKIFu2IkZu+5/JTEZDgop7gkf4eu8M55VaOReQ0p1f2qIXgyHnBEdmlhrL7zleHN8mpAIvd3Og==",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "988.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "988.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "170.07",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "1158.7",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "23 KG",
                    "23 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "988.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "988.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "170.07",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "80.58",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "9.96",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "79.53",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "1158.7",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "BKK",
                      "ArrivalDateTime": "2025-05-30T09:15:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T03:20:00",
                      "Eticket": true,
                      "FlightNumber": "332",
                      "JourneyDuration": "265",
                      "MarketingAirlineCode": "TG",
                      "MarketingAirlineName": "Thai Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "TG",
                        "Name": "Thai Airways",
                        "Equipment": "788",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Y",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "265",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T17:30:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "BKK",
                      "DepartureDateTime": "2025-05-30T14:15:00",
                      "Eticket": true,
                      "FlightNumber": "789",
                      "JourneyDuration": "135",
                      "MarketingAirlineCode": "MH",
                      "MarketingAirlineName": "Malaysia Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "MH",
                        "Name": "Malaysia Airlines",
                        "Equipment": "73H",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Y",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "135",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "MH",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB30[TBO]vAE4S61lbWIPxYgi0VwhdMIJErsBq+ZUSpXy0G0lrBUQ7iM6AfRzeaD0gbhRlfD3IdN6DeQ876LLmJ5r+l7CY+pLSRlaWt2BbWQmR4xHsRN9GFAqEwlE6NdM+/wtelePgIK7f83kO19TjlzeyV+WB/hoZqVtz0y/Kg+nxPE8h6wwEpQh+dm7485ytvxyNRwp6CdWYVkl+4S8Ub3zlQz1idZ06sGhsJpyoqQqA97MLtD7jsVxhc7Ydu6vjE6NMHh26+Ut155GapagA/2HwjP8Vup9JdI5MUdiHGrFwEzKMykVbzbBlTxe5QvCu0E/4VTUYDAZQ2RIPDBl74elFp1/Ha3Ctdil47KlwkwcKkWMeyLzdzVYBDjhwISexrCL7fxb0N83HdWYoiNSh6FLSfxTZS5f5zJWtFZG/wSVWFl3tL0x+BMfS3kOJ3jGd7jJD1s+wXgOz63EJif3+Cy0Ppkq3JXRKMcSkvrAqSvIuBggYX6sLCH9i1nIvMK1rfAs+aZb7ylr2eKzWrN7S1eOY1//UV03jltIrWlnq4GqJQbtoJtGZFxdUMgvcyXYoeZsGgfgb3KcJ3hW2AiB2LvgtKF7Bo5qJj2avGivItUVXW+lTrS9YFxI6MLPShrf7mtIuzYCIfflbXP2wstAi+mg9MVN5XPLrbdVhdDDYVecXS9vcuATlf45XZYfAAoi1buiuW1A8Tlma3R3B8o4BZynqu2ITg==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB30[TBO]vAE4S61lbWIPxYgi0VwhdMIJErsBq+ZUSpXy0G0lrBUQ7iM6AfRzeaD0gbhRlfD3IdN6DeQ876LLmJ5r+l7CY+pLSRlaWt2BbWQmR4xHsRN9GFAqEwlE6NdM+/wtelePgIK7f83kO19TjlzeyV+WB/hoZqVtz0y/Kg+nxPE8h6wwEpQh+dm7485ytvxyNRwp6CdWYVkl+4S8Ub3zlQz1idZ06sGhsJpyoqQqA97MLtD7jsVxhc7Ydu6vjE6NMHh26+Ut155GapagA/2HwjP8Vup9JdI5MUdiHGrFwEzKMykVbzbBlTxe5QvCu0E/4VTUYDAZQ2RIPDBl74elFp1/Ha3Ctdil47KlwkwcKkWMeyLzdzVYBDjhwISexrCL7fxb0N83HdWYoiNSh6FLSfxTZS5f5zJWtFZG/wSVWFl3tL0x+BMfS3kOJ3jGd7jJD1s+wXgOz63EJif3+Cy0Ppkq3JXRKMcSkvrAqSvIuBggYX6sLCH9i1nIvMK1rfAs+aZb7ylr2eKzWrN7S1eOY1//UV03jltIrWlnq4GqJQbtoJtGZFxdUMgvcyXYoeZsGgfgb3KcJ3hW2AiB2LvgtKF7Bo5qJj2avGivItUVXW+lTrS9YFxI6MLPShrf7mtIuzYCIfflbXP2wstAi+mg9MVN5XPLrbdVhdDDYVecXS9vcuATlf45XZYfAAoi1buiuW1A8Tlma3R3B8o4BZynqu2ITg==",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "988.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "988.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "170.07",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "1158.7",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "23 KG",
                    "23 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "988.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "988.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "170.07",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "80.58",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "9.96",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "79.53",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "1158.7",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "BKK",
                      "ArrivalDateTime": "2025-05-30T17:35:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T11:40:00",
                      "Eticket": true,
                      "FlightNumber": "324",
                      "JourneyDuration": "265",
                      "MarketingAirlineCode": "TG",
                      "MarketingAirlineName": "Thai Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "TG",
                        "Name": "Thai Airways",
                        "Equipment": "333",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Y",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "265",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T22:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "BKK",
                      "DepartureDateTime": "2025-05-30T19:40:00",
                      "Eticket": true,
                      "FlightNumber": "781",
                      "JourneyDuration": "130",
                      "MarketingAirlineCode": "MH",
                      "MarketingAirlineName": "Malaysia Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "MH",
                        "Name": "Malaysia Airlines",
                        "Equipment": "73H",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Y",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "130",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "MH",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB32[TBO]OgEBemt4w2utYth1X3h7cAleH1x+qQnLHH8kmj4sqn6aj26B9yCrQDTVReVy2rgjG9TxG0BO9WBNAX44getC0xJtbErFwntxTGFmibyMbyarI0T1wzWOWs/8ektaHuasshaNjNLKhxYu5vLSnVm3YV6YHd1wVS//o+UT2FBDWR7siHKqEJ79+wulPbjGz9DzULhCTbqthRt2TD+sArkszGqVI4SrZgofQj/QlHT30mtCzSSr+FamiAMjSn9MmVOBaQylpnkR5WPvp60bHKi9ny6tth0LFoeCW9gSry0raMYX/LLz4ZRSE5im8x2jRamI/9VcIUT010IaPUSDjWoFEZcxwrHQ6dHcGX7aADMJaVJoRLeVxcuSTzWI7nd/A9icHoiDx/telndPa5zxyNaEfCzHZkTv6Y7Fp7pBeThqWkoh4U+Qs2oXUv7eK9J+msSJ6Gsoz/awkOCRe5+NdDYeTf9FQc7bflZUwVA2P4n9QIffWxUOdziefbRRrEiP8b5OVMJl7oMAs2OoLaG6hFHYGuYf5iKwq5eZyJ75MEYK+dO2OaEWLyEbQ9ouZD5ktp0+5g2NQT9mHIUdHyRhMhVsgqOuuYcXS0uBt8uDk4FtOGcFuajHoM88i0dIfAqIieaD1jvWMomtC65sPUolmhJgmQRfGTUSDFAD3gg1PZ/1wGSPkOM6lJM9RYzNxzLHZpXk6qk1ghn1hK1vdASJG2wkSA==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB32[TBO]OgEBemt4w2utYth1X3h7cAleH1x+qQnLHH8kmj4sqn6aj26B9yCrQDTVReVy2rgjG9TxG0BO9WBNAX44getC0xJtbErFwntxTGFmibyMbyarI0T1wzWOWs/8ektaHuasshaNjNLKhxYu5vLSnVm3YV6YHd1wVS//o+UT2FBDWR7siHKqEJ79+wulPbjGz9DzULhCTbqthRt2TD+sArkszGqVI4SrZgofQj/QlHT30mtCzSSr+FamiAMjSn9MmVOBaQylpnkR5WPvp60bHKi9ny6tth0LFoeCW9gSry0raMYX/LLz4ZRSE5im8x2jRamI/9VcIUT010IaPUSDjWoFEZcxwrHQ6dHcGX7aADMJaVJoRLeVxcuSTzWI7nd/A9icHoiDx/telndPa5zxyNaEfCzHZkTv6Y7Fp7pBeThqWkoh4U+Qs2oXUv7eK9J+msSJ6Gsoz/awkOCRe5+NdDYeTf9FQc7bflZUwVA2P4n9QIffWxUOdziefbRRrEiP8b5OVMJl7oMAs2OoLaG6hFHYGuYf5iKwq5eZyJ75MEYK+dO2OaEWLyEbQ9ouZD5ktp0+5g2NQT9mHIUdHyRhMhVsgqOuuYcXS0uBt8uDk4FtOGcFuajHoM88i0dIfAqIieaD1jvWMomtC65sPUolmhJgmQRfGTUSDFAD3gg1PZ/1wGSPkOM6lJM9RYzNxzLHZpXk6qk1ghn1hK1vdASJG2wkSA==",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "988.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "988.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "170.07",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "1158.7",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "23 KG",
                    "23 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "988.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "988.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "170.07",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "80.58",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "9.96",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "79.53",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "1158.7",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "BKK",
                      "ArrivalDateTime": "2025-05-31T05:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T23:30:00",
                      "Eticket": true,
                      "FlightNumber": "316",
                      "JourneyDuration": "265",
                      "MarketingAirlineCode": "TG",
                      "MarketingAirlineName": "Thai Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "TG",
                        "Name": "Thai Airways",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Y",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "265",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T14:15:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "BKK",
                      "DepartureDateTime": "2025-05-31T11:05:00",
                      "Eticket": true,
                      "FlightNumber": "785",
                      "JourneyDuration": "130",
                      "MarketingAirlineCode": "MH",
                      "MarketingAirlineName": "Malaysia Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "MH",
                        "Name": "Malaysia Airlines",
                        "Equipment": "73H",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Y",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "130",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "MH",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB29[TBO]sYyMRdz+FivVHHxFfluYJogr+jXbn72906OmR28jecHQytWvd6i9PX68Rie2cKkF6grdKOAhbK1EaZz/EibmYN8TO6FU/88/y5Cwt4ICGz/PbLHmDm1KIlvxja740Z03ORlkuMz9h6VVKrc9pIvbXtPeuPFc2D8rHg9dBNG1Chs2EjgaKb874VSK5EyLQuv2XGbBoEKetoL10MBUVUZTSle/Q4NO16sYw3CuwG0pNFLAqrbSeFHUZYN5ParyCjTwdN1oWxXX8bDxpYVkyB1YgG3buhDx97f0mikYilLwLzCMnEvZwDEAQvaoXH8ZFUHQeRL9ZtvxgfIBAbEmSrMuFTWfRG34S5jtJHsL0jN2le86LIlrEGNM6zT/pJ5OnMDJmgfHmiOrbi4NO6alAAgKAoBptLUyhXYQdiPuhiqYoQy+MtyEFFYdJBbMYJmb5MTNdkPM0cLEeXK+KTig0QxDTg3cvq/55TJltwNpCXyW9aiUYnL/Gvd4OUBWzPZGPyoLjWbQJ3CW1S8rDTwzXB/UIP2dZbCUciqaifBfIzmbxn7VkOW+P4D1G98KnQCHC0IcU78n/CLqgY01b1jsoxRrkX01p/F/xIYVVNnfsIJCHfuadbB060p1BBsQ5qOuvFGLryZ8qEN+UKlD9Q+gcf6mLhJBnhi68sEKijAHdjuzpuLMnqCBsS7yx83+T7wB8reQJh0wOSjBzphJDgnVefGJ6w==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB29[TBO]sYyMRdz+FivVHHxFfluYJogr+jXbn72906OmR28jecHQytWvd6i9PX68Rie2cKkF6grdKOAhbK1EaZz/EibmYN8TO6FU/88/y5Cwt4ICGz/PbLHmDm1KIlvxja740Z03ORlkuMz9h6VVKrc9pIvbXtPeuPFc2D8rHg9dBNG1Chs2EjgaKb874VSK5EyLQuv2XGbBoEKetoL10MBUVUZTSle/Q4NO16sYw3CuwG0pNFLAqrbSeFHUZYN5ParyCjTwdN1oWxXX8bDxpYVkyB1YgG3buhDx97f0mikYilLwLzCMnEvZwDEAQvaoXH8ZFUHQeRL9ZtvxgfIBAbEmSrMuFTWfRG34S5jtJHsL0jN2le86LIlrEGNM6zT/pJ5OnMDJmgfHmiOrbi4NO6alAAgKAoBptLUyhXYQdiPuhiqYoQy+MtyEFFYdJBbMYJmb5MTNdkPM0cLEeXK+KTig0QxDTg3cvq/55TJltwNpCXyW9aiUYnL/Gvd4OUBWzPZGPyoLjWbQJ3CW1S8rDTwzXB/UIP2dZbCUciqaifBfIzmbxn7VkOW+P4D1G98KnQCHC0IcU78n/CLqgY01b1jsoxRrkX01p/F/xIYVVNnfsIJCHfuadbB060p1BBsQ5qOuvFGLryZ8qEN+UKlD9Q+gcf6mLhJBnhi68sEKijAHdjuzpuLMnqCBsS7yx83+T7wB8reQJh0wOSjBzphJDgnVefGJ6w==",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "988.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "988.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "170.07",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "1158.7",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "23 KG",
                    "23 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "988.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "988.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "170.07",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "80.58",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "9.96",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "79.53",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "1158.7",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "BKK",
                      "ArrivalDateTime": "2025-05-30T09:15:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T03:20:00",
                      "Eticket": true,
                      "FlightNumber": "332",
                      "JourneyDuration": "265",
                      "MarketingAirlineCode": "TG",
                      "MarketingAirlineName": "Thai Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "TG",
                        "Name": "Thai Airways",
                        "Equipment": "788",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Y",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "265",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T14:15:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "BKK",
                      "DepartureDateTime": "2025-05-30T11:05:00",
                      "Eticket": true,
                      "FlightNumber": "785",
                      "JourneyDuration": "130",
                      "MarketingAirlineCode": "MH",
                      "MarketingAirlineName": "Malaysia Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "MH",
                        "Name": "Malaysia Airlines",
                        "Equipment": "73H",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Y",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "130",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "MH",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB38[TBO]fjZx+UjPJqBlNd4wINM5KbQxGoVaREdGLSk6mZBI0Ys8ii7HTtE478mXuSj0B1R9P+Yd6RRInLHet4gjYyB5sQVp/8gRSiAymPFDn1zGhzZBPEg+fw+MBT3ABGtxrLMFfQ6z+MSJC9hIMs5ynHqV2FOk7wM7fJqsjsoI/Xj3iHHR+dukTuS82PiBRLKTAbaTfv0a1w4bb3wxFM6XYTr7wzYGlnzZTntjGTh+dZk6h3GLqnawWP+xNss/NzfsahaMpAkpV0GQ6bsZRKDOam/ulcqlJRs0Mee/2LRMyjd5G2qWkpR8xTtbzGiuZwmDZXxOCILZ56d372lm++CE0eOqPvnWqi/UcNrgaitzesB/k1MMETO5/aFS8VPjZG8sV9JFfMuwuF0ZoTrCMCvsT80ghN6r7wuaM4yphZhsMRi/FdhlFxlMVAjQTALeDNDxjGuyeX6FLTH30WkNAW+pIJMwbt+BBnG3cleDm/pj6j6g96pBVj1MXo3lwI3NLhK6ztZE8eglbGkpCCfAt1axowbwCVutS6I5/s2xACkkulEOBiiUmW+sKOok+14x50tpnjHYLlaHiuq3fxGVBzRe1IM+xhjx3KlOIjh0AUVmLhopTkbNr0u33wxTIFvI28NnyEIFAy2CYHdpl3n9acWGDK9OyzCagX6HKvEM5HraQw7QVjY=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB38[TBO]fjZx+UjPJqBlNd4wINM5KbQxGoVaREdGLSk6mZBI0Ys8ii7HTtE478mXuSj0B1R9P+Yd6RRInLHet4gjYyB5sQVp/8gRSiAymPFDn1zGhzZBPEg+fw+MBT3ABGtxrLMFfQ6z+MSJC9hIMs5ynHqV2FOk7wM7fJqsjsoI/Xj3iHHR+dukTuS82PiBRLKTAbaTfv0a1w4bb3wxFM6XYTr7wzYGlnzZTntjGTh+dZk6h3GLqnawWP+xNss/NzfsahaMpAkpV0GQ6bsZRKDOam/ulcqlJRs0Mee/2LRMyjd5G2qWkpR8xTtbzGiuZwmDZXxOCILZ56d372lm++CE0eOqPvnWqi/UcNrgaitzesB/k1MMETO5/aFS8VPjZG8sV9JFfMuwuF0ZoTrCMCvsT80ghN6r7wuaM4yphZhsMRi/FdhlFxlMVAjQTALeDNDxjGuyeX6FLTH30WkNAW+pIJMwbt+BBnG3cleDm/pj6j6g96pBVj1MXo3lwI3NLhK6ztZE8eglbGkpCCfAt1axowbwCVutS6I5/s2xACkkulEOBiiUmW+sKOok+14x50tpnjHYLlaHiuq3fxGVBzRe1IM+xhjx3KlOIjh0AUVmLhopTkbNr0u33wxTIFvI28NnyEIFAy2CYHdpl3n9acWGDK9OyzCagX6HKvEM5HraQw7QVjY=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "236.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "1176.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "236.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "144.24",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "91.86",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "1176.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "DXB",
                      "ArrivalDateTime": "2025-05-31T00:05:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T22:00:00",
                      "Eticket": true,
                      "FlightNumber": "515",
                      "JourneyDuration": "215",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "215",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T21:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DXB",
                      "DepartureDateTime": "2025-05-31T10:25:00",
                      "Eticket": true,
                      "FlightNumber": "342",
                      "JourneyDuration": "445",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "388",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "445",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EK",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB33[TBO]orFRZZgI8rZ0i5g4etxj+WZV7wH1M39GHo6kiovWYL4QyLLN13e4crxng6zbQLmBsxDCgmhZ6bC1Dt6kG4LqwbJqtoz/RTMlpOh1zNwJmbvNP/VXKr7nXWIlBgJfMNC9uq3byrQXZIxf+69CMxaTpZKR3jS1ilkqdr9ywMlEzxN+FG3VKIuvfrtAl2qTnXlTwyWI9Qry5jvxPPylSCFlkv3DXJicCKnjPeWQhy0YYCcjmCw5d2tneDDBfKMLOKXxSxeqtHzINoA3nNL5QzX1yLZFmJFBLawywXyfYVJp75Cap7UG4LNVyWhIN5LSMdbSwVmFkyKeKzziw9Edmmm7YIhJATnFiTYcjyQffvX4n5NeZdWmceRCXHbU5T0cveKC9vElyGh//5aPUREObLSN496t3G/VNz0QWtIywK2QKKMYVGuRNwQZ6mAYkzSIIi6YPRv0GLXTgeBgWD+rA1wqrzMcaC+XL1xQUWiEVZIrPhaX5IqbjwR0pr1Qfrs8W4qZiAYgiU6PziyG1oxLgTNJWAUbMmyApuYD749bpVeTTGspKKNvqfhDHZ55cneLm9FLEnrEuIS70ZknlR5QH8N+BRAD/wodoLVvE47UQKGc4Re3h/B8FD7yKpPc0iFyXuRKXgha3OQxYfG/sE22QFlA9pKAcKnPHqCEFlLRX5WRGuI=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB33[TBO]orFRZZgI8rZ0i5g4etxj+WZV7wH1M39GHo6kiovWYL4QyLLN13e4crxng6zbQLmBsxDCgmhZ6bC1Dt6kG4LqwbJqtoz/RTMlpOh1zNwJmbvNP/VXKr7nXWIlBgJfMNC9uq3byrQXZIxf+69CMxaTpZKR3jS1ilkqdr9ywMlEzxN+FG3VKIuvfrtAl2qTnXlTwyWI9Qry5jvxPPylSCFlkv3DXJicCKnjPeWQhy0YYCcjmCw5d2tneDDBfKMLOKXxSxeqtHzINoA3nNL5QzX1yLZFmJFBLawywXyfYVJp75Cap7UG4LNVyWhIN5LSMdbSwVmFkyKeKzziw9Edmmm7YIhJATnFiTYcjyQffvX4n5NeZdWmceRCXHbU5T0cveKC9vElyGh//5aPUREObLSN496t3G/VNz0QWtIywK2QKKMYVGuRNwQZ6mAYkzSIIi6YPRv0GLXTgeBgWD+rA1wqrzMcaC+XL1xQUWiEVZIrPhaX5IqbjwR0pr1Qfrs8W4qZiAYgiU6PziyG1oxLgTNJWAUbMmyApuYD749bpVeTTGspKKNvqfhDHZ55cneLm9FLEnrEuIS70ZknlR5QH8N+BRAD/wodoLVvE47UQKGc4Re3h/B8FD7yKpPc0iFyXuRKXgha3OQxYfG/sE22QFlA9pKAcKnPHqCEFlLRX5WRGuI=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "236.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "1176.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "236.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "144.24",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "91.86",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "1176.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "DXB",
                      "ArrivalDateTime": "2025-05-30T18:20:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T16:20:00",
                      "Eticket": true,
                      "FlightNumber": "517",
                      "JourneyDuration": "210",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "210",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T08:40:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DXB",
                      "DepartureDateTime": "2025-05-30T21:15:00",
                      "Eticket": true,
                      "FlightNumber": "344",
                      "JourneyDuration": "445",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "445",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EK",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB34[TBO]U0Rmhk69LovCm7U1n3dqj9O5jO9P5dtg3/E3b2PnBg0PHp4BP73fZm/jKhf4HH3Kd4LSqmUdflUbeZgFX9qp6gn81OJsTX4acLXKbtoCeOg03F35v40DOB/EsC5r2BUMjvcNov0XArjduT0pnwOtjTnJeCyCweO/Wzh4hUYy3rkjf23PkwaqxSJhrUyk1T6DPKCqLkrE1KzRsh4fXuAozeppdVufPMHde2/CMBtCPM96NWWdJ+CT+k74Lp8s0ao/7LW7+/WSwSLJwc2Wog7zwNfNOYv0+VtnNbdkrcgfIj1jh8vlDcEwKPG9lRpUEbKB+798vvNSAG1mR0xJap4ynU2f39VLr1BTnYYOoIu6qs3DZn4IyUSBuCRpMhD8e8ckv0xLQ7VYjI/d8HCmqxJXXNB60jxnCC4Sv+RwzKiTDaeSYuU78ldH9tPv+dI+VDGrBFdXQfxzguH3VJHqW0MGWec3+R+wkVhSPl8uIckoq7lV7BEGvoQPVVoeS0YQFPbgpbjZD8aqqsP+4o98binptvvz1/JL72f1jZA8dwhjhwOjdVMdT5BK2U3yRu4TIQxxPuyRSCEHQjiefqPKOCu6PCg4MnvkdrQFVQzgiPTVV/OGZFwQqUuS7iEHHQsnwhuyFko3tLbG+GCbuwgaWnUL+Q84kQwBL544ER08qufr5lc=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB34[TBO]U0Rmhk69LovCm7U1n3dqj9O5jO9P5dtg3/E3b2PnBg0PHp4BP73fZm/jKhf4HH3Kd4LSqmUdflUbeZgFX9qp6gn81OJsTX4acLXKbtoCeOg03F35v40DOB/EsC5r2BUMjvcNov0XArjduT0pnwOtjTnJeCyCweO/Wzh4hUYy3rkjf23PkwaqxSJhrUyk1T6DPKCqLkrE1KzRsh4fXuAozeppdVufPMHde2/CMBtCPM96NWWdJ+CT+k74Lp8s0ao/7LW7+/WSwSLJwc2Wog7zwNfNOYv0+VtnNbdkrcgfIj1jh8vlDcEwKPG9lRpUEbKB+798vvNSAG1mR0xJap4ynU2f39VLr1BTnYYOoIu6qs3DZn4IyUSBuCRpMhD8e8ckv0xLQ7VYjI/d8HCmqxJXXNB60jxnCC4Sv+RwzKiTDaeSYuU78ldH9tPv+dI+VDGrBFdXQfxzguH3VJHqW0MGWec3+R+wkVhSPl8uIckoq7lV7BEGvoQPVVoeS0YQFPbgpbjZD8aqqsP+4o98binptvvz1/JL72f1jZA8dwhjhwOjdVMdT5BK2U3yRu4TIQxxPuyRSCEHQjiefqPKOCu6PCg4MnvkdrQFVQzgiPTVV/OGZFwQqUuS7iEHHQsnwhuyFko3tLbG+GCbuwgaWnUL+Q84kQwBL544ER08qufr5lc=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "236.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "1176.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "236.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "144.24",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "91.86",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "1176.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "DXB",
                      "ArrivalDateTime": "2025-05-31T00:05:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T22:00:00",
                      "Eticket": true,
                      "FlightNumber": "515",
                      "JourneyDuration": "215",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "215",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T14:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DXB",
                      "DepartureDateTime": "2025-05-31T03:10:00",
                      "Eticket": true,
                      "FlightNumber": "346",
                      "JourneyDuration": "435",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "435",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EK",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB35[TBO]S+TTCaIeNHtDchrKyQXy6HMN5UaFFi7DJjrGhAMqL/tw0XHlRvxZFU4+/FWIKJtaeb/DcrAXuhxTMyzZ1+djYhEcxhejcvBHbml66xOddvoGw47Vdfk9uislndy3RDIXMCl0wC6KpJSbFXU32jD4FI+mI8RzMood6jiKlD3IDZaLdpiSv4WAk+Ja7lnsNx5A5W32UYr0fDGNBDSm9TbA9+VL8neCgWM0B4sBqaUqQ7/BqN5t7Gz5NnJyvVV4RD2T0fA4/X4/iLPHfD64VzYx+pN2asaolxwtCzyj27wKwbvreju7yHpZeXptXzqpxIf82pHOQy8XIe/nZbHjnUOI1nseQsQd1x/uWuxJelwN71g0L5ZWPArMZEg5SepmBpe3rwc4tCsThTMHQtV8QLeEAwDzunZzNTT4wHhQl3UJONg6SRSA8eHXdO6GE4mriWAT9ozIyJv2acWakUP6Zr+qjGZwWXsPiL/RhmvAr7nosE/qTp0+lMvUaD9GlAi1L5ITqjOmL3eUVX5UYoHjEOcWjUE2jxNZdJslf4h/hPFHMsJwkQhOICjfKf2Bzh3DyJ2RB5psmU457tmsgfhobtyjJ9kPSsdX1ssvJRQb/m2lnxkVfWhn/qSy9wCQRRahkJs91Td7QnV8r3YRhj29bP8sH0G9dQwVWto0HGuhH5dpL9M=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB35[TBO]S+TTCaIeNHtDchrKyQXy6HMN5UaFFi7DJjrGhAMqL/tw0XHlRvxZFU4+/FWIKJtaeb/DcrAXuhxTMyzZ1+djYhEcxhejcvBHbml66xOddvoGw47Vdfk9uislndy3RDIXMCl0wC6KpJSbFXU32jD4FI+mI8RzMood6jiKlD3IDZaLdpiSv4WAk+Ja7lnsNx5A5W32UYr0fDGNBDSm9TbA9+VL8neCgWM0B4sBqaUqQ7/BqN5t7Gz5NnJyvVV4RD2T0fA4/X4/iLPHfD64VzYx+pN2asaolxwtCzyj27wKwbvreju7yHpZeXptXzqpxIf82pHOQy8XIe/nZbHjnUOI1nseQsQd1x/uWuxJelwN71g0L5ZWPArMZEg5SepmBpe3rwc4tCsThTMHQtV8QLeEAwDzunZzNTT4wHhQl3UJONg6SRSA8eHXdO6GE4mriWAT9ozIyJv2acWakUP6Zr+qjGZwWXsPiL/RhmvAr7nosE/qTp0+lMvUaD9GlAi1L5ITqjOmL3eUVX5UYoHjEOcWjUE2jxNZdJslf4h/hPFHMsJwkQhOICjfKf2Bzh3DyJ2RB5psmU457tmsgfhobtyjJ9kPSsdX1ssvJRQb/m2lnxkVfWhn/qSy9wCQRRahkJs91Td7QnV8r3YRhj29bP8sH0G9dQwVWto0HGuhH5dpL9M=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "236.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "1176.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "236.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "144.24",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "91.86",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "1176.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "DXB",
                      "ArrivalDateTime": "2025-05-30T06:20:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T04:15:00",
                      "Eticket": true,
                      "FlightNumber": "513",
                      "JourneyDuration": "215",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "215",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-30T21:50:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DXB",
                      "DepartureDateTime": "2025-05-30T10:25:00",
                      "Eticket": true,
                      "FlightNumber": "342",
                      "JourneyDuration": "445",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "388",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "445",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EK",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB36[TBO]EnDdSeGus7TajNEVMOQNZ8I62I2yOO4QEqh7wYrCHAJByicdokGjGIbkynckRlYANJXpO/0oRU8necNewLXKDAagFCK1FcfpRcf/0mty3lsZTlAsX/XtWlQl3amlmHbS6SnFSiQlpXm3Hxm8XBpsR/9yfcxqh6YiLeFNzb/G+u9SzJpSFEEDAs/hN733bVcic9VgxgmZ0wfDtri892Ey6aiSg/mpyyRk9UBJf2UV8K+TMUBhpRYqnJyaHktSnG1bUHnsJjNvS8FYcE/p0RCenlyX8JCo/zwi2IWcxcjmNtguxqF56q9Xt38g3Vq+E1LBNmybDV0Upm8WQYhb5GhmzBIoJP0l0C+e5DohCxufpFKOfC7gC5qxRovfH/cnL/e1uumUqpoJmnGypgfW2tBdtFBmYQGHI43fKBlYAX9rRZ7/eevwmSft8C4/euYKUYnLEHLTUPKve8gXAxXwp6sxwUA2mmvl4BX3cC+3JB+foAke9wS/eR3yZqYqU+5zX4nZQErPiW/hu3sVB7v6Y7gxPC/5sGKQHhO8UsThchR8gbFFMosoTLBg9nISmvcAIo8yN0qovwrx6MvUaghZDNiXnE5PoFAQ/76lPKWh+QOLpDNw+ixE1j/aN3423gylg42SO2jZhOuLjtj2UdOecLFCZy1XnhMghucPSXsB5ejiYTU=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB36[TBO]EnDdSeGus7TajNEVMOQNZ8I62I2yOO4QEqh7wYrCHAJByicdokGjGIbkynckRlYANJXpO/0oRU8necNewLXKDAagFCK1FcfpRcf/0mty3lsZTlAsX/XtWlQl3amlmHbS6SnFSiQlpXm3Hxm8XBpsR/9yfcxqh6YiLeFNzb/G+u9SzJpSFEEDAs/hN733bVcic9VgxgmZ0wfDtri892Ey6aiSg/mpyyRk9UBJf2UV8K+TMUBhpRYqnJyaHktSnG1bUHnsJjNvS8FYcE/p0RCenlyX8JCo/zwi2IWcxcjmNtguxqF56q9Xt38g3Vq+E1LBNmybDV0Upm8WQYhb5GhmzBIoJP0l0C+e5DohCxufpFKOfC7gC5qxRovfH/cnL/e1uumUqpoJmnGypgfW2tBdtFBmYQGHI43fKBlYAX9rRZ7/eevwmSft8C4/euYKUYnLEHLTUPKve8gXAxXwp6sxwUA2mmvl4BX3cC+3JB+foAke9wS/eR3yZqYqU+5zX4nZQErPiW/hu3sVB7v6Y7gxPC/5sGKQHhO8UsThchR8gbFFMosoTLBg9nISmvcAIo8yN0qovwrx6MvUaghZDNiXnE5PoFAQ/76lPKWh+QOLpDNw+ixE1j/aN3423gylg42SO2jZhOuLjtj2UdOecLFCZy1XnhMghucPSXsB5ejiYTU=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "236.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "1176.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "236.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "144.24",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "91.86",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "1176.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "DXB",
                      "ArrivalDateTime": "2025-05-30T13:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T11:00:00",
                      "Eticket": true,
                      "FlightNumber": "511",
                      "JourneyDuration": "210",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "210",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T08:40:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DXB",
                      "DepartureDateTime": "2025-05-30T21:15:00",
                      "Eticket": true,
                      "FlightNumber": "344",
                      "JourneyDuration": "445",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "445",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EK",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB37[TBO]L+u5I5Py3cQ5KHNZhm1B8JvZpB7XXnUh2/zFTtal/6JYYrB984RXcazqJxM06fh1tAh8fktKFjA2Tylq0ZMasAPwWyXRzmtDhhz2B0TBtpetodJGM3V+vlrO0r6BakQAkkcUPaSaXSdTgy3Vk5Csx5IcPBVZqk6jpyuIf45i1GDsE5rESmsXhlKG2nhkhvaxwBJriUMYI2wdoNMlEuBhbvSSeBgvbhRE4Y/vajsq0nzCxuNrzl6FY0f9Ok9JBw+ym+UkA9cNlALIp8eI1InIYzpMH3ofrVKNfJ09QyUMht5ey8XceT48zvyzkT0M9poWEmTPUEaWydG+zsqFloBSlZ3d8ytYS3TinuuPY8HWLXyhmuXUW4i+3O0TN4tueOgE6QrmGK7Xt8TLmAIbMzDVhfTNOj9bHmxMmHchomX26oxdUNwPh7CmgW7i0hV65zz9h0VIEawki0FSQyB6Ff+PogP0WEQyebmuqcNRr3NrbHAa3vrzZVnL/Mk5j7qMKYsLbE5Yj//Fh5EkRNkjHGqHWdWDeYh4tW6wcKDU4UDwNfT5cvme2gm6V9NYLl9RfIJvFCTNQ2/YD66e94Hrt5vec3RIqse45N3oBxH9wE7nv5EoAxvHB1C4MpILOosZytVePVZ8LLvQtWHCg41pGSQiPNcYwsb+DPmaw/4E8mp5EAA=-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB37[TBO]L+u5I5Py3cQ5KHNZhm1B8JvZpB7XXnUh2/zFTtal/6JYYrB984RXcazqJxM06fh1tAh8fktKFjA2Tylq0ZMasAPwWyXRzmtDhhz2B0TBtpetodJGM3V+vlrO0r6BakQAkkcUPaSaXSdTgy3Vk5Csx5IcPBVZqk6jpyuIf45i1GDsE5rESmsXhlKG2nhkhvaxwBJriUMYI2wdoNMlEuBhbvSSeBgvbhRE4Y/vajsq0nzCxuNrzl6FY0f9Ok9JBw+ym+UkA9cNlALIp8eI1InIYzpMH3ofrVKNfJ09QyUMht5ey8XceT48zvyzkT0M9poWEmTPUEaWydG+zsqFloBSlZ3d8ytYS3TinuuPY8HWLXyhmuXUW4i+3O0TN4tueOgE6QrmGK7Xt8TLmAIbMzDVhfTNOj9bHmxMmHchomX26oxdUNwPh7CmgW7i0hV65zz9h0VIEawki0FSQyB6Ff+PogP0WEQyebmuqcNRr3NrbHAa3vrzZVnL/Mk5j7qMKYsLbE5Yj//Fh5EkRNkjHGqHWdWDeYh4tW6wcKDU4UDwNfT5cvme2gm6V9NYLl9RfIJvFCTNQ2/YD66e94Hrt5vec3RIqse45N3oBxH9wE7nv5EoAxvHB1C4MpILOosZytVePVZ8LLvQtWHCg41pGSQiPNcYwsb+DPmaw/4E8mp5EAA=",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "940.54",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "236.1",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "1176.64",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "940.54",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "236.1",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "144.24",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "91.86",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "1176.64",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "DXB",
                      "ArrivalDateTime": "2025-05-30T18:20:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T16:20:00",
                      "Eticket": true,
                      "FlightNumber": "517",
                      "JourneyDuration": "210",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "210",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T14:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DXB",
                      "DepartureDateTime": "2025-05-31T03:10:00",
                      "Eticket": true,
                      "FlightNumber": "346",
                      "JourneyDuration": "435",
                      "MarketingAirlineCode": "EK",
                      "MarketingAirlineName": "Emirates",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "EK",
                        "Name": "Emirates",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "K",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "435",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "EK",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 30MAY25 - DATE OF ORIGIN \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB39[TBO]5V/M15loYWT49pTDdqrOn4gT7OZlG/N6WBHGxXBOG/hlBgMkNIntiqbyVStq7kife9LpkBivA3oP++TSc1q0O69GSbvJ7NPZPqgXbyKTSVGq/BKtG7egQesHCH4K1Er1RELcxurybj2t0ryZrHd/HiOY+Xbc7QFvGNh+uvZYyJdMs3V1qR7/rAKNvMOAwnMtQZ5k55mvZHzDB5aRwuQFhXLoZAvqzxEn2D4iSG+cAZzCRmj81L3zWLxGDE8lrGpjS48c9Hrj5g+sgPI/8rfNKm5DP2nkBf/35kotw8JZjWWkV+Bifsi74WBuoQZDY+wtbY7hkUez20rIZIB822vSMCDfrv7jhFqEVIqVQD1oemQxV86zzP/ieaOnbruy3qVJR+IkZPIqNA1obzAF+nhkAn33StowXSSJhNcaJVc7XK0UnrCigKdk49A2tXra0maaDB0p8oFkg+opUp8gfXi7Q51OD3FXs8XaxtkWlOZDP8eW96S17bEhX4f3JQnvXjB2+aRUJIHP2cBeUFXwTfzKWj7GGQGlMKIny8tHRkIGGEJ6A6DyKcFZ+hhnx6a3flXU/pFsKBKJW8lJmr/lnQcMqjBwZZJys/vdFL1853WUdNRlY9Fr7tzDMXlbDOhWASFU9YleEYVmX9VpwgkGb+7qFFqbJoDcBmE2fPMLKl5REqLzbau5hPP66N9QAc///wbZXgwM5gledXC+8Q2lQHgo8A==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB39[TBO]5V/M15loYWT49pTDdqrOn4gT7OZlG/N6WBHGxXBOG/hlBgMkNIntiqbyVStq7kife9LpkBivA3oP++TSc1q0O69GSbvJ7NPZPqgXbyKTSVGq/BKtG7egQesHCH4K1Er1RELcxurybj2t0ryZrHd/HiOY+Xbc7QFvGNh+uvZYyJdMs3V1qR7/rAKNvMOAwnMtQZ5k55mvZHzDB5aRwuQFhXLoZAvqzxEn2D4iSG+cAZzCRmj81L3zWLxGDE8lrGpjS48c9Hrj5g+sgPI/8rfNKm5DP2nkBf/35kotw8JZjWWkV+Bifsi74WBuoQZDY+wtbY7hkUez20rIZIB822vSMCDfrv7jhFqEVIqVQD1oemQxV86zzP/ieaOnbruy3qVJR+IkZPIqNA1obzAF+nhkAn33StowXSSJhNcaJVc7XK0UnrCigKdk49A2tXra0maaDB0p8oFkg+opUp8gfXi7Q51OD3FXs8XaxtkWlOZDP8eW96S17bEhX4f3JQnvXjB2+aRUJIHP2cBeUFXwTfzKWj7GGQGlMKIny8tHRkIGGEJ6A6DyKcFZ+hhnx6a3flXU/pFsKBKJW8lJmr/lnQcMqjBwZZJys/vdFL1853WUdNRlY9Fr7tzDMXlbDOhWASFU9YleEYVmX9VpwgkGb+7qFFqbJoDcBmE2fPMLKl5REqLzbau5hPP66N9QAc///wbZXgwM5gledXC+8Q2lQHgo8A==",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "907.92",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "907.92",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "349.85",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "1257.76",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "30 KG",
                    "30 KG"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "907.92",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "907.92",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "349.85",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "23.88",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "235.73",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "90.24",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "1257.76",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "IST",
                      "ArrivalDateTime": "2025-05-30T11:10:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T06:35:00",
                      "Eticket": true,
                      "FlightNumber": "4650",
                      "JourneyDuration": "425",
                      "MarketingAirlineCode": "TK",
                      "MarketingAirlineName": "Turkish Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "6E",
                        "Name": "Indigo Airlines",
                        "Equipment": "77W",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "W",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 4
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "425",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T07:05:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "IST",
                      "DepartureDateTime": "2025-05-30T15:50:00",
                      "Eticket": true,
                      "FlightNumber": "62",
                      "JourneyDuration": "615",
                      "MarketingAirlineCode": "TK",
                      "MarketingAirlineName": "Turkish Airlines",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "TK",
                        "Name": "Turkish Airlines",
                        "Equipment": "359",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "H",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "615",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "GP",
            "TicketAdvisory": "PENALTY APPLIES \nLAST TKT DTE 27MAY25 - SEE ADV PURCHASE \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB40[TBO]gwLReiGejv2BssQVIVY1iCIsbClPLOG47wCiylWmzUPtu99vZIb7vjDVGy2VOgVESnx/+qYkgv1IaynzHXc1guHno8vPtHiNOEe6PESqqly0BXKngPkmy52u5Vn1xDa0fSC722jcRWXvK5XttUIFoDkkSAGgZNoLToGh6czyKu412dwj3PD+1h6NvkGYfeDRxzHh8DDFE4MRt8dUAdNXEoG4iJG8ycxUe1loVUExVYfuQPRsVBcwvLFJSkIA5m2FVnyJB4sRkPz25SC54rkKnCgzSFE0ZSBYBmUXhYJtRiKiKzu+8JdAsc8aq9DPurkhm6eToBGiD27VC98CkEmrsHWZB5vf5d2KFfbAV1OKgQQgZ6lOhzk77J9zELlNewHAakj5+u5VCjjvACfA1wBwBCE9KcHNOYlu3eUD8o5pElAr4TkzIL7LpmgXPQuL4q1VnoUGvoPuk/v8qBZhgpwdqbT+sHoLcQWPAUIwa3buxqDStwaxA6w8cKaMH8uIKM9rffHq76qZWRUbi2qjWTtNyI7x+6VoDp3BhpaBSpFu8ldw+g6IXWkzX1rnplBOg1fQkWzzaPgWi8JRrNZULNB58tIDjinlsUmcit+km7LhgMqBuIOi8vsGrRM5voj6CZVP-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB40[TBO]gwLReiGejv2BssQVIVY1iCIsbClPLOG47wCiylWmzUPtu99vZIb7vjDVGy2VOgVESnx/+qYkgv1IaynzHXc1guHno8vPtHiNOEe6PESqqly0BXKngPkmy52u5Vn1xDa0fSC722jcRWXvK5XttUIFoDkkSAGgZNoLToGh6czyKu412dwj3PD+1h6NvkGYfeDRxzHh8DDFE4MRt8dUAdNXEoG4iJG8ycxUe1loVUExVYfuQPRsVBcwvLFJSkIA5m2FVnyJB4sRkPz25SC54rkKnCgzSFE0ZSBYBmUXhYJtRiKiKzu+8JdAsc8aq9DPurkhm6eToBGiD27VC98CkEmrsHWZB5vf5d2KFfbAV1OKgQQgZ6lOhzk77J9zELlNewHAakj5+u5VCjjvACfA1wBwBCE9KcHNOYlu3eUD8o5pElAr4TkzIL7LpmgXPQuL4q1VnoUGvoPuk/v8qBZhgpwdqbT+sHoLcQWPAUIwa3buxqDStwaxA6w8cKaMH8uIKM9rffHq76qZWRUbi2qjWTtNyI7x+6VoDp3BhpaBSpFu8ldw+g6IXWkzX1rnplBOg1fQkWzzaPgWi8JRrNZULNB58tIDjinlsUmcit+km7LhgMqBuIOi8vsGrRM5voj6CZVP",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "2696.12",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "2696.12",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "778.23",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "3474.35",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "2 PC(s)",
                    "2 PC(s)"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "2696.12",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "2696.12",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "778.23",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "337.18",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "9.96",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "431.09",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "3474.35",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "LHR",
                      "ArrivalDateTime": "2025-05-30T15:25:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T10:05:00",
                      "Eticket": true,
                      "FlightNumber": "256",
                      "JourneyDuration": "590",
                      "MarketingAirlineCode": "BA",
                      "MarketingAirlineName": "British Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "BA",
                        "Name": "British Airways",
                        "Equipment": "351",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "W",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "590",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-05-31T17:20:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "LHR",
                      "DepartureDateTime": "2025-05-30T21:10:00",
                      "Eticket": true,
                      "FlightNumber": "33",
                      "JourneyDuration": "790",
                      "MarketingAirlineCode": "BA",
                      "MarketingAirlineName": "British Airways",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "BA",
                        "Name": "British Airways",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Y",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "790",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "BA",
            "TicketAdvisory": "LAST TKT DTE 26MAY25 - SEE ADV PURCHASE \nFARE VALID FOR E TICKET ONLY \n"
          }
        },
        {
          "FareItinerary": {
            "AirItineraryFareInfo": {
              "DivideInPartyIndicator": "false",
              "FareSourceCode": "e556c2f1-ce68-42bf-9bc8-88a43fdbc506-RI-OB41[TBO]Trwg0sTYKZiJ4E+zrgeoy5Swa99Hdo8AD6tnS/08SwsgYmrNRoHxAHppqgPJCmOVkQu61EEVRUG6qpT292ZZY57IKKFatPms4hkbtPjsjylnlgQ7inYX6egIxVW3LFmP3+VdhJ44wkVPWHZ4yg/7Ot9/gSEiZFMW10cFVPAMvCA69tF/z3JA9lpQ0YOKEKTy1k/MoOfDrCDkLfJVBPyGgM8jg6FoOmOmkvC1cA8EiJmLF/CxH6KIg9q6SC3OmADXHEDAzAC1mWZOxceCg+loQQ2n2QosbJpJsPUcQSU6D/uWeEh8eU7bTzLKxPFY1OI1ohbl5GjYCoFaQcmLSinYm5Fp4oxx9Y14BPenMoEQQzivlbZ7XqE/dpAhrMr/AqD9HFg+1cd1OVZM9xLjg7FFAKRk+eaf7X1Z2UDt1XFObHuEup5jELyeoKjT/72pmvCULXC+hap1/ubQeY+5W47gaxAH12XSGT1XsSchLIGGVAzf/zPpsSTF0D3nUm0vwyypn6GnnbeGjJuFiEvQBsyZlR+FdtGTbUZPbIdZ03A/D0GsbpX0kc4WDU2h3dBk/+4V4xw+gHc81sFEjlGAguY9qwkCKVEW4UB/hBSTU+H72CTDKyAPtZbM8uXtfCTzaazO5MdYvAk4sWzAtaunJAG0VA==-RI-MA==",
              "FareInfos": [],
              "FareType": "Public",
              "ResultIndex": "OB41[TBO]Trwg0sTYKZiJ4E+zrgeoy5Swa99Hdo8AD6tnS/08SwsgYmrNRoHxAHppqgPJCmOVkQu61EEVRUG6qpT292ZZY57IKKFatPms4hkbtPjsjylnlgQ7inYX6egIxVW3LFmP3+VdhJ44wkVPWHZ4yg/7Ot9/gSEiZFMW10cFVPAMvCA69tF/z3JA9lpQ0YOKEKTy1k/MoOfDrCDkLfJVBPyGgM8jg6FoOmOmkvC1cA8EiJmLF/CxH6KIg9q6SC3OmADXHEDAzAC1mWZOxceCg+loQQ2n2QosbJpJsPUcQSU6D/uWeEh8eU7bTzLKxPFY1OI1ohbl5GjYCoFaQcmLSinYm5Fp4oxx9Y14BPenMoEQQzivlbZ7XqE/dpAhrMr/AqD9HFg+1cd1OVZM9xLjg7FFAKRk+eaf7X1Z2UDt1XFObHuEup5jELyeoKjT/72pmvCULXC+hap1/ubQeY+5W47gaxAH12XSGT1XsSchLIGGVAzf/zPpsSTF0D3nUm0vwyypn6GnnbeGjJuFiEvQBsyZlR+FdtGTbUZPbIdZ03A/D0GsbpX0kc4WDU2h3dBk/+4V4xw+gHc81sFEjlGAguY9qwkCKVEW4UB/hBSTU+H72CTDKyAPtZbM8uXtfCTzaazO5MdYvAk4sWzAtaunJAG0VA==",
              "IsRefundable": "Yes",
              "ItinTotalFares": {
                "BaseFare": {
                  "Amount": "3400.38",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "EquivFare": {
                  "Amount": "3400.38",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "ServiceTax": {
                  "Amount": "0",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalTax": {
                  "Amount": "682.8",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                },
                "TotalFare": {
                  "Amount": "4083.18",
                  "CurrencyCode": "USD",
                  "DecimalPlaces": "2"
                }
              },
              "FareBreakdown": [
                {
                  "FareBasisCode": "",
                  "Baggage": [
                    "2 PC(s)",
                    "2 PC(s)"
                  ],
                  "CabinBaggage": [
                    "Included",
                    "Included"
                  ],
                  "PassengerFare": {
                    "BaseFare": {
                      "Amount": "3400.38",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "EquivFare": {
                      "Amount": "3400.38",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "ServiceTax": {
                      "Amount": "682.8",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    },
                    "Taxes": [
                      {
                        "Amount": "214.87",
                        "TaxCode": "YQTax",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "0.00",
                        "TaxCode": "YR",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      },
                      {
                        "Amount": "467.93",
                        "TaxCode": "OtherTaxes",
                        "CurrencyCode": "USD",
                        "DecimalPlaces": "2"
                      }
                    ],
                    "TotalFare": {
                      "Amount": "4083.18",
                      "CurrencyCode": "USD",
                      "DecimalPlaces": 2
                    }
                  },
                  "PassengerTypeQuantity": {
                    "Code": "ADT",
                    "Quantity": 1
                  }
                }
              ],
              "SplitItinerary": false
            },
            "DirectionInd": "OneWay",
            "IsPassportMandatory": true,
            "OriginDestinationOptions": [
              {
                "OriginDestinationOption": [
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "HND",
                      "ArrivalDateTime": "2025-05-31T05:35:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "DEL",
                      "DepartureDateTime": "2025-05-30T18:00:00",
                      "Eticket": true,
                      "FlightNumber": "838",
                      "JourneyDuration": "485",
                      "MarketingAirlineCode": "NH",
                      "MarketingAirlineName": "Ana All Nippon",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "NH",
                        "Name": "Ana All Nippon",
                        "Equipment": "789",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "G",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 8
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "485",
                      "LocationCode": ""
                    }
                  },
                  {
                    "FlightSegment": {
                      "ArrivalAirportLocationCode": "KUL",
                      "ArrivalDateTime": "2025-06-01T06:00:00",
                      "CabinClassCode": "Y",
                      "CabinClassText": "",
                      "DepartureAirportLocationCode": "HND",
                      "DepartureDateTime": "2025-05-31T23:30:00",
                      "Eticket": true,
                      "FlightNumber": "885",
                      "JourneyDuration": "450",
                      "MarketingAirlineCode": "NH",
                      "MarketingAirlineName": "Ana All Nippon",
                      "MarriageGroup": "",
                      "MealCode": "",
                      "OperatingAirline": {
                        "Code": "NH",
                        "Name": "Ana All Nippon",
                        "Equipment": "788",
                        "FlightNumber": ""
                      }
                    },
                    "ResBookDesigCode": "Y",
                    "ResBookDesigText": "",
                    "SeatsRemaining": {
                      "BelowMinimum": false,
                      "Number": 9
                    },
                    "StopQuantity": 0,
                    "StopQuantityInfo": {
                      "ArrivalDateTime": "",
                      "DepartureDateTime": "",
                      "Duration": "450",
                      "LocationCode": ""
                    }
                  }
                ],
                "TotalStops": 1
              }
            ],
            "SequenceNumber": "",
            "TicketType": "eTicket",
            "ValidatingAirlineCode": "NH",
            "TicketAdvisory": "SUBJ TO CANCELLATION/CHANGE PENALTY \nLAST TKT DTE 30MAY25 - SEE ADV PURCHASE \n"
          }
        }
      ]
    }
  }
}';
        return [
            'status_code' => $http_status,
            'response' => json_decode($response, true)
        ];
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
