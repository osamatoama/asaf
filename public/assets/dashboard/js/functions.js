function currentLocale() {
    return $('html').attr('lang')
}

function toggleButton(button, enable = false) {
    if (enable && button.children().length) {
        button.css('pointer-events', 'auto')
        button.html(button.find('span:last-child').text())
    } else {
        let form = button.closest('form')
        if (form && !form[0].checkValidity()) {
            return
        }

        button.css('pointer-events', 'none')
        button.html(`
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span>${button.text()}</span>
        `)
    }
}

//Alerts
function fireSomethingWentWrong() {
    NioApp.Toast(_dictionary.errors.somethingWentWrong, 'error')
}

function fireSuccessToast(message) {
    NioApp.Toast(message, 'success')
}

function fireErrorToast(message) {
    NioApp.Toast(message, 'error')
}

//Sweetalert helpers
function swalConfirm(confirmCallback, title = null, text = null, confirmText = null, cancelText = null) {
    Swal.fire({
        title: title ?? _dictionary.alerts.areYouSure,
        text: text ?? _dictionary.alerts.undoneAction,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: confirmText ?? _dictionary.alerts.confirm,
        cancelButtonText: cancelText ?? _dictionary.alerts.cancel,
    }).then((result) => {
        if (result.isConfirmed) {
            confirmCallback()
        }
    })
}

function swalConfirmWithReason(confirmCallback = (reason) => null, title = null, text = null, confirmText = null, cancelText = null) {
    Swal.fire({
        title: title ?? _dictionary.alerts.areYouSure,
        input: 'textarea',
        inputAttributes: {
            autocapitalize: 'off'
        },
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: confirmText ?? _dictionary.alerts.confirm,
        cancelButtonText: cancelText ?? _dictionary.alerts.cancel,
        preConfirm: (reason) => {
            if(reason !== ""){
                confirmCallback(reason)
            }else{
                return false;
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
        }
    })
}

//Inits
function initDropzone(element, options = {}, removedFileCallback = (file) => null, successCallback = (file, response, _this) => null) {
    let defaultOptions = {
        url: _routes.dropzone.store,
        headers: {'X-CSRF-TOKEN': _csrf},
        addRemoveLinks: true,

        dictFileTooBig: _dictionary.dropzone.dictFileTooBig,
        dictMaxFilesExceeded: _dictionary.dropzone.dictMaxFilesExceeded,
        dictInvalidFileType: _dictionary.dropzone.dictInvalidFileType,
        dictCancelUpload: _dictionary.dropzone.dictCancelUpload,
        dictCancelUploadConfirmation: _dictionary.dropzone.dictCancelUploadConfirmation,
        dictRemoveFile: _dictionary.dropzone.dictRemoveFile,
        dictDefaultMessage: _dictionary.dropzone.dictDefaultMessage,
        dictFallbackMessage: _dictionary.dropzone.dictFallbackMessage,
        dictFallbackText: _dictionary.dropzone.dictFallbackText,

        removedfile: function (file) {
            if (file.previewElement != null && file.previewElement.parentNode != null) {
                if (file.status !== 'error') {
                    removedFileCallback(file)
                    this.options.maxFiles = this.options.maxFiles + 1
                }
                file.previewElement.parentNode.removeChild(file.previewElement)
            }
        },
        error: function (file, message) {
            if (file.previewElement) {
                file.previewElement.classList.add('dz-error')

                if (typeof message === 'object' && message.errors) {
                    message = message.errors['file'][0]
                }

                for (let node of file.previewElement.querySelectorAll('[data-dz-errormessage]')) {
                    node.textContent = message;
                }
            }
        },
        success: function (file, response) {
            if (file.previewElement) {
                successCallback(file, response, this)
                this.options.maxFiles = this.options.maxFiles - 1

                return file.previewElement.classList.add('dz-success')
            }
        },
    }
    options = Object.keys(options).length ? {...defaultOptions, ...options} : defaultOptions

    NioApp.Dropzone(element, options)
}

function initDatatable(element, columns = [], options = {}, pageLength = 10, sortOptions = [0, 'desc'], isOrdersTable = false) {
    let _this = $(element)

    let defaultOptions = {
        processing: true,
        serverSide: true,
        ajax: _this.data('url'),
        createdRow: function(row, data, dataIndex, cells) {
            $(row).addClass('nk-tb-item');
            if(isOrdersTable) {
                $(row).addClass(data.background_color);
            }
        },
        columns: columns,
        lengthChange: true,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, _dictionary.datatable.lengthMenu.all],
        ],
        autoWidth: false,
        responsive: true,
        language: {
            url: `${_urls.assets}/json/datatable/languages/${currentLocale()}.json`,
        },
        order: [sortOptions],
        pageLength: pageLength,
        buttons: [
            {
                extend: 'copy',
                titleAttr: _dictionary.datatable.buttons.copy,
            },
            {
                extend: 'excel',
                titleAttr: _dictionary.datatable.buttons.excel,
            },
            {
                extend: 'csv',
                titleAttr: _dictionary.datatable.buttons.csv,
            },
            {
                extend: 'pdf',
                titleAttr: _dictionary.datatable.buttons.pdf,
            },
            {
                extend: 'colvis',
                titleAttr: _dictionary.datatable.buttons.colvis,
            },
        ],
    }
    options = Object.keys(options).length ? {...defaultOptions, ...options} : defaultOptions

    NioApp.DataTable(element, options)

    return _this.DataTable()
}

//Datatable actions
function initDatatableDeleteAction(datatable, element = null) {
    if (element === null) {
        element = '.delete-btn'
    }

    $(document).on('click', element, function (e) {
        e.preventDefault()

        swalConfirm(() => {
            axios.delete($(this).attr('href'))
                .then(({data}) => {
                    if (data.success) {
                        NioApp.Toast(data.message, 'success')
                        datatable.ajax.reload()
                    } else {
                        NioApp.Toast(data.message, 'error')
                    }
                })
                .catch(({response}) => {
                    fireSomethingWentWrong()
                })
        })
    })
}

function initDeleteAction(element = null) {
    if (element === null) {
        element = '.delete-btn'
    }

    $(document).on('click', element, function (e) {
        e.preventDefault()

        swalConfirm(() => {
            axios.delete($(this).attr('href'))
                .then(({data}) => {
                    if (data.success) {
                        NioApp.Toast(data.message, 'success')
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000);
                    } else {
                        NioApp.Toast(data.message, 'error')
                    }
                })
                .catch(({response}) => {
                    fireSomethingWentWrong()
                })
        })
    })
}

//Activate action
function initActivateAction(element = null) {
    if (element === null) {
        element = '.activate-btn'
    }

    $(document).on('click', element, function (e) {
        e.preventDefault()

        swalConfirm(() => {
            axios.post($(this).data('action'))
                .then(({data}) => {
                    if (data.success) {
                        NioApp.Toast(data.message, 'success')
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000);
                    } else {
                        NioApp.Toast(data.message, 'error')
                    }
                })
                .catch(({response}) => {
                    fireSomethingWentWrong()
                })
        })
    })
}

//Deactivate action
function initDeactivateAction(element = null) {
    if (element === null) {
        element = '.deactivate-btn'
    }

    $(document).on('click', element, function (e) {
        e.preventDefault()

        swalConfirm(() => {
            axios.post($(this).data('action'))
                .then(({data}) => {
                    if (data.success) {
                        NioApp.Toast(data.message, 'success')
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000);
                    } else {
                        NioApp.Toast(data.message, 'error')
                    }
                })
                .catch(({response}) => {
                    fireSomethingWentWrong()
                })
        })
    })
}

//Disapprove action
function initDisapproveAction(element = null) {
    if (element === null) {
        element = '.disapprove-btn'
    }

    $(document).on('click', element, function (e) {
        e.preventDefault()

        swalConfirmWithReason((reason) => {
            axios.post($(this).data('action'), {disapproval_reason:reason})
                .then(({data}) => {
                    if (data.success) {
                        NioApp.Toast(data.message, 'success')
                        setTimeout(() => {
                            window.location.reload()
                        }, 1000);
                    } else {
                        NioApp.Toast(data.message, 'error')
                    }
                })
                .catch(({response}) => {
                    fireSomethingWentWrong()
                })
        })
    })
}

