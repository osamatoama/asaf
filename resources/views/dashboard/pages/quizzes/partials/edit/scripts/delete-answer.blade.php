<script>
    const deleteAnswerBtnClass = '.delete-answer-btn'

    $(document).on('click', deleteAnswerBtnClass, function() {
        const el = $(this)
        const answerId = el.data('answer-id')

        el.addClass('disabled')

        Swal.fire({
            title: 'هل أنت متأكد من حذف الإجابة',
            text: 'سيتم حذف المنتجات التابعة للإجابة أيضاً',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'تراجع',
            confirmButtonText: 'تأكيد الحذف',
        }).then(function (result) {
            if (result.value) {

                let formData = new FormData
                formData.append('_method', 'DELETE')

                axios.post(el.data('action'), formData)
                    .then((response) => {
                        $(`#answer-${answerId}`).remove()
                        successToast(response.data.message)
                    })
                    .catch((error) => {
                        el.removeClass('disabled')
                        errorToast(error.response.data.error)
                    })
            } else {
                el.removeClass('disabled')
            }
        })
    })
</script>
