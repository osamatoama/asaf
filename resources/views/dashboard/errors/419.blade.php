@extends('dashboard.layouts.errors')

@section('title', '419')

@section('code')
    419
@endsection

@section('message')
    حدث خطأ ما هنا...
@endsection

@section('content')
    <p class="nk-error-text">
        صَلاحِيَة الجَلسة انتهت من فضلك أعد تحميل الصفحة
    </p>
    <a href="{{ url()->previous() ?? route('dashboard.home') }}" class="btn btn-lg btn-primary mt-2">
        إعادة التحميل
    </a>
@endsection
