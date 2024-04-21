@extends('layouts.app')

@section('content')
    <main class="main" id="main">
        <div class="container">
            <h1>الإشعارات الغير مقروءة</h1>
            @foreach ($unreadNotifications as $index => $notification)
                <div class="alert alert-info">
                    <h5>{{ $index + 1 }}</h5>
                    <p>{{ $notification->data['message'] }}</p>

                    {{-- Search for the user based on user_id --}}
                    @php
                        $user = \App\Models\User::find($notification->data['user_id']);
                    @endphp

                    {{-- Display the user name --}}
                    <p>اسم المستخدم: {{ $user ? $user->name : 'غير متوفر' }}</p>

                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                    <a href="{{ route('admin.showNotificationDetailsAndSend', ['notificationId' => $notification->id]) }}"
                        class="details-link">
                        {{ $notification->read() ? 'تمت القراءة' : 'عرض التفاصيل وإرسال إشعار جديد' }}
                    </a>
                </div>
            @endforeach


            <h1>الإشعارات المقروءة</h1>
            @foreach ($readNotifications as $index => $notification)
                <div class="alert alert-secondary">
                    <h5>{{ $index + 1 }}</h5>
                    <p>{{ $notification->data['message'] }}</p>

                    {{-- Search for the user based on user_id --}}
                    @php
                        $user = \App\Models\User::find($notification->data['user_id']);
                    @endphp

                    {{-- Display the user name --}}
                    <p>اسم المستخدم: {{ $user ? $user->name : 'مستخدم غير متاح' }}</p>

                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                 <!--   <a href="{{ route('admin.showNotificationDetailsAndSend', ['notificationId' => $notification->id]) }}"
                        class="details-link">
                        تمت القراءة
                    </a> -->
                </div>
            @endforeach
        </div>
    </main>
@endsection
