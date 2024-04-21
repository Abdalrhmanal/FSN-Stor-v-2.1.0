@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Categories</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/categories')}}">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item"><span>/ الفئة </span></li>
                    <li><span> الكود </span></li>
                </ol>
            </nav>
            @can('is-admin')
                <h3><a href="{{route('categories.archivedCategories')}}">الأرشيف</a></h3>
            @endcan
        </div>
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
                    <h5 class="card-title"><span> الفئات | المتوفرة</span></h5>
                    <div class="table-responsive">
                        <table class="table table-borderless datatable text-light">
                            <thead>
                                <tr>
                                    <th scope="col">الصورة </th>
                                    <th scope="col">الفئة </th>
                                    <th scope="col">السعر</th>
                                    <th scope="col">تفاصيل</th>
                                    @can('is-admin')
                                        <th scope="col">ادارة</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $index => $category)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('images/' . $category->image) }}" class="img-fluid rounded-start" 
                                                    style="width: 100%; height: auto; object-fit: cover; max-width: 120px; max-height: 120px;"
                                                    alt="{{ $category->type }}">
                                        </td>
                                        <td><a href="#" class="text-primary">{{ $category->type }}</a></td>
                                        <td> </span>{{ $category->price }} <span><i class="fa fa-turkish-lira"></i></td>
                                        <td><span><a href="{{ url('/codes/category', $category->id) }}" class="btn btn-outline-success">تفاصيل</a></span></td>
                                        <td>
                                            @can('is-admin')
                            <div class="row">
    <div class="col-2">
        <form id="archiveForm{{ $category->id }}" action="{{ route('categories.archive', $category->id) }}" method="POST" style="display: inline; width: 100%;">
            @csrf
            <button type="button" class="btn btn-warning custom-btn" onclick="confirmArchive('{{ $category->id }}')">
                <i class="bi bi-archive"></i> 
            </button>
        </form>
    </div>
    <div class="col-2"></div>
    <div class="col-2">
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-outline-success custom-btn">
            <i class="bi bi-pencil-square"></i> 
        </a>
    </div>
</div>

                        @endcan
                                        </td>
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

<script>
    function confirmArchive(categoryId) {
        var result = window.confirm('هل أنت متأكد من أرشفة الفئة؟');

        if (result) {
            document.getElementById('archiveForm' + categoryId).submit();
        }
    }
</script>
