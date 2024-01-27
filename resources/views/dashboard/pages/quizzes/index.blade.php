@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">قائمة الاختبارات</h3>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <table class="table table-bordered table-striped table-hover" id="quizzes-table"
                           data-url="{{ route('dashboard.quizzes.index') }}">
                        <thead>
                            <tr>
                                <th class="text-center">تسلسل</th>
                                <th class="text-center">اسم الاختبار</th>
                                <th class="text-center">عدد الأسئلة</th>
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
    @include('dashboard.pages.quizzes.partials.scripts.index')
@endpush
