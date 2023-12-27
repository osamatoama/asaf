<script>
    /**
     * Prepare Inputs
     */
    const resizableInputClass = 'input.resizable'

    $(document).ready(function() {
        $(resizableInputClass).each((i, el) => {
            resizeTextInput(el)
        })
    })

    $(document).on('keydown', resizableInputClass, function() {
        resizeTextInput(this)
    })

    $('select.select2').each(function() {
        initSelect2($(this))
    })

    /**
     * Helper functions
     */
    function resizeTextInput(input) {
        const el = $(input)
        const charLen = el.val().length
        el.css('width', `${charLen}ch`)
    }

    function showInputValidationError(form, inputName, error) {
        const input = form.find(`[name='${inputName}']`)

        input.addClass('is-invalid')
        input.siblings('.invalid-feedback').text(error)
    }

    function hideFormValidationErrors(form) {
        form.find('.is-invalid').removeClass('is-invalid')
        form.find('.invalid-feedback').text(null)
    }

    function resetForm(form) {
        form.trigger('reset')
        form.find('.select2').val(null).trigger('change')
    }

    function successToast(message) {
        NioApp.Toast(message, 'success', {position: 'top-left'})
    }

    function errorToast(message) {
        NioApp.Toast(message || 'حدث خطأ أثناء العملية', 'error', {position: 'top-left'})
    }

    function initSelect2(el) {
        let options = {}

        options.dir = $('html').attr('lang') == 'ar' ? 'rtl' : 'ltr'
        if (el.attr('data-placeholder')) {
            options.placeholder = el.attr('data-placeholder')
        }

        options.closeOnSelect = false

        el.select2(options)
    }
</script>
