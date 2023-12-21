<script>
    document.querySelectorAll('.quill').forEach(element => {
        const quill = new Quill(element, {
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block', 'link'],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'script': 'sub'}, {'script': 'super'}],
                    [{'indent': '-1'}, {'indent': '+1'}],
                    [{'header': [1, 2, 3, 4, 5, 6]}],
                    [{'color': []}, {'background': []}],
                    [{'font': []}],
                    [{'align': []}],
                    ['clean']
                ]
            },
            theme: 'snow'
        })
        const textarea = element.closest('.form-group').querySelector('textarea')
        quill.on('text-change', function (delta, oldDelta, source) {
            textarea.innerHTML = quill.container.firstChild.innerHTML
        })
    })

    const editInfoForm = $('#edit-info-form')

    editInfoForm.on('submit', function(e) {
        e.preventDefault()

        const el = $(this)
        const submitButton = el.find(`button[type='submit']`)
        const titleInput = el.find(`input[name='title']`)
        const descriptionInput = el.find(`textarea[name='description']`)

        hideFormValidationErrors(el)
        submitButton.addClass('disabled')

        axios.post(el.attr('action'), new FormData(el[0]))
            .then((response) => {
                successToast(response.data.message)
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    let errors = error.response.data.errors

                    for (let name in error.response.data.errors) {
                        if (name == 'description') {
                            // Quill Editor type
                            descriptionInput.siblings('.quill').addClass('is-invalid')
                            descriptionInput.siblings('.invalid-feedback').text(errors['description'][0])
                            descriptionInput.siblings('.ql-toolbar').addClass('is-invalid')
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
