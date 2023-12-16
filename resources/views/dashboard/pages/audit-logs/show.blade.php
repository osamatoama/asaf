@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    @lang('global.show') @lang('cruds.auditLog.title_singular')
                </h3>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card">
            <div class="card-inner">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th>
                                @lang('cruds.auditLog.fields.id')
                            </th>
                            <td>
                                {{ $auditLog->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                @lang('cruds.auditLog.fields.description')
                            </th>
                            <td>
                                {{ $auditLog->description ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                @lang('cruds.auditLog.fields.subject_id')
                            </th>
                            <td>
                                {{ $auditLog->subject_id ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                @lang('cruds.auditLog.fields.subject_type')
                            </th>
                            <td>
                                {{ $auditLog->subject_type ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                @lang('cruds.auditLog.fields.user_id')
                            </th>
                            <td>
                                {{ $auditLog->user_id ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                @lang('cruds.auditLog.fields.properties')
                            </th>
                            <td>
                                {{ $auditLog->properties ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                @lang('cruds.auditLog.fields.host')
                            </th>
                            <td>
                                {{ $auditLog->host ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                @lang('cruds.auditLog.fields.created_at')
                            </th>
                            <td>
                                {{ $auditLog->created_at }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('dashboard.audit-logs.index') }}"
                   class="dropdown-toggle btn btn-icon btn-warning p-2 text-white">
                    <span>
                        <em class="ni ni-arrow-left"></em>
                        {{ trans('global.back_to_list') }}
                    </span>
                </a>
            </div>
        </div>
    </div>
@endsection
