<script>
    let columns = [
        {data: 'id', name: 'id', class: 'text-center'},
        {data: 'user_id', name: 'user_id', class: 'text-center'},
        {data: 'subject_id', name: 'subject_id', class: 'text-center'},
        {data: 'subject_type', name: 'subject_type', orderable: false, class: 'text-center'},
        {data: 'description', name: 'description', orderable: false, class: 'text-center'},
        {data: 'host', name: 'host', orderable: false, class: 'text-center'},
        {data: 'created_at', name: 'created_at', class: 'text-center'},
        {data: 'actions', name: 'actions', searchable: false, orderable: false, class: 'text-center'},
    ]
    let datatable = initDatatable('#auditLogs-table', columns, {}, 25)
</script>
