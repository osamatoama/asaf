@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">قائمة موظفين لوحة التحكم</h3>
            </div>
            @can( config('models.user.permissions.create') )
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                           data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="{{ route('dashboard.users.create') }}"
                                       class="ajax-modal-btn dropdown-toggle btn btn-icon btn-primary p-2 text-white" data-link="">
                                        <span>
                                            <em class="icon ni ni-plus"></em>
                                            إضافة موظف
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <table class="table table-bordered table-striped table-hover" id="users-table"
                           data-url="{{ route('dashboard.users.index') }}">
                        <thead>
                            <tr>
                                <th class="text-center">تسلسل</th>
                                <th class="text-center">الاسم</th>
                                <th class="text-center">البريد الإلكتروني</th>
                                <th class="text-center">الهاتف</th>
                                <th class="text-center">تم التحقق</th>
                                <th class="text-center">مُفعل</th>
                                <th class="text-center">رمز التحقق</th>
                                <th class="text-center">الأذونات</th>
                                <th class="text-center">{{ __('global.Actions') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashboard/js/libs/datatable-btns.js') }}"></script>
    @include('dashboard.pages.users.partials.scripts.index')
@endpush
