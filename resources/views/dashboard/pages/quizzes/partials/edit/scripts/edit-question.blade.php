<script>
    const editQuestionFormClass = '.edit-question-form'
    const editQuestionBtnClass = '.edit-question-btn'
    const discardQuestionBtnClass = '.discard-question-btn'

    $(document).on('click', editQuestionBtnClass, function() {
        const el = $(this)
        const questionId = el.data('question-id')

        $(`#question-show-${questionId}`).addClass('d-none')
        $(`#question-edit-${questionId}`).removeClass('d-none')
    })

    $(document).on('submit', editQuestionFormClass, function(e) {
        e.preventDefault()

        const el = $(this)
        const submitButton = el.find(`button[type='submit']`)
        const questionIdInput = el.find(`input[name='question_id']`)
        const titleInput = el.find(`input[name='title']`)
        const questionId = questionIdInput.val()

        hideFormValidationErrors(el)
        submitButton.addClass('disabled')

        axios.post(el.attr('action'), new FormData(el[0]))
            .then((response) => {
                $(`#question-show-${questionId}`).find('.question-title').text(titleInput.val())
                $(`#question-show-${questionId}`).removeClass('d-none')
                $(`#question-edit-${questionId}`).addClass('d-none')
                successToast(response.data.message)
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    let errors = error.response.data.errors

                    for (let name in error.response.data.errors) {
                        showInputValidationError(el, name, errors[name][0])
                    }
                } else {
                    errorToast(error.response.data.error)
                }
            })
            .finally(() => {
                submitButton.removeClass('disabled')
            })
    })

    $(document).on('click', discardQuestionBtnClass, function(e) {
        e.preventDefault()

        const el = $(this)
        const questionId = el.data('question-id')

        $(`#question-show-${questionId}`).removeClass('d-none')
        $(`#question-edit-${questionId}`).addClass('d-none')
    })
</script>
