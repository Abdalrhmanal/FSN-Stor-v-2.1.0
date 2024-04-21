@extends('layouts.app')

@section('content')
    <main class="main" id="main">
        <center>
            <h1>خطأ في قاعدة البيانات </h1>
            <p style="color: red">هناك بيانات مكررة يرجى ادخال اكواد جديدة  </p>
            <a href="{{url('/dashboard')}}">الرجوع الى صفحة التحكم</a>
        </center>
    </main>
@endsection
