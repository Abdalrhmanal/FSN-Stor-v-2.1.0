
<!-- resources/views/categories/create.blade.php -->

@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="container">
            <h1>اضافة فئة جديدة</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image" class="col-form-label">الصورة :</label>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input form-image" id="image" accept="image/*" required>
                        <label class="custom-file-label" for="image">اختر صورة</label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="type" class="form-label">النوع</label>
                    <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">السعر</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">انشاء فئة</button>
            </form>
        </div>
    </main>
@endsection
