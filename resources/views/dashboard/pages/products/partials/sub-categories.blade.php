<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
        </div>
        @can( config('models.sub-category.permissions.create') )
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu">
                        <em class="icon ni ni-menu-alt-r"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a href="{{ route('dashboard.sub-categories.create') }}"
                                   class="ajax-modal-btn dropdown-toggle btn btn-icon btn-primary p-2 text-white"
                                   data-link="">
                                    <span><em class="icon ni ni-plus"></em>
                                        {{ __('global.add') . ' ' . __('cruds.subCategory.title_singular') }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endcan
    </div>
</div>

<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border-top: 1px solid #d7d7d7">
                        <thead>
                            <tr>
                                <th class="text-center">{{ trans('cruds.subCategory.fields.id') }}</th>
                                <th>{{ trans('cruds.subCategory.fields.image') }}</th>
                                <th>{{ trans('cruds.subCategory.fields.longitudinal_image') }}</th>
                                <th>{{ trans('cruds.subCategory.fields.landscape_image') }}</th>
                                <th>{{ trans('cruds.subCategory.fields.title_ar') }}</th>
                                <th>{{ trans('cruds.subCategory.fields.title_en') }}</th>
                                <th class="text-center">{{ trans('global.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subCategories = $category->subCategories as $key => $subCategory)
                                <tr data-entry-id="{{ $subCategory->id }}">
                                    <td>
                                        {{ $subCategory->id ?? '' }}
                                    </td>
                                    <td>
                                        @if($subCategory->image->media ?? false)
                                            <img src="{{ $subCategory->image->thumbnail ?? '' }}"
                                                 alt="{{ $subCategory->image->media->file_name ?? '' }}"
                                                 data-src="{{ $subCategory->image->default }}"
                                                 data-fancybox="gallery-{{ $subCategory->id }}"
                                                 class="pointer" width="60px" height="60px">
                                        @endif
                                    </td>
                                    <td>
                                        @if($subCategory->longitudinal_image->media ?? false)
                                            <img src="{{ $subCategory->longitudinal_image->thumbnail ?? '' }}"
                                                 class="pointer"
                                                 data-src="{{ $subCategory->longitudinal_image->default }}"
                                                 data-fancybox="gallery-{{ $subCategory->id }}"
                                                 alt="{{ $subCategory->longitudinal_image->media->file_name ?? '' }}"
                                                 width="60px" height="60px">
                                        @endif
                                    </td>
                                    <td>
                                        @if($subCategory->landscape_image->media ?? false)
                                            <img src="{{ $subCategory->landscape_image->thumbnail ?? '' }}"
                                                 data-src="{{ $subCategory->landscape_image->default }}"
                                                 data-fancybox="gallery-{{ $subCategory->id }}"
                                                 alt="{{ $subCategory->landscape_image->media->file_name ?? '' }}"
                                                 class="pointer" width="60px" height="60px">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $subCategory->title_en ?? '' }}
                                    </td>
                                    <td>
                                        {{ $subCategory->title_ar ?? '' }}
                                    </td>
                                    <td>
                                        @can( config('models.sub-category.permissions.show') )
                                            <a class="btn btn-xs btn-primary"
                                               href="{{ route('dashboard.sub-categories.show', $subCategory) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                        @endcan

                                        @can( config('models.sub-category.permissions.edit') )
                                            <a class="btn btn-xs btn-info"
                                               href="{{ route('dashboard.sub-categories.edit', $subCategory) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan

                                        @can( config('models.sub-category.permissions.delete') )
                                            <a href="{{ route('dashboard.categories.destroy.sub-category', ['category' => $category, 'sub_category' => $subCategory]) }}"
                                               class="delete-btn btn btn-xs btn-danger">
                                                {{ trans('global.delete') }}
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        {{ trans('cruds.subCategory.no_records') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
