@extends('dashboard.layouts.auth')

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">
                @lang('global.reset_password')
            </h5>
        </div>
    </div>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="auth" value="{{ $token }}">
        <div class="form-group">
            <div class="form-label">
                <label class="form-label" for="password">
                    @lang('global.login_password')
                </label>
            </div>
            <div class="form-control-wrap">
                <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" @class(['form-control form-control-lg', 'is-invalid' => $errors->has('password')]) id="password"
                       name="password" placeholder="@lang('global.login_password')" required>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="form-label">
                <label class="form-label" for="password-confirmation">
                    @lang('global.login_password_confirmation')
                </label>
            </div>
            <div class="form-control-wrap">
                <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password-confirmation">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" class="form-control form-control-lg" id="password-confirmation" name="password_confirmation"
                       placeholder="@lang('global.login_password_confirmation')" required>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block should-toggle">
                @lang('global.reset_password')
            </button>
        </div>
    </form>
@endsection
