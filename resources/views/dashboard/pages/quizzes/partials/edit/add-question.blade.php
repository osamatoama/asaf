<div id="add-question" class="add-question card mt-4 p-2">
    <div class="d-flex align-items-center justify-content-between">
        <input class="form-control resizable fs-20px" type="text" name="title" placeholder="السؤال" required />

        <button
            class="add-question-btn btn btn-sm btn-success ms-1"
            data-quiz-id="{{ $quiz->id }}"
            data-action="{{ route('dashboard.quiz-questions.store') }}"
        >
            إضافة سؤال
        </button>
    </div>
</div>

@push('scripts')

@endpush
