<div id="question-{{ $question->id }}" class="question card mt-4 p-2">
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-start flex-grow-1">
            <div id="question-show-{{ $question->id }}" class="question-show">
                <span class="question-title fs-20px fw-bold">
                    {{ $question->title }}
                </span>

                <span
                    class="edit-question-btn" style="cursor: pointer" data-id="{{ $question->id }}"
                >
                    <em class="icon ni ni-edit fs-20px text-info"></em>
                </span>
            </div>

            <div id="question-edit-{{ $question->id }}" class="question-edit d-flex align-items-center d-none">
                <input
                    class="question-title-input form-control resizable fs-20px" type="text" name="title"
                    value="{{ $question->title }}" required
                />

                <button
                    class="save-question-btn btn btn-sm btn-primary ms-1"
                    data-id="{{ $question->id }}"
                    data-action="{{ route('dashboard.quiz-questions.update', $question->id) }}"
                >
                    حفظ
                </button>

                <button
                    class="discard-question-btn btn btn-sm btn-danger ms-1"
                    data-id="{{ $question->id }}"
                >
                    إلغاء
                </button>
            </div>
        </div>

        <div class="mx-3">
            <span
                class="delete-question-btn" style="cursor: pointer"
                data-id="{{ $question->id }}"
                data-action="{{ route('dashboard.quiz-questions.destroy', $question->id) }}"
            >
                <em class="icon ni ni-trash fs-20px text-danger"></em>
            </span>
        </div>
    </div>

    <hr>

    <ul>
        @foreach ($question->answers as $answer)
            @include('dashboard.pages.quizzes.partials.edit.answer')
        @endforeach

        @include('dashboard.pages.quizzes.partials.edit.add-answer')
    </ul>
</div>
