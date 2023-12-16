<script>
    let columns = [
        { data: 'id', name: 'id', class: 'text-center' },
        { data: 'name', name: 'name', orderable: false, class: 'text-center' },
        { data: 'email', name: 'email', orderable: false, class: 'text-center' },
        { data: 'phone', name: 'phone', orderable: false, class: 'text-center' },
        { data: 'verified', name: 'verified', searchable: false, orderable: false, class: 'text-center' },
        { data: 'active', name: 'active', searchable: false, orderable: false, class: 'text-center' },
        { data: 'verification_code', name: 'verification_code', orderable: false, class: 'text-center' },
        { data: 'roles', name: 'roles', orderable: false, class: 'text-center' },
        { data: 'actions', name: 'actions', searchable: false, orderable: false, class: 'text-center' },
    ]
    let datatable = initDatatable('#users-table', columns)

    initDatatableDeleteAction(datatable)

    $(document).on('click', '.toggle-btn', function (e) {
        e.preventDefault()

        let element   = $(this)
        let input     = element.find('input')
        let icon      = element.find('em')
        let isChecked = element.hasClass('checked')

        axios.put(element.data('url'))
            .then(({data}) => {
                if (data.success) {
                    if (isChecked) {
                        element.removeClass('checked')
                        input.attr('checked', false)
                        icon.removeClass('ni-check-thick')
                        icon.addClass('ni-cross')
                    } else {
                        element.addClass('checked')
                        input.attr('checked', true)
                        icon.removeClass('ni-cross')
                        icon.addClass('ni-check-thick')
                    }

                    NioApp.Toast(data.message, 'success')
                } else {
                    NioApp.Toast(data.message, 'error')
                }
            })
            .catch(({response}) => {
                fireSomethingWentWrong()
            })
    })
</script>
