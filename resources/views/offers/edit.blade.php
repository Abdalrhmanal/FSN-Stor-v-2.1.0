@extends('layouts.app')

@section('content')
    <main class="main" id="main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Main Content -->
                    <h1 class="my-4">تعديل العرض</h1>

                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset($offer->image) }}" class="img-fluid rounded-start" alt="Offer Image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('offers.update', $offer->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="title" class="form-label">عنوان العرض</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $offer->title) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">وصف العرض</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $offer->description) }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="expiry_date" class="form-label">تاريخ انتهاء العرض</label>
                                            <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ old('expiry_date', $offer->expiry_date) }}" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
