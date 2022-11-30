var ThezilVariables = ThezilVariables || {};

class ThezilCMS {
    constructor() {
        this.ajaxSetup();
    }

    ajaxSetup() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    static showNotice(messageType, message) {
        let content = {};

        switch (messageType) {
            case 'error':
                content.html = message;
                content.icon = 'error';
                break;
            case 'success':
                content.html = message;
                content.icon = 'success';
                break;
        }

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire(content);
    }

    static handleError(data) {
        if (typeof (data.errors) !== 'undefined' && !_.isArray(data.errors)) {
            ThezilCMS.handleValidationError(data.errors);
        } else {
            if (typeof (data.responseJSON) !== 'undefined') {
                if (typeof (data.responseJSON.errors) !== 'undefined') {
                    if (data.status === 422) {
                        ThezilCMS.handleValidationError(data.responseJSON.errors);
                    }
                } else if (typeof (data.responseJSON.message) !== 'undefined') {
                    ThezilCMS.showNotice('error', data.responseJSON.message);
                } else {
                    $.each(data.responseJSON, (index, el) => {
                        $.each(el, (key, item) => {
                            ThezilCMS.showNotice('error', item);
                        });
                    });
                }
            } else {
                ThezilCMS.showNotice('error', data.statusText);
            }
        }
    }

    static handleValidationError(errors) {
        let message = '';
        $.each(errors, (index, item) => {
            message += item + '<br />';

                let $input = $('*[name="' + index + '"]');
                if ($input.closest('.next-input--stylized').length) {
                    $input.closest('.next-input--stylized').addClass('field-has-error');
                } else {
                    $input.addClass('field-has-error');
                }

                let $input_array = $('*[name$="[' + index + ']"]');

                if ($input_array.closest('.next-input--stylized').length) {
                    $input_array.closest('.next-input--stylized').addClass('field-has-error');
                } else {
                    $input_array.addClass('field-has-error');
                }
        });
        ThezilCMS.showNotice('error', message);
    }

}

$(document).ready(() => {
    $('#js-select-all').on('click', function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('#js-select-all-subscribe').on('click', function () {
        $('input:checkbox').filter(function () {
            return !this.disabled
        }).prop('checked', this.checked);
    });

    new ThezilCMS();
    window.ThezilCMS = ThezilCMS;
});
