<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SH-FSN</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <!-- Favicons -->
    <link href="{{ asset('img/FSN.png') }}" rel="icon">
    <link href="{{ asset('img/FSN.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    
</head>


<style>
    @media (max-width: 768px) {
    #hero .carousel-container {
        height: 50vh;
    }

    #hero h2 {
        font-size: 28px;
    }
}

    </style>
<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h1><a href="/"> <img src="{{ asset('img/FSNL.png') }}" alt=""
                            style="width: 75px;height: 75px;"> SH-FSN</a></h1>
            </div>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->


            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero"><p>الصفحة الرئيسية</p> </a></li>
                    <li><a class="nav-link scrollto" href="#about"><p>عن الشركة</p></a></li>
                    <li><a class="nav-link scrollto" href="#services"><p>خدماتنا</p></a></li>
                    <li><a class="nav-link scrollto" href="#cta"><p>انضم الينا </p>   </a></li>
                    <li><a class="nav-link scrollto" href="#offers"><p>عروضنا</p></a></li>
                    <li><a class="nav-link scrollto" href="#contact"><p>تواصل معنا</p> </a></li>
                    <li>
                        @if (Route::has('login'))
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                @auth
                                    <a href="{{ url('/dashboard') }}" a class="nav-link scrollto"
                                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"><p>لوحة التحكم</p></a>
                                @else
                                    <a href="{{ route('login') }}" a class="nav-link scrollto"
                                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                        <p>تسجيل الدخول</p>
                                        </a>
                                @endauth
                            </div>
                        @endif
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex flex-column justify-content-end align-items-center" style="margin-top: 00px">
        <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade"
                                    data-bs-ride="carousel">
                                    <!-- Slide 1 -->
                                    <div class="carousel-item active">
                                        <div class="carousel-container"
                                            style="background-image: url('assets/img/1.jpg'); margin-top: 55px; border-radius: 30px; background-repeat: no-repeat; background-size: 100% 100%;">
                                           
                                        </div>
                                    </div>

                                    <!-- Slide 2 -->
                                    <div class="carousel-item">
                                        <div class="carousel-container"
                                            style="background-image: url('assets/img/2.jpg'); margin-top: 55px; border-radius: 30px; background-repeat: no-repeat; background-size: 100% 100%;">
                                            
                                        </div>
                                    </div>

                                    <!-- Slide 3 -->
                                    <div class="carousel-item">
                                        <div class="carousel-container"
                                            style="background-image: url('assets/img/3.jpg'); margin-top: 55px; border-radius: 30px; background-repeat: no-repeat; background-size: 100% 100%;">
                                     
                                        </div>
                                    </div>


                                    <a class="carousel-control-prev" href="#heroCarousel" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon bx bx-chevron-left"
                                            aria-hidden="true"></span>
                                    </a>

                                    <a class="carousel-control-next" href="#heroCarousel" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon bx bx-chevron-right"
                                            aria-hidden="true"></span>
                                    </a>

                                </div>

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
            </g>
        </svg>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="section-title" data-aos="zoom-out">
                   <p>عن الشركة </p>
                    <h1>من نحن</h1>
                </div>

                <div class="row content" data-aos="fade-up">
                    <div class="col-lg-6">
                        <p>
                        شركة الشهباء للاتصالات
                        
                        شركة اتصالات ووكيل معتمد لـشبكة سوريا المستقبل
                        
                        نقدم جميع الخدمات المتعلقة بشـبكة سوريا المستقبل FSN 
                        
                 
                        </p>
                        <ul>
                            <li><p>  </p> </li>
                            <li><p>   </p> </li>
                            <li><p> - نبـذل قصارى جهدنا لتقـديم أفضـل خدمـة انـترنـت لمشتركـيـنا 
                                 
                      </p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <p>


                        </p>
                        @if (Route::has('login'))
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn-learn-more"
                                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">لوحة التحكم</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn-learn-more"
                                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">تسجيل الدخول
                                        </a>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Features Section ======= -->
        <section id="features" class="features">
            <div class="container">

                <ul class="nav nav-tabs row d-flex">
                    <li class="nav-item col-3" data-aos="zoom-in">
                        <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">
                            <i class="ri-speed-up-line"></i>
                            <h4 class="d-none d-lg-block">اكواد الرصيد والسرعات</h4>
                        </a>
                    </li>
                    <li class="nav-item col-3" data-aos="zoom-in" data-aos-delay="100">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-2">
                            <i class="ri-recycle-line"></i>
                            <h4 class="d-none d-lg-block">اعادة تفعيل خط او تفعيل خط دولي</h4>
                        </a>
                    </li>
                    <li class="nav-item col-3" data-aos="zoom-in" data-aos-delay="200">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-3">
                            <i class="ri-road-map-line"></i>
                            <h4 class="d-none d-lg-block">خدمة انتشار عالية للشبكة</h4>
                        </a>
                    </li>
                    <li class="nav-item col-3" data-aos="zoom-in" data-aos-delay="300">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-4">
                            <i class="ri-store-line"></i>
                            <h4 class="d-none d-lg-block">الامان والمحافظة على الخصوصية والخدمة</h4>
                        </a>
                    </li>
                </ul>

                <div class="tab-content" data-aos="fade-up">
                    <div class="tab-pane active show" id="tab-1">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>  باقـات متنوعة لتناسب جميع احتياجاتكم
</h3>
                                <p class="fst-italic">
                                    لكل كود رصيد لديه فترة شهرية او شهرين او ثلاثة اشهر وبسرعات متنوعة تلبي جميع انواع
                                    احتياجاتك بالاضافة
                                    الى وجود العديد من العروض الدورية.
                                </p>
                                <ul>
                                    <li><P><i class="ri-check-double-line"></i> ثبات و استقرار سرعة الاتصال لتلبية
                                        احتياجات
                                        العمل </P></li>
                                    <li><P><i class="ri-check-double-line"></i> سرعة عالية تخدمك لزيادة كفائة التصفح على
                                     الإنترنت</P></li>
                                    <li><P><i class="ri-check-double-line"></i> الاستمرار بالتطوير من قبلنا للوصول الى
                                        افضل
                                        خدمة ممكنة
                                          للمستخدمين </P>  </li>
                                </ul>
                                <p>تُعد شركتنا  والتي تقدم خدمة الإنترنت بتقنية 4G الشركة الوحيدة التي تلبي احتياجات المستخدمين لاتصال سريع وموثوق. تقدم الشركة سرعات متنوعة لتناسب مختلف احتياجات المستهلكين، مع باقات متنوعة تتيح للمشتركين اختيار العرض الذي يلبي متطلباتهم بشكل أفضل.
                                </p>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="assets/img/features-1.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-2">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>خدماتنا تكون للمستخدم دائمة ومستمرة </h3>
                                <p>
                                       
                                    
                                </p>
                                <p class="fst-italic">
                                    الخدمات الحالية
                                </p>
                                <ul>
                                    <li><P><i class="ri-check-double-line"></i>  خدمة تفعيل خط دولي  </P></li>
                                    <li><P><i class="ri-check-double-line"></i> خدمة اعادة تفعيل خط
                                    </P></li>
                                    <li><P><i class="ri-check-double-line"></i>   خدمة تفعيل خط جديد</p><li></li>
                                </ul>
                                <p class="fst-italic">
                                    في القرييب سنحاول توفير جميع الخدمات التي يطلبها المستخدم
                                </p>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="assets/img/features-2.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-3">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>مناطق توزع شبكتنا  </h3>
                                <p>
                                    نهدف الى تزويد وتغطية الشمال السوري المحرر بشبكتنا باكبر قدر ممكن من اجل ان تكون
                                    تجربة المستخدم بافضل
                                    شكل ممكن من ناحية السرعة و قوة الاشارةو ثباتها.
                                </p>
                                <p class="fst-italic">
                                    المناطق التي نغطيها بشبكتنا حاليا
                                </p>
                                <ul>
                                    <li><P><i class="ri-check-double-line"></i> منطقة عفرين وريفها</P></li>
                                    <li><P><i class="ri-check-double-line"></i> منطقة اعزاز وريفها
                                    </P></li>
                                    <li><P><i class="ri-check-double-line"></i> منطقة الباب ورفها</P></li>
                                    <li><P><i class="ri-check-double-line"></i> منطقة الراعي وريفها</P></li>
                                </ul>
                                <p class="fst-italic">
                                    قريبا باذن الله سنقوم بنشر شبكتنا الى المزيد من مناطق الشمال السوري المحرر من اجل
                                    تغطيت المحرر بالكامل
                                </p>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="assets/img/features-3.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-4">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>شبكاتنا محمية باحدث و افضل بروتوكولات الحماية</h3>
                                <p>
                                    
                            
                                </p>
                                <ul>
                                    <li><P><i class="ri-check-double-line"></i> تمتع معنا بالموثوقية</P></li>
                                    <li><P><i class="ri-check-double-line"></i> حافظ على امان بياناتك عبر الشبكة
                                    </P></li>
                                </ul>
                                <p>
                                    نحن نهتم بامور الحماية بشكل كبير جدا ومميز هذا اهم ما يميزنا
                                </p>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="assets/img/features-4.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Features Section -->

        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
            <div class="container">

                <div class="row" data-aos="zoom-out">

                    <div class="col-lg-3 cta-btn-container text-center">
                        <a class="cta-btn align-middle" href="#contact">تواصل معنا </a>
                    </div>
                    <div class="col-lg-9 text-center text-lg-start">
                        <h3>دعوة الى العمل معنا</h3>
                        <p> نرحب بأي مركز اتصالات يود الانضمام الينا ليكون ضمن مجموعة الاتصالات الخدمية الخاصة بنا.</p>
                    </div>
                </div>

            </div>
        </section><!-- End Cta Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title" data-aos="zoom-out">
                    <h2>الخدمات</h2>
                    <p>الخدمات التي نقدمها ونتميز بها معكم</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="icon-box" data-aos="zoom-in-left">
                            <div class="icon"><i class="bi bi-briefcase" style="color: #1484c4;"></i></div>
                            <h4 class="title"><a href="">انضم للعمل معنا</a></h4>
                            <p class="description">نرحب بمراكز الاتصالات للإنضمام إلينا وتسويق خدماتنا</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
                        <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="100">
                            <div class="icon"><i class="bi bi-speedometer2" style="color: #e9bf06;"></i></div>
                            <h4 class="title"><a href="">السرعات العالية التي نوفرها</a></h4>
                            <p class="description">نوفر اكواد رصيد بسرعات عالية ومدة متنوعة بين الشهر و الثلاث اشهر</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mt-5 mt-lg-0 ">
                        <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="200">
                            <div class="icon"><i class="bi bi-eraser" style="color: #3fcdc7;"></i></div>
                            <h4 class="title"><a href="">تفعيل الأرقام المكفولة</a></h4>
                            <p class="description">نوفر خدمة الأرقام المكفولة لتفعيل كافة التطبيقات </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="300">
                            <div class="icon"><i class="bi bi-eraser-fill" style="color:#41cf2e;"></i></div>
                            <h4 class="title"><a href="">اعادة تفعيل خط</a></h4>
                            <p class="description">يمكنك اعادة تفعيل خطك من خلالنا بعد توقفه</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="400">
                            <div class="icon"><i class="bi bi-reception-4" style="color: #d6ff22;"></i></div>
                            <h4 class="title"><a href="">انتشار الشبكة</a></h4>
                            <p class="description">نقدم انتشار واسع في العديد من المناطق المختلفة ونتوسع مع مرور الوقت
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="500">
                            <div class="icon"><i class="bi bi-emoji-heart-eyes" style="color: #4680ff;"></i></div>
                            <h4 class="title"><a href="">عروض وفيرة ومميزة</a></h4>
                            <p class="description">نقدم العديد من العروض المميزة والمغرية لعملائنا </p>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Services Section -->

        <div id="offers" class="container">
    <div class="section-title">
        <h2>العــروض</h2>
        <p>العروض التي نقدمها للمندوبين </p>
    </div>
    <div class="row">
        @foreach ($offers as $offer)
        <div class="col-xxl-4 col-md-4">
            <div class="card" style="height: 100%;">
                <img src="{{ asset('images/' . $offer['image']) }}" style="width: 100%; height: 200px;" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $offer['title'] }}</h5>
                    <p class="card-text">{{ $offer['description'] }}</p>
                    @if (Route::has('login'))
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                @auth
                                    <a href="{{ url('/categories') }}" a class="btn btn-primary"
                                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"><p>التفاصيل </p></a>
                                @else
                                    <a href="{{ route('login') }}" a class="btn btn-primary"
                                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                        <p>تسجيل الدخول</p>
                                        </a>
                                @endauth
                            </div>
                        @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

        <!-- ======= F.A.Q Section ======= -->
        <section id="faq" class="faq">
            <div class="container">

                <div class="section-title" data-aos="zoom-out">
                    <h2>F.A.Q</h2>
                    <p>الاسئلة و الاستفسارات</p>
                </div>

                <ul class="faq-list">

                    <li>
                        <div data-bs-toggle="collapse" class="collapsed question" href="#faq1"><p>هل يوجد شروط للعمل
                            معكم؟؟.. </p><i class="bi bi-chevron-down icon-show"></i><i
                                class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                نعم يوجد العديد من الشروط التي يجب توافرها بالشركة او الجهة التي ترغب بالعمل معنا
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">
                            <p  style="font-family: "Cairo", sans-serif;"> هل خدمة اعادة تفعيل
                            خط مجانبة؟؟.. </p><i class="bi bi-chevron-down icon-show"></i><i
                                class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                نعم حاليا الخدمة مجانية لاكن مستقبلا قد لا تكون مجانية.
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq3" class="collapsed question"><p>هل يوجد لديكم خدمة
                            تفعيل خط دولي؟ وكم تكلفة تفعيله؟؟..</p>
                            <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i>
                        </div>
                        <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                نعم لدينا خدمة تفعيل خط دولي , وهي حاليا مجانية مستقبلا قد تكون غير مجانية.
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq4" class="collapsed question"><p>كيف يمكنني الانضمام
                             للعمل معكم
                            كمندوب؟؟ </p><i class="bi bi-chevron-down icon-show"></i><i
                                class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                يجب عليك اولا التواصل معنا ومن ثم التأكد انك تحقق الشروط المناسبة للعمل معنا ومن ثم يتم
                                اعطائك حساب
                                مندوب للعمل معنا والتفاعل على النظام
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq5" class="collapsed question"><p>ما هي اوقات عملكم
                             على النظام او
                            الفيزيائي في موقع الشركة؟؟.. </p><i class="bi bi-chevron-down icon-show"></i><i
                                class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                الخدمات التي تحتاج الى موافقتنا او الرد عليها تكون من التاسعة صباحا حتى العاشرة مساءا
                                اما باقي الخدمات
                                او المنتجات فهي متاحة دوما على النظام
                            </p>
                        </div>
                    </li>

                </ul>

            </div>
        </section><!-- End F.A.Q Section -->

        <section id="contact" class="section contact" style="direction: rtl;">
            <div class="container">
                <div class="row" data-aos="fade-in">

                    <div class="col-lg-3 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>الموقع:</h4>
                                <p>الباب - غرب دوار السنتر -مقابل حكيم مول</p>
                            </div>

                            <div class="email">
                                <a href="mailto:Shahbaatelecom@gmail.com" target="_blank"> <i
                                        class="bi bi-envelope"></i></a>
                                <h4>البريد:</h4>
                                <p>Shahbaatelecom@gmail.com</p>
                            </div>
                            <div class="email">
                                <a href="https://www.instagram.com/shahbaatelecom?igsh=MzNlNGNkZWQ4Mg=="> <i
                                        class="bi bi-instagram" aria-hidden="true"></i>
                                    <h4>انستغرام:</h4>
                                    <p>زوروا صفحتنا على انستكرام</p>
                                </a>
                            </div>
                            <br><br>

                        </div>

                    </div>
                    <div class="col-lg-1"></div>

                    <div class="col-lg-3 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <a href="https://www.facebook.com/shahbaafsn?mibextid=ZbWKwL"> <i
                                        class="bi bi-facebook"></i>
                                    <h4>فيسبوك:</h4>
                                    <p>زوروا صفحتنا على الفيس بوك</p>
                                </a>
                            </div>
                            
                            <div class="phone">
                                <a href="https://wa.me/+963992819597" target="_blank"><i class="bi bi-whatsapp"></i></a>
                                <h4>وتس اب :</h4>
                                <p>الإدارة:</p>
                                <p><a href="https://wa.me/+13013237402"> 301-323-7402 1+</a></p>
                            </div>
                            <div class="phone">
                                <a href="https://wa.me/+905072415450" target="_blank"><i class="bi bi-whatsapp"></i></a>
                                <h4>وتس اب:</h4>
                                <p>خدمة الزبائن / الدعم الفني :</p>
                                <p><a href="https://wa.me/+18628106085"> 862-810-6085 1+</a></p>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d2780.5221693200315!2d37.51400956959189!3d36.373273833620395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzbCsDIyJzI3LjAiTiAzN8KwMzAnNDguMSJF!5e0!3m2!1sar!2s!4v1706539788154!5m2!1sar!2s"
                            frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

     <!-- ======= Footer ======= -->
  <footer id="footer" class="footer" style="direction: ltr;">
    <div class="copyright">
          <div class="copyright">
       &copy;   <strong><span><a href="https://wa.me/+18628106085"> شــركـة الــشــهـــباء للإتــصالات</a></span> </span></stron>.
    </div>
    </div>
    <div class="credits">

     <h6> <b> مصمم الموقع : <a href="https://abdalrhmanal.github.io/CV-MY">Abdulrahman Al-Saraqbi</a></b></h6>
    </div>
  </footer><!-- End Footer -->
    <section id="hero" class="d-flex flex-column justify-content-end align-items-center">
        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="100" y="3" fill="rgba(255,255,255, .1)">
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="100" y="0" fill="rgba(255,255,255, .2)">
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="100" y="9" fill="#fff">
            </g>
        </svg>
    </section>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="path/to/darkmode.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
