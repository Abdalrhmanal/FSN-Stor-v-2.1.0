@extends('layouts.app')

@section('content')
    <div class="main" id="main">
        <div class="container">
            <h2>إضافة تفعيل سيم دولية جديدة</h2>
            <p>مرحبًا {{ auth()->user()->name }}</p> <!-- عرض اسم المستخدم -->
             <p> يرجى الانتظار 5 دقائق بعد ارسال الطلب من اجل معالجة الطلب من قبلنا , عليك ان تراقب الاشعارات ليصلك الرد.</p>
            <form action="{{ route('activations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="first_image">الصورة الأولى:</label>
                    <input type="file" name="first_image" class="form-control" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="second_image">الصورة الثانية:</label>
                    <input type="file" name="second_image" class="form-control" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="serial_number">الرقم التسلسلي:</label>
                    <input type="text" name="serial_number" class="form-control" required>
                </div>

                <div class="form-group">

                    <label for="price">السعر:</label>
                    <input type="number" name="price" class="form-control" value="170" readonly>
                </div>


                <button type="submit" class="btn btn-primary" style="margin-top: 10px">ارسال البيانات</button>
            </form>
        </div>
    </div>
@endsection
