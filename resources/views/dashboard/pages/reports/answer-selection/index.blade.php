@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">تقرير اختيار التصنيفات</h3>
            </div>

            <a href="{{ route('dashboard.reports.index') }}" class="btn btn-secondary">
                <em class="icon ni ni-arrow-right"></em> عودة
            </a>
        </div>
    </div>

    @foreach ($result['quizzes'] as $quiz)
        <div class="nk-block">
            <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                    <div class="card-inner">
                        <div class="my-3">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>تسلسل</th>
                                        <td>{{ $quiz->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>اسم الاختبار</th>
                                        <td>{{ $quiz->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>عدد مرّات اجتياز الاختبار</th>
                                        <td>{{ $quiz->results_count }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <ul>
                                @foreach ($quiz->questions as $question)
                                    <li class="card mt-2 mb-4 p-2">
                                        <span style="font-size: x-large; font-weight: bold;">{{ $loop->iteration.' - '.$question->title }}</span>
                                        <ul>
                                            @php
                                                $topQuestionAnswerSelectionsCount = $question->answers->max('result_answers_count');
                                            @endphp

                                            @foreach ($question->answers as $answer)
                                                <li class="my-2">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <span class="mx-4" style="font-size: medium;">{{ '- '.$answer->title }}</span>
                                                        </div>
                                                        <div class="col-md-9">
                                                            @php
                                                                $badgeColor = 'primary';

                                                                if ($answer->result_answers_count == $topQuestionAnswerSelectionsCount) {
                                                                    $badgeColor = 'success';
                                                                }
                                                            @endphp

                                                            <span class="badge badge-sm bg-{{ $badgeColor }}">
                                                                {{ $answer->result_answers_count }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- <div class="table-responsive">
                            <table class="table table-bordered" style="border-top: 1px solid #d7d7d7">
                                <tbody>
                                    <tr>
                                        <th>تسلسل</th>
                                        <td>{{ $quiz->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>اسم الاختبار</th>
                                        <td>{{ $quiz->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>عدد مرّات اجتياز الاختبار</th>
                                        <td>{{ $quiz->results_count }}</td>
                                    </tr>
                                    <tr>
                                        <th>الأسئلة والإجابات</th>
                                        <td>
                                            <ul>
                                                @foreach ($quiz->questions as $question)
                                                    <li class="card mt-2 mb-4 p-2">
                                                        <span style="font-size: x-large; font-weight: bold;">{{ $loop->iteration.' - '.$question->title }}</span>
                                                        <ul>
                                                            @foreach ($question->answers as $answer)
                                                                <li class="my-2">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <span class="mx-4" style="font-size: medium;">{{ '- '.$answer->title }}</span>
                                                                        </div>
                                                                        <div class="col-md-9">

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
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
