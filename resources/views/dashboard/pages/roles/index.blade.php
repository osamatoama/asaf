@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">قائمة الأذونات</h3>
            </div>
            @can( config('models.role.permissions.create') )
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                           data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="{{ route('dashboard.roles.create') }}"
                                       class="ajax-modal-btn dropdown-toggle btn btn-icon btn-primary p-2 text-white" data-link="">
                                        <span>
                                            <em class="icon ni ni-plus"></em>
                                            إضافة إذن
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
                    <table class="table table-bordered table-striped table-hover" id="roles-table"
                           data-url="{{ route('dashboard.roles.index') }}">
                        <thead>
                        <tr class="nk-tb-head">
                            <th class="text-center">تسلسل</th>
                            <th class="text-center">اسم الدور</th>
                            <th class="text-center">الصلاحيات</th>
                            <th class="text-center">{{ trans('global.Actions') }}</th>
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
    @include('dashboard.pages.roles.partials.scripts.index')
@endpush
