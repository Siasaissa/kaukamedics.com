<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="Kauka Medical Supplies - Professional medical equipment and healthcare services">
    <!-- Meta Keyword -->
    <meta name="keywords" content="medical equipment, hospital supplies, healthcare services, medical consumables">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Kauka Medics - Our Services</title>
    <!--
			CSS
			============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/ion.rangeSlider.css" />
    <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <!-- Start Header Area -->
	<header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box" style="padding-top:0 !important; padding-bottom:0 !important;">
                <div class="container">
                    <a class="navbar-brand logo_h" href="#" style="padding:0 !important; margin:0 !important; line-height:0 !important;">
                        <img src="img/logo.png" 
                            alt="Kauka Company Logo" 
                            style="height:100px !important; padding:0 !important; margin:0 !important; display:block;">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                     aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
                            <li class="nav-item"><a href="{{ route('products') }}" class="nav-link">Products</a></li>
                            <li class="nav-item active"><a href="{{ route('service') }}" class="nav-link">Services</a></li>
                            <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About Us</a></li>
                            <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item"><a href="{{ route('cart') }}" class="cart"><span class="ti-bag text-primary">{{ session('cart') ? count(session('cart')) : 0 }}</span></a></li>
                            <li class="nav-item">
                                <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between">
                    <input type="text" class="form-control" id="search_input" placeholder="Search products...">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
	<!-- End Header Area -->

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Our Services</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="service.html">Services</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Services Grid Section - Professional Horizontal Layout -->
    <section class="blog_categorie_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-top-border">
                        <h3 class="mb-30">Delivering Trusted Medical Solutions</h3>
                        <p class="mb-30">We supply a wide range of medical products and equipment designed to meet the needs of healthcare professionals and institutions nationwide. Our commitment to quality ensures that every healthcare facility receives reliable supplies that empower them to save lives every day.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="categories_post">
                        <img src="img/blog/cat-post/cat-post-3.jpg" alt="Medical Equipment">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="#">
                                    <h5>Medical Equipment</h5>
                                </a>
                                <div class="border_line"></div>
                                <p>High-quality diagnostic and treatment equipment for hospitals and clinics nationwide.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="categories_post">
                        <img src="img/blog/cat-post/cat-post-2.jpg" alt="Hospital Consumables">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="#">
                                    <h5>Hospital Consumables</h5>
                                </a>
                                <div class="border_line"></div>
                                <p>Essential medical supplies including gloves, syringes, bandages, masks and daily consumables.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="categories_post">
                        <img src="img/blog/cat-post/cat-post-1.jpg" alt="Patient Care Products">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="#">
                                    <h5>Patient Care Products</h5>
                                </a>
                                <div class="border_line"></div>
                                <p>Comfort, safety and monitoring solutions including mobility aids and monitoring devices.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="categories_post">
                        <img src="img/blog/cat-post/cat-post-3.jpg" alt="Pharmaceutical Supplies">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="#">
                                    <h5>Pharmaceutical Supplies</h5>
                                </a>
                                <div class="border_line"></div>
                                <p>Trusted pharmaceutical products meeting global safety and efficacy standards.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="categories_post">
                        <img src="img/blog/cat-post/cat-post-2.jpg" alt="Medical Logistics">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="#">
                                    <h5>Medical Logistics</h5>
                                </a>
                                <div class="border_line"></div>
                                <p>Efficient distribution network ensuring timely delivery of critical medical supplies.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="categories_post">
                        <img src="img/blog/cat-post/cat-post-1.jpg" alt="Hospital Setup">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="#">
                                    <h5>Hospital Setup Solutions</h5>
                                </a>
                                <div class="border_line"></div>
                                <p>Complete support for new and existing healthcare facilities from planning to installation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Grid Section -->

    <!-- Footer Area -->
     @include('layouts.footer')
    <!-- End Footer Area -->

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
    <script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>