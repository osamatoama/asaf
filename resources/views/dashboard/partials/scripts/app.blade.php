<script>
    NioApp.CurrentLink = () => null
    Dropzone.autoDiscover = false
    $('.select-all').click(function () {
        let select = $(this).parent().parent().find('select')
        select.find('option').prop('selected', true)
        select.trigger('change')
    })
    $('.deselect-all').click(function () {
        let select = $(this).parent().parent().find('select')
        select.find('option').prop('selected', false)
        select.trigger('change')
    })
    $('.select2-init').select2({
        placeholder: `@lang('global.pleaseSelect')`,
        allowClear: true,
    })

    $('.select2-multiple-init').select2({
        placeholder: `@lang('global.pleaseSelect')`,
    })
</script>
