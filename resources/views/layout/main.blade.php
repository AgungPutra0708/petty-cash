<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Management System">
    <meta name="author" content="Management System">
    <meta name="keywords" content="Management System">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Page-->
    <title>@yield('title', 'Dashboard')</title>

    @include('layout.header')
</head>

<body class="animsition">
    <div class="page-wrapper">

        @include('layout.nav')

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">

                                        {{-- HOME --}}
                                        <li class="list-inline-item">
                                            <a href="{{ route('dashboard.index') }}">Home</a>
                                        </li>

                                        @php
                                            $route = Route::currentRouteName();
                                        @endphp

                                        {{-- BILYET --}}
                                        @if (str_starts_with($route, 'bilyet'))
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">
                                                <a href="{{ route('bilyet.index') }}">Bilyet</a>
                                            </li>
                                        @endif

                                        {{-- CREATE --}}
                                        @if ($route === 'bilyet.create')
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">@yield('title')</li>
                                        @endif

                                        {{-- EDIT --}}
                                        @if ($route === 'bilyet.edit')
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">@yield('title')</li>
                                        @endif

                                        {{-- CUSTOMER --}}
                                        @if (str_starts_with($route, 'customer'))
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">
                                                <a href="{{ route('customer.index') }}">Customer</a>
                                            </li>
                                        @endif

                                        {{-- CREATE --}}
                                        @if ($route === 'customer.create')
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">@yield('title')</li>
                                        @endif

                                        {{-- EDIT --}}
                                        @if ($route === 'customer.edit')
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">@yield('title')</li>
                                        @endif

                                        {{-- Master Barang --}}
                                        @if (str_starts_with($route, 'master-barang'))
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">
                                                <a href="{{ route('master-barang.index') }}">Master Barang</a>
                                            </li>
                                        @endif

                                        {{-- CREATE --}}
                                        @if ($route === 'master-barang.create')
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">@yield('title')</li>
                                        @endif

                                        {{-- EDIT --}}
                                        @if ($route === 'master-barang.edit')
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">@yield('title')</li>
                                        @endif

                                        {{-- Pemasukan Barang --}}
                                        @if (str_starts_with($route, 'pemasukan'))
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">
                                                <a href="{{ route('pemasukan.index') }}">Pemasukan Barang</a>
                                            </li>
                                        @endif

                                        {{-- CREATE --}}
                                        @if ($route === 'pemasukan.create')
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">@yield('title')</li>
                                        @endif

                                        {{-- EDIT --}}
                                        @if ($route === 'pemasukan.edit')
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">@yield('title')</li>
                                        @endif

                                        {{-- Pengeluaran Barang --}}
                                        @if (str_starts_with($route, 'pengeluaran'))
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">
                                                <a href="{{ route('pengeluaran.index') }}">Pengeluaran Barang</a>
                                            </li>
                                        @endif

                                        {{-- CREATE --}}
                                        @if ($route === 'pengeluaran.create')
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">@yield('title')</li>
                                        @endif

                                        {{-- EDIT --}}
                                        @if ($route === 'pengeluaran.edit')
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">@yield('title')</li>
                                        @endif

                                        {{-- History Stock --}}
                                        @if (str_starts_with($route, 'history-stock'))
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item">
                                                <a href="{{ route('history-stock.index') }}">Stock Opname</a>
                                            </li>
                                            @if (!in_array($route, ['history-stock.index']))
                                                <li class="list-inline-item seprate"><span>/</span></li>
                                                <li class="list-inline-item active">@yield('title')</li>
                                            @endif
                                        @endif

                                        {{-- Petty Cash --}}
                                        @if (str_starts_with($route, 'petty-cash'))
                                              <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item">
                                                <a href="{{ route('petty-cash.index') }}">Petty Cash</a>
                                            </li>
                                            @if (!in_array($route, ['petty-cash.index']))
                                                <li class="list-inline-item seprate"><span>/</span></li>
                                                <li class="list-inline-item active">@yield('title')</li>
                                            @endif
                                        @endif
                                        
                                        {{-- Manajemen User --}}
                                        @if (str_starts_with($route, 'user'))
                                              <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item">
                                                <a href="{{ route('user.index') }}">Manajemen User</a>
                                            </li>
                                            @if (!in_array($route, ['user.index']))
                                                <li class="list-inline-item seprate"><span>/</span></li>
                                                <li class="list-inline-item active">@yield('title')</li>
                                            @endif
                                        @endif

                                        {{-- DASHBOARD --}}
                                        @if ($route === 'dashboard.index')
                                            <li class="list-inline-item seprate"><span>/</span></li>
                                            <li class="list-inline-item active">@yield('title')</li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            @yield('content')
        </div>

    </div>

    @include('layout.footer')

    @include('layout.footer-script')
</body>

</html>
