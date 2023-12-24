<div id="question-{{ $question->id }}" class="question card col-12 mt-4 p-2 @if(! $question->active) opacity-03 @endif">

    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <div id="question-show-{{ $question->id }}" class="question-show">
                <span class="question-title fs-20px fw-bold">
                    {{ $question->title }}
                </span>

                <span class="edit-question-btn cursor-pointer" data-question-id="{{ $question->id }}">
                    <em class="icon ni ni-edit fs-20px text-info"></em>
                </span>
            </div>

            <div id="question-edit-{{ $question->id }}" class="question-edit d-none">
                <form class="edit-question-form" action="{{ route('dashboard.quiz-questions.update', $question->id) }}">
                    @method('PUT')

                    <input type="hidden" name="question_id" value="{{ $question->id }}">

                    <div class="d-flex align-items-center">
                        <div class="form-group mb-0">
                            <input class="form-control resizable fs-20px" type="text" name="title" value="{{ $question->title }}" />
                            <div class="invalid-feedback"></div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary ms-1">حفظ</button>

                        <button class="discard-question-btn btn btn-sm btn-danger ms-1" data-question-id="{{ $question->id }}">إلغاء</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex">
            <div class="custom-control custom-switch opacity-1">
                <input
                    type="checkbox" class="toggle-active-question-btn custom-control-input"
                    id="toggle-active-question-{{ $question->id }}" name="active"
                    data-action="{{ route('dashboard.quiz-questions.toggle-active', $question->id) }}"
                    data-question-id="{{ $question->id }}"
                    @checked($question->active)
                >
                <label class="custom-control-label" for="toggle-active-question-{{ $question->id }}"></label>
            </div>

            <span
                class="delete-question-btn cursor-pointer"
                data-question-id="{{ $question->id }}"
                data-action="{{ route('dashboard.quiz-questions.destroy', $question->id) }}"
            >
                <em class="icon ni ni-trash fs-20px text-danger"></em>
            </span>
        </div>
    </div>

    <div class="card-body px-0">
        <ul>
            @foreach ($question->answers as $answer)
                @include('dashboard.pages.quizzes.partials.edit.answer')
            @endforeach

            @include('dashboard.pages.quizzes.partials.edit.add-answer')
        </ul>
    </div>
</div>

@if(! request()->expectsJson())
    @pushOnce('scripts')
        @include('dashboard.pages.quizzes.partials.edit.scripts.edit-question')
        @include('dashboard.pages.quizzes.partials.edit.scripts.toggle-active-question')
        @include('dashboard.pages.quizzes.partials.edit.scripts.delete-question')
    @endPushOnce
@endif
