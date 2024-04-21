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

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">الرقم التسلسلي</th>
                                <th scope="col">السعر</th>
                                <th scope="col">المندوب</th>
                                <th scope="col">تاريخ الشراء</th>
                                <th scope="col">ادارة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soldLines as $index => $soldLine)
                                <tr>
                                    <th scope="row"><a href="#">{{ $index + 1 }}</a></th>
                                    <td><a href="#" class="text-primary">{{ optional($soldLine->simcard)->serial_number }}</a></td>
                                    <td> {{ optional($soldLine->simcard)->price }} <i class="fa fa-turkish-lira"></i></td>
                                    <td>{{ optional($soldLine->simcard->user)->name }}</td>
                                    <td><span>44</span></td>
                                    <td><a href="{{ route('sold_lines.details',  $soldLine->id )}}" class="btn btn-outline-danger"><i class="bi bi-folder-plus"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Recent Sales -->

    </main>
@endsection
