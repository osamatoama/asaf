@extends('dashboard.layouts.errors')

@section('title', '404')

@section('code')
    404
@endsection

@section('message')
    عفواً. حدث خطأ ما هنا...
@endsection

@section('content')
    <p class="nk-error-text">
        ممكن يكون هناك خطأ فى عنوان الصفحة او ربما لا توجد هذه الصفحة
    </p>

    <a href="{{ route('dashboard.home') }}" class="btn btn-lg btn-primary mt-2">
        الرجوع للرئيسية
    </a>
@endsection
