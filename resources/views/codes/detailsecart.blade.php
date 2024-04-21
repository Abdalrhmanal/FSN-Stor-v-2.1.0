<!-- resources/views/codes/details.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>تفاصيل الكود</h2>
        <div>
            <p><strong>نوع الكود:</strong> {{ $code->category->type }}</p>
            <p><strong>رقم الكود:</strong> {{ $code->code }}</p>
            <p><strong>السعر:</strong> {{ $code->category->price }}$</p>
        </div>
        <div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div>
            <a href="{{ route('addToCart', ['codeId' => $code->id]) }}" class="btn btn-primary">إضافة إلى السلة</a>
        </div>
    </div>
@endsection
