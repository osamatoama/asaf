@extends('dashboard.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard_theme/assets/css/editors/quill.rtl.css') }}">
@endpush

@section('content')
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">تعديل الاختبار #{{ $quiz->id }}</h5>
            </div>
            <div class="card-body">

                {{-- <form method="POST"
                    action="{{ route('dashboard.quizzes.update', $quiz->id) }}"
                    enctype="multipart/form-data"
                >
                    @method('PUT')
                    @csrf --}}

                    <div class="row g-gs">
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

                    <hr>

                    <div class="row g-gs">
                        <h5>الأسئلة والإجابات</h5>

                        @foreach ($quiz->questions as $question)
                            <div class="question-wrapper card mt-2 mb-4 p-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-start flex-grow-1">
                                        <div id="question-show-{{ $question->id }}" class="question-show">
                                            <span class="question-title fs-20px fw-bold">
                                                {{ $question->title }}
                                            </span>

                                            <span
                                                class="edit-question-btn" style="cursor: pointer" data-id="{{ $question->id }}"
                                            >
                                                <em class="icon ni ni-edit fs-20px text-info"></em>
                                            </span>
                                        </div>

                                        <div id="question-edit-{{ $question->id }}" class="question-edit d-flex align-items-center d-none">
                                            <input
                                                class="question-title-input form-control resizable fs-20px" type="text" name="title"
                                                value="{{ $question->title }}" required
                                            />

                                            <button
                                                class="save-question-btn btn btn-sm btn-primary ms-1"
                                                data-id="{{ $question->id }}"
                                                data-action="{{ route('dashboard.quiz-questions.update', $question->id) }}"
                                            >
                                                حفظ
                                            </button>

                                            <button
                                                class="discard-question-btn btn btn-sm btn-danger ms-1"
                                                data-id="{{ $question->id }}"
                                            >
                                                إلغاء
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mx-3">
                                        <span
                                            class="delete-question-btn" style="cursor: pointer"
                                            data-action="{{ route('dashboard.quiz-questions.destroy', $question->id) }}"
                                        >
                                            <em class="icon ni ni-trash fs-20px text-danger"></em>
                                        </span>
                                    </div>
                                </div>

                                <hr>

                                <ul>
                                    @foreach ($question->answers as $answer)
                                        <li class="answer-wrapper my-2">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div id="answer-show-{{ $answer->id }}" class="answer-show">
                                                        <span class="answer-title ms-4 fw-bold fs-16px">{{ $answer->title }}</span>

                                                        <span
                                                            class="edit-answer-btn" style="cursor: pointer" data-id="{{ $answer->id }}"
                                                        >
                                                            <em class="icon ni ni-edit fs-20px text-info"></em>
                                                        </span>

                                                        <span class="answer-description mx-4 d-block text-muted">
                                                            {{ $answer->description }}
                                                        </span>
                                                    </div>

                                                    <div id="answer-edit-{{ $answer->id }}" class="answer-edit d-none">
                                                        <div>
                                                            <input
                                                                class="answer-title-input form-control fs-16px mb-1" type="text" name="title"
                                                                value="{{ $answer->title }}" required
                                                            />

                                                            <textarea class="form-control answer-description-input mb-1" name="description" rows="4">{{ $answer->description }}</textarea>
                                                        </div>

                                                        <div>
                                                            <button
                                                                class="save-answer-btn btn btn-sm btn-primary ms-1"
                                                                data-id="{{ $answer->id }}"
                                                                data-action="{{ route('dashboard.quiz-question-answers.update', $answer->id) }}"
                                                            >
                                                                حفظ
                                                            </button>

                                                            <button
                                                                class="discard-answer-btn btn btn-sm btn-danger ms-1"
                                                                data-id="{{ $answer->id }}"
                                                            >
                                                                إلغاء
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    @forelse($answer->products as $product)
                                                        <a href="{{ route('dashboard.products.show', $product) }}"
                                                        target="_blank"
                                                        class="badge text-white bg-info">
                                                            <span>{{ $product->name }}</span>
                                                        </a>
                                                    @empty
                                                        ---
                                                    @endforelse
                                                </div>
                                                <div class="col-md-2">
                                                    <span
                                                        class="delete-answer-btn" style="cursor: pointer"
                                                        data-action="{{ route('dashboard.quiz-question-answers.destroy', $answer->id) }}"
                                                    >
                                                        <em class="icon ni ni-trash fs-20px text-danger"></em>
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <a href="{{ route('dashboard.quizzes.index') }}"
                            class=" dropdown-toggle btn btn-lg btn-icon btn-warning p-2 text-white">
                                <span>
                                    <em class="ni ni-arrow-left"></em>
                                    {{ trans('global.back_to_list') }}
                                </span>
                            </a>
                            <button class="btn btn-lg btn-success p-2" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </div>
                {{-- </form> --}}

                {{-- <div class="table-responsive">
                    <table class="table table-bordered" style="border-top: 1px solid #d7d7d7">
                        <tbody>
                            <tr>
                                <th>اسم الاختبار</th>
                                <td>{{ $quiz->title }}</td>
                            </tr>
                            <tr>
                                <th>عدد مرّات اجتياز الاختبار</th>
                                <td>{{ $quiz->results_count }}</td>
                            </tr>
                            <tr>
                                <th>الأسئلة والإجابات</th>
                                <td>
                                    <ul>
                                        @foreach ($quiz->questions as $question)
                                            <li class="card mt-2 mb-4 p-2">
                                                <span style="font-size: x-large; font-weight: bold;">{{ $loop->iteration.' - '.$question->title }}</span>
                                                <ul>
                                                    @foreach ($question->answers as $answer)
                                                        <li class="my-2">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <span class="mx-4" style="font-size: medium;">{{ '- '.$answer->title }}</span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    @forelse($answer->products as $product)
                                                                        <a href="{{ route('dashboard.products.show', $product) }}"
                                                                           target="_blank"
                                                                           class="badge text-white bg-info">
                                                                            <span>{{ $product->name }}</span>
                                                                        </a>
                                                                    @empty
                                                                        ---
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div> --}}
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
        const questionTitleInputClass = '.question-title-input'
        const resizableInputClass = 'input.resizable'
        const deleteQuestionBtnClass = '.delete-question-btn'
        const deleteAnswerBtnClass = '.delete-answer-btn'
        const editQuestionBtnClass = '.edit-question-btn'
        const discardQuestionBtnClass = '.discard-question-btn'
        const saveQuestionBtnClass = '.save-question-btn'
        const answerTitleInputClass = '.answer-title-input'
        const editAnswerBtnClass = '.edit-answer-btn'
        const discardAnswerBtnClass = '.discard-answer-btn'
        const saveAnswerBtnClass = '.save-answer-btn'

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

        $(document).on('click', saveQuestionBtnClass, function() {
            const el = $(this)
            const dataId = el.data('id')
            const questionTitle = el.siblings('.question-title-input').val()

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

            $(`#answer-show-${dataId}`).addClass('d-none')
            $(`#answer-edit-${dataId}`).removeClass('d-none')
        })

        $(document).on('click', saveAnswerBtnClass, function() {
            const el = $(this)
            const dataId = el.data('id')
            const answerTitle = $(`#answer-edit-${dataId} .answer-title-input`).val()
            const answerDescription = $(`#answer-edit-${dataId} .answer-description-input`).val()

            el.addClass('disabled')

            let formData = new FormData
            formData.append('_method', 'PUT')
            formData.append('title', answerTitle)
            formData.append('description', answerDescription)

            axios.post(el.data('action'), formData)
                .then((response) => {
                    $(`#answer-show-${dataId}`).find('.answer-title').text(response.data.data.title)
                    $(`#answer-show-${dataId}`).find('.answer-description').text(response.data.data.description)
                    $(`#answer-show-${dataId}`).removeClass('d-none')
                    $(`#answer-edit-${dataId}`).addClass('d-none')
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

            $(`#answer-show-${dataId}`).removeClass('d-none')
            $(`#answer-edit-${dataId}`).addClass('d-none')
        })

        $(document).on('click', deleteQuestionBtnClass, function() {
            const el = $(this)
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
                            el.closest('.question-wrapper').remove()
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
                            el.closest('.answer-wrapper').remove()
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
    </script>
@endpush
