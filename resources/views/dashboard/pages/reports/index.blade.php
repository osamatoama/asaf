@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">التقارير</h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('dashboard.reports.products-apperance.index') }}" class="card">
                    <div class="card-inner">
                        <h5 class="card-title">
                            <em class="icon ni ni-percent"></em>
                            ظهور المنتجات
                        </h5>
                        <p class="card-text text-muted">عدد مرات ظهور كل منتج في نتائج الاختبار والنسبة المئوية لها</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
