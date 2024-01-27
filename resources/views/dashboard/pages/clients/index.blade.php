@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">قائمة العملاء</h3>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <table class="table table-bordered table-striped table-hover" id="clients-table"
                           data-url="{{ route('dashboard.clients.index') }}">
                        <thead>
                            <tr>
                                <th class="text-center">تسلسل</th>
                                <th class="text-center">كود العميل</th>
                                <th class="text-center">البريد الإلكتروني</th>
                                <th class="text-center">الهاتف</th>
                                <th class="text-center">عدد مرّات اجتياز الاختبار</th>
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
    <script src="{{ assetCustom('assets/dashboard/js/libs/datatable-btns.js') }}"></script>
    @include('dashboard.pages.clients.partials.scripts.index')
@endpush
