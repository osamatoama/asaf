@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">تقرير إكمال الاختبار</h3>
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
                                        <th>اسم الاختبار</th>
                                        <td>{{ $quiz['title'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>تاريخ بداية التقرير</th>
                                        <td>
                                            <span dir="ltr">{{ $quiz['report_start_date'] }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>عدد العملاء الذين دخلوا الاختبار</th>
                                        <td>{{ $quiz['total_entries'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>عدد العملاء الذين أكملوا الاختبار</th>
                                        <td>
                                            <span class="me-3">{{ $quiz['complete_entries'] }}</span>

                                            @if($quiz['completion_ratio'] !== null)
                                                <span class="badge badge-sm bg-success">{{ $quiz['completion_ratio'] }} %</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>عدد العملاء الذين لم يكملوا الاختبار</th>
                                        <td>
                                            <span class="me-3">{{ $quiz['incomplete_entries'] }}</span>

                                            @if($quiz['incompletion_ratio'] !== null)
                                                <span class="badge badge-sm bg-danger">{{ $quiz['incompletion_ratio'] }} %</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
