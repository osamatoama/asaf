@foreach($row->permissions as $permission)
    <span class="badge bg-info">@lang('dashboard/permissions.'. $permission->title)</span>
@endforeach
