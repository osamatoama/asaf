<script>
    let columns = [
        { data: 'id', name: 'id', class: 'text-center' },
        { data: 'title', name: 'title', orderable: false, class: 'text-center' },
        { data: 'permissions', name: 'permissions', orderable: false, class: 'text-center' },
        { data: 'actions', name: 'actions', searchable: false, orderable: false, class: 'text-center' },
    ]
    let datatable = initDatatable('#roles-table', columns)

    initDatatableDeleteAction(datatable)
</script>
