<link rel="stylesheet" href="<?= site_url(); ?>public/css/grid-productos.css">

<div class="col-md-6">
    <div class="card card-warning card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Importar Lista de Jugadores</div>
        </div>
        <div class="card-body">
            <form id="form-import-jugadores" action="<?=  site_url(); ?>load-jugadores" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label" for="select-liga">Liga</label>
                    <select class="form-select" id="select-liga" name="idliga" required>
                        <option value="">Seleccione una liga</option>
                        <?php foreach ($ligas as $liga): ?>
                            <option value="<?= esc($liga->id); ?>"><?= esc($liga->nombre_liga); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="select-campeonato">Campeonato</label>
                    <select class="form-select" id="select-campeonato" name="idcampeonato" disabled required>
                        <option value="">Seleccione primero una liga</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="select-equipo">Equipo</label>
                    <select class="form-select" id="select-equipo" name="idequipo" disabled required>
                        <option value="">Seleccione primero un campeonato</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="form-file-multi">Subir archivo Excel (.xlsx, .xls, .csv)</label>
                    <input class="form-control" type="file" name="excelEquipos" id="form-file-multi" multiple />
                </div>
                
                <button class="btn btn-primary" type="submit">Enviar</button>
                <button class="btn btn-secondary" type="reset">Limpiar campos</button>
            </form>
        </div>
    </div>
</div>

<script>
(() => {
    const ligaSelect = document.getElementById('select-liga');
    const campeonatoSelect = document.getElementById('select-campeonato');
    const equipoSelect = document.getElementById('select-equipo');
    const form = document.getElementById('form-import-jugadores');
    const campeonatosUrl = <?= json_encode(site_url('jugadores/campeonatos')); ?>;
    const equiposUrl = <?= json_encode(site_url('jugadores/equipos')); ?>;

    const resetSelect = (select, placeholder) => {
        select.replaceChildren(new Option(placeholder, ''));
        select.disabled = true;
    };

    const loadOptions = async (url, select, placeholder, labelField) => {
        resetSelect(select, 'Cargando...');
        try {
            const response = await fetch(url, { headers: { Accept: 'application/json' } });
            if (!response.ok) throw new Error('No se pudieron cargar las opciones');
            const options = await response.json();
            resetSelect(select, placeholder);
            options.forEach((item) => select.add(new Option(item[labelField], item.id)));
            select.disabled = options.length === 0;
            if (options.length === 0) resetSelect(select, 'No hay opciones disponibles');
        } catch (error) {
            resetSelect(select, 'Error al cargar opciones');
        }
    };

    form.addEventListener('reset', () => {
        // El reset nativo limpia también el input file. Reponer los selects luego
        // del reset evita que queden seleccionadas opciones cargadas dinámicamente.
        window.setTimeout(() => {
            resetSelect(campeonatoSelect, 'Seleccione primero una liga');
            resetSelect(equipoSelect, 'Seleccione primero un campeonato');
        }, 0);
    });

    ligaSelect.addEventListener('change', () => {
        resetSelect(equipoSelect, 'Seleccione primero un campeonato');
        if (!ligaSelect.value) {
            resetSelect(campeonatoSelect, 'Seleccione primero una liga');
            return;
        }
        loadOptions(`${campeonatosUrl}/${encodeURIComponent(ligaSelect.value)}`, campeonatoSelect, 'Seleccione un campeonato', 'campeonato');
    });

    campeonatoSelect.addEventListener('change', () => {
        if (!campeonatoSelect.value) {
            resetSelect(equipoSelect, 'Seleccione primero un campeonato');
            return;
        }
        loadOptions(`${equiposUrl}/${encodeURIComponent(campeonatoSelect.value)}`, equipoSelect, 'Seleccione un equipo', 'nombre');
    });
})();
</script>
