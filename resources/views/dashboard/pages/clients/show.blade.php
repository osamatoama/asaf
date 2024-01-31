@extends('dashboard.layouts.app')

@section('content')
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">عرض تفاصيل عميل</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border-top: 1px solid #d7d7d7">
                        <tbody>
                            <tr>
                                <th>تسلسل</th>
                                <td>{{ $client->id }}</td>
                            </tr>
                            <tr>
                                <th>المعرف</th>
                                <td>{{ $client->remote_id ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>النوع</th>
                                <td>{{ $client->getType() }}</td>
                            </tr>
                            <tr>
                                <th>كود العميل</th>
                                <td>{{ $client->key }}</td>
                            </tr>
                            {{-- <tr>
                                <th>البريد الإلكتروني</th>
                                <td>{{ $client->email ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>رقم الهاتف</th>
                                <td>{{ $client->phone ?? '---' }}</td>
                            </tr> --}}
                            <tr>
                                <th>عدد مرّات اجتياز الاختبار</th>
                                <td>{{ $client->results_count ?? 0 }}</td>
                            </tr>
                            <tr>
                                <th>أسماء الاختبارات المُجتازة</th>
                                <td>
                                    @foreach($passedQuizzes as $passedQuiz)
                                        <span class="badge bg-info">{{ $passedQuiz->quiz->title ?? '---' }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('dashboard.clients.index') }}"
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
