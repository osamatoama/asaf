@extends('dashboard.layouts.app')

@section('content')
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">عرض تفاصيل الإذن</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border-top: 1px solid #d7d7d7">
                        <tbody>
                        <tr>
                            <th>تسلسل</th>
                            <td>{{ $role -> id }}</td>
                        </tr>
                        <tr>
                            <th>اسم الدور</th>
                            <td>{{ $role->title }}</td>
                        </tr>
                        <tr>
                            <th>الصلاحيات</th>
                            <td>
                                @forelse($role->permissions as $permission)
                                    <span class="badge badge-pill bg-info btn-sm">@lang('dashboard/permissions.'. $permission->title)</span>
                                @empty
                                    ---
                                @endforelse
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('dashboard.roles.index') }}"
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
