@extends('layouts.app')

@section('content')
<main class="main" id="main">
    <div class="container mt-5">
        <h1 class="mb-4">تفاصيل الإشعار</h1>

        @if($notification)
            <div class="alert alert-info">
                <p>{{ $notification->data['message'] }}</p>
                <img src="{{ $notification->data['first_image'] }}" alt=""><h1>rgbfdfg</h1>
                        <img src="{{ $notification->data['second_image'] }}" alt=""><h1>rgbfdfg</h1>
                {{-- Search for the user based on user_id --}}
                @php
                $user = \App\Models\User::find($notification->data['user_id']);
                @endphp
                {{-- Display the user name --}}
                <p>اسم المستخدم: {{ $user ? $user->name : 'مستخدم غير متاح' }}</p>
                <small>{{ $notification->created_at->diffForHumans() }}</small>
            </div>

            <form action="{{ route('adminN.handle_activation', ['activation' => $notification->id]) }}" method="post" class="mt-4">
                @csrf

                <div class="form-group">
                    <label for="message">رسالة:</label>
                    <textarea class="form-control" name="message" id="message" rows="4" cols="50"></textarea>
                </div>

                <button type="submit" class="btn btn-success" name="accept">قبول</button>
                <button type="submit" class="btn btn-danger" name="reject">رفض</button>
            </form>

            <a href="{{ route('adminN.notifications') }}" class="btn btn-secondary mt-3">عودة إلى الإشعارات</a>
        @else
            <p class="alert alert-warning">الإشعار غير موجود.</p>
        @endif
    </div>
</main>
@endsection
