@extends('layouts.app')

@section('content')
<main id="main" class="main">
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="/img/FSN.png" alt="">
                                <span class="d-none d-lg-block">الشهباء</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-4 border-primary">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class=" text-center pb-0 fs-4">اضافة أكواد</h5>
                                    <p class="text-center small"> قم برفع الملف الذي يحتوي على الاكواد التي ترغب باضافتها يجب ان يكون ملف نصي ولا يحتوي على فراغات </p>
                                </div>

                                @if(session('success'))
                                    <div class="alert alert-success" role="alert">
                                        تم ارسال البيانات الى قاعدة المعطيات بنجاح
                                    </div>
                                @else
                                    <h5 class="alert alert-success" role="alert">قم بادخال بيانات جديدة اذا كان هناك اي بيانات مكررة سيظهر خطأ .</h5>
                                @endif

                                <form action="{{ route('codes.store') }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div class="col-12">
                                        <label for="fileInput" class="form-label"> الملف</label>
                                        <div class="input-group">
                                            <input type="file" name="file" class="form-control" id="fileInput" accept=".txt" required style="height: 150px;">
                                            <label class="input-group-text" for="fileInput">
                                                <span class="d-none d-sm-inline">اسحب الملف الى هنا أو </span>اختر الملف
                                            </label>
                                        </div>
                                        <div class="invalid-feedback">من فضلك، قم بتحميل ملف المنتجات !</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="category_id" class="form-label">الفئة</label>
                                        <select class="form-select" id="category_id" name="category_id" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" name="price" value="0">
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">إرسال البيانات</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->
@endsection
