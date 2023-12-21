@extends('dashboard.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard_theme/assets/css/editors/quill.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/custom/edit-quiz.css') }}?version=1.0.0">
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
        @include('dashboard.pages.quizzes.partials.edit.basic-info')
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

    <script>
        const resizableInputClass = 'input.resizable'
        const deleteQuestionBtnClass = '.delete-question-btn'
        const editQuestionBtnClass = '.edit-question-btn'
        const discardQuestionBtnClass = '.discard-question-btn'
        const saveQuestionBtnClass = '.save-question-btn'
        const addQuestionBtnClass = '.add-question-btn'


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
                    successToast(response.data.message)
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        // Show validation errors
                    } else {
                        errorToast(error.response.data.error)
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

        $('select.select2').each(function() {
            initSelect2($(this))
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
                    successToast(response.data.message)

                    $(`#add-question input[name='title']`).val(null)
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        // Show validation errors
                    } else {
                        errorToast(error.response.data.error)
                    }
                })
                .finally(() => {
                    el.removeClass('disabled')
                })
        })


        /**
         * Helper functions
         */
        function resizeTextInput(input) {
            const el = $(input)
            const charLen = el.val().length
            el.css('width', `${charLen}ch`)
        }

        function showInputValidationError(form, inputName, error) {
            const input = form.find(`[name='${inputName}']`)

            input.addClass('is-invalid')
            input.siblings('.invalid-feedback').text(error)
        }

        function hideFormValidationErrors(form) {
            form.find('.is-invalid').removeClass('is-invalid')
            form.find('.invalid-feedback').text(null)
        }

        function resetForm(form) {
            form.trigger('reset')
            form.find('.select2').val(null).trigger('change')
        }

        function successToast(message) {
            NioApp.Toast(message, 'success', {position: 'top-left'})
        }

        function errorToast(message) {
            NioApp.Toast(message || 'حدث خطأ أثناء العملية', 'error', {position: 'top-left'})
        }

        function initSelect2(el) {
            let options = {}

            options.dir = $('html').attr('lang') == 'ar' ? 'rtl' : 'ltr'
            if (el.attr('data-placeholder')) {
                options.placeholder = el.attr('data-placeholder')
            }

            options.closeOnSelect = false

            el.select2(options)
        }
    </script>
@endpush
