<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>@yield('title', 'JetLife Travel') </title>
    <link rel="stylesheet" href="assets/front/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/front/css/animate.min.css" />
    <link rel="stylesheet" href="assets/front/css/fontawesome.all.min.css" />
    <link rel="stylesheet" href="../../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/front/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/front/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets/front/css/navber.css" />
    <link rel="stylesheet" href="assets/front/css/meanmenu.css" />
    <link rel="stylesheet" href="assets/front/css/style.css" />
    <link rel="stylesheet" href="assets/front/css/responsive.css" />
    <link rel="icon" type="image/png" href="assets/front/img/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="assets/front/js/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> --}}
    <style>
        .hidemsg {
            display: none
        }

        .hidemsg1 {
            display: none
        }
    </style>

</head>

<body>
    <!-- preloader Area -->
    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="lds-spinner">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
    @include('front.partials.header')
    @yield('content')
    <!-- Footer  -->
    <footer id="footer_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Need any help?</h5>
                    </div>
                    <div class="footer_first_area">
                        <div class="footer_inquery_area">
                            <h5>Call 24/7 for any help</h5>
                            <h3> <a href="#!">+00 123 456 789</a></h3>
                        </div>
                        <div class="footer_inquery_area">
                            <h5>Mail to our support team</h5>
                            <h3> <a href="#!">support@domain.com</a></h3>
                        </div>
                        <div class="footer_inquery_area">
                            <h5>Follow us on</h5>
                            <ul class="soical_icon_footer">
                                <li><a href="#!"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#!"><i class="fab fa-twitter-square"></i></a></li>
                                <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#!"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-6 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>About Company</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="#!">About Us</a></li>
                            <li><a href="#!">Loyalty program</a></li>
                            <li><a href="#!">Latest News</a></li>
                            <li><a href="#!">Work with Us</a></li>
                            <li><a href="#!">Meet the Team </a></li>
                            <li><a href="#!">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Support</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="#!">Account</a></li>
                            <li><a href="#!">Faq</a></li>
                            <li><a href="#!">Legal</a></li>
                            <li><a href="#!">Contact Us</a></li>
                            <li><a href="#!">Affiliate Program</a></li>
                            <li><a href="#!">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Hot Deals</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="#!">Kantua hotel, Thailand</a></li>
                            <li><a href="#!">Hotel international</a></li>
                            <li><a href="#!">Hotel kualalampur</a></li>
                            <li><a href="#!">Hotel deluxe</a></li>
                            <li><a href="#!">Hotel rajavumi</a></li>
                            <li><a href="#!">Thailand grand suit</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Top cities</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="#!">Chicago</a></li>
                            <li><a href="#!">New York</a></li>
                            <li><a href="#!">San Francisco</a></li>
                            <li><a href="#!">California</a></li>
                            <li><a href="#!">Ohio </a></li>
                            <li><a href="#!">Alaska</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="co-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="copyright_left">
                        <p>Copyright © 2025 JetLife Travel All Rights Reserved</p>
                    </div>
                </div>
                <div class="co-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="copyright_right">
                        <a href="#!"><img src="assets/front/img/payC1.png" alt="img"></a>
                        <a href="#!"><img src="assets/front/img/payC2.png" alt="img"></a>
                        <a href="#!"><img src="assets/front/img/payC3.png" alt="img"></a>
                        <a href="#!"><img src="assets/front/img/payC4.png" alt="img"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="go-top">
        <i class="fas fa-chevron-up"></i>
        <i class="fas fa-chevron-up"></i>
    </div>


    <script src="assets/front/js/bootstrap.bundle.js"></script>
    <script src="assets/front/js/jquery.meanmenu.js"></script>
    <script src="assets/front/js/owl.carousel.min.js"></script>
    <script src="assets/front/js/wow.min.js"></script>
    <script src="assets/front/js/custom.js"></script>
    <script src="assets/front/js/add-form.js"></script>
    <script src="assets/front/js/form-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        const weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        const today = new Date();

        document.addEventListener("DOMContentLoaded", function() {
            // Show today's weekday for #datepicker
            const journeyDayEl = document.getElementById("journeyDay");
            if (journeyDayEl) {
                journeyDayEl.innerText = weekdays[today.getDay()];
                flatpickr("#datepicker", {
                    dateFormat: "d M Y",
                    defaultDate: today,
                    minDate: today,
                    onChange: function(selectedDates) {
                        if (selectedDates[0]) {
                            journeyDayEl.innerText = weekdays[selectedDates[0].getDay()];
                        }
                    }
                });
            }

            // Initialize #startDate and #endDate with constraints
            const startInput = document.getElementById("startDate");
            const endInput = document.getElementById("endDate");
            const returnDay = new Date(today.getTime() + 3 * 24 * 60 * 60 * 1000);

            if (startInput && endInput) {
                const startDayEl = document.getElementById("startDay");
                const endDayEl = document.getElementById("endDay");
                startDayEl.innerText = weekdays[today.getDay()];
                endDayEl.innerText = weekdays[returnDay.getDay()];

                const start = flatpickr(startInput, {
                    dateFormat: "d M Y",
                    defaultDate: today,
                    minDate: today,
                    onChange: function(selectedDates) {
                        if (selectedDates[0]) {
                            if (startDayEl) startDayEl.innerText = weekdays[selectedDates[0].getDay()];
                            end.set('minDate', selectedDates[0]);
                        }
                    }
                });

                const end = flatpickr(endInput, {
                    dateFormat: "d M Y",
                    defaultDate: new Date(today.getTime() + 3 * 24 * 60 * 60 * 1000), // +3 days
                    minDate: today,
                    onChange: function(selectedDates) {
                        if (selectedDates[0]) {
                            if (endDayEl) endDayEl.innerText = weekdays[selectedDates[0].getDay()];
                        }
                    }
                });
            }
        });
    </script>
    <script>
        function updateClassName(selectElement) {
            const selectedValue = selectElement.value;
            document.querySelector('.changecname').textContent = selectedValue;
        }
    </script>
    {{-- <script>
        let adultCount = 0;
        let childCount = 0;
        let infantCount = 0;
        let selectedClass = "Business"; // default class

        function updateDisplay() {
            $('.pcount').text(adultCount);
            $('.ccount').text(childCount);
            $('.incount').text(infantCount);

            // Construct breakdown
            const parts = [];
            if (adultCount > 0) parts.push(`${adultCount} Adult${adultCount > 1 ? "s" : ""}`);
            if (childCount > 0) parts.push(`${childCount} Child${childCount > 1 ? "ren" : ""}`);
            if (infantCount > 0) parts.push(`${infantCount} Infant${infantCount > 1 ? "s" : ""}`);

            const text = parts.length > 0 ? `${parts.join(", ")}` : "0 Passenger";
            $('.final-count').text(text);

            // Update span showing selected class
            $('.flight_Search_boxed > span').text(selectedClass);
        }

        // Passenger button handlers
        $('.btn-add').on('click', function(e) {
            adultCount++;
            updateDisplay();
            e.preventDefault();
        });
        $('.btn-subtract').on('click', function(e) {
            if (adultCount > 0) adultCount--;
            updateDisplay();
            e.preventDefault();
        });
        $('.btn-add-c').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent dropdown from closing

            childCount++;
            updateDisplay();
        });
        $('.btn-subtract-c').on('click', function(e) {
            if (childCount > 0) childCount--;
            updateDisplay();
            e.preventDefault();
            e.stopPropagation();
        });
        $('.btn-add-in').on('click', function(e) {
            infantCount++;
            updateDisplay();
            e.preventDefault();
            e.stopPropagation();
        });
        $('.btn-subtract-in').on('click', function(e) {
            if (infantCount > 0) infantCount--;
            updateDisplay();
            e.preventDefault();
            e.stopPropagation();
        });

        // Cabin class selection handler
        $('.label-select-btn').on('click', function() {
            $('.label-select-btn').removeClass('active');
            $(this).addClass('active');
            selectedClass = $(this).text().trim();
            updateDisplay();
        });

        // Initialize on document ready
        $(document).ready(updateDisplay);
    </script> --}}
    <!-- jQuery UI -->
    {{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: "dd-mm-yy"
            });
        });
    </script> --}}

</body>

</html>
