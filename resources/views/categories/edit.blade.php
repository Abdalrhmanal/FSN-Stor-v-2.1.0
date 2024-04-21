@extends('layouts.app')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>تعديل فئة</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/public/categories')}}">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="{{url('/public/categories')}}">فئات</a></li>
                <li class="breadcrumb-item active">تعديل</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3>تعديل فئة</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('categories/' . $category->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Add fields for updating the category -->
                            <div class="mb-3">
                                <label for="type" class="form-label">نوع الفئة</label>
                                <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $category->type) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">السعر</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $category->price) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">الصورة الحالية</label>
                                <img src="{{ asset('images/' . $category->image) }}" alt="Current Image" style="max-width: 200px;">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">تحديث الصورة</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
