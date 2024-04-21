<header id="header" class="header fixed-top  align-items-center" style="background-color: #1484c4;">
    <div class="container-fluid">
        <div class="row " style="margin-top: 7px;">
            <div class="col-4">
                <nav class="header-nav ms-auto">
                    <ul class="d-flex align-items-center">

                        <li class="nav-item dropdown pe-3">

                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                                data-bs-toggle="dropdown">
                                @auth
                                    @if (Auth::user()->role_id == 1)
                                        @can('is-admin')
                                            <img src="{{ asset('/img/FSNL.png') }}" alt="{{ __('Profile') }}"
                                                class="rounded-circle">
                                        @endcan
                                    @elseif(Auth::user()->role_id == 2)
                                        <img src="{{ asset('/img/picture.jpg') }}" alt="{{ __('Profile') }}"
                                            class="rounded-circle">
                                    @endif
                                    <h5 class="d-none d-md-block dropdown-toggle ps-2" style="color: white;">{{ Auth::user()->name }}</h5>
                                @endauth
                            </a><!-- End Profile Image Icon -->

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                <li class="dropdown-header">
                                    @auth
                                        <h6>{{ Auth::user()->name }}</h6>
                                        <span>({{ Auth::user()->role->name ?? 'Default Role' }})</span>
                                    @endauth
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{url('/profiles')}}">
                                        <i class="bi bi-person"></i>
                                        <span>{{ __('ملفي الشخصي') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{url('/profiles')}}">
                                        <i class="bi bi-gear"></i>
                                        <span>{{ __('اعدادات الحساب') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/Contact') }}">
                                        <i class="bi bi-question-circle"></i>
                                        <span>{{ __('مساعدة') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="dropdown-item d-flex align-items-center">
                                            <i class="bi bi-box-arrow-right"></i>
                                            <span>{{ __('تسجيل الخروج') }}</span>
                                        </a>
                                    </form>
                                </li>

                            </ul><!-- End Profile Dropdown Items -->
                        </li><!-- End Profile Nav -->

                        <li class="nav-item dropdown">

                            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-bell text-white"></i>
                                <span class=" badge-number">
                                    @if ($totalNotifications > 0)
                                        <div class="spinner-grow text-warning"
                                            style="width: 10px;height: 10px;margin-bottom: 20px" role="status">
                                            <div>
                                                <span class="badge-numbe">
                                                    <h6 style="color: black;">
                                                        {{ $totalNotifications }}
                                                    </h6>
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                            </a><!-- End Notification Icon -->

<ul class="dropdown-menu "  style="max-height: 300px; overflow-y: auto; width: 200px;margin-left: 00px;">
    <li class="dropdown-header">
        @if ($totalNotifications == 0)
            {{ __('الاشعارات') }}
        @endif
        @auth
            @if (Auth::user()->role_id == 1)
                <a href="{{ route('admin.getAllNotifications') }}">
                    <span class="badge rounded-pill bg-primary p-2 ms-2">{{ __('عرض الكل') }}</span>
                </a>
            @elseif (Auth::user()->role_id == 2)
                <a href="{{ route('user.notifications') }}">
                    <span class="badge rounded-pill bg-primary p-2 ms-2">{{ __('عرض الكل') }}</span>
                </a>
            @endif
        @endauth
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>

    @if (Auth::user()->role_id == 1 && isset($unreadNotifications) && count($unreadNotifications) > 0)
        @foreach ($unreadNotifications as $index => $notification)
            <li class="notification-item">
                <div class="alert alert-info col-12">
                    <h5>{{ $index + 1 }}</h5>
                    <small>{{ $notification->data['message'] }}</small>

                    @php
                        $user = \App\Models\User::find($notification->data['user_id']);
                    @endphp

                    {{-- Display the user name --}}
                    <small>اسم المستخدم: {{ $user ? $user->name : 'غير متوفر' }}</small>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                    <br><a href="{{ route('admin.getAllNotifications') }}">
                        <span> تفاصيل الاشعار </span>
                    </a>
                </div>
            </li>
        @endforeach
    @endif

    @if (Auth::user()->role_id == 2 && isset($unreadNotifications) && $unreadNotifications->count() > 0)
        @foreach ($unreadNotifications as $index => $notification)
            <li class="notification-item">
                <div class="alert alert-info col-12">
                    <small>{{ $notification->data['message'] }}</small>
                    <small>تاريخ الإشعار: {{ $notification->created_at->diffForHumans() }}</small>
                    <a href="{{ url('user/notifications') }}" class="details-link mark-as-read">
                        {{ $notification->read() ? 'تمت القراءة' : 'تفاصيل' }}
                    </a>
                </div>
            </li>
        @endforeach
    @endif
    <li>
        <hr class="dropdown-divider">
    </li>
</ul>


                        </li><!-- End Notification Nav -->
                    </ul>
                </nav><!-- End Icons Navigation -->
            </div>
            <div class="col-4"><h3 class="xy" style="color: white;"><center><b>شركة الشهباء للاتصالات</b></center></hr> </div>
            <div class="col-1"></div>
            <div class="col-3">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="col-4" style="justify-content:end;margin-right: 17px">
                            <i class="bi bi-list toggle-sidebar-btn text-white"></i>
                        </div>
                        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                            <img src="{{ asset('/img/FSNL.png') }}" style="width: 50px;height: 60px;margin: 10px"
                                alt="">
                            <span class="d-none d-lg-block" style="font-family: 'Cairo', sans-serif ;color: white; ">{{ __('الشهباء') }}</span>
                        </a>
                    </div><!-- End Logo -->
                </div>
            </div>
        </div>
    </div>
</header><!-- End Header -->
<script>
    function fetchAndUpdateNotifications() {
        fetch("{{ route('layouts.navigation') }}")
            .then(response => response.json())
            .then(data => {
                // Update your notifications here
                updateNotificationContent(data.unreadNotifications);
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
            });
    }

    function updateNotificationContent(unreadNotifications) {
        const notificationsContainer = document.getElementById('unread-notifications');

        // Clear existing content
        notificationsContainer.innerHTML = '';

        if (unreadNotifications.length > 0) {
            unreadNotifications.forEach((notification, index) => {
                const notificationItem = document.createElement('div');
                notificationItem.className = 'notification-item';
                notificationItem.innerHTML = `
                    <div class="alert alert-info col-12" role="alert">
                        <!-- ... (Other notification content) ... -->
                        <a href="{{ url('admin/notifications') }}/${notification.id}/send-new-notification"
                            class="details-link">
                            ${notification.read ? 'تمت القراءة' : 'عرض التفاصيل وإرسال إشعار جديد'}
                        </a>
                    </div>`;

                notificationsContainer.appendChild(notificationItem);
            });
        } else {
            // If there are no notifications, you can display a message or handle it as needed
            notificationsContainer.innerHTML = '<p>No new notifications.</p>';
        }
    }

    setInterval(fetchAndUpdateNotifications, 10000);
</script>


<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar ">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ url('/dashboard') }}">
                <span class="ms-auto">لوحة التحكم</span>
                <i class="bi bi-grid " style="margin-left: 10px"></i>

            </a>
        </li><!-- End Dashboard Nav -->
        @can('is-admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-chevron-down"></i><span class="ms-auto">المندوبين</span><i class="bi bi-menu-button-wide " style="margin-left: 10px"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('users.index') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span>عرض المندوبين</span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/register') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span>اضافة مندوب</span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-chevron-down "></i><span class="ms-auto">الاكواد</span><i class="bi bi-cart4 "style="margin-left: 10px"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                @can('is-admin')
                    <li>
                        <a href="{{ route('categories.create') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span> اضافة فئة </span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span> عرض الفئات </span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('codes.create') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span> اضافة أكواد </span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                @endcan
                @if (Auth::user()->role_id == 2)
                    <li>
                        <a href="{{ route('categories.index') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span>شراء اكواد </span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transfers.create') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span> تحويل رصيد عن بعد </span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('offers.index') }}">
                        <div class="ms-auto" style="margin-right: 30px">
                            <span> العروض المتوفرة</span><i class="bi bi-circle" style="margin-left: 10px"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-chevron-down "></i><span class=" ms-auto">الخطوط</span>
                <i class="bi bi-layout-text-window-reverse" style="margin-left: 10px"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                @can('is-admin')
                    <li>
                        <a href="{{ route('sim_card1.create') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span> أضافة خطوط لمندوب </span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                @endcan
                <li>
                    @if (Auth::user()->role_id == 2)
                        <a href="{{ route('sim_cards.index') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span>عرض الخطوط </span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                <li>
                    <a href="{{ route('activate_sim.create') }}">
                        <div class="ms-auto" style="margin-right: 30px">
                            <span>اعادة تفعيل خط</span><i class="bi bi-circle" style="margin-left: 10px"></i>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('activations.create') }}">
                        <div class="ms-auto" style="margin-right: 30px">
                            <span>تفعيل خط دولي</span><i class="bi bi-circle" style="margin-left: 10px"></i>
                        </div>
                    </a>
                </li>
                @endif
            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-chevron-down "></i><span class="ms-auto">المبيعات</span><i class="bi bi-bar-chart " style="margin-left: 10px"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                @if (Auth::user()->role_id == 2)
                    <li>
                        <a href="{{ route('code_management.index') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span> سجل مبيعات الاكواد</span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transfers.indexuser') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span> سجل تحويل رصيد عن بعد </span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                @endif

                @can('is-admin')
                    <li>
                        <a href="{{ route('code_management.user_sold_codes') }}">
                            <div class="ms-auto" style="margin-right: 30px;">
                                <span> سجل مبيعات الاكواد</span><i class="bi bi-circle"
                                    style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transfers.index') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span> سجل تحويل رصيد عن بعد </span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                    @endif


                    <li>
                        <a href="{{ route('sold_lines.index') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span> سجل الخطوط المباعة</span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('activate_sims.index') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span>سجل اعادة تفعيل خط</span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('activations.index') }}">
                            <div class="ms-auto" style="margin-right: 30px">
                                <span>سجل تفعيل خط دولي</span><i class="bi bi-circle" style="margin-left: 10px"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </li><!-- End Charts Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-chevron-down "></i> <span class="ms-auto">الرصيد</span><i class="bi bi-gem "style="margin-left: 10px"></i>
                </a>
                <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @if (Auth::user()->role_id == 2)
                        @php
                            $userid = Auth::user()->id;
                        @endphp

                        <li>
                            <a href="{{ route('balances.show', ['userId' => $userid]) }}">
                                <div class="ms-auto" style="margin-right: 30px">
                                    <span>عرض الرصيد </span> <i class="bi bi-circle" style="margin-left: 10px"></i>
                                </div>
                            </a>
                        </li>

                    @endif

                    @can('is-admin')
                        <li>
                            <a href="{{ route('balances.create') }}">
                                <div class="ms-auto" style="margin-right: 30px">
                                    <span> اضافة رصيد </span><i class="bi bi-circle" style="margin-left: 10px"></i>
                                </div>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li><!-- End Icons Nav -->

            <center>
                <li
                     style="font-size: 11px;
                            text-transform: uppercase;
                            color: #899bbd;
                            font-weight: 600;">
                    صفحات</li>
            </center>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/profiles') }}">
                    <span class="ms-auto">الملف الشخصي</span><i class="bi bi-person " style="margin-left: 10px"></i>

                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/Contact') }}">
                    <span class="ms-auto">التواصل</span>
                    <i class="bi bi-envelope " style="margin-left: 10px"></i>
                </a>
            </li><!-- End Contact Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/profiles') }}">
                    <span class="ms-auto">الاعدادات</span>
                    <i class="bi bi-gear " style="margin-left: 10px"></i>
                </a>
            </li><!-- End Blank Page Nav -->
            <li class="nav-item">
                @auth
                    @if (Auth::user()->role_id == 1)
                        <a class="nav-link nav-icon" href="{{ route('admin.getAllNotifications') }}">
                        @elseif (Auth::user()->role_id == 2)
                            <a class="nav-link nav-icon" href="{{ route('user.notifications') }}">
                    @endif
                @endauth
                <span class="ms-auto">الاشعارات</span>
                <i class="bi bi-bell " style="margin-left: 10px"></i>
                </a><!-- End Notification Icon -->
            </li><!-- End Blank Page Nav -->
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" >
                    @csrf
                <a class="nav-link collapsed" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <span class="ms-auto">تسجيل الخروج</span>
                    <i class="bi bi-box-arrow-right" style="margin-left: 10px"></i>
                </a>
            </form>
            </li><!-- End Blank Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->
<style>
    @media (max-width: 768px) {
  /* إخفاء العنوان عندما يكون عرض الشاشة أصغر من 768 بكسل */
  .xy {
    display: none;
  }
}

</style>
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
