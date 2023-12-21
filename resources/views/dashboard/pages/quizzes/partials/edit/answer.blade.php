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
                <span class="badge text-white bg-info">{{ $product->name }}</span>
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

            <div class="col-md-7">
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
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-sm btn-primary ms-1">حفظ</button>

                <button class="discard-answer-btn btn btn-sm btn-danger ms-1" data-answer-id="{{ $answer->id }}">إلغاء</button>
            </div>
        </div>
    </form>
</li>

@pushOnce('scripts')
    <script>

        /**
         * Edit Answer
         */
        const editAnswerBtnClass = '.edit-answer-btn'
        const editAnswerFormClass = '.edit-answer-form'
        const discardAnswerBtnClass = '.discard-answer-btn'

        $(document).on('submit', editAnswerFormClass, function(e) {
            e.preventDefault()

            const el = $(this)
            const submitButton = el.find(`button[type='submit']`)
            const answerIdInput = el.find(`input[name='answer_id']`)
            const titleInput = el.find(`input[name='title']`)
            const descriptionInput = el.find(`textarea[name='description']`)
            const productIdsInput = el.find(`select[name='product_ids\\[\\]']`)
            const answerId = answerIdInput.val()

            hideFormValidationErrors(el)
            submitButton.addClass('disabled')

            axios.post(el.attr('action'), new FormData(el[0]))
                .then((response) => {
                    $(`#answer-${answerId}`).replaceWith(response.data.data.html)
                    initSelect2($(`#answer-${answerId}`).find('.select2'))
                    $(`#answer-${answerId} .answer-edit`).addClass('d-none')
                    successToast(response.data.message)
                    resetForm(el)
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        let errors = error.response.data.errors

                        for (let name in error.response.data.errors) {
                            if (name.includes('product_ids')) {
                                // Select2 type
                                productIdsInput.addClass('is-invalid')
                                productIdsInput.siblings('.select2').find('.select2-selection').addClass('is-invalid')
                                productIdsInput.siblings('.invalid-feedback').text(errors[name][0])
                            } else {
                                // Default input types
                                showInputValidationError(el, name, errors[name][0])
                            }
                        }
                    } else {
                        errorToast(error.response.data.error)
                    }
                })
                .finally(() => {
                    submitButton.removeClass('disabled')
                })
        })

        $(document).on('click', editAnswerBtnClass, function() {
            const el = $(this)
            const answerId = el.data('answer-id')

            $(`#answer-${answerId} .answer-show`).addClass('d-none')
            $(`#answer-${answerId} .answer-edit`).removeClass('d-none')
        })

        $(document).on('click', discardAnswerBtnClass, function(e) {
            e.preventDefault()

            const el = $(this)
            const answerId = el.data('answer-id')

            $(`#answer-${answerId} .answer-show`).removeClass('d-none')
            $(`#answer-${answerId} .answer-edit`).addClass('d-none')
        })


        /**
         * Delete Answer
         */
        const deleteAnswerBtnClass = '.delete-answer-btn'

        $(document).on('click', deleteAnswerBtnClass, function() {
            const el = $(this)
            const answerId = el.data('answer-id')

            el.addClass('disabled')

            Swal.fire({
                title: 'هل أنت متأكد من حذف الإجابة',
                text: 'سيتم حذف المنتجات التابعة للإجابة أيضاً',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'تراجع',
                confirmButtonText: 'تأكيد الحذف',
            }).then(function (result) {
                if (result.value) {

                    let formData = new FormData
                    formData.append('_method', 'DELETE')

                    axios.post(el.data('action'), formData)
                        .then((response) => {
                            $(`#answer-${answerId}`).remove()
                            successToast(response.data.message)
                        })
                        .catch((error) => {
                            el.removeClass('disabled')
                            errorToast(error.response.data.error)
                        })
                } else {
                    el.removeClass('disabled')
                }
            })
        })
    </script>
@endpushOnce
