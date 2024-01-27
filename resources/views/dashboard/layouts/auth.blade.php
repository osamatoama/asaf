<!DOCTYPE html>
<html lang="ar" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Perfume Quiz">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Perfume Quiz">
    <meta name="robots" content="noindex,nofollow">

    <link rel="shortcut icon" href="{{ assetCustom('assets/dashboard/images/favicon.png') }}">

    <title>اختبار العطور</title>

    <link rel="stylesheet" href="{{ assetCustom('assets/dashboard/css/dashlite.rtl.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ assetCustom('assets/dashboard/css/theme.rtl.css') }}">

    @stack('styles')
</head>
<body @class(['nk-body bg-white npc-default pg-auth', 'has-rtl' => true]) dir="rtl">
<div class="nk-app-root">
    <div class="nk-main ">
        <div class="nk-wrap nk-wrap-nosidebar">
            <div class="nk-content ">
                <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                    <div class="brand-logo pb-4 text-center">
                        <a href="{{ route('website.perfume-quiz') }}" class="logo-link">
                            <img class="logo-light logo-img"
                                 src="{{ assetCustom('assets/dashboard/images/logos/logo.png') }}"
                                 srcset="{{ assetCustom('assets/dashboard/images/logos/logo2x.png') }} 2x"
                                 alt="logo">
                            <img class="logo-dark logo-img"
                                 src="{{ assetCustom('assets/dashboard/images/logos/logo-dark.png') }}"
                                 srcset="{{ assetCustom('assets/dashboard/images/logos/logo-dark2x.png') }} 2x"
                                 alt="logo-dark">
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-inner card-inner-lg">
                            @yield('content')
                        </div>
                    </div>
                </div>
                <div class="nk-footer nk-auth-footer-full">
                    <div class="container wide-lg">
                        <div class="row g-3">
                            <div class="col-lg-6 order-lg-last">
                                <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <div class="nk-block-content text-center text-lg-left">
                                    <p class="text-soft">
                                        حقوق النشر &copy; {{ date('Y') }} اختبار العطور. جميع الحقوق محفوظة
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ assetCustom('assets/dashboard/js/bundle.js') }}"></script>
<script src="{{ assetCustom('assets/dashboard/js/scripts.js') }}"></script>

@include('dashboard.partials.scripts.main')
@include('dashboard.partials.scripts.auth')
@stack('scripts')
</body>
</html>
