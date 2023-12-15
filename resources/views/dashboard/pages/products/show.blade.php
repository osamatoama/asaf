@extends('dashboard.layouts.app')
@section('content')
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">{{ trans('global.show') . ' ' . trans('cruds.category.title_singular') }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border-top: 1px solid #d7d7d7">
                        <tbody>
                            <tr>
                                <th>{{ trans('cruds.category.fields.id') }}</th>
                                <td>{{ $category -> id }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.category.fields.image') }}</th>
                                <td>
                                    @if($category->image->media ?? false)
                                        <img src="{{ $category->image->thumbnail }}"
                                             class="pointer"
                                             data-src="{{ $category->image->default }}"
                                             data-fancybox
                                             alt="{{ $category->image->media->file_name ?? '' }}"
                                             style="width: 70px; height: 70px; border-radius: 10px;">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.category.fields.title_ar') }}</th>
                                <td>{{ $category -> title_ar }}</td>
                            </tr>
                            {{-- <tr>
                                <th>{{ trans('cruds.category.fields.title_en') }}</th>
                                <td>{{ $category -> title_en }}</td>
                            </tr> --}}
                            <tr>
                                <th>{{ trans('cruds.category.fields.title_tag_ar') }}</th>
                                <td>{{ $category->getSeoTranslation('title_tag', 'ar') }}</td>
                            </tr>
                            {{-- <tr>
                                <th>{{ trans('cruds.category.fields.title_tag_en') }}</th>
                                <td>{{ $category->getSeoTranslation('title_tag', 'en') }}</td>
                            </tr> --}}
                            <tr>
                                <th>{{ trans('cruds.category.fields.description_ar') }}</th>
                                <td>{!! $category->getTranslation('description', 'ar') !!}</td>
                            </tr>
                            {{-- <tr>
                                <th>{{ trans('cruds.category.fields.description_en') }}</th>
                                <td>{!! $category->getTranslation('description', 'en') !!}</td>
                            </tr> --}}
                            <tr>
                                <th>{{ trans('cruds.category.fields.meta_description_ar') }}</th>
                                <td>{!! $category->getSeoTranslation('meta_description', 'ar') !!}</td>
                            </tr>
                            {{-- <tr>
                                <th>{{ trans('cruds.category.fields.meta_description_en') }}</th>
                                <td>{!! $category->getSeoTranslation('meta_description', 'en') !!}</td>
                            </tr> --}}
                            <tr>
                                <th>{{ trans('cruds.seo_tools.meta_robots') }}</th>
                                <td>{{ $category->meta_robots }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('dashboard.categories.index') }}"
                   class="dropdown-toggle btn btn-icon btn-warning p-2 text-white">
                    <span>
                        <em class="ni ni-arrow-left"></em>
                        {{ trans('global.back_to_list') }}
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">{{ trans('cruds.subCategory.title') }}</h5>
            </div>
            <div class="card-body text-center">
                @includeIf('dashboard.pages.categories.partials.sub-categories')
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        initDeleteAction();
    </script>
@endpush
