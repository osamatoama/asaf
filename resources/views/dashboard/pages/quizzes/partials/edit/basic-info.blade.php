<form id="edit-info-form" action="{{ route('dashboard.quizzes.update', $quiz->id) }}">
    @method('PUT')

    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title mb-0">البيانات</h5>

                <button type="submit" class="save-info-btn btn btn-icon btn-primary text-white px-2 py-1">
                    حفظ البيانات
                </button>
            </div>

            <hr>

            <div class="card-body">
                <div id="quiz-info" class="row g-gs">
                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <label class="form-label required">اسم الاختبار</label>
                            <div class="form-control-wrap">
                                <input class="form-control" type="text" name="title" value="{{ $quiz->title }}">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <label class="form-label required">وصف الاختبار</label>
                            <div class="form-control-wrap">
                                <textarea class="d-none" name="description">{!! $quiz->description !!}</textarea>
                                <div @class(['quill form-control'])>{!! $quiz->description !!}</div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
    @include('dashboard.partials.scripts.quill')

    <script>
        /**
         * Init libs
         */
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

        /**
         * Handle Form
         */
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
@endpush
