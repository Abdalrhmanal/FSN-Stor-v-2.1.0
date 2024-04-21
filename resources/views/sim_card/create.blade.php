@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">إضافة أرقام تسلسلية</div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('sim_cards1.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="user_id" class="form-label">اختر المستخدم</label>
                                    <select class="form-select" id="user_id" name="user_id" required>
                                        @foreach ($users as $user)
                                            <?php $adminUser = \App\Models\User::where('role_id', 1)->first(); ?>
                                            @if ($user->id != $adminUser->id)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">سعر الرقم التسلسلي</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>

                                <div class="mb-3">
                                    <label for="file" class="form-label">اختر ملف الأرقام التسلسلية</label>
                                    <input type="file" class="form-control" id="file" name="file" accept=".txt"
                                        required>
                                </div>

                                <button type="submit" class="btn btn-primary">إرسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
