@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Contact</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{url('/dashboard')}}">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item">صفحة </li>
                    <li class="breadcrumb-item active">التواصل</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section contact">

            <div class="row gy-4">

                <div class="col-xl-6">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="info-box card">
                                <i class="bi bi-geo-alt"></i>
                                <h3>العنوان</h3>
                                <p>A108 Adam Street,<br>New York, NY 535022</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box card">
                                <i class="bi bi-telephone"></i>
                                <h3>رقم الهاتف</h3>
                                <p><a href="https://wa.me/+905072415450">+90 507 241 54 50</a><br><a
                                        href="https://wa.me/+963992819597">+963 992 819 597</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box card">
                                <i class="bi bi-envelope"></i>
                                <h3>الايميل الخاص بالشركة</h3>
                                <p>info@example.com<br>contact@example.com</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box card">
                                <i class="bi bi-clock"></i>
                                <h3>ساعات العمل</h3>
                                <p>السـبـت -  
                                الجـمـعـة   <br>  9 صباحاً حتى الــ 10 ليلاً</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-6">
                    <div class="card p-4">
                        <form action="forms/contact.php" method="post" class="php-email-form">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="اسمك الكامل"
                                        required>
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="ايميلك"
                                        required>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="الموضوع"
                                        required>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="الرسالة" required></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">تحميل</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">تم ارسال رسالتك. شكرًا لك!</div>

                                    <button type="submit">ارسال الرسالة</button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </section>

    </main><!-- End #main -->
@endsection
