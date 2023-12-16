@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    قائمة سجلات النشاط
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
                        <th class="text-center">تسلسل</th>
                        <th class="text-center">معرف المستخدم</th>
                        <th class="text-center">معرف الموضوع</th>
                        <th>نوع الموضوع</th>
                        <th>الوصف</th>
                        <th>المضيف</th>
                        <th>أنشأ في</th>
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
