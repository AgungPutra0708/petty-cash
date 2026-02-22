@extends('layout.main')
@section('title', 'Dashboard')
@section('content')
    <!-- WELCOME-->
    <section class="p-t-10 p-l-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-4">Welcome <span>{{ Auth::user()->name }}</span>
                    </h1>
                    <hr class="line-seprate">
                </div>
            </div>
        </div>
    </section>
    <!-- END WELCOME-->

    <!-- STATISTIC-->
    <section class="statistic statistic2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="statistic__item statistic__item--green">
                        <h2 class="number">{{ $userCount }}</h2>
                        <span class="desc">User online</span>
                        <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="statistic__item statistic__item--orange">
                        <h2 class="number">{{ $bilyetCount }}</h2>
                        <span class="desc">Serah Terima Bilyet</span>
                        <div class="icon">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="statistic__item statistic__item--blue">
                        <h2 class="number">{{ $customerCount }}</h2>
                        <span class="desc">Customer</span>
                        <div class="icon">
                            <i class="zmdi zmdi-account"></i>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6 col-lg-3">
                    <div class="statistic__item statistic__item--red">
                        <h2 class="number">$1,060,386</h2>
                        <span class="desc">total earnings</span>
                        <div class="icon">
                            <i class="zmdi zmdi-money"></i>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- END STATISTIC-->
@endsection
