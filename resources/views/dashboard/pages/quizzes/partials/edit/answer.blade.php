<li id="answer-{{ $answer->id }}" class="answer my-2">
    <div class="answer-show row">
        <div class="col-md-3">
            <div class="d-flex align-items-center">
                <span class="answer-title ms-4 me-1 fw-bold fs-16px">{{ $answer->title }}</span>

                <span class="edit-answer-btn cursor-pointer" data-answer-id="{{ $answer->id }}">
                    <em class="icon ni ni-edit fs-20px text-info"></em>
                </span>
            </div>

            <div class="answer-description mx-4 text-muted">
                {{ $answer->description }}
            </div>
        </div>

        <div class="col-md-7">
            @forelse($answer->products as $product)
                <span class="badge bg-outline-primary">{{ $product->name }}</span>
            @empty
                ---
            @endforelse
        </div>

        <div class="col-md-2">
            <span
                class="delete-answer-btn cursor-pointer"
                data-answer-id="{{ $answer->id }}"
                data-action="{{ route('dashboard.quiz-question-answers.destroy', $answer->id) }}"
            >
                <em class="icon ni ni-trash fs-20px text-danger"></em>
            </span>
        </div>
    </div>

    <form class="edit-answer-form" action="{{ route('dashboard.quiz-question-answers.update', $answer->id) }}">
        @method('PUT')

        <input type="hidden" name="answer_id" value="{{ $answer->id }}">

        <div class="answer-edit row d-none">
            <div class="col-md-3">
                <div class="form-group ms-4 mb-1">
                    <input class="form-control fs-16px" type="text" name="title" value="{{ $answer->title }}" />
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group ms-4 mb-1">
                    <textarea class="form-control resize-none" name="description" rows="3">{{ $answer->description }}</textarea>
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            {{-- TEMP: Fix and bring input back --}}
            <div class="col-md-7">
                @forelse($answer->products as $product)
                    <span class="badge bg-outline-primary">{{ $product->name }}</span>
                @empty
                    ---
                @endforelse
            </div>

            {{-- <div class="col-md-7">
                <div class="form-group">
                    <div class="form-control-wrap">
                        <select class="form-select select2" name="product_ids[]" data-placeholder="اختر المنتجات" multiple>
                            @foreach ($productOptions as $productId => $productName)
                                <option value="{{ $productId }}" @selected(in_array($productId, $answer->product_ids))>{{ $productName }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div> --}}

            <div class="col-md-2">
                <button type="submit" class="btn btn-sm btn-outline-success ms-1 mb-1">
                    <em class="icon ni ni-save me-1"></em>
                    حفظ
                </button>

                <button class="discard-answer-btn btn btn-sm btn-outline-danger ms-1 mb-1" data-answer-id="{{ $answer->id }}">
                    <em class="icon ni ni-cross me-1"></em>
                    إلغاء
                </button>
            </div>
        </div>
    </form>
</li>

@if(! request()->expectsJson())
    @pushOnce('scripts')
        @include('dashboard.pages.quizzes.partials.edit.scripts.edit-answer')
        @include('dashboard.pages.quizzes.partials.edit.scripts.delete-answer')
    @endpushOnce
@endif
