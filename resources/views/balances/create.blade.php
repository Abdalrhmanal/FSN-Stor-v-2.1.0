@extends('layouts.app') <!-- قد تحتاج إلى تعديلها وفقًا لتخطيط التطبيق الخاص بك -->

@section('content')
    <main id="main" class="main">
        <div class="container card" style="padding: 20px">
            <h2> اضافة رصيد فعال للمستخدم </h2>
                
            <form action="{{ route('balances.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="user_id">اختر المستخدم:</label>
                    <select name="user_id" class="form-control" required>
                        @foreach ($users as $user)
                        <?php $adminUser = \App\Models\User::where('role_id', 1)->first(); ?>
                            @if ($user->id !=$adminUser->id)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="balance_type">اختر نوع الرصيد:</label>
                    <select name="balance_type" class="form-control">
                        <option value="credit_balance">رصيد فعال</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">المبلغ:</label>
                    <input type="number" name="amount" class="form-control" min="0.01" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary">حفظ</button>
            </form>
        </div>
        <div class="container card" style="padding: 20px">
            <h2>إضافة رصيد دين للمستخدم</h2>

            <form action="{{ route('balances.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="user_id">اختر المستخدم:</label>
                    <select name="user_id" class="form-control" required>
                        @foreach ($users as $user)
                        <?php $adminUser = \App\Models\User::where('role_id', 1)->first(); ?>
                            @if ($user->id !=$adminUser->id)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="balance_type">اختر نوع الرصيد:</label>
                    <select name="balance_type" class="form-control">
                        <option value="debit_balance">رصيد دين</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">المبلغ:</label>
                    <input type="number" name="amount" class="form-control" min="0.01" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary">حفظ</button>
            </form>
        </div> 
        <div class="container card" style="padding: 20px">
            <h2>إضافة ايفاء دين للمستخدم</h2>

            <form action="{{ route('balances.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="user_id">اختر المستخدم:</label>
                    <select name="user_id" class="form-control" required>
                        @foreach ($users as $user)
                        <?php $adminUser = \App\Models\User::where('role_id', 1)->first(); ?>
                            @if ($user->id !=$adminUser->id)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="balance_type">اختر نوع الرصيد:</label>
                    <select name="balance_type" class="form-control">
                        <option value="debit_repayment">ايفاء دين</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">المبلغ:</label>
                    <input type="number" name="amount" class="form-control" min="0.01" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary">حفظ</button>
            </form>
        </div>
    </main>
@endsection

