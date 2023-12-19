<li id="add-answer-{{ $question->id }}" class="add-answer my-2">
    <div class="row">
        <div class="col-md-3">
            <input class="form-control fs-16px mb-1 mx-4" type="text" name="title" placeholder="الإجابة" required />

            <textarea class="form-control mb-1 mx-4 resize-none" name="description" placeholder="وصف الإجابة" rows="3"></textarea>
        </div>

        <div class="col-md-7">
            <div class="form-group">
                <div class="form-control-wrap">
                    <select class="form-select select2" name="product_ids" data-placeholder="اختر المنتجات" multiple>
                        @foreach ($productOptions as $productId => $productName)
                            <option value="{{ $productId }}">{{ $productName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <button
                class="add-answer-btn btn btn-sm btn-success ms-1"
                data-question-id="{{ $question->id }}"
                data-action="{{ route('dashboard.quiz-question-answers.store') }}"
            >
                إضافة
            </button>
        </div>
    </div>
</li>
