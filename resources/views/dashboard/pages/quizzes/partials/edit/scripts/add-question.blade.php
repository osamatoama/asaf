<script>
    const addQuestionForm = $('#add-question-form')

    addQuestionForm.on('submit', function(e) {
        e.preventDefault()

        const el = $(this)
        const submitButton = el.find(`button[type='submit']`)
        const quizIdInput = el.find(`input[name='quiz_id']`)
        const titleInput = el.find(`input[name='title']`)

        hideFormValidationErrors(el)
        submitButton.addClass('disabled')

        axios.post(el.attr('action'), new FormData(el[0]))
            .then((response) => {
                $(response.data.data.html).insertBefore(`#add-question`)
                initSelect2($(`#question-${response.data.data.id}`).find('.select2'))
                successToast(response.data.message)
                resetForm(el)
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    let errors = error.response.data.errors

                    for (let name in error.response.data.errors) {
                        showInputValidationError(el, name, errors[name][0])
                    }
                } else {
                    errorToast(error.response.data.message)
                }
            })
            .finally(() => {
                submitButton.removeClass('disabled')
            })
    })
</script>
