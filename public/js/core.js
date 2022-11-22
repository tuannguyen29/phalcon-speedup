var PhalconVariables = PhalconVariables || {};

class PhalconCMS {
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
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
        });

        Toast.fire(content);
    }
}

$(document).ready(() => {
    new PhalconCMS();
    window.PhalconCMS = PhalconCMS;
});
