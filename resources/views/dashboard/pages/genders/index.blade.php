@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    قائمة الأنواع
                </h3>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card">
            <div class="card-inner">
                <table class="table table-bordered table-striped table-hover" id="genders-table"
                       data-url="{{ route('dashboard.genders.index') }}">
                    <thead>
                    <tr>
                        <th class="text-center">تسلسل</th>
                        <th class="text-center">الاسم</th>
                        <th class="text-center">عدد المنتجات</th>
                        <th class="text-center">@lang('global.Actions')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ assetCustom('assets/dashboard/js/libs/datatable-btns.js') }}"></script>
    @include('dashboard.pages.genders.partials.scripts.index')
@endpush
