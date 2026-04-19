<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/fav.png">
    <meta name="author" content="Kauka Company">
    <meta name="description" content="Kauka Company - Reliable Medical Supplies for a Healthier Tomorrow">
    <meta name="keywords" content="kauka,medics,medical equipment, hospital supplies, healthcare">
    <meta charset="UTF-8">
    <title>Kauka Company - About Us</title>
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/ion.rangeSlider.css">
    <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css">
    <link rel="stylesheet" href="css/main.css">

    <style>
        /* ============================================================
           LAYOUT & PROFESSIONAL POLISH — colours from main.css only
           ============================================================ */

        /* Section spacing */
        .blog_categorie_area { padding: 60px 0 40px; }
        .blog_area           { padding: 50px 0 70px; }

        /* Section title helper */
        .section-title-wrap            { text-align: center; margin-bottom: 44px; }
        .section-title-wrap .sub-label {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 8px;
            opacity: .55;
        }
        .section-title-wrap h2   { font-size: 2rem; font-weight: 700; margin: 0 0 14px; line-height: 1.25; }
        .section-title-wrap .title-bar { width: 48px; height: 3px; margin: 0 auto; border-radius: 2px; }

        /* ── Mission / Vision / Values ── */
        .blog_categorie_area .row   { display: flex; align-items: stretch; }
        .blog_categorie_area .col-lg-4 { display: flex; margin-bottom: 24px; }
        .mvv-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 22px rgba(0,0,0,.09);
            transition: transform .26s ease, box-shadow .26s ease;
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        .mvv-card:hover { transform: translateY(-6px); box-shadow: 0 14px 36px rgba(0,0,0,.14); }
        .mvv-card img   { width: 100%; height: 200px; object-fit: cover; display: block; }
        .mvv-card .card-body-inner { padding: 24px 22px 28px; flex: 1; }
        .mvv-card .card-icon {
            width: 42px; height: 42px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px; margin-bottom: 14px;
        }
        .mvv-card h5  { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; }
        .mvv-card .border_line { margin-bottom: 12px; }
        .mvv-card p   { font-size: 0.9rem; line-height: 1.75; margin: 0; opacity: .82; }
        .mvv-card .bottom-line { height: 4px; border-radius: 0 0 10px 10px; }

        /* ── Stats bar ── */
        .stats-bar            { padding: 44px 0; }
        .stat-item            { text-align: center; padding: 0 8px; }
        .stat-item .stat-num  { display: block; font-size: 2.5rem; font-weight: 800; line-height: 1; margin-bottom: 6px; }
        .stat-item .stat-lbl  { font-size: 0.75rem; letter-spacing: 1.8px; text-transform: uppercase; opacity: .6; }
        .stat-sep             { width: 1px; height: 48px; opacity: .12; align-self: center; }

        /* ── Blog articles ── */
        .blog_item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 46px;
            padding-bottom: 46px;
            border-bottom: 1px solid rgba(0,0,0,.07);
        }
        .blog_item:last-of-type { border-bottom: none; margin-bottom: 0; }
        .blog_item .blog_post img {
            width: 100%; height: 230px;
            object-fit: cover; border-radius: 8px; display: block;
        }
        .blog_item .blog_info   { padding-top: 6px; }
        .blog_details h2        { font-size: 1.18rem; font-weight: 700; line-height: 1.45; margin: 14px 0 10px; }
        .blog_details p         { font-size: 0.89rem; line-height: 1.78; opacity: .84; margin-bottom: 16px; }
        .blog_meta li a         { font-size: 0.81rem; }

        /* ── Sidebar ── */
        .blog_right_sidebar { padding-left: 10px; }
        .single_sidebar_widget,
        .single-sidebar-widget {
            border-radius: 10px;
            box-shadow: 0 2px 14px rgba(0,0,0,.07);
            padding: 24px 22px;
            margin-bottom: 28px;
        }
        .widget_title {
            font-size: 0.97rem; font-weight: 700; letter-spacing: .4px;
            margin-bottom: 18px; padding-bottom: 10px;
            border-bottom: 2px solid rgba(0,0,0,.06);
        }

        /* Author */
        .author_widget         { text-align: center; }
        .author_widget .author_img {
            width: 90px; height: 90px; object-fit: cover; border-radius: 50%;
            margin: 0 auto 14px; display: block; border: 3px solid rgba(0,0,0,.08);
        }
        .author_widget h4      { font-size: 1rem; font-weight: 700; margin-bottom: 3px; }
        .author_widget .role   { font-size: 0.78rem; opacity: .55; margin-bottom: 12px; }
        .author_widget .social_icon { margin: 10px 0 14px; }
        .author_widget .social_icon a { margin: 0 6px; font-size: 15px; }
        .author_widget blockquote {
            font-size: 0.84rem; line-height: 1.72; font-style: italic;
            opacity: .78; border-left: none; padding: 0; margin: 0;
        }

        /* Milestones */
        .post_item {
            display: flex; align-items: center; gap: 14px;
            margin-bottom: 14px; padding-bottom: 14px;
            border-bottom: 1px solid rgba(0,0,0,.05);
        }
        .post_item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .post_item img        { width: 66px; height: 50px; object-fit: cover; border-radius: 5px; flex-shrink: 0; }
        .post_item .media-body h3 { font-size: 0.87rem; font-weight: 600; margin-bottom: 3px; }
        .post_item .media-body p  { font-size: 0.77rem; margin: 0; opacity: .55; }

        /* Services */
        .cat-list              { list-style: none; padding: 0; margin: 0; }
        .cat-list li           { border-bottom: 1px solid rgba(0,0,0,.05); }
        .cat-list li:last-child { border-bottom: none; }
        .cat-list li a {
            display: flex; justify-content: space-between; align-items: center;
            padding: 9px 0; transition: padding-left .18s;
        }
        .cat-list li a:hover  { padding-left: 5px; }
        .cat-list li a p      { margin: 0; font-size: 0.87rem; }
        .cat-list li a p:last-child { font-size: 0.77rem; font-weight: 700; opacity: .5; }

        /* Newsletter */
        .newsletter_widget .form-group {
            display: flex; align-items: center; gap: 6px; flex-wrap: nowrap; margin-bottom: 8px;
        }
        .newsletter_widget .bbtns { white-space: nowrap; padding: 9px 14px; font-size: 0.82rem; border-radius: 4px; }
        .newsletter_widget .text-bottom { font-size: 0.75rem; opacity: .5; margin: 0; }

        /* Tags */
        .tag_cloud_widget ul.list { display: flex; flex-wrap: wrap; gap: 7px; list-style: none; padding: 0; margin: 0; }
        .tag_cloud_widget ul.list li a {
            display: inline-block; padding: 5px 13px; border-radius: 20px;
            font-size: 0.77rem; font-weight: 600; border: 1px solid rgba(0,0,0,.1);
            transition: all .2s;
        }
        .tag_cloud_widget ul.list li a:hover { border-color: transparent; }

        /* Ads widget */
        .ads_widget { padding: 0 !important; overflow: hidden; }
        .ads_widget img { border-radius: 10px; display: block; width: 100%; }

        /* ============================================================
           VIDEO GALLERY
           ============================================================ */
        .video-gallery-section { padding: 70px 0; }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            margin-top: 10px;
        }
        .video-card {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 4px 18px rgba(0,0,0,.11);
            transition: transform .26s ease, box-shadow .26s ease;
        }
        .video-card:hover { transform: translateY(-6px); box-shadow: 0 16px 38px rgba(0,0,0,.17); }
        .video-card > img { width: 100%; height: 195px; object-fit: cover; display: block; }
        .video-card .vc-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,.68) 0%, rgba(0,0,0,.18) 55%, transparent 100%);
            display: flex; flex-direction: column; justify-content: flex-end; padding: 16px;
        }
        .video-card .play-btn {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -60%);
            width: 52px; height: 52px; border-radius: 50%;
            background: rgba(255,255,255,.93);
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
            box-shadow: 0 4px 18px rgba(0,0,0,.28);
            transition: transform .22s ease, background .22s ease;
        }
        .video-card:hover .play-btn { transform: translate(-50%, -60%) scale(1.13); background: #fff; }
        .video-card .play-btn i     { margin-left: 3px; }
        .video-card .vc-label       { color: #fff; }
        .video-card .vc-label h6    { font-size: 0.88rem; font-weight: 700; margin: 0 0 3px; line-height: 1.3; }
        .video-card .vc-label span  { font-size: 0.73rem; opacity: .75; }
        .video-card .vc-duration {
            position: absolute; top: 10px; right: 10px;
            background: rgba(0,0,0,.58); color: #fff;
            font-size: 0.7rem; padding: 3px 8px;
            border-radius: 3px; font-weight: 700; letter-spacing: .5px;
        }

        /* ── Video Popup ── */
        .video-popup-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.88); z-index: 99999;
            align-items: center; justify-content: center;
        }
        .video-popup-overlay.active { display: flex; animation: popupFadeIn .22s ease; }
        @keyframes popupFadeIn { from { opacity: 0; } to { opacity: 1; } }
        .video-popup-inner  { position: relative; width: 90%; max-width: 880px; }
        .close-popup {
            position: absolute; top: -40px; right: 0;
            background: none; border: none; color: #fff;
            font-size: 28px; cursor: pointer; line-height: 1;
            transition: transform .2s; opacity: .85;
        }
        .close-popup:hover { transform: rotate(90deg); opacity: 1; }
        .video-wrapper {
            position: relative; padding-top: 56.25%;
            border-radius: 10px; overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,.55);
        }
        .video-wrapper iframe,
        .video-wrapper video {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;
        }
        .popup-title-bar { color: #fff; padding: 14px 2px 0; font-size: 1rem; font-weight: 600; }

        /* Responsive */
        @media (max-width: 991px) { .video-grid { grid-template-columns: repeat(2,1fr); } }
        @media (max-width: 575px) {
            .video-grid { grid-template-columns: 1fr; }
            .blog_right_sidebar { padding-left: 0; margin-top: 30px; }
            .stat-item .stat-num { font-size: 1.9rem; }
        }
    </style>
</head>

<body>
    @php
        $aboutImageVersion = time();
        $aboutImages = [
            'img/image1.jpg?v=' . $aboutImageVersion,
            'img/image2.jpg?v=' . $aboutImageVersion,
            'img/image3.jpg?v=' . $aboutImageVersion,
            'img/image4.jpg?v=' . $aboutImageVersion,
        ];
    @endphp

    <!-- ═══ HEADER ═══ -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box"
                style="padding-top:0 !important; padding-bottom:0 !important;">
                <div class="container">
                    <a class="navbar-brand logo_h" href="#"
                        style="padding:0 !important; margin:0 !important; line-height:0 !important;">
                        <img src="img/logo.png" alt="Kauka Company Logo"
                            style="height:100px !important; padding:0 !important; margin:0 !important; display:block;">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
                            <li class="nav-item submenu dropdown">
                                <a class="nav-link dropdown-toggle" href="{{ route('service') }}">Services</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('about') }}">About Us</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item">
                                <a href="{{ route('cart') }}" class="cart">
                                    <span class="ti-bag text-primary">
                                        {{ session('cart') ? count(session('cart')) : 0 }}
                                    </span>
                                </a>
                            </li>
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

    <!-- ═══ PAGE BANNER ═══ -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>About Us</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="about.html">About Us</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ MISSION / VISION / VALUES ═══ -->
    <section class="blog_categorie_area">
        <div class="container">
            <div class="section-title-wrap">
                <span class="sub-label">Who We Are</span>
                <h2>Our Foundation</h2>
                <div class="title-bar"></div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="mvv-card">
                        <img src="{{ $aboutImages[0] }}" alt="Our Mission">
                        <div class="card-body-inner">
                            <div class="card-icon"><i class="fa fa-bullseye"></i></div>
                            <h5>Our Mission</h5>
                            <div class="border_line"></div>
                            <p>To enhance healthcare delivery by providing innovative, affordable, and reliable medical supplies that meet international quality standards.</p>
                        </div>
                        <div class="bottom-line"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="mvv-card">
                        <img src="{{ $aboutImages[1] }}" alt="Our Vision">
                        <div class="card-body-inner">
                            <div class="card-icon"><i class="fa fa-eye"></i></div>
                            <h5>Our Vision</h5>
                            <div class="border_line"></div>
                            <p>To be the most trusted partner in healthcare supply across Africa, empowering every clinic, hospital, and professional we serve.</p>
                        </div>
                        <div class="bottom-line"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="mvv-card">
                        <img src="{{ $aboutImages[2] }}" alt="Our Values">
                        <div class="card-body-inner">
                            <div class="card-icon"><i class="fa fa-star"></i></div>
                            <h5>Our Values</h5>
                            <div class="border_line"></div>
                            <p>Quality, Integrity, Reliability, and Customer-Centered Service — the four pillars that guide every decision we make.</p>
                        </div>
                        <div class="bottom-line"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ STATS BAR ═══ -->
    <section class="stats-bar">
        <div class="container">
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <span class="stat-num">20+</span>
                        <span class="stat-lbl">Years Experience</span>
                    </div>
                </div>
                <div class="col-1 d-none d-md-flex justify-content-center">
                    <div class="stat-sep"></div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <span class="stat-num">1,500+</span>
                        <span class="stat-lbl">Happy Clients</span>
                    </div>
                </div>
                <div class="col-1 d-none d-md-flex justify-content-center">
                    <div class="stat-sep"></div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <span class="stat-num">1,200+</span>
                        <span class="stat-lbl">Products Supplied</span>
                    </div>
                </div>
                <div class="col-1 d-none d-md-flex justify-content-center">
                    <div class="stat-sep"></div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <span class="stat-num">24/7</span>
                        <span class="stat-lbl">Support Available</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ VIDEO GALLERY ═══ -->
    <section class="video-gallery-section">
        <div class="container">
            <div class="section-title-wrap">
                <span class="sub-label">See Us in Action</span>
                <h2>Our Story in Videos</h2>
                <div class="title-bar"></div>
            </div>
            <div class="video-grid">

                <div class="video-card"
                    data-video="{{ asset('img/video1.mp4') }}"
                    data-title="Kauka Company Overview">
                    <img src="{{ $aboutImages[0] }}" alt="Company Overview">
                    <span class="vc-duration">Video 1</span>
                    <div class="vc-overlay">
                        <div class="play-btn"><i class="fa fa-play text-primary"></i></div>
                        <div class="vc-label">
                            <h6>Company Overview</h6>
                            <span>Who we are &amp; what we do</span>
                        </div>
                    </div>
                </div>

                <div class="video-card"
                    data-video="{{ asset('img/video2.mp4') }}"
                    data-title="Our Medical Products Range">
                    <img src="{{ $aboutImages[1] }}" alt="Products Range">
                    <span class="vc-duration">Video 2</span>
                    <div class="vc-overlay">
                        <div class="play-btn"><i class="fa fa-play text-primary"></i></div>
                        <div class="vc-label">
                            <h6>Our Products Range</h6>
                            <span>Certified medical supplies</span>
                        </div>
                    </div>
                </div>

                <div class="video-card"
                    data-video="{{ asset('img/video3.mp4') }}"
                    data-title="Meet Our Team">
                    <img src="{{ $aboutImages[2] }}" alt="Meet Our Team">
                    <span class="vc-duration">Video 3</span>
                    <div class="vc-overlay">
                        <div class="play-btn"><i class="fa fa-play text-primary"></i></div>
                        <div class="vc-label">
                            <h6>Meet Our Team</h6>
                            <span>The people behind Kauka</span>
                        </div>
                    </div>
                </div>

                <div class="video-card"
                    data-video="{{ asset('img/video4.mp4') }}"
                    data-title="Supply & Delivery Process">
                    <img src="{{ $aboutImages[3] }}" alt="Supply Process">
                    <span class="vc-duration">Video 4</span>
                    <div class="vc-overlay">
                        <div class="play-btn"><i class="fa fa-play text-primary"></i></div>
                        <div class="vc-label">
                            <h6>Supply &amp; Delivery Process</h6>
                            <span>From order to doorstep</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══ VIDEO POPUP MODAL ═══ -->
    <div class="video-popup-overlay" id="videoPopup">
        <div class="video-popup-inner">
            <button class="close-popup" id="closePopup" aria-label="Close video">&times;</button>
            <div class="video-wrapper">
                <video id="popupVideo" controls playsinline>
                    <source id="popupVideoSource" src="" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="popup-title-bar" id="popupTitle"></div>
        </div>
    </div>

    <!-- ═══ ABOUT CONTENT + SIDEBAR ═══ -->
    <section class="blog_area">
        <div class="container">
            <div class="row">

                <!-- Left: Articles -->
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">

                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="#">Quality,</a>
                                        <a class="active" href="#">Healthcare,</a>
                                        <a href="#">Medical</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">Kauka Team <i class="lnr lnr-user"></i></a></li>
                                        <li><a href="#">Est. 2005 <i class="lnr lnr-calendar-full"></i></a></li>
                                        <li><a href="#">1.2M Clients <i class="lnr lnr-eye"></i></a></li>
                                        <li><a href="#">1500 Products <i class="lnr lnr-bubble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{ $aboutImages[1] }}" alt="Delivering Quality Healthcare">
                                    <div class="blog_details">
                                        <a href="#"><h2>Delivering Quality Healthcare Solutions Since 2005</h2></a>
                                        <p>We are a trusted provider of medical equipment, hospital supplies, and healthcare solutions dedicated to improving the quality of care across hospitals, clinics, and medical institutions. Our goal is to make reliable medical products accessible to those who save lives every day.</p>
                                        <a href="#" class="white_bg_btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="#">Mission,</a>
                                        <a class="active" href="#">Values,</a>
                                        <a href="#">Commitment</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">Our Team <i class="lnr lnr-user"></i></a></li>
                                        <li><a href="#">2024 <i class="lnr lnr-calendar-full"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{ $aboutImages[0] }}" alt="Our Mission">
                                    <div class="blog_details">
                                        <a href="#"><h2>Our Mission: Quality Healthcare for All</h2></a>
                                        <p>To enhance healthcare delivery by providing innovative, affordable, and reliable medical supplies that meet international quality standards. We partner with healthcare providers to improve outcomes and remain committed to advancing medical care across Africa.</p>
                                        <a href="#" class="white_bg_btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="#">Team,</a>
                                        <a class="active" href="#">Experts,</a>
                                        <a href="#">Professionals</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">Leadership <i class="lnr lnr-user"></i></a></li>
                                        <li><a href="#">2024 <i class="lnr lnr-calendar-full"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{ $aboutImages[2] }}" alt="Our Team">
                                    <div class="blog_details">
                                        <a href="#"><h2>Meet Our Professional Team</h2></a>
                                        <p>Our team is led by experienced healthcare professionals. Dr. Ambwene John Mwankenja (Director), Fadhili Mwankenja (Operation Manager), Patrick Mbise (Operation Manager), and Clementina Peter (Sales & Procurement Officer) bring decades of combined experience to ensure every client receives the best products and service.</p>
                                        <a href="#" class="white_bg_btn">Meet the Team</a>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="#">Partners,</a>
                                        <a class="active" href="#">Clients,</a>
                                        <a href="#">Hospitals</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">Clients <i class="lnr lnr-user"></i></a></li>
                                        <li><a href="#">2024 <i class="lnr lnr-calendar-full"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{ $aboutImages[3] }}" alt="Trusted Clients">
                                    <div class="blog_details">
                                        <a href="#"><h2>Trusted by Healthcare Providers Nationwide</h2></a>
                                        <p>We are proud to serve over 1,500 satisfied clients including hospitals, clinics, and pharmacies across Tanzania and East Africa. Our reputation is built on quality products, timely delivery, and professional customer service.</p>
                                        <a href="#" class="white_bg_btn">View More</a>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="#">Why,</a>
                                        <a class="active" href="#">Choose,</a>
                                        <a href="#">Us</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">Benefits <i class="lnr lnr-user"></i></a></li>
                                        <li><a href="#">2024 <i class="lnr lnr-calendar-full"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{ $aboutImages[0] }}" alt="Why Choose Kauka">
                                    <div class="blog_details">
                                        <a href="#"><h2>Why Choose Kauka Company?</h2></a>
                                        <p>We offer certified and approved medical products, a strong distribution and logistics network, and an experienced and dedicated support team. Partner with us to access reliable medical solutions that keep your healthcare facility equipped and efficient.</p>
                                        <a href="contact.html" class="white_bg_btn">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- Pagination -->
                        
                    </div>
                </div>

                <!-- Right: Sidebar -->
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">

                        <aside class="single_sidebar_widget search_widget">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Our Story"
                                    onfocus="this.placeholder=''" onblur="this.placeholder='Search Our Story'">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="lnr lnr-magnifier"></i>
                                    </button>
                                </span>
                            </div>
                        </aside>

                        <aside class="single_sidebar_widget author_widget">
                            <img class="author_img rounded-circle" src="img/team-3.png" alt="Dr. Ambwene John Mwankenja">
                            <h4>Dr. Ambwene John Mwankenja</h4>
                            <p class="role">Director, Kauka Company</p>
                            <div class="social_icon">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                            <blockquote>"Our commitment is to provide healthcare facilities with reliable and affordable medical supplies. We believe in building a healthier tomorrow through quality products and exceptional service."</blockquote>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Our Milestones</h3>
                            <div class="media post_item">
                                <img src="{{ $aboutImages[0] }}" alt="Company Founded">
                                <div class="media-body">
                                    <a href="#"><h3>Company Founded</h3></a>
                                    <p>2005</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="{{ $aboutImages[1] }}" alt="Expanded to East Africa">
                                <div class="media-body">
                                    <a href="#"><h3>Expanded to East Africa</h3></a>
                                    <p>2010</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="{{ $aboutImages[2] }}" alt="ISO Certification">
                                <div class="media-body">
                                    <a href="#"><h3>ISO Certification</h3></a>
                                    <p>2015</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="{{ $aboutImages[3] }}" alt="1500+ Clients Served">
                                <div class="media-body">
                                    <a href="#"><h3>1500+ Clients Served</h3></a>
                                    <p>2024</p>
                                </div>
                            </div>
                        </aside>

                        <aside class="single_sidebar_widget ads_widget">
                            <a href="contact.html">
                                <img class="img-fluid" src="{{ $aboutImages[2] }}" alt="Contact Kauka">
                            </a>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Our Services</h4>
                            <ul class="list cat-list">
                                <li><a href="#"><p>Medical Equipment Supply</p><p>50+</p></a></li>
                                <li><a href="#"><p>Hospital Consumables</p><p>200+</p></a></li>
                                <li><a href="#"><p>Equipment Maintenance</p><p>24/7</p></a></li>
                                <li><a href="#"><p>Medical Logistics</p><p>Nationwide</p></a></li>
                                <li><a href="#"><p>Staff Training</p><p>Monthly</p></a></li>
                                <li><a href="#"><p>Consultancy</p><p>Available</p></a></li>
                            </ul>
                        </aside>

                        <aside class="single-sidebar-widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>
                            <p>Stay updated with our latest products and healthcare news.</p>
                            <div class="form-group d-flex flex-row">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter email"
                                        onfocus="this.placeholder=''" onblur="this.placeholder='Enter email'">
                                </div>
                                <a href="#" class="bbtns">Subscribe</a>
                            </div>
                            <p class="text-bottom">You can unsubscribe at any time</p>
                        </aside>

                        <aside class="single-sidebar-widget tag_cloud_widget">
                            <h4 class="widget_title">Tags</h4>
                            <ul class="list">
                                <li><a href="#">Medical</a></li>
                                <li><a href="#">Healthcare</a></li>
                                <li><a href="#">Equipment</a></li>
                                <li><a href="#">Hospital</a></li>
                                <li><a href="#">Supplies</a></li>
                                <li><a href="#">Pharmaceutical</a></li>
                                <li><a href="#">Quality</a></li>
                                <li><a href="#">Certified</a></li>
                                <li><a href="#">Logistics</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Training</a></li>
                                <li><a href="#">Maintenance</a></li>
                            </ul>
                        </aside>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══ FOOTER ═══ -->
     @include('layouts.footer')
    <!-- Scripts -->
    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
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

    <script>
        $(document).ready(function () {

            /* Header search */
            $('#search').on('click', function () { $('#search_input_box').slideToggle(); });
            $('#close_search').on('click', function () { $('#search_input_box').slideUp(); });

            /* Video popup */
            var $overlay = $('#videoPopup');
            var videoEl = document.getElementById('popupVideo');
            var sourceEl = document.getElementById('popupVideoSource');
            var $title   = $('#popupTitle');

            $('.video-card').on('click', function () {
                sourceEl.src = $(this).data('video');
                videoEl.load();
                var playPromise = videoEl.play();
                if (playPromise !== undefined) {
                    playPromise.catch(function () {});
                }
                $title.text($(this).data('title'));
                $overlay.addClass('active');
                $('body').css('overflow', 'hidden');
            });

            $('#closePopup').on('click', function () { closeVideo(); });

            $overlay.on('click', function (e) {
                if ($(e.target).is($overlay)) { closeVideo(); }
            });

            $(document).on('keydown', function (e) {
                if (e.key === 'Escape') { closeVideo(); }
            });

            function closeVideo() {
                $overlay.removeClass('active');
                videoEl.pause();
                sourceEl.src = '';
                videoEl.load();
                $('body').css('overflow', '');
            }
        });
    </script>

</body>
</html>
