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
                            <h6>فلترة</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">تفعيلات</a></li>

                    </ul>
                </div>

                <div class="card-body">
                    <h5 class="card-title">سجل <span>| تفعيل دولي</span></h5>
                     <a class="btn btn-danger" href="{{url('/admin/notifications/')}}">رجوع </a>
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>الصورة الاولى </center>
                                </th>
                                <th scope="col">
                                    <center>الصورة الثانية </center>
                                </th>
                                <th scope="col">
                                    <center>الرقم التسلسلي </center>
                                </th>
                                <th scope="col">
                                    <center>السعر</center>
                                </th>
                                <th scope="col">
                                    <center>التاريخ</center>
                                </th>
                                <th scope="col">
                                    <center>ادارة</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td><img src="{{ asset($activation->first_image) }}" alt="First Image"
                                            width="50"></td>
                                    <td><img src="{{ asset($activation->second_image) }}" alt="Second Image"
                                            width="50"></td>

                                    <td>
                                        <center>{{ $activation->serial_number }}</center>
                                    </td>
                                    <td>
                                        <center><i class="fa fa-turkish-lira"></i> {{ $activation->price }}</center>
                                    </td>
                                    <td>
                                        <center> {{ $activation->created_at }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            <form action="{{ route('activations.destroy', $activation->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                        </center>
                                        </form>
                                    </td>
                                </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Recent Sales -->

    </main>
@endsection
