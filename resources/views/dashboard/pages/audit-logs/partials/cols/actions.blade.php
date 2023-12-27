<div class="dropdown">
    <a class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" aria-expanded="false">
        <em class="icon ni ni-more-h"></em>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        <ul class="link-list-opt no-bdr">
            @can($viewGate)
                <li>
                    <a href="{{ route('dashboard.' . $crudRoutePart . '.show', $row) }}">
                        <em class="icon ni ni-eye-alt"></em>
                        <span>@lang('global.view')</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
