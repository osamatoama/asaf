@extends('dashboard.layouts.auth')

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">
                @lang('global.reset_password')
            </h5>
        </div>
    </div>
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="email">
                @lang('global.login_email')
            </label>
            <div class="form-control-wrap">
                <input type="email" @class(['form-control form-control-lg', 'is-invalid' => $errors->has('email')]) id="email"
                       name="email" placeholder="@lang('global.login_email')" value="{{ old('email') }}" required>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block should-toggle">
                @lang('global.send_password')
            </button>
        </div>
    </form>
    <div class="form-note-s2 text-center pt-4">
        <a href="{{ route('login') }}">
            تسجيل الدخول
        </a>
    </div>
@endsection
