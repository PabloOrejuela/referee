<link rel="stylesheet" href="<?= site_url(); ?>public/css/form-califica-arbitro.css">
<style>
.calificacion {
    display: flex;
    gap: 3px;
}

.calificacion span {
    font-size: 30px;
    color: #ccc;
    cursor: pointer;
}

.calificacion span.activa {
    color: #000;
}
</style>
<div class="col-md-6">
    <div class="card card-warning card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Importar Lista de Arbitros</div>
        </div>
        <div class="card-body">
            <div class="calificacion" id="calificacion">
            <span data-value="1">★</span>
            <span data-value="2">★</span>
            <span data-value="3">★</span>
            <span data-value="4">★</span>
            <span data-value="5">★</span>
            <span data-value="6">★</span>
            <span data-value="7">★</span>
            <span data-value="8">★</span>
            <span data-value="9">★</span>
            <span data-value="10">★</span>
        </div>

        <input type="hidden" name="calificacion" id="valorCalificacion">
        </div>
    </div>
</div>

<script>

const calificacion = document.getElementById('calificacion');
const estrellas = calificacion.querySelectorAll('span');
const valorCalificacion = document.getElementById('valorCalificacion');

calificacion.addEventListener('mousemove', function(e) {

    let valor = 0;

    estrellas.forEach(estrella => {

        const rect = estrella.getBoundingClientRect();

        if (
            e.clientX >= rect.left &&
            e.clientX <= rect.right &&
            e.clientY >= rect.top &&
            e.clientY <= rect.bottom
        ) {
            valor = Number(estrella.dataset.value);
        }

    });

    if (valor > 0) {

        estrellas.forEach(estrella => {

            estrella.classList.toggle(
                'activa',
                Number(estrella.dataset.value) <= valor
            );

        });

    }

});

calificacion.addEventListener('click', function(e) {

    estrellas.forEach(estrella => {

        const rect = estrella.getBoundingClientRect();

        if (
            e.clientX >= rect.left &&
            e.clientX <= rect.right &&
            e.clientY >= rect.top &&
            e.clientY <= rect.bottom
        ) {
            valorCalificacion.value = estrella.dataset.value;
        }

    });

});

calificacion.addEventListener('mouseleave', function() {

    const valor = Number(valorCalificacion.value);

    estrellas.forEach(estrella => {

        estrella.classList.toggle(
            'activa',
            Number(estrella.dataset.value) <= valor
        );

    });

});
</script>

