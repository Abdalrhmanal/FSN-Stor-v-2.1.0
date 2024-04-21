<!-- ملف resources/views/activate_sims/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="main" id="main">
        <div class="container">
            <h2>إضافة تفعيل سيم جديد</h2>
            <p>مرحبًا {{ auth()->user()->name }}</p> <!-- عرض اسم المستخدم -->
             <p> يرجى الانتظار 5 دقائق بعد ارسال الطلب من اجل معالجة الطلب من قبلنا , عليك ان تراقب الاشعارات ليصلك الرد.</p>
            <form action="{{ route('activate_sim.store') }}" method="POST"> <!-- تصحيح الاسم هنا -->
                @csrf

                <div class="form-group">
                    <label for="serial_number">الرقم التسلسلي:</label>
                    <input type="text" name="serial_number" class="form-control" required>
                </div>

                <div class="form-group">

                    <label for="price">السعر:</label>
                    <input type="number" name="price" class="form-control" value="0"  readonly>
                    <p style="color: red">هذه الخدمة مجانية في الوقت الحالي</p>
                </div>


                {{-- يمكنك إضافة حقول إضافية هنا حسب احتياجاتك --}}

                <button type="submit" class="btn btn-primary" style="margin-top: 10px">ارسال البيانات</button>
            </form>
        </div>
    </div>
@endsection
