<script>
    let columns = [
        { data: 'id', name: 'id', class: 'text-center' },
        { data: 'remote_id', name: 'remote_id', orderable: false, class: 'text-center'},
        { data: 'type', name: 'type', orderable: false, class: 'text-center'},
        { data: 'key', name: 'key', orderable: false, class: 'text-center' },
        { data: 'results_count', name: 'results_count', searchable: false, class: 'text-center' },
        { data: 'actions', name: 'actions', searchable: false, orderable: false, class: 'text-center' },
    ];

    let datatable = initDatatable('#clients-table', columns);
</script>
