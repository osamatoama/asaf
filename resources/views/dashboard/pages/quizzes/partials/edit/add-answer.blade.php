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
                <button type="submit" class="btn btn-sm btn-success ms-1" data-question-id="{{ $question->id }}">إضافة</button>
            </div>
        </div>
    </form>
</li>

@pushOnce('scripts')
    <script>
        const addAnswerFormClass = '.add-answer-form'

        $(document).on('submit', addAnswerFormClass, function(e) {
            e.preventDefault()

            const el = $(this)
            const submitButton = el.find(`button[type='submit']`)
            const questionIdInput = el.find(`input[name='quiz_question_id']`)
            const titleInput = el.find(`input[name='title']`)
            const descriptionInput = el.find(`textarea[name='description']`)
            const productIdsInput = el.find(`select[name='product_ids\\[\\]']`)
            const questionId = questionIdInput.val()
            console.log(productIdsInput.val())

            hideFormValidationErrors(el)
            submitButton.addClass('disabled')

            axios.post(el.attr('action'), new FormData(el[0]))
                .then((response) => {
                    $(response.data.data.html).insertBefore(`#add-answer-${questionId}`)
                    initSelect2($(`#answer-${response.data.data.id}`).find('.select2'))
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
    </script>
@endpushOnce
