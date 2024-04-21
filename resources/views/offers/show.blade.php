@extends('layouts.app')

@section('content')
<main class="main" id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $offer->title }}
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $offer->description }}</p>
                        <p class="card-text">تاريخ انتهاء العرض: {{ $offer->expiration_date }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('offers.index') }}" class="btn btn-primary">عودة إلى القائمة</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
