@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    عرض تفاصيل السجل
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
                                تسلسل
                            </th>
                            <td>
                                {{ $auditLog->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                الوصف
                            </th>
                            <td>
                                {{ $auditLog->description ?? '---' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                معرف الموضوع
                            </th>
                            <td>
                                {{ $auditLog->subject_id ?? '---' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                نوع الموضوع
                            </th>
                            <td>
                                {{ $auditLog->subject_type ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                معرف المستخدم
                            </th>
                            <td>
                                {{ $auditLog->user_id ?? '---' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                الخصائص
                            </th>
                            <td>
                                {{ $auditLog->properties ?? '---' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                المضيف
                            </th>
                            <td>
                                {{ $auditLog->host ?? '---' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                أنشأ في
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
