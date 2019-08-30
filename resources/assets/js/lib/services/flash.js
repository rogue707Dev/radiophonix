import Swal from 'sweetalert2';

function sendFlashMessage(type, message, title = null) {
    return Swal.fire({
        text: message,
        title: title,
        type: type,
    });
}

const flash = window.flash = {
    info: (message, title) => sendFlashMessage('info', message, title),
    success: (message, title) => sendFlashMessage('success', message, title),
    warning: (message, title) => sendFlashMessage('warning', message, title),
    error: (message, title) => sendFlashMessage('error', message, title),
    confirm: (message, title, withPasswordInput = false) => {
        return Swal.fire({
            title: title,
            text: message,
            type: 'warning',
            input: withPasswordInput ? 'password' : '',
            showConfirmButton: true,
            confirmButtonText: 'Oui',
            showCancelButton: true,
            cancelButtonText: 'Non',
        });
    },
    close: () => {
        Swal.close();
    },
};

export default flash;
