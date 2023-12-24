@extends('dashboard.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard_theme/assets/css/editors/quill.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/custom/edit-quiz.css') }}?version=1.0.2">
@endpush

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">تعديل الاختبار #{{ $quiz->id }}</h3>
            </div>

            <div class="nk-block-head-content">
                <a href="{{ route('dashboard.quizzes.index') }}" class="btn btn-lg btn-icon btn-warning p-2 text-white">
                    <span>
                        <em class="ni ni-arrow-right"></em>
                        {{ trans('global.back_to_list') }}
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="nk-block">
        @include('dashboard.pages.quizzes.partials.edit.basic-info')
    </div>

    <div class="nk-block">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <h5 class="card-title">الأسئلة والإجابات</h5>
            </div>

            <div class="card-inner">
                <div class="card-body">
                    <div class="row g-gs">
                        @foreach ($quiz->questions as $question)
                            @include('dashboard.pages.quizzes.partials.edit.question')
                        @endforeach

                        @include('dashboard.pages.quizzes.partials.edit.add-question')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('dashboard.pages.quizzes.partials.edit.scripts.main')
@endpush
