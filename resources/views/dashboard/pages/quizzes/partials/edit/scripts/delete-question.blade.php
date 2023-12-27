<script>
    const deleteQuestionBtnClass = '.delete-question-btn'

    $(document).on('click', deleteQuestionBtnClass, function() {
        const el = $(this)
        const questionId = el.data('question-id')
        el.addClass('disabled')

        Swal.fire({
            title: 'هل أنت متأكد من حذف السؤال؟',
            text: 'سيتم حذف الإجابات والمنتجات التابعة للسؤال أيضاً',
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
                        $(`#question-${questionId}`).remove()
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
