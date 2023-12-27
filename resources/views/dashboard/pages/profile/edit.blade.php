@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    @lang('global.my_profile')
                </h3>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card">
            <div class="card-inner">
                <h5 class="card-title">
                    @lang('global.profile_information')
                </h5>
                <form action="{{ route('dashboard.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label required" for="name">
                            الاسم
                        </label>
                        <div class="form-control-wrap">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) id="name"
                                   placeholder="الاسم"
                                   name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <span class="form-note">
                            &nbsp;
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="email">
                            البريد الإلكتروني
                        </label>
                        <div class="form-control-wrap">
                            <input type="email" @class(['form-control', 'is-invalid' => $errors->has('email')]) id="email"
                                   placeholder="البريد الإلكتروني"
                                   name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <span class="form-note">
                            &nbsp;
                        </span>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary should-toggle">
                        @lang('global.save')
                    </button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-inner">
                <h5 class="card-title">
                    @lang('global.change_password')
                </h5>
                <form action="{{ route('dashboard.profile.change-password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label required" for="password">
                            كلمة المرور الجديدة
                        </label>
                        <div class="form-control-wrap">
                            <input type="password" @class(['form-control', 'is-invalid' => $errors->has('password')]) id="password"
                                   placeholder="كلمة المرور الجديدة"
                                   name="password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <span class="form-note">
                            &nbsp;
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="password_confirmation">
                            إعادة كلمة المرور الجديدة
                        </label>
                        <div class="form-control-wrap">
                            <input type="password" class="form-control" id="password_confirmation"
                                   placeholder="إعادة كلمة المرور الجديدة"
                                   name="password_confirmation" required>
                        </div>
                        <span class="form-note">
                            &nbsp;
                        </span>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary should-toggle">
                        @lang('global.save')
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
