<script>
    let columns = [
        {data: 'id', name: 'id', searchable: true, orderable: true, class: 'text-center'},
        {data: 'user_id', name: 'user_id', searchable: true, orderable: true, class: 'text-center'},
        {data: 'subject_id', name: 'subject_id', searchable: true, orderable: true, class: 'text-center'},
        {data: 'subject_type', name: 'subject_type', searchable: true, orderable: false},
        {data: 'description', name: 'description', searchable: true, orderable: false},
        {data: 'host', name: 'host', searchable: true, orderable: false},
        {data: 'created_at', name: 'created_at', searchable: true, orderable: true},
        {data: 'actions', name: 'actions', searchable: false, orderable: false, class: 'text-center'},
    ]
    let datatable = initDatatable('#auditLogs-table', columns)
</script>
