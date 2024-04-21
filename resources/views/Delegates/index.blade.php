@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>{{ __('فلترة') }}</h6>
                        </li>
                        <li><a class="dropdown-item" href="#">{{ __('كل المندوبين') }}</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ __('المندوبين') }} <span>| {{ __('سجل') }}</span></h5>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr style="margin-left: 15px">
                                <th scope="col">#</th>
                                <th scope="col">{{ __('المندوب') }}</th>
                                <th scope="col">{{ __('الايميل') }}</th>
                                <th scope="col">{{ __('الرصيد') }}</th>
                                <th scope="col">{{ __('تعديل الرصيد') }}</th>
                                <th scope="col">{{ __('حالة الحساب') }}</th>
                                <th scope="col">{{ __('ادارة') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <?php $adminUser = \App\Models\User::where('role_id', 1)->first(); ?>
                                @if ($user->id != $adminUser->id)
                                    <tr>
                                        <th scope="row"><a href="#">{{ $user->id }}</a></th>
                                        <td>{{ $user->name }}</td>
                                        <td><a href="{{ route('users.showEditPasswordFormAdmin', $user->id) }}" class="text-primary">{{ $user->email }}</a></td>
                                        <td>
                                            @if ($user->balance)
                                                <a href="{{ route('balances.show', $user->id) }}"> <i class="fa fa-turkish-lira"></i>
                                                    عرض الرصيد</a>
                                            @else
                                                {{ __('لا يوجد رصيد لعرضه') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->balance)
                                                <a href="{{ route('balances.edit', $user->id) }}">{{ __('تعديل') }}</a>
                                            @else
                                                {{ __('لا يوجد رصيد لتعديله') }}
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $user->is_active ? __('نشط') : __('متوقف') }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST"
                                                onsubmit="return confirmStatusChange(event, {{ $user->is_active }})">
                                                @csrf
                                                @method('POST')
                                                <button type="submit">
                                                    <i class="bi bi-power" style="margin-left: 30px;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        function confirmStatusChange(event, isActive) {
            if (!confirm(isActive ? '{{ __('The account will be deactivated. Are you sure?') }}' :
                    '{{ __('The account will be reactivated. Are you sure?') }}')) {
                event.preventDefault();
            }
        }
    </script>
@endsection
