<div @class(['custom-control custom-checkbox custom-control-pro custom-control-pro-icon no-control toggle-btn', 'checked' => $row->active])
     data-url="{{ route('dashboard.users.toggle', [$row, 'active']) }}">
    <input type="checkbox" class="custom-control-input" id="toggle-active-{{ $row->id }}"
           @if($row->active) checked @endif>
    <label class="custom-control-label" for="toggle-active-{{ $row->id }}">
        <em class="icon ni @if($row->active) ni-check-thick @else ni-cross @endif"></em>
    </label>
</div>
