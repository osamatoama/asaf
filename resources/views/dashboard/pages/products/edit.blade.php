@extends('dashboard.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard_theme/assets/css/editors/quill.rtl.css') }}">
@endpush
@section('content')
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">تعديل منتج</h5>
            </div>
            <form class="form-validate" method="POST"
                  action="{{ route('dashboard.products.update', $product) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row g-gs">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="name">
                                اسم المنتج
                            </label>
                            <div class="form-control-wrap">
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       type="text" name="name"
                                       id="name" value="{{ old('name', $product->name) }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <span class="help-block">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="gender_id">
                                النوع
                            </label>
                            <div class="form-control-wrap">
                                <select class="form-control select2-init @error('gender_id') is-invalid @enderror"
                                        name="gender_id" id="gender_id"
                                        required>
                                    @foreach($genders as $id => $entry)
                                        <option value="{{ $id }}" {{ ((int)old('gender_id', $product->gender_id)) === $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @error('gender_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <span class="help-block">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="url">
                                رابط المنتج (URL)
                            </label>
                            <div class="form-control-wrap">
                                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}"
                                       type="text" name="url"
                                       id="url" value="{{ old('url', $product->url) }}"
                                       required>
                                @error('url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <span class="help-block">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="description">
                                وصف المنتج
                            </label>
                            <div class="form-control-wrap">
                                <textarea class="d-none" id="description"
                                          name="description">{!! old('description', $product->description) !!}</textarea>
                                <div @class(['quill form-control', 'is-invalid' => $errors->has('description')])>{!! old('description', $product->description) !!}</div>
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
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="image_url">
                                رابط صورة المنتج (URL)
                            </label>
                            <div class="form-control-wrap">
                                <input class="form-control {{ $errors->has('image_url') ? 'is-invalid' : '' }}"
                                       type="text" name="image_url"
                                       id="image_url" value="{{ old('image_url', $product->image_url) }}"
                                >
                                @error('image_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <span class="help-block">&nbsp;</span>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="image">
                                أو ارفع صورة
                            </label>
                            <div class="form-control-wrap">
                                <div class="js-validation" id="image">
                                    <div class="dz-message" data-dz-message>
                                        <span class="dz-message-text">اسحب وارفع المِلَفّ</span>
                                        <span class="dz-message-or">أو</span>
                                        <button class="btn btn-primary" type="button">اختر</button>
                                    </div>
                                </div>
                                @error('image')
                                <div style="color: #e85347 !important; font-size: small;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <span class="form-note">
                                &nbsp;
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <a href="{{ route('dashboard.products.index') }}"
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
            </form>
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
        let form = $('form')

        initDropzone('#image', {
            maxFilesize: 8,
            acceptedFiles: '.jpeg,.jpg,.png,.webp',
            maxFiles: 1,
            params: {
                size: 8,
                mimes: 'jpeg,jpg,png,webp',
                width: parseInt('{{ \App\Models\Product::RECOMMENDED_WIDTH }}'),
                height: parseInt('{{ \App\Models\Product::RECOMMENDED_HEIGHT }}'),
            },
            init: function () {
                @if($product->image->media ?? false)
                    let file = {
                        name: '{{ $product->image->media->file_name ?? '' }}',
                        thumbnail: '{{ $product->image->thumbnail ?? '' }}',
                        size: '{{ $product->image->media->size ?? '' }}'
                    }
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.thumbnail)
                    file.previewElement.classList.add('dz-complete')
                    form.append(`<input type="hidden" name="image" value="${file.name}">`)
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
        }, (file) => {
            form.find('input[name="image"]').remove()
        }, (file, response, _this) => {
            form.find('input[name="image"]').remove()
            form.append(`<input type="hidden" name="image" value="${response.name}">`)
        })
    </script>
@endpush
