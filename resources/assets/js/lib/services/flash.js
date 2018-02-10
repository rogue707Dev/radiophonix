import swal from 'sweetalert';

function sendFlashMessage(type, message, title = null) {
    swal({
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
};

export default flash;
