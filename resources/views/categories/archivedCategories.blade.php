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
            <h3><a href="{{url('/categories')}}">عرض الفئات</a></h3>
        </div>

        <section class="section">
            <div class="row align-items-top">
                @foreach ($archivedCategories as $category)
                    <div class="col-lg-6">
                        @can('is-admin')
                            <div class="row">
                                <div class="col-2">
                                    <form id="archiveForm{{ $category->id }}"
                                        action="{{ route('categories.archivecate', $category->id) }}" method="POST"
                                        style="display: inline; width: 100%;">
                                        @csrf
                                        <button type="button" class="btn btn-warning"
                                            onclick="confirmArchive('{{ $category->id }}')">
                                            <i class="bi bi-archive"></i> فك الأرشفة
                                        </button>
                                    </form>

                                </div>
                            </div>
                        @endcan

                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-7">
                                            <img src="{{ asset('images/' . $category->image) }}" class="w-100 rounded-start"
                                                style="width: 100%;height: 100%;padding: 10px;
                                            border-radius: 20px;"
                                                alt="{{ $category->type }}">
                                        </div>
                                        <div class="col-5">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $category->type }}</h5>
                                                <h6 class="card-text">{{ $category->price }} <i class="fa fa-turkish-lira"></i></h6>
                                                <a href="{{ url('/codes/category', $category->id) }}"
                                                    class="btn btn-outline-success">تفاصيل</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection

<script>
    function confirmArchive(categoryId) {
        var result = window.confirm('هل أنت متأكد من فك أرشفة الفئة؟');

        if (result) {
            document.getElementById('archiveForm' + categoryId).submit();
        }
    }
</script>
