(() => {
    const inputImagen = document.getElementById('imagen');
    const previewImagen = document.getElementById('preview-imagen');
    const cancelarCambioImagen = document.getElementById('cancelar-cambio-imagen');
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

        urlPreviewImagen = URL.createObjectURL(archivo);
        previewImagen.src = urlPreviewImagen;
        cancelarCambioImagen.classList.remove('d-none');
        alertaMensaje('Se ha cambiado la imágen del jugador', 1200, 'success')
    });

    cancelarCambioImagen.addEventListener('click', (event) => {
        event.preventDefault();
        alertaMensaje('Se ha restablecido la imágen original', 1200, 'success')
        restaurarImagenOriginal();
    });
})();

const alertaMensaje = (msg, time, icon) => {
    const toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: time,
        //timerProgressBar: true,
        //height: '200rem',
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
        customClass: {
            // container: '...',
            popup: 'popup-class',
        }
    });
    toast.fire({
        position: "top-end",
        icon: icon,
        title: msg,
    });
}