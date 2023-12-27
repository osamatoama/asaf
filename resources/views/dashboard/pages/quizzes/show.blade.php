@extends('dashboard.layouts.app')

@section('content')
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">عرض تفاصيل الاختبار</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border-top: 1px solid #d7d7d7">
                        <tbody>
                            <tr>
                                <th>تسلسل</th>
                                <td>{{ $quiz -> id }}</td>
                            </tr>
                            <tr>
                                <th>اسم الاختبار</th>
                                <td>{{ $quiz -> title }}</td>
                            </tr>
                            <tr>
                                <th>عدد مرّات اجتياز الاختبار</th>
                                <td>{{ $quiz -> results_count }}</td>
                            </tr>
                            <tr>
                                <th>الأسئلة والإجابات</th>
                                <td>
                                    <ul>
                                        @foreach ($quiz -> questions as $question)
                                            <li class="card mt-2 mb-4 p-2">
                                                <span style="font-size: x-large; font-weight: bold;">{{ $loop->iteration.' - '.$question -> title }}</span>
                                                <ul>
                                                    @foreach ($question -> answers as $answer)
                                                        <li class="my-2">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <span class="mx-4" style="font-size: medium;">{{ '- '.$answer -> title }}</span>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    @forelse($answer->products as $product)
                                                                        <a href="{{ route('dashboard.products.show', $product) }}"
                                                                           target="_blank"
                                                                           class="badge text-white bg-info">
                                                                            <span>{{ $product->name }}</span>
                                                                        </a>
                                                                    @empty
                                                                        ---
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('dashboard.quizzes.index') }}"
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
