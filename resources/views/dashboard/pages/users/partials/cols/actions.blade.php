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
            @can($editGate)
                <li>
                    <a href="{{ route('dashboard.' . $crudRoutePart . '.edit', $row) }}">
                        <em class="icon ni ni-edit"></em>
                        <span>@lang('global.edit')</span>
                    </a>
                </li>
            @endcan
            @can($deleteGate)
                <li class="divider"></li>
                <li>
                    <a href="{{ route('dashboard.' . $crudRoutePart . '.destroy', $row) }}" class="delete-btn">
                        <em class="icon ni ni-delete"></em>
                        <span>@lang('global.delete')</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
