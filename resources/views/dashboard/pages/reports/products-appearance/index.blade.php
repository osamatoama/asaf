@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">تقرير ظهور المنتجات</h3>
            </div>

            <a href="{{ route('dashboard.reports.index') }}" class="btn btn-secondary">
                <em class="icon ni ni-arrow-right"></em> عودة
            </a>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th>المنتج</th>
                            <th>عدد مرات الظهور</th>
                            <th>النسبة المئوية للظهور</th>
                        </thead>

                        <tbody>
                            @foreach ($result['products'] as $product)
                                <tr>
                                    <td>
                                        @if ($media = ($product?->image?->media ?? false) && file_exists($media))
                                            <img src="{{ $media->thumbnail }}" data-src="{{ $media->original }}" class="pointer me-1" width="50px" height="50px" data-fancybox>
                                        @elseif(filled($product->image_url))
                                            <img src="{{ $product->image_url }}" data-src="{{ $product->image_url }}" class="pointer me-1" width="50px" height="50px" data-fancybox>
                                        @else
                                            <img src="{{ asset('assets/dashboard/images/placeholder.jpg') }}" class="me-1" width="50px" height="50px">
                                        @endif

                                        {{ $product->name }}
                                    </td>
                                    <td>
                                        {{ $product->results_count }}
                                    </td>
                                    <td>
                                        <strong>{{ round($product->results_count / $result['total_quiz_results'] * 100, 2) }}</strong> %
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
