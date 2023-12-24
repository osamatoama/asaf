<script>
    const toggleActiveQuestionBtnClass = '.toggle-active-question-btn'

    $(document).on('click', toggleActiveQuestionBtnClass, function() {
        const el = $(this)
        const isChecked = el.prop('checked')
        const questionId = el.data('question-id')
        el.addClass('disabled')

        Swal.fire({
            title: isChecked ? 'تفعيل السؤال' : 'إلغاء تفعيل السؤال',
            text: isChecked ? 'سيتم إظهار السؤال في الاختبار' : 'سيتم إخفاء السؤال من الاختبار',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'تراجع',
            confirmButtonText: isChecked ? 'تأكيد التفعيل' : 'تأكيد إلغاء التفعيل',
        }).then(function (result) {
            if (result.value) {

                let formData = new FormData
                formData.append('_method', 'PUT')

                axios.post(el.data('action'), formData)
                    .then((response) => {
                        console.log(response)
                        console.log(isChecked)

                        if (! isChecked) {
                            $(`#question-${questionId}`).addClass('opacity-03')
                        } else {
                            $(`#question-${questionId}`).removeClass('opacity-03')
                        }
                        successToast(response.data.message)
                    })
                    .catch((error) => {
                        el.prop('checked', ! isChecked)
                        errorToast(error.response.data.error)
                    })
            } else {
                el.prop('checked', ! isChecked)
            }
        })
    })
</script>
