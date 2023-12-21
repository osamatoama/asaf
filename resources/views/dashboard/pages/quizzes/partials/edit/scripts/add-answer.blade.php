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
