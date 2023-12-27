<script>
    const toggleActiveQuestionBtnClass = '.toggle-active-question-btn'

    $(document).on('click', toggleActiveQuestionBtnClass, function() {
        const el = $(this)
        const isChecked = el.prop('checked')
        const questionId = el.data('question-id')
        const questionWrapper = $(`#question-${questionId}`)
        const answersCount = questionWrapper.find('.answer').length
        el.addClass('disabled')

        if (answersCount == 0 && isChecked) {
            Swal.fire({
                text: 'لا يمكن تفعيل السؤال قبل إضافة إجابة واحدة على الأقل',
                icon: 'error',
                confirmButtonText: 'حسناً',
            }).then(function (result) {
                el.prop('checked', ! isChecked)
            })

            return
        }

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
                        if (! isChecked) {
                            $(`#question-${questionId}`).addClass('opacity-03')
                        } else {
                            $(`#question-${questionId}`).removeClass('opacity-03')
                        }
                        successToast(response.data.message)
                    })
                    .catch((error) => {
                        el.prop('checked', ! isChecked)
                        errorToast(error.response.data.message)
                    })
            } else {
                el.prop('checked', ! isChecked)
            }
        })
    })
</script>
