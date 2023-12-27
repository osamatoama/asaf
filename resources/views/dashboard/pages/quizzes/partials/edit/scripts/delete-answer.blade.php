<script>
    const deleteAnswerBtnClass = '.delete-answer-btn'

    $(document).on('click', deleteAnswerBtnClass, function() {
        const el = $(this)
        const answerId = el.data('answer-id')
        const questionWrapper = el.closest('.question')

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

                        if (response.data.data.answers_count == 0) {
                            questionWrapper.addClass('opacity-03')
                            questionWrapper.find('.toggle-active-question-btn').prop('checked', false)
                        }

                        successToast(response.data.message)
                    })
                    .catch((error) => {
                        el.removeClass('disabled')
                        errorToast(error.response.data.message)
                    })
            } else {
                el.removeClass('disabled')
            }
        })
    })
</script>
