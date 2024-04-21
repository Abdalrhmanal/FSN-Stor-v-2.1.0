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

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>#</center>
                                </th>
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
                                @can('is-admin')
                                    <th scope="col">
                                        <center>المندوب</center>
                                    </th>
                                @endcan
                                <th scope="col">
                                    <center>ادارة</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($internationalSims as $index => $internationalSim)
                                <tr>
                                    <td>
                                        <center>{{ $index + 1 }}</center>
                                    </td>


                                    <td>
                                        <img src="{{ asset($internationalSim->first_image) }}" alt="First Image"
                                            width="50">
                                        <a href="{{ asset($internationalSim->first_image) }}" download="first_image.png">
                                            <i class="btn btn-outline-danger bi bi-file-earmark-arrow-down-fill"></i>
                                        </a>
                                    </td>
                                    <td><img src="{{ asset($internationalSim->second_image) }}" alt="Second Image"
                                            width="50">
                                        <a href="{{ asset($internationalSim->second_image) }}" download="second_image.png">
                                        <i class="btn btn-outline-danger bi bi-file-earmark-arrow-down-fill"></i>
                                    </a>
                                    </td>

                                    <td>
                                        <center>{{ $internationalSim->serial_number }}</center>
                                    </td>
                                    <td>
                                        <center><i class="fa fa-turkish-lira"></i> {{ $internationalSim->price }}</center>
                                    </td>
                                    <td>
                                        <center> {{ $internationalSim->created_at }}</center>
                                    </td>
                                    @can('is-admin')
                                        <td>
                                            <center>{{ $internationalSim->user->name }}</center>
                                        </td>
                                    @endcan
                                    <td>
                                        <center>
                                            <form action="{{ route('activations.destroy', $internationalSim->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                        </center>
                                        </form>
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
