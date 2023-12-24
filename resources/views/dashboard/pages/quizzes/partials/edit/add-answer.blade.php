<li id="add-answer-{{ $question->id }}" class="add-answer my-2">
    <form class="add-answer-form" action="{{ route('dashboard.quiz-question-answers.store') }}">

        <input type="hidden" name="quiz_question_id" value="{{ $question->id }}">

        <div class="row">
            <div class="col-md-3">
                <div class="form-group ms-4 mb-1">
                    <input class="form-control fs-16px" type="text" name="title" placeholder="الإجابة" />
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group ms-4 mb-1">
                    <textarea class="form-control resize-none" name="description" placeholder="وصف الإجابة" rows="3"></textarea>
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="form-group">
                    <div class="form-control-wrap">
                        <select class="form-select select2" name="product_ids[]" data-placeholder="اختر المنتجات" multiple>
                            @foreach ($productOptions as $productId => $productName)
                                <option value="{{ $productId }}">{{ $productName }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-sm btn-outline-success ms-1">
                    <em class="icon ni ni-plus-circle-fill me-1"></em>
                    إضافة
                </button>
            </div>
        </div>
    </form>
</li>

@if(! request()->expectsJson())
    @pushOnce('scripts')
        @include('dashboard.pages.quizzes.partials.edit.scripts.add-answer')
    @endpushOnce
@endif
