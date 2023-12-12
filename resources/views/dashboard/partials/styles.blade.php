@if(isRtl())
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/dashlite.rtl.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/dashboard/css/theme.rtl.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/dashlite.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/dashboard/css/theme.css') }}">
@endif
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/libs/fancybox.css') }}">
<style>
    .select2-dropdown {
        position: relative !important;
    }
</style>
