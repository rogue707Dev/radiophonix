import Swal, {SweetAlertOptions, SweetAlertType} from 'sweetalert2';

function sendFlashMessage(type: SweetAlertType, message: string, title?: any) {
    return Swal.fire({
        text: message,
        title: title,
        type: type,
    });
}

const flash = {
    info: (message: string, title: string) => sendFlashMessage('info', message, title),
    success: (message: string, title: string) => sendFlashMessage('success', message, title),
    warning: (message: string, title: string) => sendFlashMessage('warning', message, title),
    error: (message: string, title: string) => sendFlashMessage('error', message, title),
    confirm: (message: string, title: string, withPasswordInput: boolean = false) => {
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
