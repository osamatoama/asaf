<!DOCTYPE html>
<html lang="ar" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Perfume Quiz">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Perfume Quiz">

    <link rel="shortcut icon" href="{{ asset('assets/dashboard/images/favicon.png') }}">

    <title>@yield('title') | اختبار العطور</title>

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/dashlite.rtl.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/dashboard/css/theme.rtl.css') }}">
</head>
<body @class(['nk-body bg-white npc-default pg-error', 'has-rtl' => true]) dir="rtl">
<div class="nk-app-root">
    <div class="nk-main ">
        <div class="nk-wrap nk-wrap-nosidebar">
            <div class="nk-content ">
                <div class="nk-block nk-block-middle wide-xs mx-auto">
                    <div class="nk-block-content nk-error-ld text-center">
                        <h1 class="nk-error-head">
                            @yield('code')
                        </h1>

                        <h3 class="nk-error-title">
                            @yield('message')
                        </h3>

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
