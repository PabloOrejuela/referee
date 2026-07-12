<link rel="stylesheet" href="<?= site_url(); ?>public/css/form-nueva-liga.css">
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
                            <h5 class="mb-0">Registrar nuevo arbitro</h5>
                        </div>
                        <div class="card-body">

                            <form action="<?= site_url('jugadores/guardar') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <h6 class="mb-3">Datos del usuario</h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label">Nombre completo</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= old('nombre') ?>" placeholder="Ingrese nombre completo" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="usuario" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?= old('usuario') ?>" placeholder="Ingrese nombre de usuario" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese una contraseña" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="usuario@correo.com" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="documento" class="form-label">Documento</label>
                                        <input type="text" class="form-control" id="documento" name="documento" value="<?= old('documento') ?>" placeholder="DNI, cédula o pasaporte">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="telf_1" class="form-label">Teléfono</label>
                                        <input type="tel" class="form-control" id="telf_1" name="telf_1" value="<?= old('telf_1') ?>" placeholder="Ej. 0991234567">
                                    </div>

                                    <div class="col-12">
                                        <label for="direccion" class="form-label">Dirección</label>
                                        <textarea class="form-control" id="direccion" name="direccion" rows="2" placeholder="Ingrese la dirección"><?= old('direccion') ?></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="fecha_nac" class="form-label">Fecha de nacimiento</label>
                                        <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" value="<?= old('fecha_nac') ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="idrol" class="form-label">Rol</label>
                                        <select id="idrol" name="idrol" class="form-select">
                                            <option value="">Seleccione un rol</option>
                                            <?php
                                            if (isset($roles)) {
                                                foreach ($roles as $key => $rol) {
                                                    echo '<option value="' . $rol->id . '">' . $rol->rol . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select id="estado" name="estado" class="form-select">
                                            <option value="activo" <?= old('estado') === 'activo' ? 'selected' : '' ?>>Activo</option>
                                            <option value="inactivo" <?= old('estado') === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="imagen" class="form-label">Foto / imagen</label>
                                        <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*">
                                    </div>

                                    <div class="col-md-6 d-flex align-items-end">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_logged" name="is_logged" value="1" <?= old('is_logged') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="is_logged">Mantener sesión activa</label>
                                        </div>
                                    </div>


                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a href="<?= site_url() ?>" class="btn btn-secondary ms-2">Cancelar</a>
                                    </div>
                                </div>
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