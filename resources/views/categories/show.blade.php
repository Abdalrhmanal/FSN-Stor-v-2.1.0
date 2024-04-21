@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Categories</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/categories')}}">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item"><span> الفئة </span></li>
                    <li class="breadcrumb-item active"><span> الكود </span></li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row align-items-top">
                <div class="col-lg-6">
                    @can('is-admin')
                        <div class="row">
                            <div class="col-1">
                                <form action="{{ route('categories.destroy',  $category->id)}}" method="post" id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger"
                                        onclick="confirmDelete('{{ route('categories.destroy', ['id' => $category->id]) }}')">
                                        حذف
                                    </button>
                                </form>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-1" style="margin-left: 10px">
                                <a href="{{ route('categories.edit ',  $category->id)}}" class="btn btn-outline-success"
                                    style="width: 90px;">تعديل</a>
                            </div>
                        </div>
                    @endcan

                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-7">
                                        <img src="{{ asset('images/' . $category->image) }}" class="w-100 rounded-start"
                                            style="width: 100%;height: 100%;padding: 10px; border-radius: 20px;"
                                            alt="{{ $category->type }}">
                                    </div>
                                    <div class="col-5">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $category->type }}</h5>
                                            <h6 class="card-text">{{ $category->price }} <i class="fa fa-turkish-lira"></i></h6>
                                            <a href="{{ route('codes.details ',  $category->id)}}"
                                                class="btn btn-outline-success">تفاصيل</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection

<script>
    function confirmDelete(url) {
        if (confirm('هل أنت متأكد من حذف الفئة؟')) {
            window.location.href = url;
        }
</script>
