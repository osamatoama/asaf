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
    @include('dashboard.pages.quizzes.partials.edit.scripts.edit-info')
@endpush
