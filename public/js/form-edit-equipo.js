(() => {
    const inputImagen = document.getElementById('imagen');
    const previewImagen = document.getElementById('preview-imagen');
    const cancelarCambioImagen = document.getElementById('cancelar-cambio-imagen');

    if (!inputImagen || !previewImagen || !cancelarCambioImagen) {
        return;
    }

    const imagenOriginal = previewImagen.src;
    let urlPreviewImagen = null;

    const restaurarImagenOriginal = () => {
        if (urlPreviewImagen) {
            URL.revokeObjectURL(urlPreviewImagen);
            urlPreviewImagen = null;
        }

        inputImagen.value = '';
        previewImagen.src = imagenOriginal;
        cancelarCambioImagen.classList.add('d-none');
    };

    inputImagen.addEventListener('change', () => {
        if (urlPreviewImagen) {
            URL.revokeObjectURL(urlPreviewImagen);
            urlPreviewImagen = null;
        }

        const archivo = inputImagen.files[0];
        if (!archivo) {
            restaurarImagenOriginal();
            return;
        }

        if (!archivo.type.startsWith('image/')) {
            restaurarImagenOriginal();
            if (typeof alertaMensaje === 'function') {
                alertaMensaje('Seleccione un archivo de imagen válido', 1800, 'error');
            }
            return;
        }

        urlPreviewImagen = URL.createObjectURL(archivo);
        previewImagen.src = urlPreviewImagen;
        cancelarCambioImagen.classList.remove('d-none');
        if (typeof alertaMensaje === 'function') {
            alertaMensaje('Se ha cambiado la imagen del equipo', 1200, 'success');
        }
    });

    cancelarCambioImagen.addEventListener('click', (event) => {
        event.preventDefault();
        restaurarImagenOriginal();
        if (typeof alertaMensaje === 'function') {
            alertaMensaje('Se ha restablecido la imagen original', 1200, 'success');
        }
    });
})();

const alertaMensaje = (msg, time, icon) => {
    if (typeof Swal === 'undefined') {
        return;
    }

    const toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: time,
        didOpen: (toastElement) => {
            toastElement.onmouseenter = Swal.stopTimer;
            toastElement.onmouseleave = Swal.resumeTimer;
        },
        customClass: {
            popup: 'popup-class',
        },
    });

    toast.fire({
        icon,
        title: msg,
    });
};
