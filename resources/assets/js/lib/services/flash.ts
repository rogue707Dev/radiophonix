import Swal, {SweetAlertOptions} from 'sweetalert2';

function sendFlashMessage(type, message, title = null) {
    return Swal.fire({
        text: message,
        title: title,
        type: type,
    });
}

const flash = {
    info: (message, title) => sendFlashMessage('info', message, title),
    success: (message, title) => sendFlashMessage('success', message, title),
    warning: (message, title) => sendFlashMessage('warning', message, title),
    error: (message, title) => sendFlashMessage('error', message, title),
    confirm: (message, title, withPasswordInput = false) => {
        let config: SweetAlertOptions = {
            title: title,
            text: message,
            type: 'warning',
            showConfirmButton: true,
            confirmButtonText: 'Oui',
            showCancelButton: true,
            cancelButtonText: 'Non',
        };

        if (withPasswordInput) {
            config.input = 'password';
        }

        return Swal.fire(config);
    },
    close: () => {
        Swal.close();
    },
};

export default flash;
