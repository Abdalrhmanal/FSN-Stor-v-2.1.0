@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="container">
            <h2>قائمة التحويلات</h2>
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
                    <h5 class="card-title"><span>قائمة التحويلات</span></h5>
                    <div class="table-responsive">
                        <table class="table table-borderless datatable text-light">
                            <thead>
                                <tr>
                                    <th scope="col" >#</th>
                                    @can('is-admin')
                                        <th scope="col">المندوب</th>
                                    @endcan
                                    <th scope="col">كود الرصيد</th>
                                    <th scope="col">رقم الخط</th>
                                    <th scope="col">تاريخ الإنشاء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transfers as $index => $transfer)
                                    <tr>
                                        <th scope="row"><a href="#" class="text-light">{{ $index + 1 }}</a></th>
                                        @can('is-admin')
                                            <td>{{ $transfer->user->name }}</td>
                                        @endcan
                                        <td>{{ $transfer->balance_code }}</td>
                                        <td>{{ $transfer->line_number }}</td>
                                        <td>{{ $transfer->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
