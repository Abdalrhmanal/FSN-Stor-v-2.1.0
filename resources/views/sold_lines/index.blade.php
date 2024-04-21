@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <!-- Recent Sales -->
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
                    <h5 class="card-title"><span> مبيعات | الخطوط</span></h5>
                    <div class="table-responsive">
                        <table class="table table-borderless datatable text-light">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">الرقم التسلسلي</th>
                                    <th scope="col">السعر</th>
                                    @can('is-admin')
                                        <th scope="col">المندوب</th>
                                    @endcan
                                    <th scope="col">التاريخ</th>
                                    <th scope="col">ادارة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($soldLines as $index => $soldLine)
                                    <tr>
                                        <th scope="row"><a href="#" class="text-light">{{ $index + 1 }}</a></th>
                                        <td><a href="#" class="text-primary">{{ optional($soldLine->simcard)->serial_number }}</a></td>
                                        <td> </span>{{ optional($soldLine->simcard)->price }} <span><i class="fa fa-turkish-lira"></i></td>
                                        @can('is-admin')
                                            <td>{{ $soldLine->simcard->user->name }}</td>
                                        @endcan
                                        <td><span>{{ $soldLine->created_at }}</span></td>
                                        <td><a href="{{ route('sold_lines.details',  $soldLine->id )}}"
                                                class="btn btn-outline-danger"><i class="bi bi-folder-plus"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div><!-- End Recent Sales -->

    </main>
@endsection
