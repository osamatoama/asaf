<script>
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
</script>
