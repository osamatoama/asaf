<script>
    let columns = [
        {data: 'id', name: 'id', class: 'text-center'},
        {data: 'image', name: 'image', searchable: false, orderable: false, class: 'text-center'},
        {data: 'product_name', name: 'product_name', orderable: false, class: 'text-center'},
        {data: 'gender_name', name: 'gender_name', orderable: false, class: 'text-center'},
        {data: 'actions', name: 'actions', searchable: false, orderable: false, class: 'text-center'},
    ]
    let datatable = initDatatable('#products-table', columns)

    initDatatableDeleteAction(datatable)
</script>
