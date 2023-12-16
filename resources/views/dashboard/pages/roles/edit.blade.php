@extends('dashboard.layouts.app')

@section('content')
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">تعديل إذن</h5>
            </div>
            <form class="form-validate" method="POST"
                  action="{{ route('dashboard.roles.update', $role) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-gs">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="title">
                                اسم الدور
                            </label>
                            <div class="form-control-wrap">
                                <input class="form-control @error('title') is-invalid @enderror"
                                       type="text" name="title"
                                       id="title" value="{{ old('title', $role->title) }}"
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
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label required" for="permissions">
                                الصلاحيات
                            </label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all"
                                      style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all"
                                      style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>

                            <select class="form-control select2-multiple-init @error('permissions') is-invalid @enderror"
                                    name="permissions[]"
                                    id="permissions"
                                    aria-label="Permissions" multiple required>
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}" @if(isSelectedMultiple('permissions', $permission->id, $rolePermissions)) selected @endif>
                                        @lang('dashboard/permissions.'. $permission->title)
                                    </option>
                                @endforeach
                            </select>
                            @error('permissions')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <span class="help-block">&nbsp;</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('dashboard.roles.index') }}"
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
