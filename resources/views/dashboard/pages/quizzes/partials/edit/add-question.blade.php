<div id="add-question" class="add-question card mt-4 p-2">
    <form id="add-question-form" action="{{ route('dashboard.quiz-questions.store') }}">

        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

        <div class="d-flex align-items-center justify-content-between">
            <div class="form-group mb-0 ms-4">
                <input class="form-control resizable fs-20px" type="text" name="title" placeholder="السؤال" />
                <div class="invalid-feedback"></div>
            </div>

            <button type="submit" class="btn btn-sm btn-success ms-1">إضافة سؤال</button>
        </div>
    </form>
</div>

@push('scripts')
    @include('dashboard.pages.quizzes.partials.edit.scripts.add-question')
@endpush
