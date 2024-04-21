@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="container">
            <h1 class="mb-4">بيع خط</h1>

            {{-- عرض أي رسائل تحذير أو نجاح --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('sold_lines.store', $simCard->serial_number) }}" method="post"
                enctype="multipart/form-data">
                @csrf

                {{-- حقل رقم التسلسل --}}
                <div class="mb-3">
                    <label for="serial_number" class="form-label">الرقم التسلسلي </label>
                    <input type="text" class="form-control" id="serial_number" name="serial_number"
                        value="{{ $simCard->serial_number }}" readonly>
                </div>
                {{-- حقل الصورة الأولى --}}
                <div class="mb-3">
                    <label for="first_image" class="form-label"> الصورة الاولى</label>
                    <input type="file" class="form-control" id="first_image" name="first_image" accept="image/*"
                        required>
                    <div class="invalid-feedback">يرجى تحديد ملف بامتداد الصورة المناسب.</div>
                </div>

                {{-- حقل الصورة الثانية --}}
                <div class="mb-3">
                    <label for="second_image" class="form-label">الصورة الثانية</label>
                    <input type="file" class="form-control" id="second_image" name="second_image" accept="image/*"
                        required>
                    <div class="invalid-feedback">يرجى تحديد ملف بامتداد الصورة المناسب.</div>
                </div>


                {{-- زر البيع --}}
                <button type="submit" class="btn btn-primary">بيع</button>
            </form>
        </div>
    </main>
@endsection
