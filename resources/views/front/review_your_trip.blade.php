@extends('front.layouts.app')
@section('title', 'JetLife Travel')

@section('content')


    <!-- search -->
    <div class="search-overlay">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="search-overlay-layer"></div>
                <div class="search-overlay-layer"></div>
                <div class="search-overlay-layer"></div>
                <div class="search-overlay-close">
                    <span class="search-overlay-close-line"></span>
                    <span class="search-overlay-close-line"></span>
                </div>
                <div class="search-overlay-form">
                    <form>
                        <input type="text" class="input-search" placeholder="Search here...">
                        <button type="button"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Common Banner Area -->
    <section id="common_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_bannner_text">
                        <h2>{{ $flightReview->Segment[0]->AirlineName }}</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span><i class="fas fa-circle"></i></span> Review your trip</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us -->

    <section class="sectionFlightdetails">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                    <div class="aboveflightdetail borderedColor mb-4">
                        <h3 class="allsameheading">{{ $fromCityname }} to {{ $toCityname }}</h3>
                        <label class="fontsamll">{{ $flightReview->Segment[0]->DepartureTime }} -
                            {{ $flightReview->Segment[count($flightReview->Segment) - 1]->ArrivalTime }}
                            ({{ $flightReview->totalTravelTime }}, {{ $flightReview->totalStops }} stop)</label>
                        <div class="airInaDate fontsamll">
                            <span><img class="contryImg" src="{{ $flightReview->Segment[0]->AirLineLogo }}"
                                    alt="imgIND"></span> {{ $flightReview->Segment[0]->AirlineName }} •
                            {{ date('D, d M Y', strtotime($flightReview->Segment[0]->Departure)) }}
                        </div>
                        {{-- <p class="aboveAverage fontsamll">Above average CO₂</p> --}}
                        <div class="changeflightdetails">
                            <button type="button" class="btn flightBtn btn_md"
                                onclick='flightdetails(@json($flightReview->Segment), "{{ $flightReview->cabinClassCode }}", "{{ $flightReview->cabinBaggage }}", "{{ $flightReview->from }}", "{{ $flightReview->to }}")'>Flight
                                details</button>
                            {{-- <button type="button" class="btn flightBtn btn_md">Change flight</button> --}}
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="flightdetailsModal" tabindex="-1"
                            aria-labelledby="flightdetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modalHeader">
                                        <h1 class="modal-title fs-5" id="explorepackagesLabel">Flight details</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="flightlist">
                                            <div class="flightFirst">
                                                <label class="fontsamll">Flight 1 of 2</label>
                                                <div class="fltdetails">
                                                    <div class="fontsamll mb-4">
                                                        <span>
                                                            <img class="contryImg" src="assets/img/favicon.png"
                                                                alt="imgIND">
                                                        </span> <strong>Air India</strong> AI2985
                                                    </div>
                                                    <div class="order-track">
                                                        <div class="order-track-step">
                                                            <div class="order-track-status">
                                                                <span class="order-track-status-dot"></span>
                                                                <span class="order-track-status-line"></span>
                                                            </div>
                                                            <div class="order-track-text">
                                                                <div class="reachStopStart">
                                                                    <h3 class="allsameheading">Delhi</h3>
                                                                    <div class="fontsamll">Indira Gandhi Intl. (DEL)
                                                                    </div>
                                                                    <div class="fontsamll">Terminal 1</div>
                                                                </div>
                                                                <div class="rechTimeDate">
                                                                    <h3 class="allsameheading">7:35pm</h3>
                                                                    <div class="fontsamll">IST</div>
                                                                    <div class="fontsamll"><Strong>Tue, Jun 24</Strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="order-track-step">
                                                            <div class="order-track-status">
                                                                <span class="order-track-status-line timeLine"></span>
                                                            </div>
                                                            <div class="order-track-text">
                                                                <div class="travelTime">
                                                                    Travel time: 2h 25m
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="order-track-step">
                                                            <div class="order-track-status">
                                                                <span class="order-track-status-dot"></span>
                                                                <span class="order-track-status-line"></span>
                                                            </div>
                                                            <div class="order-track-text">
                                                                <div class="reachStopStart">
                                                                    <h3 class="allsameheading">Mumbai</h3>
                                                                    <div class="fontsamll">Chhatrapati Shivaji Intl.
                                                                        (BOM)</div>
                                                                    <div class="fontsamll">Terminal 2</div>
                                                                </div>
                                                                <div class="rechTimeDate">
                                                                    <h3 class="allsameheading">10:00pm</h3>
                                                                    <div class="fontsamll">IST</div>
                                                                    <div class="fontsamll"><Strong>Tue, Jun 24</Strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="secMoreDetails row">
                                                    <div class="col-md-6 airmore aircraftAirbus">
                                                        <table class="table table-borderless">

                                                            <body class="fontsamll">
                                                                <tr>
                                                                    <td>Aircraft</td>
                                                                    <td class="textRight"><strong>Airbus
                                                                            A320-200neo</strong> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Cabin</td>
                                                                    <td class="textRight"><strong>Economy</strong> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Distance</td>
                                                                    <td class="textRight"><strong>708 mi</strong> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="emissions">Emissions <span
                                                                                class=" amenitiesic0n material-icons">
                                                                                info</span></div>
                                                                    </td>
                                                                    <td class="textRight">
                                                                        <p class="aboveAverage fontsamll mt-0">Above
                                                                            average CO₂</p>
                                                                    </td>
                                                                </tr>
                                                            </body>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 airmore amenities">
                                                        <h6>Amenities</h6>
                                                        <div class="fontsamll"> <span
                                                                class="amenitiesic0n material-icons"> power</span>
                                                            In-seat power outlet</div>
                                                        <div class="fontsamll"><span
                                                                class="amenitiesic0n material-icons">live_tv </span>
                                                            In-flight entertainment</div>
                                                    </div>

                                                    <div class="updateTime">
                                                        <div class="fontsamll upadetText"><span
                                                                class="amenitiesic0n material-icons">update </span>
                                                            <strong> 3h 40m layover in Mumbai</strong></div>
                                                        <div class="fontsamll"> Change planes in Chhatrapati Shivaji Intl.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flightFirst mt-4">
                                                <label class="fontsamll">Flight 2 of 2</label>
                                                <div class="fltdetails">
                                                    <div class="fontsamll mb-4">
                                                        <span>
                                                            <img class="contryImg" src="assets/img/favicon.png"
                                                                alt="imgIND">
                                                        </span> <strong>Air India</strong> AI2985
                                                    </div>
                                                    <div class="order-track">
                                                        <div class="order-track-step">
                                                            <div class="order-track-status">
                                                                <span class="order-track-status-dot"></span>
                                                                <span class="order-track-status-line"></span>
                                                            </div>
                                                            <div class="order-track-text">
                                                                <div class="reachStopStart">
                                                                    <h3 class="allsameheading">Delhi</h3>
                                                                    <div class="fontsamll">Indira Gandhi Intl. (DEL)
                                                                    </div>
                                                                    <div class="fontsamll">Terminal 1</div>
                                                                </div>
                                                                <div class="rechTimeDate">
                                                                    <h3 class="allsameheading">7:35pm</h3>
                                                                    <div class="fontsamll">IST</div>
                                                                    <div class="fontsamll"><Strong>Tue, Jun 24</Strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="order-track-step">
                                                            <div class="order-track-status">
                                                                <span class="order-track-status-line timeLine"></span>
                                                            </div>
                                                            <div class="order-track-text">
                                                                <div class="travelTime">
                                                                    Travel time: 2h 25m
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="order-track-step">
                                                            <div class="order-track-status">
                                                                <span class="order-track-status-dot"></span>
                                                                <span class="order-track-status-line"></span>
                                                            </div>
                                                            <div class="order-track-text">
                                                                <div class="reachStopStart">
                                                                    <h3 class="allsameheading">Mumbai</h3>
                                                                    <div class="fontsamll">Chhatrapati Shivaji Intl.
                                                                        (BOM)</div>
                                                                    <div class="fontsamll">Terminal 2</div>
                                                                </div>
                                                                <div class="rechTimeDate">
                                                                    <h3 class="allsameheading">10:00pm</h3>
                                                                    <div class="fontsamll">IST</div>
                                                                    <div class="fontsamll"><Strong>Tue, Jun 24</Strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="secMoreDetails row">
                                                    <div class="col-md-6 airmore aircraftAirbus">
                                                        <table class="table table-borderless">

                                                            <body class="fontsamll">
                                                                <tr>
                                                                    <td>Aircraft</td>
                                                                    <td class="textRight"><strong>Airbus
                                                                            A320-200neo</strong> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Cabin</td>
                                                                    <td class="textRight"><strong>Economy</strong> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Distance</td>
                                                                    <td class="textRight"><strong>708 mi</strong> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="emissions">Emissions <span
                                                                                class=" amenitiesic0n material-icons">
                                                                                info</span></div>
                                                                    </td>
                                                                    <td class="textRight">
                                                                        <p class="aboveAverage fontsamll mt-0">Above
                                                                            average CO₂</p>
                                                                    </td>
                                                                </tr>
                                                            </body>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6 airmore amenities">
                                                        <h6>Amenities</h6>
                                                        <div class="fontsamll"> <span
                                                                class="amenitiesic0n material-icons"> power</span>
                                                            In-seat power outlet</div>
                                                        <div class="fontsamll"><span
                                                                class="amenitiesic0n material-icons">live_tv </span>
                                                            In-flight entertainment</div>
                                                    </div>

                                                    <div class="updateTime">
                                                        <div class="fontsamll upadetText"><span
                                                                class="amenitiesic0n material-icons">update </span>
                                                            <strong> 3h 40m layover in Mumbai</strong></div>
                                                        <div class="fontsamll"> Change planes in Chhatrapati Shivaji Intl.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="aboveflightdetail borderedColor mb-4">
                        <h3 class="allsameheading">Your fare: Eco Value</h3>
                        <ul class="comntitle mt-3">
                            <li><span class="greenicon material-icons"> check_circle </span>Seat choice included</li>
                            <li><span class="greenicon material-icons"> check_circle </span>Hand baggage included
                                ({{ $cabinbag }} kg)</li>
                            <li><span class="greenicon material-icons"> check_circle </span>1st checked bag included
                                ({{ $checkedBaggage }} kg)</li>
                            {{-- <li><span class="material-icons"> paid </span> Cancellation fee applies</li>
                            <li><span class="material-icons"> paid </span> Change fee: $293</li> --}}

                        </ul>

                    </div>

                    <div class="aboveflightdetail borderedColor mb-4">
                        <h3 class="allsameheading">Seats</h3>

                        <ul class="comntitle mt-3">
                            <li><span class="greenicon material-icons"> check_circle </span>Seat choice included</li>
                        </ul>
                        <label class="fontsamll">Purchase seats for this flight through
                            {{ $flightReview->Segment[0]->AirlineName }} after booking.</label>
                    </div>
                    <div class="aboveflightdetail borderedColor mb-4">
                        <h3 class="allsameheading">Bags</h3>

                        <ul class="comntitle mt-3">
                            <li><span class="greenicon material-icons"> check_circle </span>Hand baggage included
                                ({{ $cabinbag }} kg)</li>
                            <li><span class="greenicon material-icons"> check_circle </span>1st checked bag included
                                ({{ $checkedBaggage }} kg)</li>

                        </ul>
                        <label class="fontsamll">Purchase additional bags for this flight through
                            {{ $flightReview->Segment[0]->AirlineName }} after
                            booking.</label>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="borderedColor">
                        <h3 class="allsameheading">Price summary</h3>
                        <table class="table table-borderless summaryTable mt-4">
                            @php
                                $grandTotal = 0;
                            @endphp

                            @foreach ($flightReview->FareBreakdown as $FareBreakdownvalue)
                                @php
                                    $taxTotal = 0;
                                    foreach ($FareBreakdownvalue->tax as $tax) {
                                        $taxTotal += $tax->Amount;
                                    }
                                    $fareTotal = $FareBreakdownvalue->BaseFare + $taxTotal;
                                    $grandTotal += $FareBreakdownvalue->TotalFare; // or use $fareTotal * $FareBreakdownvalue->Quantity;
                                @endphp
                                <thead>
                                    <tr>
                                        <th>Traveler {{ $FareBreakdownvalue->Quantity }}:
                                            {{ $FareBreakdownvalue->PassengerType }}
                                            @if ($FareBreakdownvalue->PassengerType == 'ADT')
                                                Adult
                                            @elseif ($FareBreakdownvalue->PassengerType == 'CHD')
                                                Child
                                            @elseif ($FareBreakdownvalue->PassengerType == 'INF')
                                                Infant
                                            @endif
                                        </th>
                                        <th>${{ number_format($FareBreakdownvalue->TotalFare, 2) }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Flight</td>
                                        <td>${{ number_format($FareBreakdownvalue->BaseFare, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Taxes, fees, and charges</td>
                                        <td>${{ number_format($taxTotal, 2) }}</td>
                                    </tr>
                            @endforeach

                            <tr class="tableborder">
                                <td><span class="padtp"> Subtotal </span></td>
                                <td><span class="padtp">${{ number_format($grandTotal, 2) }}</span></td>
                            </tr>

                            <tr class="tableborder">
                                <td>
                                    <h4 class="padtp">Trip total</h4>
                                </td>
                                <td>
                                    <h4 class="padtp">${{ number_format($grandTotal, 2) }}</h4>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">Rates are quoted in US dollars</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button class="sidebaarSelectBtn btn btn_theme btn_md">Select</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function flightdetails(segments, cabinClassCode, cabinBaggage, from, to) {
            console.log(segments); // Inspect the data structure
            let cabinname = ""; // Declare variable in outer scope

            if (cabinClassCode == "Y") {
                cabinname = "Economy";
            } else if (cabinClassCode == "S") {
                cabinname = "Premium Economy";
            } else if (cabinClassCode == "C") {
                cabinname = "Business";
            } else if (cabinClassCode == "F") {
                cabinname = "First";
            }
            console.log(cabinname);
            // Clear previous content
            const container = document.querySelector(".flightlist");
            container.innerHTML = "";

            segments.forEach((segment, index) => {
                const layoverHtml = segment.Layover ?
                    `<div class="updateTime">
                    <div class="fontsamll upadetText">
                        <span class="amenitiesic0n material-icons">update</span>
                        <strong>${segment.Layover} layover in ${segment.ArrivalAirportLocationCode}</strong>
                    </div>
               </div>` :
                    ""; // Empty if no layover
                const html = `<div class="flightFirst ${index > 0 ? 'mt-4' : ''}">
                                                <label class="fontsamll">Flight ${index + 1} of ${segments.length}</label>
                                                <div class="fltdetails">
                                                    <div class="fontsamll mb-4">
                                                        <span>
                                                            <img class="contryImg" src="${segment.AirLineLogo}" alt="imgIND">
                                                        </span> <strong>${segment.AirlineName}</strong> ${segment.Airlinecode}${segment.FlightNumber}
                                                    </div>
                                                    <div class="order-track">
                                                        <div class="order-track-step">
                                                            <div class="order-track-status">
                                                                <span class="order-track-status-dot"></span>
                                                                <span class="order-track-status-line"></span>
                                                            </div>
                                                            <div class="order-track-text">
                                                                <div class="reachStopStart">
                                                                    <h3 class="allsameheading">${segment.DepartureAirportLocationCode}</h3>
                                                                </div>
                                                                <div class="rechTimeDate">
                                                                    <h3 class="allsameheading">${segment.DepartureTime}</h3>
                                                                    <div class="fontsamll"><Strong>${formatDate(segment.Departure)}</Strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="order-track-step">
                                                            <div class="order-track-status">
                                                                <span class="order-track-status-line timeLine"></span>
                                                            </div>
                                                            <div class="order-track-text">
                                                                <div class="travelTime">
                                                                    Travel time: ${segment.Duration}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="order-track-step">
                                                            <div class="order-track-status">
                                                                <span class="order-track-status-dot"></span>
                                                                <span class="order-track-status-line"></span>
                                                            </div>
                                                            <div class="order-track-text">
                                                                <div class="reachStopStart">
                                                                    <h3 class="allsameheading">${segment.ArrivalAirportLocationCode}</h3>
                                                                </div>
                                                                <div class="rechTimeDate">
                                                                    <h3 class="allsameheading">${segment.ArrivalTime}</h3>
                                                                    <div class="fontsamll"><Strong>${formatDate(segment.Arrival)}</Strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="secMoreDetails row">
                                                    <div class="col-md-6 airmore aircraftAirbus">
                                                        <table class="table table-borderless">
                                                            <body class="fontsamll">

                                                                <tr>
                                                                    <td>Cabin</td>
                                                                    <td class="textRight"><strong>${cabinname}</strong> </td>
                                                                </tr>

                                                            </body>
                                                        </table>
                                                    </div>
                                                    ${layoverHtml}
                                                </div>
                                            </div>`
                container.innerHTML += html;
            });

            $('#flightdetailsModal').modal('show');
        }

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            const options = {
                weekday: 'short',
                month: 'short',
                day: 'numeric'
            };
            return date.toLocaleDateString('en-US', options);
        }
    </script>
@endsection
