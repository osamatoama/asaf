@extends('dashboard.layouts.app')
@section('content')
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">عرض تفاصيل المنتج</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border-top: 1px solid #d7d7d7">
                        <tbody>
                            <tr>
                                <th>تسلسل</th>
                                <td>{{ $product -> id }}</td>
                            </tr>
                            <tr>
                                <th>الصورة</th>
                                <td>
                                    @if($product->image->media ?? false)
                                        <img src="{{ $product->image->thumbnail }}"
                                             class="pointer"
                                             data-src="{{ $product->image->original }}"
                                             data-fancybox
                                             alt="{{ $product->name }}"
                                             style="width: 70px; height: 70px; border-radius: 10px;">
                                    @elseif(filled($product->image_url))
                                        <img src="{{ $product->image_url }}"
                                             class="pointer"
                                             data-src="{{ $product->image_url }}"
                                             data-fancybox
                                             alt="{{ $product->name }}"
                                             style="width: 70px; height: 70px; border-radius: 10px;">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>الاسم</th>
                                <td>{{ $product -> name }}</td>
                            </tr>
                            <tr>
                                <th>النوع</th>
                                <td>{{ $product -> gender -> name ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th>الوصف</th>
                                <td>{!! $product->description !!}</td>
                            </tr>
                            <tr>
                                <th>رابط المنتج</th>
                                <td>
                                    <a href="{{ $product->url }}" target="_blank">
                                        {{ $product->url }}
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('dashboard.products.index') }}"
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
