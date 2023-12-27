@foreach($row->roles as $role)
    <span class="badge bg-info">
        {{ $role->title }}
    </span>
@endforeach
