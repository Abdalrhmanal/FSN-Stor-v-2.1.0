<!-- ملف المصادر: resources/views/balances/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="main" id="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('تحديث الرصيد') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('balances.update', $balance->id) }}">
                                @csrf
                                @method('PUT')

                                <!-- Field to update credit_balance -->
                                <div class="form-group row">
                                    <label for="credit_balance"
                                        class="col-md-4 col-form-label text-md-right">{{ __('رصيد الفعّال') }}</label>
                                    <div class="col-md-6">
                                        <?php
                                        use App\Models\Balance;

// جلب أحدث سجل في جدول الرصيد Balance بناءً على تاريخ الإضافة
$latestBalanceRecord = Balance::latest('created_at')->first();

if ($latestBalanceRecord) {
    // إذا تم العثور على سجل، استخراج قيمة الرصيد credit_balance
    $latestCreditBalance = $latestBalanceRecord->credit_balance;
} else {
    // في حالة عدم وجود سجلات، يتم تعيين القيمة الافتراضية إلى صفر أو أي قيمة تراها مناسبة
    $latestCreditBalance = 0;
}

                                        ?>
                                        <input id="credit_balance" type="number"
                                            class="form-control @error('credit_balance') is-invalid @enderror"
                                            name="credit_balance"
                                            value="{{ $latestCreditBalance }}"
                                            required autofocus>

                                        @error('credit_balance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Field to update debit_balance -->
                                <div class="form-group row">
                                    <label for="debit_balance"
                                        class="col-md-4 col-form-label text-md-right">{{ __('رصيد الدين') }}</label>
                                    <div class="col-md-6">
                                        <input id="debit_balance" type="number"
                                            class="form-control @error('debit_balance') is-invalid @enderror"
                                            name="debit_balance" value="{{ -old('debit_balance', $balance->debit_balance) }}"
                                            readonly>
                                        @error('debit_balance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('تحديث الرصيد') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
