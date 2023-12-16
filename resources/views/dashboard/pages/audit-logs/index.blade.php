@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    @lang('global.list') @lang('cruds.auditLog.title')
                </h3>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card">
            <div class="card-inner">
                <table class="table table-bordered table-striped table-hover" id="auditLogs-table"
                       data-url="{{ route('dashboard.audit-logs.index') }}">
                    <thead>
                    <tr>
                        <th class="text-center">@lang('cruds.auditLog.fields.id')</th>
                        <th class="text-center">@lang('cruds.auditLog.fields.user_id')</th>
                        <th class="text-center">@lang('cruds.auditLog.fields.subject_id')</th>
                        <th>@lang('cruds.auditLog.fields.subject_type')</th>
                        <th>@lang('cruds.auditLog.fields.description')</th>
                        <th>@lang('cruds.auditLog.fields.host')</th>
                        <th>@lang('cruds.auditLog.fields.created_at')</th>
                        <th class="text-center">@lang('global.Actions')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashboard/js/libs/datatable-btns.js') }}"></script>
    @include('dashboard.pages.audit-logs.partials.scripts.index')
@endpush
