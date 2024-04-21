@extends('layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>الملف الشخصي</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/profiles')}}"> الملف الشخصي  </a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="img/picture.jpg" alt="Profile" class="rounded-circle">
                        <h2>{{ Auth::user()->name }}</h2>
                        <h3>({{ Auth::user()->role->name ?? 'Default Role' }})</h3>
                        <div class="social-links mt-2">
                            <a href="#" ><i class="bi bi-award"></i></a>
                            <img src="{{ asset('/img/FSN.png') }}" style="width: 50px;height: 50px;" alt="">
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">ملخص</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">تعديل
                                    الملف الشخصي</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-settings">الاعدادات</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">تغيير كلمة المرور</button>
                            </li>
                            @can('is-admin')
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-delete">حذف الحساب</button>
                            </li>
                            @endcan

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">تفاصيل الملف الشخصي</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">الاسم  </div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">الصلاحية</div>
                                    <div class="col-lg-9 col-md-8">({{ Auth::user()->role->name ?? 'Default Role' }})</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">رقم الهاتف</div>
                                    <div class="col-lg-9 col-md-8"><a href="https://wa.me/+963992819597">+963 992 819 597</a></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">الايميل</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('معلومات الملف الشخصي') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __("قم بتحديث معلومات الملف الشخصي لحسابك وعنوان البريد الإلكتروني.") }}
                                    </p>
                                </header>

                                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                    @csrf
                                </form>

                                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('patch')

                                    <div class="mb-3">
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" name="name" type="text" class="form-control"
                                            :value="old('name', Auth::user()->name)" required autofocus autocomplete="name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>

                                    <div class="mb-3">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" name="email" type="email"
                                            class="form-control" :value="old('email', Auth::user()->email)" required autocomplete="username" />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                        @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !Auth::user()->hasVerifiedEmail())
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-800">
                                                    {{ __('لم يتم التحقق من عنوان بريدك الإلكتروني.') }}
                                                    <button form="send-verification"
                                                        class="btn btn-link text-sm hover:underline">
                                                        {{ __('انقر هنا لإعادة إرسال رسالة التحقق عبر البريد الإلكتروني.') }}
                                                    </button>
                                                </p>

                                                @if (session('status') === 'verification-link-sent')
                                                    <p class="mt-2 font-medium text-sm text-green-600">
                                                        {{ __('تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.') }}
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <div class="d-flex align-items-center gap-4">
                                        <x-primary-button>
                                            {{ __('حفظ') }}
                                        </x-primary-button>

                                        @if (session('status') === 'profile-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition
                                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                {{ __('تم الحفظ.') }}
                                            </p>
                                        @endif
                                    </div>
                                </form>
                            </div>


                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">الايميل
                                            الاشعارات</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="changesMade"
                                                    checked>
                                                <label class="form-check-label" for="changesMade">
                                                    التغييرات التي تم إجراؤها على حسابك
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="newProducts"
                                                    checked>
                                                <label class="form-check-label" for="newProducts">
                                                    معلومات عن المنتجات والخدمات الجديدة
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="proOffers">
                                                <label class="form-check-label" for="proOffers">
                                                    العروض التسويقية والترويجية
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="securityNotify"
                                                    checked disabled>
                                                <label class="form-check-label" for="securityNotify">
                                                    تنبيهات أمنية
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                    </div>
                                </form><!-- End settings Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <section>
                                    <header>
                                        <h2 class="text-lg font-medium text-gray-900">
                                            {{ __('تحديث كلمة المرور') }}
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __('تأكد من أن حسابك يستخدم كلمة مرور طويلة وعشوائية ليظل آمنًا.') }}
                                        </p>
                                    </header>

                                    <form method="post" action="{{ route('password.update') }}"
                                        class="mt-6 space-y-6">
                                        @csrf
                                        @method('put')

                                        <div class="mb-3">
                                            <label for="update_password_current_password"
                                                class="form-label">{{ __('كلمة السر الحالية') }}</label>
                                            <input id="update_password_current_password" name="current_password"
                                                type="password" class="form-control" autocomplete="current-password">
                                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="update_password_password"
                                                class="form-label">{{ __('كلمة المرور الجديدة') }}</label>
                                            <input id="update_password_password" name="password" type="password"
                                                class="form-control" autocomplete="new-password">
                                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="update_password_password_confirmation"
                                                class="form-label">{{ __('تأكيد كلمة المرور') }}</label>
                                            <input id="update_password_password_confirmation"
                                                name="password_confirmation" type="password" class="form-control"
                                                autocomplete="new-password">
                                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                        </div>

                                        <div class="d-flex align-items-center gap-4">
                                            <button type="submit"
                                                class="btn btn-primary">{{ __('حفظ') }}</button>

                                            @if (session('status') === 'password-updated')
                                                <p x-data="{ show: true }" x-show="show" x-transition
                                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                    {{ __('تم الحفظ.') }}</p>
                                            @endif
                                        </div>
                                    </form>
                                </section>
                            </div>
                            <div class="tab-pane fade pt-3" id="profile-delete">
                                <section class="space-y-6">
                                    <header>
                                        <h2 class="text-lg font-medium text-gray-900">
                                            {{ __('حذف الحساب') }}
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __('بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته نهائيًا. قبل حذف حسابك، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.') }}
                                        </p>
                                    </header>

                                    <x-danger-button x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('حذف الحساب') }}</x-danger-button>

                                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                            @csrf
                                            @method('delete')

                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('هل انت متأكد انك تريد حذف حسابك?') }}
                                            </h2>

                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ __('بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته نهائيًا. الرجاء إدخال كلمة المرور الخاصة بك لتأكيد رغبتك في حذف حسابك نهائيًا.') }}
                                            </p>

                                            <div class="mt-6">
                                                <x-input-label for="password" value="{{ __('Password') }}"
                                                    class="sr-only" />

                                                <x-text-input id="password" name="password" type="password"
                                                    class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

                                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                            </div>

                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('يلغي') }}
                                                </x-secondary-button>

                                                <x-danger-button class="ms-3">
                                                    {{ __('حذف الحساب') }}
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </section>
                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
