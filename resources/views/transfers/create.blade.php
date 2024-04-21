<!-- resources/views/transfers/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div id="main" class="main">
        <div class="container">
            <h2>إضافة تحويل جديد</h2>
            <p>مرحبًا {{ auth()->user()->name }}</p> <!-- عرض اسم المستخدم -->
             <p> يرجى الانتظار 5 دقائق بعد ارسال الطلب من اجل معالجة الطلب من قبلنا , عليك ان تراقب الاشعارات وتحديث الصفحة ليصلك الرد.</p>
            <form method="POST" action="{{ route('transfers.store') }}">
                @csrf
                <div class="form-group">
                    <label for="balance_code">كود الرصيد:</label>
                    <input type="text" class="form-control" id="balance_code" name="balance_code">
                </div>
                <div class="form-group">
                    <label for="line_number">رقم الخط:</label>
                    <input type="text" class="form-control" id="line_number" name="line_number">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 10px">ارسال الطلب</button>
            </form>
        </div>
    </div>
@endsection
