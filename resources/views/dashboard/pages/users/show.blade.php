@extends('dashboard.layouts.app')

@section('content')
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">عرض تفاصيل موظف</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border-top: 1px solid #d7d7d7">
                        <tbody>
                            <tr>
                                <th>تسلسل</th>
                                <td>{{ $user -> id }}</td>
                            </tr>
                            <tr>
                                <th>الاسم</th>
                                <td>{{ $user -> name }}</td>
                            </tr>
                            <tr>
                                <th>البريد الإلكتروني</th>
                                <td>{{ $user -> email ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>رقم الهاتف</th>
                                <td>{{ $user -> phone ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>الأذونات</th>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-info">{{ $role->title }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>كود التحقق</th>
                                <td>{{ $user -> verification_code ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>تم التحقق</th>
                                <td>
                                    @if($user->verified)
                                        <span class="badge bg-success">
                                            <em class="icon ni ni-check-thick"></em>
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <em class="icon ni ni-cross"></em>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>مُفعل</th>
                                <td>
                                    @if($user->active)
                                        <span class="badge bg-success">
                                            <em class="icon ni ni-check-thick"></em>
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <em class="icon ni ni-cross"></em>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('dashboard.users.index') }}"
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
