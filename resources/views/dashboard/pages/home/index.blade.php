@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title mb-3">
                    لوحة التحكم
                </h2>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="row g-gs mb-5">
            @include('dashboard.pages.home.partials.statistics')
        </div>
    </div>
@endsection
