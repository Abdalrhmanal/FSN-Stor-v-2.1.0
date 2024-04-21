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
                    <h5 class="card-title">تفعيلات السيم</h5>

                    @if ($activationSims)
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col"><center>#</center></th>
                                    <th scope="col">
                                        <center>الرقم التسلسلي </center>
                                    </th>
                                    <th scope="col">
                                        <center>السعر</center>
                                    </th>
                                    @can('is-admin')
                                        <th scope="col">
                                            <center>المندوب</center>
                                        </th>
                                    @endcan
                                    <th scope="col">
                                        <center>التاريخ</center>
                                    </th>
                                    <th scope="col">
                                        <center>الإجراءات</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activationSims as $index => $activationSim)
                                    <tr>
                                        <td>
                                            <center>{{ $index + 1 }}</center>
                                        </td>
                                        <td>
                                            <center>{{ $activationSim->serial_number }}</center>
                                        </td>
                                        <td>
                                            <center> <i class="fa fa-turkish-lira"></i> {{ $activationSim->price }}</center>
                                        </td>
                                        @can('is-admin')
                                            <td>
                                                <center>{{ $activationSim->user->name }}</center>
                                            </td>
                                        @endcan
                                        <td>
                                            <center> {{ $activationSim->created_at }}</center>
                                        </td>
                                        <td>
                                            <center>
                                                <form action="{{ route('activate_sim.destroy', $activationSim->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">حذف</button>
                                                </form>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>لا توجد تفعيلات سيم حاليًا.</p>
                    @endif
                </div>

            </div>
        </div><!-- End Recent Sales -->
    </main>
@endsection
