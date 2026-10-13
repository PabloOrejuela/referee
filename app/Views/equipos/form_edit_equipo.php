<link rel="stylesheet" href="<?= site_url(); ?>public/css/form-edit-equipo.css">
<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?= esc($title); ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Editar datos del equipo</h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($equipo) && $equipo): ?>
                                <form action="<?= site_url('update-equipo/' . $equipo->id); ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field() ?>
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <h6 class="mb-3">Datos del equipo</h6>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="nombre"
                                                name="nombre"
                                                value="<?= esc(old('nombre', $equipo->nombre)); ?>"
                                                placeholder="Ingrese el nombre del equipo"
                                                required
                                            >
                                        </div>

                                        <div class="col-md-6">
                                            <label for="siglas" class="form-label">Siglas</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="siglas"
                                                name="siglas"
                                                value="<?= esc(old('siglas', $equipo->siglas)); ?>"
                                                placeholder="Ej. ABC"
                                                required
                                            >
                                        </div>

                                        <div class="col-12">
                                            <label for="descripcion" class="form-label">Descripción</label>
                                            <textarea
                                                class="form-control"
                                                id="descripcion"
                                                name="descripcion"
                                                rows="3"
                                                placeholder="Ingrese una descripción del equipo"
                                            ><?= esc(old('descripcion', $equipo->descripcion)); ?></textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="fecha_fundacion" class="form-label">Fecha de fundación</label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="fecha_fundacion"
                                                name="fecha_fundacion"
                                                value="<?= esc(old('fecha_fundacion', $equipo->fecha_fundacion)); ?>"
                                            >
                                        </div>

                                        <div class="col-12">
                                            <div class="row align-items-center gy-3">
                                                <div class="col-md-6">
                                                    <label for="imagen" class="form-label">Escudo / imagen</label>
                                                    <input
                                                        class="form-control"
                                                        type="file"
                                                        id="imagen"
                                                        name="imagen"
                                                        accept="image/jpeg,image/png,image/webp"
                                                    >
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label d-block">Escudo del equipo</label>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div>
                                                            <img
                                                                id="preview-imagen"
                                                                src="<?= base_url('public/img/equipos/' . rawurlencode($equipo->imagen ?? '')); ?>"
                                                                alt="Escudo de <?= esc($equipo->nombre); ?>"
                                                                style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;"
                                                            >
                                                            <a href="#" id="cancelar-cambio-imagen" class="d-none mt-2">
                                                                Cancelar cambio de imagen
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            <a href="<?= site_url('equipos'); ?>" class="btn btn-secondary ms-2">Cancelar</a>
                                        </div>
                                    </div>
                                </form>
                            <?php else: ?>
                                <div class="alert alert-warning mb-0">No se encontró el equipo solicitado.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= site_url(); ?>public/js/form-edit-equipo.js"></script>
