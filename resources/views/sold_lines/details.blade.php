@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="container">
            <h1>تفاصيل مبيعات الخطوط</h1>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card-body pb-0">
                <h5 class="card-title">المبيعات <span>| للخطوط</span></h5>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">الصورة 1</th>
                                <th scope="col">الصورة 2</th>
                                <th scope="col">الرقم التسلسلي</th>
                                <th scope="col">السعر</th>
                                <th scope="col">التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#{{ $id }}</td>
                                <td>
                                    <img src="{{ asset($first_image) }}" class="zz" alt="First Image">
                                    <a href="{{ asset($first_image) }}" download="first_image.png">
                                        <i class="btn btn-outline-danger bi bi-file-earmark-arrow-down-fill"></i>
                                    </a>
                                </td>
                                <td>
                                    <img src="{{ asset($second_image) }}" class="zz" alt="Second Image">
                                    <a href="{{ asset($second_image) }}" download="first_image.png">
                                        <i class="btn btn-outline-danger bi bi-file-earmark-arrow-down-fill"></i>
                                    </a>
                                </td>
                                <td><a href="#" class="text-primary fw-bold">{{ $serial_number }}</a></td>
                                <td>{{ $price }}<i class="fa fa-turkish-lira"></i></td>
                                <td class="fw-bold">{{ $sale_date }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <style>
        .zz{
            width: 200px;
            height: 130px;
        }
    </style>
@endsection
