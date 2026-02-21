<!-- HEADER DESKTOP-->
@php
    $route = Route::currentRouteName();
@endphp
<header class="header-desktop3 d-none d-lg-block">
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <div class="header__logo">
                <a href="{{ route('dashboard.index') }}" style="font-size: 20px; font-weight: bold; color: white;">
                    Management System
                </a>
            </div>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="{{ $route === 'dashboard.index' ? 'active' : '' }}">
                        <a href="{{ route('dashboard.index') }}">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="{{ str_starts_with($route, 'bilyet') ? 'active' : '' }}">
                        <a href="{{ route('bilyet.index') }}">
                            <i class="fas fa-dollar-sign"></i>
                            <span class="bot-line"></span>Bilyet</a>
                    </li>
                    <li class="{{ $route === 'customer.index' ? 'active' : '' }}">
                        <a href="{{ route('customer.index') }}">
                            <i class="fas fa-users"></i>
                            <span class="bot-line"></span>Customer</a>
                    </li>
                </ul>
            </div>
            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src="{{ asset('assets/images/icon/avatar-01.jpg') }}" alt="{{ Auth::user()->name }}" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="{{ route('dashboard.index') }}">
                                        <img src="{{ asset('assets/images/icon/avatar-01.jpg') }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="#">{{ Auth::user()->name }}</a>
                                    </h5>
                                    <span class="email">{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="#" data-toggle="modal" data-target="#logoutModal" id="logoutButton">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER DESKTOP-->

<!-- HEADER MOBILE-->
<header class="header-mobile header-mobile-2 d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a href="{{ route('dashboard.index') }}" style="font-size: 20px; font-weight: bold; color: white;">
                    Management System
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="{{ $route === 'dashboard.index' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="{{ str_starts_with($route, 'bilyet') ? 'active' : '' }}">
                    <a href="{{ route('bilyet.index') }}">
                        <i class="fas fa-dollar-sign"></i>
                        <span class="bot-line"></span>
                        Bilyet
                    </a>
                </li>
                <li class="{{ str_starts_with($route, 'stock') ? 'active' : '' }}">
                    <a href="{{ route('stock.index') }}">
                        <i class="fas fa-boxes"></i>
                        <span class="bot-line"></span>
                        Stock
                    </a>
                </li>
                <li class="{{ str_starts_with($route, 'customer') ? 'active' : '' }}">
                    <a href="{{ route('customer.index') }}">
                        <i class="fas fa-users"></i>
                        <span class="bot-line"></span>
                        Customer
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="sub-header-mobile-2 d-block d-lg-none">
    <div class="header__tool">
        <div class="account-wrap">
            <div class="account-item account-item--style2 clearfix js-item-menu">
                <div class="image">
                    <img src="{{ asset('assets/images/icon/avatar-01.jpg') }}" alt="{{ Auth::user()->name }}" />
                </div>
                <div class="content">
                    <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                </div>
                <div class="account-dropdown js-dropdown">
                    <div class="info clearfix">
                        <div class="image">
                            <a href="{{ route('dashboard.index') }}">
                                <img src="{{ asset('assets/images/icon/avatar-01.jpg') }}"
                                    alt="{{ Auth::user()->name }}" />
                            </a>
                        </div>
                        <div class="content">
                            <h5 class="name">
                                <a href="#">{{ Auth::user()->name }}</a>
                            </h5>
                            <span class="email">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    <div class="account-dropdown__footer">
                        <a href="#" data-toggle="modal" data-target="#logoutModal" id="logoutButton">
                            <i class="zmdi zmdi-power"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END HEADER MOBILE -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keluar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin akan keluar?
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Keluar</button>
                </div>
            </div>
        </form>
    </div>
</div>
