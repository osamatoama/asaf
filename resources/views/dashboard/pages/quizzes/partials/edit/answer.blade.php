<li id="answer-{{ $answer->id }}" class="answer my-2">
    <div class="answer-show row">
        <div class="col-md-3">
            <span class="answer-title ms-4 fw-bold fs-16px">{{ $answer->title }}</span>

            <span class="edit-answer-btn" style="cursor: pointer" data-id="{{ $answer->id }}">
                <em class="icon ni ni-edit fs-20px text-info"></em>
            </span>

            <span class="answer-description mx-4 d-block text-muted">
                {{ $answer->description }}
            </span>
        </div>

        <div class="col-md-7">
            @forelse($answer->products as $product)
                <a href="{{ route('dashboard.products.show', $product) }}"
                target="_blank"
                class="badge text-white bg-info">
                    <span>{{ $product->name }}</span>
                </a>
            @empty
                ---
            @endforelse
        </div>

        <div class="col-md-2">
            <span
                class="delete-answer-btn" style="cursor: pointer"
                data-id="{{ $answer->id }}"
                data-action="{{ route('dashboard.quiz-question-answers.destroy', $answer->id) }}"
            >
                <em class="icon ni ni-trash fs-20px text-danger"></em>
            </span>
        </div>
    </div>


    <div class="answer-edit row d-none">
        <div class="col-md-3">
            <input class="form-control fs-16px mb-1 mx-4" type="text" name="title" value="{{ $answer->title }}" required />

            <textarea class="form-control mb-1 resize-none mx-4" name="description" rows="3">{{ $answer->description }}</textarea>
        </div>

        <div class="col-md-7">
            <div class="form-group">
                <div class="form-control-wrap">
                    <select class="form-select select2" name="product_ids" multiple>
                        @foreach ($productOptions as $productId => $productName)
                            <option value="{{ $productId }}" @selected(in_array($productId, $answer->product_ids))>{{ $productName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <button
                class="save-answer-btn btn btn-sm btn-primary ms-1"
                data-id="{{ $answer->id }}"
                data-action="{{ route('dashboard.quiz-question-answers.update', $answer->id) }}"
            >
                حفظ
            </button>

            <button
                class="discard-answer-btn btn btn-sm btn-danger ms-1"
                data-id="{{ $answer->id }}"
            >
                إلغاء
            </button>
        </div>
    </div>
</li>
