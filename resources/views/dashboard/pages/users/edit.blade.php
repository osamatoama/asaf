@extends('dashboard.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/libs/intl-tel-input/css/intlTelInput.min.css') }}">
    <style>
        .iti {
            width: 100%;
        }

        .iti__flag-container {
            border-radius: inherit 0 0 inherit;
        }

        .iti__selected-flag {
            gap: 5px;
            border-radius: inherit;
        }

        .iti__arrow {
            margin-left: 3px;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #777;
        }

        .iti__arrow--up {
            border-top: none;
            border-bottom: 5px solid #777;
        }

        .iti__country-list {
            left: 0 !important;
            width: fit-content;
            max-width: calc(100vw - 89px);
            min-width: 250px;
        }

        .iti__country {
            unicode-bidi: plaintext;
        }

        .iti__country.iti__highlight {
            unicode-bidi: plaintext;
        }

        .iti__country-list {
            left: 0 !important;
        }

        .iti--separate-dial-code .iti__selected-dial-code {
            margin-left: 0;
        }
    </style>

    @if (isDark())
        <style>
            .iti__country-list {
                background-color: #141c26;
            }
        </style>
    @endif
@endpush

@section('content')
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">تعديل موظف</h5>
            </div>
            <form class="form-validate users-form" method="POST"
                  action="{{ route('dashboard.users.update', $user) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-gs">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="name">
                                الاسم
                            </label>
                            <div class="form-control-wrap">
                                <input class="form-control @error('name') is-invalid @enderror"
                                       type="text" name="name"
                                       id="name" value="{{ old('name', $user->name) }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <span class="help-block">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="email">
                                البريد الإلكتروني
                            </label>
                            <div class="form-control-wrap">
                                <input class="form-control @error('email') is-invalid @enderror"
                                       type="email" name="email"
                                       id="email" value="{{ old('email', $user->email) }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <span class="help-block">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="phone">
                                رقم الهاتف
                            </label>
                            <div class="form-control-wrap @error('phone') is-invalid @enderror">
                                <input class="form-control @error('phone') is-invalid @enderror"
                                       type="text" name="phone"
                                       id="phone" value="{{ old('phone', $user->phone) }}">
                                <input type="hidden" name="phone_country" id="phone_country" value="{{ old('phone_country') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <span class="help-block">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="password">
                                كلمة المرور
                            </label>
                            <div class="form-control-wrap">
                                <input class="form-control @error('password') is-invalid @enderror"
                                       type="password" name="password"
                                       id="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <span class="help-block">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="role">
                                الأذونات
                            </label>
                            <div class="form-control-wrap">
                                <select class="form-control select2-init @error('role') is-invalid @enderror"
                                        name="role" id="role"
                                        required>
                                    <option value="">{{ __('global.pleaseSelect') }}</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"
                                                @if(isSelected('role', $role->id, $currentRole)) selected @endif>
                                            {{ $role->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <span class="help-block">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="verification_code">
                                كود التحقق
                            </label>
                            <div class="form-control-wrap">
                                <input class="form-control @error('verification_code') is-invalid @enderror"
                                       type="number" name="verification_code"
                                       id="verification_code" value="{{ old('verification_code', $user->verification_code) }}">
                                @error('verification_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <span class="help-block">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="verified">
                                تحقق
                            </label>
                            <div class="form-control-wrap">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input"
                                           id="verified" name="verified" value="1"
                                           @if(isChecked('verified', $user->verified)) checked @endif>
                                    <label class="custom-control-label" for="verified"></label>
                                </div>
                            </div>
                            <span class="form-note">
                                &nbsp;
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="active">
                                تفعيل
                            </label>
                            <div class="form-control-wrap">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input"
                                           id="active" name="active" value="1"
                                           @if(isChecked('active', $user->active)) checked @endif>
                                    <label class="custom-control-label" for="active"></label>
                                </div>
                            </div>
                            <span class="form-note">
                                &nbsp;
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('dashboard.users.index') }}"
                           class=" dropdown-toggle btn btn-lg btn-icon btn-warning p-2 text-white">
                            <span>
                                <em class="ni ni-arrow-left"></em>
                                {{ trans('global.back_to_list') }}
                            </span>
                        </a>
                        <button class="btn btn-lg btn-success p-2" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashboard/libs/intl-tel-input/js/intlTelInput.min.js') }}"></script>
    <script>
        const form = document.querySelector('.users-form')
        const phoneInput = form.querySelector('#phone')
        const phoneCountryInput = form.querySelector('#phone_country')

        const intlTelInput = window.intlTelInput(phoneInput, {
            initialCountry: phoneCountryInput.value ?? 'sa',
            preferredCountries: ['sa'],
            separateDialCode: true,
            // utilsScript: `{{ asset('assets/dashboard/libs/intl-tel-input/js/utils.js') }}`,
        })

        form.addEventListener('submit', function () {
            phoneCountryInput.value = intlTelInput.getSelectedCountryData().iso2
        })
    </script>
@endpush
