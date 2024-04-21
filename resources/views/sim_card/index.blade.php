@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <!-- Recent Sales -->
        <div class="col-12">
            <div class="card recent-sales overflow-auto">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>
                        <li><a class="dropdown-item" href="#">اليوم</a></li>
                    </ul>
                </div>

                <div class="card-body">
                    <h5 class="card-title">المبيعات <span>| اليوم</span></h5>

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>#</center>
                                </th>
                                <th scope="col">
                                    <center>الرقم التسلسلي </center>
                                </th>
                                <th scope="col">
                                    <center>السعر</center>
                                </th>
                                <th scope="col">
                                    <center>ادارة</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($simCards as $simCard)
                                <tr>
                                    <th scope="row">
                                        <center><a href="#">{{ $simCard->id }}</a></center>
                                    </th>
                                    <td>
                                        <center><a href="#" class="text-primary"> {{ $simCard->serial_number }}</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center><i class="fa fa-turkish-lira"></i> {{ $simCard->price }}<span></span></center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('sold_lines.create', $simCard->serial_number) }}"
                                                class="btn btn-outline-danger">
                                                <span class="btn btn-red">بيع</span>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Recent Sales -->

    </main>
@endsection
