@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>معالجة طلب التفعيل</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <p>تفاصيل الطلب:</p>
            <p><strong>Activation ID:</strong> {{ $activationSim->id }}</p>
            <p><strong>User:</strong> {{ $activationSim->user->name }}</p>
            <!-- إضافة المزيد من التفاصيل حسب الحاجة -->

            <form action="{{ route('adminN.handle_activation', ['activation' => $activationSim->id]) }}" method="post" onsubmit="return confirm('هل أنت متأكد؟')">
                @csrf

                <label for="message">رسالة:</label>
                <textarea name="message" id="message" rows="4" cols="50"></textarea>

                {{-- إضافة طريقة الطلب --}}
                {{ method_field('post') }}

                <button type="submit" name="accept">قبول</button>
                <button type="submit" name="reject">رفض</button>
            </form>

            <a href="{{ route('adminN.show_notification_details', ['notificationId' => $notification->id]) }}">عرض تفاصيل الإشعار</a>
        </div>
    </div>
@endsection
