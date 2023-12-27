@extends('dashboard.layouts.auth')

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">
                @lang('global.login')
            </h5>
        </div>
    </div>
    <form action="{{ route('login') }}" method="POST">
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
            <div class="form-label-group">
                <label class="form-label" for="password">
                    @lang('global.login_password')
                </label>
                <a class="link link-primary link-sm" href="{{ route('password.request') }}">
                    @lang('global.forgot_password')
                </a>
            </div>
            <div class="form-control-wrap">
                <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" class="form-control form-control-lg" id="password" name="password"
                       placeholder="@lang('global.login_password')" required>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                <label class="custom-control-label" for="remember">
                    @lang('global.remember_me')
                </label>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block should-toggle">
                @lang('global.login')
            </button>
        </div>
    </form>
@endsection
