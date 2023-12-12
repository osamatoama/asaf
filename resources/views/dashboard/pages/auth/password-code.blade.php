@extends('dashboard.layouts.auth')

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">
                @lang('global.reset_password')
            </h5>
        </div>
    </div>
    <form action="{{ route('password.verify-code') }}" method="POST">
        @csrf
        <input type="hidden" name="auth" value="{{ $email }}">
        <div class="form-group">
            <label class="form-label" for="code">
                @lang('global.verification_code')
            </label>
            <div class="form-control-wrap">
                <input type="text" @class(['form-control form-control-lg', 'is-invalid' => $errors->has('code')]) id="code"
                       name="code" placeholder="@lang('global.verification_code')" value="{{ old('code') }}" required>
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
@endsection
