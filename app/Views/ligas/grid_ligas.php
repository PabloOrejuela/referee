<link rel="stylesheet" href="<?= site_url(); ?>public/css/grid-torneos.css">
<section class="torneos-grid-page">
    <div class="page-header mb-4">
        <div class="container-fluid">
            <div class="card shadow-sm border-0 rounded-4 bg-body-tertiary overflow-hidden">
                <div class="card-body p-4">
                    <div class="row align-items-center gy-3">
                        <div class="col-md-8">
                            <h2 class="h4 mb-1">Filtrar ligas por provincia</h2>
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

    <div class="torneos-grid">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4" id="torneosGrid">
                <div class="col">
                    <!-- <div class="card liga-card h-100 shadow-sm border-0">
                        <div class="liga-card-header text-white d-flex align-items-center px-4">
                            <div class="liga-title flex-grow-1">Afap Formativas</div>
                            <span class="liga-flag"></span>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="liga-logo rounded-3 shadow-sm bg-white d-flex align-items-center justify-content-center">
                                    <span class="liga-logo-text">A.F.A.P</span>
                                </div>
                                <div class="liga-meta">
                                    <h5 class="card-title mb-1">Afap Formativas</h5>
                                    <p class="text-muted mb-1">Quito - Ecuador</p>
                                    <p class="text-secondary mb-0 text-truncate">afapformativas.sadcaf.co...</p>
                                </div>
                            </div>
                            <a href="#" class="liga-favorite-link text-decoration-none fw-semibold text-primary">
                                <i class="bi bi-star me-2"></i>Escoger como torneo favorito
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?= site_url(); ?>public/js/grid_ligas.js"></script>