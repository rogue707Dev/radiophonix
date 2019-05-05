import swal from 'sweetalert';

function sendFlashMessage(type, message, title = null) {
    return swal({
        text: message,
        title: title,
        icon: type,
    });
}

const flash = window.flash = {
    info: (message, title) => sendFlashMessage('info', message, title),
    success: (message, title) => sendFlashMessage('success', message, title),
    warning: (message, title) => sendFlashMessage('warning', message, title),
    error: (message, title) => sendFlashMessage('error', message, title),
    confirm: (message, title) => {
        return swal({
            title: title,
            text: message,
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Non',
                    value: null,
                    visible: true,
                    closeModal: true,
                },
                confirm: {
                    text: 'Oui',
                    value: true,
                    visible: true,
                    closeModal: false,
                }
            },
            dangerMode: true,
        });
    },
    close: () => {
        swal.stopLoading();
        swal.close();
    },
};

export default flash;
