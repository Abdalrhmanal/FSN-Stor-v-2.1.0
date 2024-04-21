@extends('layouts.app')

@section('content')
    <main class="main" id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="my-4">إضافة عرض جديد</h1>
                    <form action="{{ route('offers.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان العرض</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">الصورة</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">وصف العرض</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="expiry_date" class="form-label">تاريخ انتهاء العرض</label>
                            <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
                        </div>

                        <button type="submit" class="btn btn-primary">إضافة العرض</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
