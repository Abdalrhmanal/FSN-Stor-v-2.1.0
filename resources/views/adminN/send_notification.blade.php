@extends('layouts.app')

@section('content')
    <main class="main" id="main">
        <div class="container">
            <h1>تفاصيل الاشعار</h1>
            @if ($notification)
                <div class="alert alert-info">
                    <h5>{{ $notification->id }}</h5>

                    @if ($notification->type == 'App\Notifications\ActivationSimeAdd')
                        <h6>{{ $notification->data['message'] }}</h6>
                        <h6>{{ $notification->data['serial_number'] }}</h6>
                    @elseif ($notification->type == 'App\Notifications\NewTransfer')
                        <h6 id="copy-text">*123*{{ $notification->data['balance_code'] }}*{{ $notification->data['line_number'] }}#</h6>

                    @else
                        <h6>{{ $notification->data['message'] }}</h6>
                        <h6>{{ $notification->data['serial_number'] }}</h6>
                        <a class="btn btn-danger" href="{{url('/international_sims')}}"> تفاصيل الخط الدولي</a>
                    @endif

                    {{-- Search for the user based on user_id --}}
                    @php
                        $user = \App\Models\User::find($notification->data['user_id']);
                    @endphp

                    {{-- Display the user name --}}
                    <p>User Name: {{ $user ? $user->name : 'User not available' }}</p>

                    <small>{{ $notification->created_at->diffForHumans() }}</small>

                    {{-- Form for sending a new notification to the user --}}
                    @if ($user)
                        <form action="{{ route('admin.sendNotificationToUser', ['userId' => $user->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="message">رسالة الاشعار:</label>
                                <textarea name="message" id="message" class="form-control" required></textarea>
                            </div>
                            <div name="messagedetails" id="messagedetails" class="form-control" required>
                                {{ $notification->data['message'] }}
                            </div>
                            <button type="submit" class="btn btn-primary">ارسال اشعار للمستخدم</button>
                        </form>
                    @else
                        <p>User not found, cannot send notification.</p>
                    @endif
                    
                    <form action="{{ route('admin.rejectNotification', ['notificationId' => $notification->id]) }}"
                        method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger" name="reject">رفض الطلب</button>
                    </form>
                </div>
            @else
                <p>Notification not available.</p>
            @endif
        </div>
    </main>
    <script>
    document.getElementById('copy-text').addEventListener('click', function() {
        var textToCopy = this.innerText.trim();
        var tempInput = document.createElement('input');
        tempInput.value = textToCopy;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert('تم نسخ النص بنجاح: ' + textToCopy);
    });
</script>

@endsection
