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
                        <h2>Login</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span><i class="fas fa-circle"></i></span> Login</li>
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
                            <h3>Login your account</h3>
                            <h2>Logged in to stay in touch</h2>
                        </div>
                        <div class="common_author_form">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="normalUsers-tab" data-bs-toggle="tab" data-bs-target="#normalUsers-tab-pane" type="button" role="tab" aria-controls="normalUsers-tab-pane" aria-selected="true">Normal Users</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="corporate-tab" data-bs-toggle="tab" data-bs-target="#corporate-tab-pane" type="button" role="tab" aria-controls="corporate-tab-pane" aria-selected="true">Corporate Users</button>
                                </li>

                            </ul>

                            <div class="tab-content pt-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="normalUsers-tab-pane" role="tabpanel" aria-labelledby="normalUsers-tab" tabindex="0">
                                    <form action="#" id="main_author_form">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Enter user name" autocomplete="off"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Enter password" autocomplete="off"/>
                                            <a href="#!">Forgot password?</a>
                                        </div>
                                        <div class="common_form_submit">
                                            <button class="btn btn_theme btn_md">Log in</button>
                                        </div>
                                        <div class="have_acount_area">
                                            <p>Dont have an account? <a href="register.html">Register now</a></p>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="corporate-tab-pane" role="tabpanel" aria-labelledby="corporate-tab" tabindex="0">
                                    <form action="#" id="main_author_form">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Enter user name" autocomplete="off"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Enter password" autocomplete="off"/>
                                            <a href="#!">Forgot password?</a>
                                        </div>
                                        <div class="common_form_submit">
                                            <button class="btn btn_theme btn_md">Log in</button>
                                        </div>
                                        <div class="have_acount_area">
                                            <p>Dont have an account? <a href="register.html">Register now</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>

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
                            <img src="assets/img/email.png" alt="icon">
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
@endsection
