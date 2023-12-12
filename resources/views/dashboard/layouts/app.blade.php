<!DOCTYPE html>
<html lang="ar" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Gold Boulevard">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Gold Boulevard">

    <link rel="shortcut icon" href="{{ asset('assets/dashboard/images/favicon.png') }}">

    <title>اختبار العطور</title>

    @include('dashboard.partials.styles')
    @stack('styles')
</head>
<body @class([
        'nk-body bg-lighter npc-default has-sidebar',
        'dark-mode' => isDark(),
        'has-rtl'   => true,
    ]) dir="rtl" @if(isDark()) theme="dark" @endif>
<div class="nk-app-root">
    <div class="nk-main ">
        @include('dashboard.partials.sidebar')
        <div class="nk-wrap ">
            @include('dashboard.partials.header')
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.partials.footer')
        </div>
    </div>
</div>

@stack('modals')

@include('dashboard.partials.scripts')
@stack('scripts')
</body>
</html>
