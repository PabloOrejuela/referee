<link rel="stylesheet" href="<?= site_url(); ?>public/css/form-edit-arbitro.css">
<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?= $title; ?></h3>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Editar datos del árbitro</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('update-arbitro') ?>" method="post">
                                <?= csrf_field() ?>
                                <?php
                                    if ($arbitro) {
                                        echo '
                                            <div class="row gy-3">
                                                <div class="col-12">
                                                    <h6 class="mb-3">Datos del usuario</h6>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="nombre" class="form-label">Nombre completo</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="'.$arbitro->nombre.'" placeholder="Ingrese nombre completo" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="documento" class="form-label">Documento</label>
                                                    <input type="text" class="form-control" id="documento" name="documento" value="'.$arbitro->documento.'" placeholder="DNI, cédula o pasaporte">
                                                    <p id="error-message">'.session('errors.documento').'</p>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="telf_1" class="form-label">Teléfono</label>
                                                    <input type="tel" class="form-control" id="telf_1" name="telf_1" value="'.$arbitro->telf_1.'" placeholder="Ej. 0991234567">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="fecha_nac" class="form-label">Fecha de nacimiento</label>
                                                    <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" value="'.$arbitro->fecha_nac.'">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="idrol" class="form-label">Rol</label>
                                                    <input type="tel" class="form-control" id="idrol" name="idrol" value="ARBITRO">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="estado" class="form-label">Estado</label>
                                                    <select id="estado" name="estado" class="form-select">
                                                        <option value="1"'.((old('estado') ?: $arbitro->estado) === '1' ? ' selected' : '').'>Activo</option>
                                                        <option value="0"'.((old('estado') ?: $arbitro->estado) === '0' ? ' selected' : '').'>Inactivo</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 mt-4">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                    <a href="'.site_url().'arbitros" class="btn btn-secondary ms-2">Cancelar</a>
                                                </div>
                                            </div>
                                        ';
                                        echo form_hidden('id', $arbitro->id);
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= site_url(); ?>public/js/form-edit-arbitro.js"></script>