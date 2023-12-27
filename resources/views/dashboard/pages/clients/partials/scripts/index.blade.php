<script>
    let columns = [
        { data: 'id', name: 'id', class: 'text-center' },
        { data: 'key', name: 'key', orderable: false, class: 'text-center' },
        { data: 'email', name: 'email', orderable: false, class: 'text-center' },
        { data: 'phone', name: 'phone', orderable: false, class: 'text-center' },
        { data: 'results_count', name: 'results_count', searchable: false, class: 'text-center' },
        { data: 'actions', name: 'actions', searchable: false, orderable: false, class: 'text-center' },
    ];

    let datatable = initDatatable('#clients-table', columns);
</script>
