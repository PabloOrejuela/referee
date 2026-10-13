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
                            <h5 class="mb-0">Registrar nuevo equipo</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('insert-equipo'); ?>" method="post" enctype="multipart/form-data">
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
                                            value="<?= esc(old('nombre', '')); ?>"
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
                                            value="<?= esc(old('siglas', '')); ?>"
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
                                        ><?= esc(old('descripcion')); ?></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="fecha_fundacion" class="form-label">Fecha de fundación</label>
                                        <input
                                            type="date"
                                            class="form-control"
                                            id="fecha_fundacion"
                                            name="fecha_fundacion"
                                            value="<?= esc(old('fecha_fundacion')); ?>"
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
                                                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100'%3E%3Crect width='100%25' height='100%25' fill='%23f1f3f5'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%236c757d' font-size='12'%3ESin imagen%3C/text%3E%3C/svg%3E"
                                                            alt="Vista previa del escudo del equipo"
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
