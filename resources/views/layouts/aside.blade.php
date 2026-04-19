<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard" target="_blank">
            <img src="{{ url('img/logo.png')}}" class="navbar-brand-img"  height="80" alt="main_logo">
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('dashboard') }}">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.products.index') }}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.orders.index') }}">
                    <i class="material-symbols-rounded opacity-5">receipt_long</i>
                    <span class="nav-link-text ms-1">Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.customers.index') }}">
                    <i class="material-symbols-rounded opacity-5">view_in_ar</i>
                    <span class="nav-link-text ms-1">Customers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.report.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.report.index') }}">
                    <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
                    <span class="nav-link-text ms-1">Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('bulk') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('bulk') }}">
                    <i class="material-symbols-rounded opacity-5">notifications</i>
                    <span class="nav-link-text ms-1">Bulk Sms</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.Invoice.index') ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ route('admin.Invoice.index') }}">
                    <i class="material-symbols-rounded opacity-5">receipt_long</i>
                    <span class="nav-link-text ms-1">Invoice</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
