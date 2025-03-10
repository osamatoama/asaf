<form id="edit-info-form" action="{{ route('dashboard.quizzes.update', $quiz->id) }}">
    @method('PUT')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="card-title mb-0">البيانات</h5>

            <button type="submit" class="save-info-btn btn btn-outline-success">
                <em class="icon ni ni-save me-1"></em>
                حفظ
            </button>
        </div>

        <div class="card-inner">
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

                    <div class="col-12 mt-3">
                        <div class="custom-control custom-control-lg custom-switch">
                            <input type="checkbox" class="custom-control-input" id="quiz-info-active" name="active" @checked($quiz->active)>
                            <label class="custom-control-label" for="quiz-info-active">تفعيل الاختبار</label>
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
