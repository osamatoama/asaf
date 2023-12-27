@extends('dashboard.layouts.auth')

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">
                التحقق من الحساب
            </h5>
        </div>
    </div>
    <form action="{{ route('dashboard.profile.post-verification') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="code">
                @lang('global.verification_code')
            </label>
            <div class="form-control-wrap">
                <input type="text" @class(['form-control form-control-lg', 'is-invalid' => $errors->has('code')]) id="code"
                       name="code" placeholder="@lang('global.verification_code')" value="{{ old('code') }}" required autofocus>
                @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block should-toggle">
                تأكيد
            </button>
        </div>
    </form>
    <div class="form-note-s2 text-center pt-4">
        <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit()">
            تسجيل خروج
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
@endsection
