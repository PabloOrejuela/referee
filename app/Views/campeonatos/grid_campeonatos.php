<link rel="stylesheet" href="<?= site_url(); ?>public/css/grid-torneos.css">
<section class="torneos-grid-page">
    <div class="page-header mb-4">
        <div class="container-fluid">
            <div class="card shadow-sm border-0 rounded-4 bg-body-tertiary overflow-hidden">
                <div class="card-body p-4">
                    <div class="row align-items-center gy-3">
                        <div class="col-md-8">
                            <h2 class="h4 mb-1">Gestión de campeonatos</h2>
                            <p class="text-muted mb-0">Selecciona una provincia para ver las ligas disponibles.</p>
                        </div>
                        <div class="col-md-4">
                            <label for="provinciaSelect" class="form-label visually-hidden">Provincia</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden border border-1 border-secondary-subtle">
                                <span class="input-group-text bg-white border-0"><i class="bi bi-geo-alt-fill"></i></span>
                                <select id="provinciaSelect" class="form-select border-0" aria-label="Seleccionar provincia">
                                    <option value="" selected>Elige una provincia</option>
                                    <?php if (!empty($provincias)): ?>
                                        <?php foreach ($provincias as $provincia): ?>
                                            <option value="<?= esc($provincia->id ?? '') ?>">
                                                <?= esc($provincia->provincia ?? '') ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="grid"></div>
</section>

<script src="<?= site_url(); ?>public/js/grid_campeonatos.js"></script>
