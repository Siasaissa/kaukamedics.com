<header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box" style="padding-top:0 !important; padding-bottom:0 !important;">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="#" style="padding:0 !important; margin:0 !important; line-height:0 !important;">
                        <img src="img/logo.png" 
                            alt="Kauka Company Logo" 
                            style="height:100px !important; padding:0 !important; margin:0 !important; display:block;">
                    </a>
                    <div class="d-flex align-items-center d-lg-none">
                        <a href="{{ route('cart') }}" class="cart mr-3" aria-label="Open cart">
                            <span class="ti-bag text-primary">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                         aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('index') }}">Home</a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('products') ? 'active' : '' }}">
                                <a href="{{ route('products') }}" class="nav-link">Products</a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('service') ? 'active' : '' }}">
                                <a href="{{ route('service') }}" class="nav-link">Services</a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                                <a href="{{ route('about') }}" class="nav-link">About Us</a>
                            </li>

                            <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                            </li>
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
                <form action="{{ route('products') }}" method="GET" class="d-flex justify-content-between">
                    <input
                        type="text"
                        class="form-control"
                        id="search_input"
                        name="query"
                        value="{{ request('query') }}"
                        placeholder="Search products by name..."
                    >
                    <button type="submit" class="btn" aria-label="Search products"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>

{{-- Toast Container --}}
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
    @if(session('success'))
        <div class="toast align-items-center border-0 text-white bg-success" role="alert" data-bs-delay="4000" data-bs-autohide="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
    @if(session('newsletter_success'))
        <div class="toast align-items-center border-0 text-white bg-success" role="alert" data-bs-delay="4000" data-bs-autohide="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('newsletter_success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="toast align-items-center border-0 text-white bg-danger" role="alert" data-bs-delay="5000" data-bs-autohide="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-times-circle me-2"></i>
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
    @if(session('info'))
        <div class="toast align-items-center border-0 text-white bg-primary" role="alert" data-bs-delay="4000" data-bs-autohide="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ session('info') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        toastElList.forEach(function (toastEl) {
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    });
</script>
