@extends('dashboard.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard_theme/assets/css/editors/quill.rtl.css') }}">
    <style>
        textarea.resize-none {
            resize: none;
            min-height: initial;
        }
        input.resizable {
            min-width: 16ch;
        }
    </style>
@endpush

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">تعديل الاختبار #{{ $quiz->id }}</h3>
            </div>

            <div class="nk-block-head-content">
                <a href="{{ route('dashboard.quizzes.index') }}" class="btn btn-lg btn-icon btn-warning p-2 text-white">
                    <span>
                        <em class="ni ni-arrow-right"></em>
                        {{ trans('global.back_to_list') }}
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card h-100">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">البيانات</h5>

                    <button class="save-info-btn btn btn-icon btn-primary text-white px-2 py-1" data-action="{{ route('dashboard.quizzes.update', $quiz->id) }}">
                        حفظ البيانات
                    </button>
                </div>

                <hr>

                <div class="card-body">
                    <div id="quiz-info" class="row g-gs">
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label class="form-label required" for="title">
                                    اسم الاختبار
                                </label>
                                <div class="form-control-wrap">
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        type="text" name="title"
                                        id="title" value="{{ $quiz->title }}"
                                        required>
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <span class="help-block">&nbsp;</span>
                            </div>
                        </div>

                        <div class="col-12 mt-1">
                            <div class="form-group">
                                <label class="form-label required" for="description">
                                    وصف الاختبار
                                </label>
                                <div class="form-control-wrap">
                                    <textarea class="d-none" id="description"
                                                name="description">{!! $quiz->description !!}</textarea>
                                    <div @class(['quill form-control', 'is-invalid' => $errors->has('description')])>{!! $quiz->description !!}</div>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <span class="help-block">
                                    &nbsp;
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card h-100">
            <div class="card-inner">
                <div class="card-head">
                    <h5 class="card-title">الأسئلة والإجابات</h5>
                </div>

                <hr>

                <div class="card-body">
                    <div class="row g-gs">
                        @foreach ($quiz->questions as $question)
                            @include('dashboard.pages.quizzes.partials.edit.question')
                        @endforeach

                        @include('dashboard.pages.quizzes.partials.edit.add-question')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('dashboard.partials.scripts.quill')

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
    </script>

    <script>
        const quizInfo = $('#quiz-info')
        const saveInfoBtnClass = '.save-info-btn'
        const resizableInputClass = 'input.resizable'
        const deleteQuestionBtnClass = '.delete-question-btn'
        const deleteAnswerBtnClass = '.delete-answer-btn'
        const editQuestionBtnClass = '.edit-question-btn'
        const discardQuestionBtnClass = '.discard-question-btn'
        const saveQuestionBtnClass = '.save-question-btn'
        const editAnswerBtnClass = '.edit-answer-btn'
        const discardAnswerBtnClass = '.discard-answer-btn'
        const saveAnswerBtnClass = '.save-answer-btn'
        const addQuestionBtnClass = '.add-question-btn'
        const addAnswerBtnClass = '.add-answer-btn'

        function resizeTextInput(input) {
            const el = $(input)
            const charLen = el.val().length
            el.css('width', `${charLen}ch`)
        }

        $(document).ready(function() {
            $(resizableInputClass).each((i, el) => {
                resizeTextInput(el)
            })
        })

        $(document).on('keydown', resizableInputClass, function() {
            resizeTextInput(this)
        })

        $(document).on('click', editQuestionBtnClass, function() {
            const el = $(this)
            const dataId = el.data('id')

            $(`#question-show-${dataId}`).addClass('d-none')
            $(`#question-edit-${dataId}`).removeClass('d-none')
        })

        $(document).on('click', saveInfoBtnClass, function() {
            const el = $(this)
            const quizTitle = $(`#quiz-info input[name='title']`).val()
            const quizDescription = $(`#quiz-info textarea[name='description']`).val()

            el.addClass('disabled')

            let formData = new FormData
            formData.append('_method', 'PUT')
            formData.append('title', quizTitle)
            formData.append('description', quizDescription)

            axios.post(el.data('action'), formData)
                .then((response) => {
                    NioApp.Toast(response.data.message, 'success', {position: 'top-left'})
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        // Show validation errors
                    } else {
                        NioApp.Toast(error.response.data.error || 'حدث خطأ أثناء العملية', 'error', {position: 'top-left'})
                    }
                })
                .finally(() => {
                    el.removeClass('disabled')
                })
        })

        $(document).on('click', saveQuestionBtnClass, function() {
            const el = $(this)
            const dataId = el.data('id')
            const questionTitle = $(`#question-${dataId} input[name='title']`).val()

            el.addClass('disabled')

            let formData = new FormData
            formData.append('_method', 'PUT')
            formData.append('title', questionTitle)

            axios.post(el.data('action'), formData)
                .then((response) => {
                    $(`#question-show-${dataId}`).find('.question-title').text(questionTitle)
                    $(`#question-show-${dataId}`).removeClass('d-none')
                    $(`#question-edit-${dataId}`).addClass('d-none')
                    NioApp.Toast(response.data.message, 'success', {position: 'top-left'})
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        // Show validation errors
                    } else {
                        NioApp.Toast(error.response.data.error || 'حدث خطأ أثناء العملية', 'error', {position: 'top-left'})
                    }
                })
                .finally(() => {
                    el.removeClass('disabled')
                })
        })

        $(document).on('click', discardQuestionBtnClass, function() {
            const el = $(this)
            const dataId = el.data('id')

            $(`#question-show-${dataId}`).removeClass('d-none')
            $(`#question-edit-${dataId}`).addClass('d-none')
        })

        $(document).on('click', editAnswerBtnClass, function() {
            const el = $(this)
            const dataId = el.data('id')

            $(`#answer-${dataId} .answer-show`).addClass('d-none')
            $(`#answer-${dataId} .answer-edit`).removeClass('d-none')
        })

        $(document).on('click', saveAnswerBtnClass, function() {
            const el = $(this)
            const dataId = el.data('id')
            const answerTitle = $(`#answer-${dataId} .answer-edit input[name='title']`).val()
            const answerDescription = $(`#answer-${dataId} .answer-edit textarea[name='description']`).val()
            const answerProductIds = $(`#answer-${dataId} .answer-edit select[name='product_ids']`).val()

            el.addClass('disabled')

            let formData = new FormData
            formData.append('_method', 'PUT')
            formData.append('title', answerTitle)
            formData.append('description', answerDescription)
            formData.append('product_ids', answerProductIds)

            axios.post(el.data('action'), formData)
                .then((response) => {
                    $(`#answer-${dataId}`).replaceWith(response.data.data.html)
                    initSelect2($(`#answer-${dataId}`).find('.select2'))
                    $(`#answer-${dataId} .answer-edit`).addClass('d-none')
                    NioApp.Toast(response.data.message, 'success', {position: 'top-left'})
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        // Show validation errors
                    } else {
                        NioApp.Toast(error.response.data.error || 'حدث خطأ أثناء العملية', 'error', {position: 'top-left'})
                    }
                })
                .finally(() => {
                    el.removeClass('disabled')
                })
        })

        $(document).on('click', discardAnswerBtnClass, function() {
            const el = $(this)
            const dataId = el.data('id')

            $(`#answer-${dataId} .answer-show`).removeClass('d-none')
            $(`#answer-${dataId} .answer-edit`).addClass('d-none')
        })

        $(document).on('click', deleteQuestionBtnClass, function() {
            const el = $(this)
            const questionId = el.data('id')
            el.addClass('disabled')

            Swal.fire({
                title: 'هل أنت متأكد من حذف السؤال؟',
                text: 'سيتم حذف الإجابات والمنتجات التابعة للسؤال أيضاً',
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
                            $(`#question-${questionId}`).remove()
                            NioApp.Toast(response.data.message, 'success', {position: 'top-left'})
                        })
                        .catch((error) => {
                            el.removeClass('disabled')
                            NioApp.Toast(error.response.data.error || 'حدث خطأ أثناء العملية', 'error', {position: 'top-left'})
                        })
                } else {
                    el.removeClass('disabled')
                }
            })
        })

        $(document).on('click', deleteAnswerBtnClass, function() {
            const el = $(this)
            const dataId = el.data('id')

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
                            $(`#answer-${dataId}`).remove()
                            NioApp.Toast(response.data.message, 'success', {position: 'top-left'})
                        })
                        .catch((error) => {
                            el.removeClass('disabled')
                            NioApp.Toast(error.response.data.error || 'حدث خطأ أثناء العملية', 'error', {position: 'top-left'})
                        })
                } else {
                    el.removeClass('disabled')
                }
            })
        })

        $('select.select2').each(function() {
            initSelect2($(this))
        })

        function initSelect2(el) {
            let options = {}

            options.dir = $('html').attr('lang') == 'ar' ? 'rtl' : 'ltr'
            if (el.attr('data-placeholder')) {
                options.placeholder = el.attr('data-placeholder')
            }

            el.select2(options)
        }

        $(document).on('click', addAnswerBtnClass, function() {
            const el = $(this)
            const questionId = el.data('question-id')
            const answerTitle = $(`#add-answer-${questionId} input[name='title']`).val()
            const answerDescription = $(`#add-answer-${questionId} textarea[name='description']`).val()
            const answerProductIds = $(`#add-answer-${questionId} select[name='product_ids']`).val()

            el.addClass('disabled')

            let formData = new FormData
            formData.append('quiz_question_id', questionId)
            formData.append('title', answerTitle)
            formData.append('description', answerDescription)
            formData.append('product_ids', answerProductIds)

            axios.post(el.data('action'), formData)
                .then((response) => {
                    $(response.data.data.html).insertBefore(`#add-answer-${questionId}`)
                    initSelect2($(`#answer-${response.data.data.id}`).find('.select2'))
                    NioApp.Toast(response.data.message, 'success', {position: 'top-left'})

                    $(`#add-answer-${questionId} input[name='title']`).val(null)
                    $(`#add-answer-${questionId} textarea[name='description']`).val(null)
                    $(`#add-answer-${questionId} select[name='product_ids']`).val(null)
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        // Show validation errors
                    } else {
                        NioApp.Toast(error.response.data.error || 'حدث خطأ أثناء العملية', 'error', {position: 'top-left'})
                    }
                })
                .finally(() => {
                    el.removeClass('disabled')
                })
        })

        $(document).on('click', addQuestionBtnClass, function() {
            const el = $(this)
            const quizId = el.data('quiz-id')
            const questionTitle = $(`#add-question input[name='title']`).val()

            el.addClass('disabled')

            let formData = new FormData
            formData.append('quiz_id', quizId)
            formData.append('title', questionTitle)

            axios.post(el.data('action'), formData)
                .then((response) => {
                    $(response.data.data.html).insertBefore(`#add-question`)
                    initSelect2($(`#question-${response.data.data.id}`).find('.select2'))
                    NioApp.Toast(response.data.message, 'success', {position: 'top-left'})

                    $(`#add-question input[name='title']`).val(null)
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        // Show validation errors
                    } else {
                        NioApp.Toast(error.response.data.error || 'حدث خطأ أثناء العملية', 'error', {position: 'top-left'})
                    }
                })
                .finally(() => {
                    el.removeClass('disabled')
                })
        })
    </script>
@endpush
