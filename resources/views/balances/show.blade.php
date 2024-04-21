@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="container">
            <div class="pagetitle">
                <h1>تفاصيل الرصيد</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">الصفحة الرئيسية</a></li>
                        <li class=" active"> / تفاصيل الرصيد</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title"> الرصيد الفعال </h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-turkish-lira"></i>

                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $creditBalance }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title"> رصيد الدين </h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger text-light">
                                        <i class="fa fa-turkish-lira"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $debitBalance }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User Info Card -->
                    @can('is-admin')
                        <div class="col-xxl-4 col-md-6">
                            <div class="card user-info-card">
                                <div class="card-body">
                                    <h5 class="card-title">معلومات المستخدم</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ps-3">
                                            @foreach ($user as $info)
                                                <h6>{{ $info }}</h6>
                                                <!-- أضف أي معلومات إضافية ترغب في عرضها هنا -->
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                    @if (Auth::user() && Auth::user()->role_id == 2)
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title"> طرق الدفع لدينا </h5>
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
                    @endif
                    <!-- End User Info Card -->


                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">الرصيد  <span>/ الحالي</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [

                                                {
                                                    name: 'الرصيد الفعال',
                                                    data: {!! $dataCredit !!}
                                                }, {
                                                    name: 'رصيد الدين',
                                                    data: {!! $dataDebit !!}
                                                }
                                            ],
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
                                                categories: {!! $categories !!}
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                </div>
            </section>
            <div class="col-12">
                <div class="card recent-sales overflow-auto dark-mode">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>فلترة</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">اليوم</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title"><span> الرصيد | تفاصيل</span></h5>
                        <div class="table-responsive">
                            <table class="table table-borderless datatable text-light">
                                <thead>
                                    <tr>
                                        <th scope="col"> <center>تاريخ العملية </center></th>
                                        <th scope="col"> <center>رصيد الدين </center></th>
                                        <th scope="col"> <center>ايفاء الدين </center></th>
                                        <th scope="col"> <center>الرصيد الفعال </center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td><center>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</center></td>
                                            <td><center>
                                                @if ($transaction->debit_balance > 0)
                                                    --
                                                @else
                                                    {{ $transaction->debit_balance }}
                                                @endif
                                            </center>
                                            </td>
                                            <td><center>
                                                @if ($transaction->debit_balance > 0)

                                                    {{ $transaction->debit_balance }}
                                                @else
                                                    {{ $transaction->debit_repayment }}--
                                                @endif
                                            </center>
                                            </td>
                                            <td><center>{{ $transaction->credit_balance }}</center></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
