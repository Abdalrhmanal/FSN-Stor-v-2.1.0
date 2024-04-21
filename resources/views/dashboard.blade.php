@extends('layouts.app')
@section('content')
    @if (Auth::check())
    @if (Auth::user()->is_active == 1)
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>لوحة التحكم</h1>
            <nav>
                <ol class="breadcrumb">
                    <li>
                        <h6> لوحة التحكم / </h6>
                    </li>
                    <li><a href="{{ url('dashboard') }}">الصفحة الرئيسية</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
<style>
    @media (max-width: 768px) {
    #hero .carousel-container {
        height: 50vh;
    }

    #hero h2 {
        font-size: 28px;
    }
}

    </style>
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="container">
                    <section class="section dashboard">
                    
                        @if (Auth::user() && Auth::user()->role_id == 2 )
                            <!-- ======= Hero Section ======= -->
                            <section id="hero" class="d-flex flex-column justify-content-end align-items-center"
                                style="margin-top: -35px">
                                <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade"
                                    data-bs-ride="carousel">
                                    <!-- Slide 1 -->
                                    <div class="carousel-item active">
                                        <div class="carousel-container"
                                            style="background-image: url('assets/img/1.jpg'); margin-top: 55px; border-radius: 30px; background-repeat: no-repeat; background-size: 100% 100%;">
                                            <a href="{{ url('/Contact') }}"
                                                class="btn-get-started animate__animated animate__fadeInUp scrollto">مزيد من
                                                المعلومات</a>
                                        </div>
                                    </div>

                                    <!-- Slide 2 -->
                                    <div class="carousel-item">
                                        <div class="carousel-container"
                                            style="background-image: url('assets/img/2.jpg'); margin-top: 55px; border-radius: 30px; background-repeat: no-repeat; background-size: 100% 100%;">
                                            <a href="{{ url('/activation_sim/create') }}"
                                                class="btn-get-started animate__animated animate__fadeInUp scrollto">مزيد من
                                                المعلومات</a>
                                        </div>
                                    </div>

                                    <!-- Slide 3 -->
                                    <div class="carousel-item">
                                        <div class="carousel-container"
                                            style="background-image: url('{{ asset('/img-FSN/sim.jpg') }}'); margin-top: 55px; border-radius: 30px; background-repeat: no-repeat; background-size: 100% 100%;">
                                            <a href="{{ url('/international_sims/create') }}"
                                                class="btn-get-started animate__animated animate__fadeInUp scrollto">مزيد من
                                                المعلومات</a>
                                        </div>
                                    </div>


                                    <a class="carousel-control-prev" href="#heroCarousel" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon bx bx-chevron-left"
                                            aria-hidden="true"></span>
                                    </a>

                                    <a class="carousel-control-next" href="#heroCarousel" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon bx bx-chevron-right"
                                            aria-hidden="true"></span>
                                    </a>

                                </div>

                            </section><!-- End Hero -->
                            <center>
                                <div >
                                    <hr style="border: rgba(0, 67, 251, 0.918) 3px solid;">
                                        <div class="marquee" direction="right"> <!-- تم تغيير قيمة الاتجاه هنا -->
                                            <h4 style="margin-top: 5px;"> Welcome to our website 🩵 SH-FSN    </h4>
                                        </div>
                                    <hr style="border: rgba(0, 67, 251, 0.918) 3px solid;">
                                </div>

                            </center>
                            <div class="row">
                                <div class="col-xxl-3 col-md-3">
                                    <div class="card info-card revenue-card">
                                        <div class="card-body">
                                            <h5 style="margin-top: 10px">طلب رقم دولي</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light"
                                                    style="background-color: #1484c4;">
                                                    <i class="bi bi-globe-asia-australia"></i>
                                                </div>
                                                <div class="ps-3 ss">
                                                    <h6>{{ $totalInternational }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Revenue Card -->
                                <div class="col-xxl-3 col-md-3">
                                    <div class="card info-card revenue-card">
                                        <div class="card-body">
                                            <h5 style="margin-top: 10px"> اعادة تفعيل SIM </h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light"
                                                    style="background-color: #1484c4;">
                                                    <i class="bi bi-eraser"></i>
                                                </div>
                                                <div class="ps-3 ss">
                                                    <h6>{{ $totalActivations }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Revenue Card -->
                                <div class="col-xxl-3 col-md-3">
                                    <div class="card info-card revenue-card">
                                        <div class="card-body">
                                            <h5 style="margin-top: 10px"> الخطوط SIM غير مفعلة </h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light"
                                                    style="background-color: #1484c4;">
                                                    <i class="bi bi-eraser-fill"></i>
                                                </div>
                                                <div class="ps-3 ss">
                                                    <h6>{{ $totalLines  }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Revenue Card -->
                                <div class="col-xxl-3 col-md-3">
                                    <div class="card info-card revenue-card">
                                        <div class="card-body">
                                            <h5 style="margin-top: 10px"> الاكواد التي تم شراؤها </h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light"
                                                    style="background-color: #1484c4;">
                                                    <i class="bi bi-badge-cc"></i>
                                                </div>
                                                <div class="ps-3 ss">
                                                    <h6>{{ $totalcodes }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Revenue Card -->
                                @php
                                    $balanceController = new \App\Http\Controllers\BalanceController();
                                    $balanceHistory = $balanceController->showBalanceHistoryd();
                                @endphp
                                <div class="row">
                                    <!-- Revenue Card -->
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px"> الرصيد الفعال </h5>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="fa fa-turkish-lira"></i>
                                                    </div>
                                                    <div class="ps-3 ss">
                                                        <h6>{{ $balanceHistory['creditBalance'] }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Revenue Card -->

                                    <!-- Revenue Card -->

                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px"> رصيد الدين </h5>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger text-light">
                                                        <i class="fa fa-turkish-lira"></i>
                                                    </div>
                                                    <div class="ps-3 ss">
                                                        <h6>{{ $balanceHistory['debitBalance'] }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Revenue Card -->
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px"> طرق الدفع لدينا </h5>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-light">
                                                        <i class="bi bi-cash-coin"></i>
                                                    </div>
                                                    <div class="ps-3 ss">
                                                        <a href="{{url('/payment')}}">
                                                            <p>لدينا العديد من طرق الدفع المتاحة لدينا</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Revenue Card -->
                                    <div class="col-xxl-3 col-md-6">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px"> العروض الجديدة لدينا </h5>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-info text-light">
                                                        <i class="bi bi-megaphone"></i>
                                                    </div>
                                                    <div class="ps-3 ss">
                                                        <a href="{{url('/offers')}}">
                                                            <p>عروضنا رائعة و مميزة, لا تدعها تفوتك </p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-8 col-md-8">
                                        <div class="card">
                                            <div class="filter">
                                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                        class="bi bi-three-dots"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                    <li class="dropdown-header text-start">
                                                        <h6>Filter</h6>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">All</a></li>
                                                </ul>
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">Reports <span>/Today</span></h5>

                                                <!-- Line Chart -->
                                                <div id="reportsChart"></div>

                                                <script>
                                                    document.addEventListener("DOMContentLoaded", () => {
                                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                                            series: [{
                                                                name: 'الرصيد الفعال',
                                                                data: {!! $balanceHistory['dataCredit'] !!}
                                                            }, {
                                                                name: 'رصيد الدين',
                                                                data: {!! $balanceHistory['dataDebit'] !!}
                                                            }],
                                                            chart: {
                                                                height: 350,
                                                                type: 'area',
                                                                toolbar: {
                                                                    show: false
                                                                },
                                                            },
                                                            markers: {
                                                                size: 4
                                                            },
                                                            colors: ['#2eca6a', '#ff771d'],
                                                            fill: {
                                                                type: "gradient",
                                                                gradient: {
                                                                    shadeIntensity: 1,
                                                                    opacityFrom: 0.3,
                                                                    opacityTo: 0.4,
                                                                    stops: [0, 90, 100]
                                                                }
                                                            },
                                                            dataLabels: {
                                                                enabled: false
                                                            },
                                                            stroke: {
                                                                curve: 'smooth',
                                                                width: 2
                                                            },
                                                            xaxis: {
                                                                type: 'datetime',
                                                                categories: {!! $balanceHistory['categories'] !!}
                                                            },
                                                            tooltip: {
                                                                x: {
                                                                    format: 'dd/MM/yy HH:mm'
                                                                },
                                                            }
                                                        }).render();
                                                    });
                                                </script>



                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xxl-4 col-md-4">

                                        <!-- News & Updates Traffic -->
                                        <div class="card">
                                            <div class="filter">
                                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                        class="bi bi-three-dots"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                    <li class="dropdown-header text-start">
                                                        <h6>Filter</h6>
                                                    </li>

                                                    <li><a class="dropdown-item" href="#">Today</a></li>

                                                </ul>
                                            </div>

                                            <div class="card-body pb-0">
                                                <h5 class="card-title">باقات الرصيد &amp; Updates <span>| Today</span>
                                                </h5>
                                                <div class="scrollable-container"
                                                    style="height: 400px; overflow-y: auto;">

                                                    <div class="news">
                                                        <div class="post-item clearfix">
                                                            <img src="{{ asset('img-FSN/1m.jpg') }}" alt="">
                                                            <h4><a href="/categories">1M</a></h4>
                                                            <p class="ss">باقة انترنت 1 ميغا
                                                                ، السرعة: محدودة<br>
                                                                , الكمية: مفتوحة
                                                                المدة: شهر
                                                            </p>
                                                        </div>

                                                        <div class="post-item clearfix">
                                                            <img src="{{ asset('img-FSN/2m.jpg') }}" alt="">
                                                            <h4><a href="/categories">2M</a></h4>
                                                            <p class="ss">باقة انترنت 2 ميغا
                                                                ,السرعة : محدودة<br>
                                                                ,الكمية :مفتوحة
                                                                ,المدة :شهر

                                                            </p>
                                                        </div>

                                                        <div class="post-item clearfix">
                                                            <img src="{{ asset('img-FSN/4g.jpg') }}" alt="">
                                                            <h4><a href="/categories">4G</a></h4>
                                                            <p class="ss">باقة انترنت 4 غيغا
                                                                السرعة :مفتوحة
                                                                <br>
                                                                الكمية محدودة

                                                                المدة : شهر
                                                            </p>
                                                        </div>

                                                        <div class="post-item clearfix">
                                                            <img src="{{ asset('img-FSN/7g.jpg') }}" alt="">
                                                            <h4><a href="/categories">7G</a></h4>
                                                            <p class="ss">باقة انترنت 7 غيغا
                                                                السرعة :مفتوحة<br>
                                                                الكمية محدودة
                                                                المدة : شهر
                                                            </p>
                                                        </div>

                                                        <div class="post-item clearfix">
                                                            <img src="{{ asset('img-FSN/12g.jpg') }}" alt="">
                                                            <h4><a href="/categories">12G</a></h4>
                                                            <p class="ss">باقة انترنت 12 غيغا
                                                                السرعة :مفتوحة<br>
                                                                الكمية محدودة
                                                                المدة : شهر
                                                            </p>
                                                        </div>
                                                        <div class="post-item clearfix">
                                                            <img src="{{ asset('img-FSN/16g.jpg') }}" alt="">
                                                            <h4><a href="/categories">16G</a></h4>
                                                            <p class="ss">باقة انترنت 16 غيغا
                                                                السرعة :مفتوحة<br>
                                                                الكمية محدودة
                                                                المدة : شهر
                                                            </p>
                                                        </div>
                                                        <div class="post-item clearfix">
                                                            <img src="{{ asset('img-FSN/20g.jpg') }}" alt="">
                                                            <h4><a href="/categories">20G</a></h4>
                                                            <p class="ss">باقة انترنت 20 غيغا
                                                                السرعة :مفتوح<br>
                                                                الكمية محدودة
                                                                المدة : شهر
                                                            </p>
                                                        </div>
                                                        <div class="post-item clearfix">
                                                            <img src="{{ asset('img-FSN/25g.jpg') }}" alt="">
                                                            <h4><a href="/categories">25G شهرين</a></h4>
                                                            <p class="ss"> باقة انترنت 25 غيغا
                                                                السرعة :مفتوحة<br>
                                                                الكمية محدودة
                                                                المدة : شهرين
                                                            </p>
                                                        </div>
                                                        <div class="post-item clearfix">
                                                            <img src="{{ asset('img-FSN/40g.jpg') }}" alt="">
                                                            <h4><a href="/categories">40G </a></h4>
                                                            <p class="ss"> باقة انترنت 40 غيغا
                                                                السرعة :مفتوح<br>
                                                                الكمية محدود
                                                                المدة : شهرين
                                                            </p>
                                                        </div>
                                                        <div class="post-item clearfix">
                                                            <img src="{{ asset('img-FSN/50g.jpg') }}" alt="">
                                                            <h4><a href="/categories">50G ثلاث اشهر</a></h4>
                                                            <p class="ss"> باقة انترنت 50 غيغا
                                                                السرعة :مفتوح<br>
                                                                الكمية محدودة
                                                                المدة : ثلاث اشهر
                                                            </p>
                                                        </div>
                                                        <div class="post-item clearfix">
                                                            <img src="{{ asset('img-FSN/100g.jpg') }}" alt="">
                                                            <h4><a href="/categories">100G ثلاث اشهر</a></h4>
                                                            <p class="ss"> باقة انترنت 100 غيغا
                                                                السرعة :مفتوحة<br>
                                                                الكمية محدودة
                                                                المدة : ثلاث اشهر
                                                            </p>
                                                        </div>
                                                    </div><!-- End sidebar recent posts-->

                                                </div>
                                            </div><!-- End News & Updates -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user() && Auth::user()->role_id == 1)
                            <div class="container">
                                <div class="row">
                                    <div class="col-xxl-3 col-md-3">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px"> المندوبين</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light"
                                                        style="background-color: #1484c4;">
                                                        <i class="bi bi-person-lines-fill"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6>
                                                            <center class="ss">
                                                                {{ $totalUsers }}
                                                            </center>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px">اكواد الرصيد المباعة</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light"
                                                        style="background-color: #1484c4;">
                                                        <i class="bi bi-code"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6>
                                                            <center class="ss">
                                                                {{ $totalCoderecord }}
                                                            </center>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px"> اكواد الرصيد الحالية</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light"
                                                        style="background-color: #1484c4;">
                                                        <i class="bi bi-code-square"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6>
                                                            <center class="ss">
                                                                {{ $totalCodes - $totalCoderecord}}
                                                            </center>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px"> فئات الاكواد المتوفرة</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light"
                                                        style="background-color: #1484c4;">
                                                        <i class="bi bi-collection"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6>
                                                            <center class="ss">{{ $totalCategory }}</center>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px"> المندوبين</h5>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-light">
                                                        <i class="bi bi-people"></i>
                                                    </div>
                                                    <hr>
                                                    <div class="ps-3">

                                                        <h6>
                                                            <center class="ss">
                                                                <a href="{{ route('users.index') }}"> عرض المندوبين</a>
                                                            </center>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px"> اضافة مندوب جديد</h5>
                                                <div class="d-flex align-items-center">

                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-light">
                                                        <i class="bi bi-person-plus"></i>
                                                    </div>

                                                    <hr>
                                                    <div class="ps-3">
                                                        <h6>
                                                            <center class="ss">
                                                                <a href="{{ url('/register') }}"> اضافة مندوب </a>
                                                            </center>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px">أضافة فئة أكواد جديدة</h5>
                                                <div class="d-flex align-items-center">

                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-light">
                                                        <i class="bi bi-folder2-open"></i>
                                                    </div>

                                                    <hr>
                                                    <div class="ps-3">
                                                        <h6>
                                                            <center class="ss">
                                                                <a href="{{ route('categories.create') }}"> اضافة فئة </a>
                                                            </center>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px">أضافة أكواد جديدة</h5>
                                                <div class="d-flex align-items-center">

                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-light">
                                                        <i class="bi bi-cc-square"></i>
                                                    </div>

                                                    <hr>
                                                    <div class="ps-3">
                                                        <h6>
                                                            <center class="ss">
                                                                <a href="{{ route('codes.create') }}"> اضافة أكواد </a>
                                                            </center>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px">أضافة خطوط لمندوب</h5>
                                                <div class="d-flex align-items-center">

                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-light">
                                                        <i class="bi bi-eraser"></i>
                                                    </div>

                                                    <hr>
                                                    <div class="ps-3">
                                                        <h6>
                                                            <center class="ss">
                                                                <a href="{{ route('sim_card1.create') }}"> اضافة خطوط </a>
                                                            </center>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 style="margin-top: 10px">أضافة رصيد لمندوب</h5>
                                                <div class="d-flex align-items-center">

                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-light">
                                                        <i class="bi bi-cash-coin"></i>
                                                    </div>

                                                    <hr>
                                                    <div class="ps-3">
                                                        <h6>
                                                            <center class="ss">
                                                                <a href="{{ route('balances.create') }}"> اضافة رصيد </a>
                                                            </center>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </section>
                </div>
            </div>
        </section>
    </main>
    @else
        {{-- تسجيل خروج المستخدم وتوجيهه إلى صفحة تسجيل الدخول --}}
        {{ Auth::logout() }}
        <script>window.location = "{{ route('login') }}";</script>
    @endif
@else
    {{-- توجيه المستخدم إلى صفحة تسجيل الدخول --}}
    <script>window.location = "{{ route('login') }}";</script>
@endif
@endsection
