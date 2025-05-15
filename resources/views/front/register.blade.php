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
                        <h2>Register</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span><i class="fas fa-circle"></i></span> Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  Common Author Area -->
    <section id="common_author_area" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">





                    <div class="common_author_boxed">
                        <div class="common_author_heading">
                            <h3>Register account</h3>
                            <h2>Register your account</h2>
                        </div>



                        <div class="common_author_form">
                            <!-- Tab -->

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="normalUsers-tab" data-bs-toggle="tab"
                                        data-bs-target="#normalUsers-tab-pane" type="button" role="tab"
                                        aria-controls="normalUsers-tab-pane" aria-selected="true">Normal Users</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="corporate-tab" data-bs-toggle="tab"
                                        data-bs-target="#corporate-tab-pane" type="button" role="tab"
                                        aria-controls="corporate-tab-pane" aria-selected="true">Corporate Users</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="normalUsers-tab-pane" role="tabpanel"
                                    aria-labelledby="normalUsers-tab" tabindex="0">
                                    <form id="main_author_form" class="row g-3 needs-validation" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-validation">
                                                    <input type="text" class="form-control" name="firstName"
                                                        placeholder="Enter first name*" autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="lastName"
                                                        placeholder="Enter last name*" autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="your email address*" autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="Password*" autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="cnfpassword"
                                                        placeholder="Confirm Password*" autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="phoneNumber"
                                                        placeholder="Mobile number*" autocomplete="off" required />
                                                </div>
                                            </div>


                                            <div class="common_form_submit">
                                                <input type="hidden" name="userType" value="1">
                                                <button class="btn btn_theme btn_md" type="submit">Register</button>
                                            </div>
                                            <div class="alert alert-success align-items-center hidemsg alertmsg" role="alert">

                                            </div>
                                            <div class="have_acount_area other_author_option">
                                                <p>Already have an account? <a href="{{ url('/login') }}">Log in now</a>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- End off Normal User -->
                                <div class="tab-pane fade" id="corporate-tab-pane" role="tabpanel"
                                    aria-labelledby="corporate-tab" tabindex="0">
                                    <form id="main_author_forms" class="row g-3 needs-validations" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="firstName"
                                                        placeholder="Enter first name*" autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="lastName"
                                                        placeholder="Enter last name*" autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="companyName" placeholder="Company Name"
                                                        autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="employeeId" placeholder="Employee Id"
                                                        autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="your email address" autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                                        autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="Password" class="form-control" name="cnfpassword"
                                                        placeholder="Confirm Password" autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="phoneNumber"
                                                        placeholder="Mobile number*" autocomplete="off" required />
                                                </div>
                                            </div>

                                            <div class="common_form_submit">
                                                <input type="hidden" name="userType" value="2">
                                                <button class="btn btn_theme btn_md" type="Submit">Register</button>
                                            </div>
                                            <div class="alert alert-success align-items-center hidemsg1 alertmsg" role="alert">
                                            <div class="have_acount_area other_author_option">
                                                <p>Already have an account? <a href="{{ url('/login') }}">Log in now</a>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- End off Carporate User -->
                            </div>

                            <!-- Tab -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cta Area -->
    <section id="cta_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="cta_left">
                        <div class="cta_icon">
                            <img src="assets/front/img/email.png" alt="icon">
                        </div>
                        <div class="cta_content">
                            <h4>Get the latest news and offers</h4>
                            <h2>Subscribe to our newsletter</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="cat_form">
                        <form id="cta_form_wrappper">
                            <div class="input-group"><input type="text" class="form-control"
                                    placeholder="Enter your mail address"><button class="btn btn_theme btn_md"
                                    type="button">Subscribe</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');

            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    var isValid = true;

                    // Get form fields
                    var password = form.querySelector('input[name="password"]');
                    var confirmPassword = form.querySelector('input[name="cnfpassword"]');
                    var email = form.querySelector('input[name="email"]');

                    // Clear previous validation
                    password.setCustomValidity('');
                    confirmPassword.setCustomValidity('');
                    email.setCustomValidity('');

                    // Password length
                    if (password.value.length < 8) {
                        password.setCustomValidity('Password must be at least 8 characters long.');
                        isValid = false;
                    }

                    // Password match
                    if (password.value !== confirmPassword.value) {
                        confirmPassword.setCustomValidity('Passwords do not match.');
                        isValid = false;
                    }

                    // Email format check (regex)
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email.value)) {
                        email.setCustomValidity('Enter a valid email address.');
                        isValid = false;
                    }

                    if (!isValid || !form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        event.preventDefault(); // For AJAX or custom handling
                        // Send AJAX request after validation
                        var formData = new FormData(form); // Create FormData object
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '{{ route('user.userstores') }}',
                        true); // Set your endpoint here
                        console.log(xhr)
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4) {
                                var response = JSON.parse(xhr.responseText);
                                // Display the message (adjust this according to your response structure)
                                var message = response.message; // Default message if none found
                                if (xhr.status === 200) {
                                    $('.hidemsg').css('display', 'block');
                                    $('.alertmsg').text(message);
                                    console.log('Form submitted successfully:', xhr.responseText);
                                    // Redirect to another page after success
                                    setTimeout(function() {
                                        location.reload() // Replace with your desired URL
                                    }, 2000); // Delay before redirection (2 seconds)

                                } else {
                                    $('.hidemsg').css('display', 'block');
                                    $('.alertmsg').text(message);
                                    console.error('Error submitting form:', xhr.status, xhr
                                        .responseText);
                                }
                            }
                        };

                        xhr.send(formData);
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
     <script>
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validations');

            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    var isValid = true;

                    // Get form fields
                    var password = form.querySelector('input[name="password"]');
                    var confirmPassword = form.querySelector('input[name="cnfpassword"]');
                    var email = form.querySelector('input[name="email"]');

                    // Clear previous validation
                    password.setCustomValidity('');
                    confirmPassword.setCustomValidity('');
                    email.setCustomValidity('');

                    // Password length
                    if (password.value.length < 8) {
                        password.setCustomValidity('Password must be at least 8 characters long.');
                        isValid = false;
                    }

                    // Password match
                    if (password.value !== confirmPassword.value) {
                        confirmPassword.setCustomValidity('Passwords do not match.');
                        isValid = false;
                    }

                    // Email format check (regex)
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email.value)) {
                        email.setCustomValidity('Enter a valid email address.');
                        isValid = false;
                    }

                    if (!isValid || !form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        event.preventDefault(); // For AJAX or custom handling
                        // Send AJAX request after validation
                        var formData = new FormData(form); // Create FormData object
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '{{ route('user.userstores') }}',
                        true); // Set your endpoint here
                        console.log(xhr)
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4) {
                                var response = JSON.parse(xhr.responseText);
                                // Display the message (adjust this according to your response structure)
                                var message = response.message; // Default message if none found
                                if (xhr.status === 200) {
                                    $('.hidemsg1').css('display', 'block');
                                    $('.alertmsg').text(message);
                                    console.log('Form submitted successfully:', xhr.responseText);
                                    // Redirect to another page after success
                                    setTimeout(function() {
                                        location.reload() // Replace with your desired URL
                                    }, 2000); // Delay before redirection (2 seconds)

                                } else {
                                    $('.hidemsg1').css('display', 'block');
                                    $('.alertmsg').text(message);
                                    console.error('Error submitting form:', xhr.status, xhr
                                        .responseText);
                                }
                            }
                        };

                        xhr.send(formData);
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection
