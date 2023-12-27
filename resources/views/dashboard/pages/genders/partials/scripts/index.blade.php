<script>
    let columns = [
        {data: 'id', name: 'id', class: 'text-center'},
        {data: 'name', name: 'name', class: 'text-center'},
        {data: 'products_count', name: 'products_count', searchable: false, class: 'text-center'},
        {data: 'actions', name: 'actions', searchable: false, orderable: false, class: 'text-center'},
    ]
    let datatable = initDatatable('#genders-table', columns)
</script>
