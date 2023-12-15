@extends('dashboard.layouts.app')

@section('content')
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">{{ __('global.edit') . ' ' . __('cruds.category.title_singular') }}</h5>
            </div>
            <form class="form-validate" method="POST"
                  action="{{ route('dashboard.categories.update', $category) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row g-gs">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="image">
                                {{ trans('cruds.category.fields.image') }}
                            </label>
                            <div class="form-control-wrap">
                                <div class="js-validation" id="image">
                                    <div class="dz-message" data-dz-message>
                                        <span class="dz-message-text">{{ trans('cruds.dropzone') }}</span>
                                        <span class="dz-message-or">{{ trans('cruds.dropOr') }}</span>
                                        <button class="btn btn-primary" type="button">{{ trans('cruds.dropSelect') }}</button>
                                    </div>
                                </div>
                                @error('image')
                                <div style="color: #e85347 !important;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <span class="form-note">
                            {{ trans('cruds.category.fields.image_helper') }}
                        </span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="title_ar">
                                {{ trans('cruds.category.fields.title_ar') }}
                            </label>
                            <div class="form-control-wrap">
                                <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}"
                                       type="text" name="title_ar"
                                       id="title_ar" value="{{ old('title_ar', $category -> title_ar) }}"
                                       required>
                                @error('title_ar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <span class="help-block">{{ trans('cruds.category.fields.title_ar_helper') }}</span>
                        </div>
                    </div>
                    {{-- <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="title_en">
                                {{ trans('cruds.category.fields.title_en') }}
                            </label>
                            <div class="form-control-wrap">
                                <input class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}"
                                       type="text" name="title_en"
                                       id="title_en" value="{{ old('title_en', $category -> title_en) }}"
                                       required>
                                @error('title_en')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <span class="help-block">{{ trans('cruds.category.fields.title_en_helper') }}</span>
                        </div>
                    </div> --}}

                    {{-- <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="title_tag_en">
                                @lang('cruds.category.fields.title_tag_en')
                            </label>
                            <input class="form-control @error('title_tag_en') is-invalid @enderror"
                                   type="text" name="title_tag_en" id="title_tag_en"
                                   value="{{ old('title_tag_en', $category->getSeoTranslation('title_tag', 'en')) }}" required>
                            @error('title_tag_en')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <span class="help-block">
                                @lang('cruds.category.fields.title_tag_en_helper')
                            </span>
                            <br>
                        </div>
                    </div> --}}
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="description_ar">
                                @lang('cruds.category.fields.description_ar')
                            </label>
                            <textarea class="form-control @error('description_ar') is-invalid @enderror"
                                      name="description_ar" id="description_ar"
                            >{!! old('description_ar', $category->getTranslation('description', 'ar')) !!}</textarea>
                            @error('description_ar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <span class="help-block">
                                @lang('cruds.category.fields.description_ar_helper')
                            </span>
                        </div>
                    </div>
                    {{-- <div class="col-md-6 col-sm-12">
                        <div class="form-group ">
                            <label class="form-label required" for="description_en">
                                @lang('cruds.category.fields.description_en')
                            </label>
                            <textarea class="form-control @error('description_en') is-invalid @enderror"
                                      name="description_en" id="description_en"
                                      required>{!! old('description_en', $category->getTranslation('description', 'en')) !!}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <span class="help-block">
                                @lang('cruds.category.fields.description_en_helper')
                            </span>
                        </div>
                    </div> --}}

                    {{-- <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="meta_description_en">
                                @lang('cruds.category.fields.meta_description_en')
                            </label>
                            <textarea class="form-control @error('meta_description_en') is-invalid @enderror"
                                      name="meta_description_en" id="meta_description_en"
                                      required>{!! old('meta_description_en', $category->getSeoTranslation('meta_description', 'en')) !!}</textarea>
                            @error('meta_description_en')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <span class="help-block">
                                @lang('cruds.category.fields.meta_description_en_helper')
                            </span>
                        </div>
                    </div> --}}
                </div>

                <div class="card h-100 my-4">
                    <div class="card-inner">
                        <div class="card-head">
                            <h5 class="card-title">{{ __('cruds.category.advanced_settings') }}</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label class="form-label" for="title_tag_ar">
                                        @lang('cruds.category.fields.title_tag_ar')
                                    </label>
                                    <input class="form-control @error('title_tag_ar') is-invalid @enderror"
                                           type="text" name="title_tag_ar" id="title_tag_ar"
                                           value="{{ old('title_tag_ar', $category->getSeoTranslation('title_tag', 'ar')) }}">
                                    @error('title_tag_ar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <span class="help-block">
                                        @lang('cruds.category.fields.title_tag_ar_helper')
                                    </span>
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="meta_description_ar">
                                        @lang('cruds.category.fields.meta_description_ar')
                                    </label>
                                    <textarea class="form-control @error('meta_description_ar') is-invalid @enderror"
                                              name="meta_description_ar" id="meta_description_ar"
                                    >{!! old('meta_description_ar', $category->getSeoTranslation('meta_description', 'ar')) !!}</textarea>
                                    @error('meta_description_ar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <span class="help-block">
                                        @lang('cruds.category.fields.meta_description_ar_helper')
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 my-3">
                                <div class="form-group">
                                    <label class="form-label">
                                        @lang('cruds.seo_tools.meta_robots')
                                    </label>
                                    <div class="d-flex flex-wrap h-100 py-2 px-0" style="column-gap: 60px; row-gap: 20px;">
                                        <div class="form-check form-switch p-0 d-flex align-items-center gap-2 h-100">
                                            <span class="fs-6">NoIndex</span>
                                            <input class="form-check-input ms-0" type="checkbox" role="switch" id="meta_robots_index" style="width: 3em !important; height: 1.5em !important;">
                                            <span class="fs-6">Index</span>
                                        </div>
                                        <div class="form-check form-switch p-0 d-flex align-items-center gap-2 h-100">
                                            <span class="fs-6">NoFollow</span>
                                            <input class="form-check-input ms-0" type="checkbox" role="switch" id="meta_robots_follow" style="width: 3em !important; height: 1.5em !important;">
                                            <span class="fs-6">Follow</span>
                                        </div>
                                    </div>
                                    <input type="hidden" class=" @error('meta_robots') is-invalid @enderror" id="meta_robots" name="meta_robots" value="{{old('meta_robots', \Illuminate\Support\Str::replace(',','-',$category->meta_robots) ) }}">
                                    @error('meta_robots')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-inner">
                        <div class=" show-in-navbar-container d-flex flex-wrap align-items-center gap-4 h-100 ">
                            <div class="row col-md-12">
                                <div class="mb-0 col-md-6 col-sm-12">
                                    <label class="form-label" for="show_in_navbar">
                                        @lang('cruds.category.fields.show_in_navbar_status')
                                    </label>
                                    <div class="form-check @error('show_in_navbar') is-invalid @enderror">
                                        <input type="checkbox" name="show_in_navbar" id="show_in_navbar"
                                               class="form-check-input"
                                               value="1" @if(old('show_in_navbar', $category->show_in_navbar)) checked @endif>
                                        <label for="show_in_navbar">
                                            @lang('cruds.category.fields.show_in_navbar')
                                        </label>
                                    </div>
                                    @error('show_in_navbar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <span class="help-block">
                                        @lang('cruds.category.fields.show_in_navbar_helper')
                                    </span>
                                </div>
                                <div @class(['category-order-container mb-0 col-md-6 col-sm-12', 'd-none' => !old('show_in_navbar', $category->show_in_navbar)])>
                                    <label class="form-label required" for="order">
                                        {{ trans('cruds.category.fields.order') }}
                                    </label>
                                    <div class="form-control-wrap">
                                        <input class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" type="number" value="{{ $order }}" min="1" name="order" id="order" required>
                                        @error('order')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <span class="help-block">{{ trans('cruds.category.fields.order_helper') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <a href="{{ route('dashboard.categories.index') }}"
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
    <script src="{{ asset('assets/dashboard/js/main/meta-robots.js') }}"></script>
    <script>
        let form = $('form')

        initDropzone('#image', {
            maxFilesize: 4,
            acceptedFiles: '.jpeg,.jpg,.png,.webp',
            maxFiles: 1,
            params: {
                size: 4,
                mimes: 'jpeg,jpg,png,webp',
                width: parseInt('{{ \App\Models\Category::RECOMMENDED_WIDTH }}'),
                height: parseInt('{{ \App\Models\Category::RECOMMENDED_HEIGHT }}'),
            },
            init: function () {
                @if($category->image->media ?? false)
                let file = {
                    name: '{{ $category->image->media->file_name ?? '' }}',
                    thumbnail: '{{ $category->image->thumbnail ?? '' }}',
                    size: '{{ $category->image->media->size ?? '' }}'
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

        document.getElementById('show_in_navbar').addEventListener('change', function () {
            this.closest('.show-in-navbar-container').querySelector('.category-order-container').classList.toggle('d-none')
        })

        document.getElementById('meta_robots_index').addEventListener('change', () => {
            switchMetaRobotsHandler()
        })

        document.getElementById('meta_robots_follow').addEventListener('change', () => {
            switchMetaRobotsHandler()
        })

        setMetaRobotsValue()
    </script>
@endpush
