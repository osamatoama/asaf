@extends('dashboard.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    عرض تفاصيل النوع
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
                                {{ $gender->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                الاسم
                            </th>
                            <td>
                                {{ $gender->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                عدد المنتجات
                            </th>
                            <td>
                                {{ $gender->products_count }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                المنتجات
                            </th>
                            <td>
                                @forelse($products as $id => $name)
                                    <a href="{{ route('dashboard.products.show', $id) }}"
                                       target="_blank"
                                       class="badge text-white bg-secondary">
                                        <span>{{ $name }}</span>
                                    </a>
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
                <a href="{{ route('dashboard.genders.index') }}"
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
