@extends('layouts.app')

@section('content')
    <main class="main" id="main">
        <div class="container">
            <h1>الإشعارات</h1>

            <div class="unread-notifications">
                <h2>الإشعارات الغير مقروءة</h2>
                @foreach ($unreadNotifications as $index => $notification)
                    <div class="alert alert-info" data-notification-id="{{ $notification->id }}">
                        <h5>{{ $notification->data['message'] }}</h5>
                        <p>تاريخ الإشعار: {{ $notification->created_at->diffForHumans() }}</p>
                        <a href="{{ url('/') }}" class="details-link mark-as-read" data-notification-id="{{ $notification->id }}">
                            {{ $notification->read() ? 'تمت القراءة' : 'تمييز كمقروءة' }}
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="read-notifications">
                <h2>الإشعارات المقروءة</h2>
                @foreach ($readNotifications as $notification)
                    <div class="alert alert-secondary" data-notification-id="{{ $notification->id }}">
                        <h5>{{ $notification->data['message'] }}</h5>
                        <p>تاريخ الإشعار: {{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <script>
        // الحصول على جميع العناصر التي تحتوي على الكلاس mark-as-read
        var links = document.querySelectorAll('.mark-as-read');

        // تكرار العناصر وإضافة مستمع لحدث النقر على كل عنصر
        links.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // منع سلوك الافتراضي للرابط

                // الحصول على معرف الإشعار من البيانات المخصصة
                var notificationId = this.getAttribute('data-notification-id');

                // إرسال طلب POST لتحديث حالة الإشعار
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/mark-as-read/' + notificationId);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}'); // توكن CSRF
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // إعادة تحميل الصفحة بعد تحديث الإشعار
                        window.location.reload();
                    }
                };
                xhr.send(JSON.stringify({
                    _token: '{{ csrf_token() }}'
                }));
            });
        });
    </script>
@endsection
