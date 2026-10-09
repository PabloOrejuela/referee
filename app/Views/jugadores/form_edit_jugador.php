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
                            <h5 class="mb-0">Editar información del jugador</h5>
                        </div>
                        <div class="card-body">

                            <form action="<?= site_url('jugador-update') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <h6 class="mb-3">Datos del jugador</h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            id="nombre" 
                                            name="nombre" 
                                            value="<?= old('nombre', $jugador->nombre); ?>"
                                            placeholder="Ingrese nombre" 
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6">
                                        <label for="apellido" class="form-label">Apellido</label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            id="apellido" 
                                            name="apellido" 
                                            value="<?= old('apellido', $jugador->apellido); ?>"
                                            placeholder="Ingrese apellido" 
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6">
                                        <label for="apodo" class="form-label">Seudónimo</label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            id="apodo" 
                                            name="apodo" 
                                            value="<?= old('email', $jugador->apodo); ?>"
                                            placeholder="Ingrese pseudónimo de usuario" 
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <input 
                                            type="email" 
                                            class="form-control" 
                                            id="email" 
                                            name="email" 
                                            value="<?= old('email', $jugador->email); ?>"
                                            placeholder="usuario@correo.com" 
                                        >
                                    </div>

                                    <div class="col-md-6">
                                        <label for="documento" class="form-label">Documento</label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            id="documento" 
                                            name="documento" 
                                            value="<?= old('documento', $jugador->documento); ?>"
                                            placeholder="DNI, cédula o pasaporte"
                                        >
                                    </div>

                                    <div class="col-md-6">
                                        <label for="telf" class="form-label">Teléfono</label>
                                        <input 
                                            type="tel" 
                                            class="form-control" 
                                            id="telf" 
                                            name="telf" 
                                            value="<?= old('telf', $jugador->telf); ?>"
                                            placeholder="Ej. 0991234567"
                                        >
                                    </div>

                                    <div class="col-12">
                                        <label for="direccion" class="form-label">Dirección</label>
                                        <textarea 
                                            class="form-control" 
                                            id="direccion" 
                                            name="direccion" 
                                            rows="2" 
                                            placeholder="Ingrese la dirección"><?= old('direccion', $jugador->direccion); ?></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="fecha_nac" class="form-label">Fecha de nacimiento</label>
                                        <input 
                                            type="date" 
                                            class="form-control" 
                                            id="fecha_nac" 
                                            name="fecha_nac" 
                                            value="<?= old('fecha_nac', $jugador->fecha_nac); ?>"
                                        >
                                    </div>

                                    <div class="col-md-4">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select id="estado" name="estado" class="form-select">
                                            <option value="1"<?= (old('estado') ?: $jugador->estado) === '1' ? ' selected' : '' ?>>Activo</option>
                                            <option value="0"<?= (old('estado') ?: $jugador->estado) === '0' ? ' selected' : '' ?>>Inactivo</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="imagen" class="form-label">Foto / imagen</label>
                                        <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="imagen" class="form-label">Foto del Jugador</label>

                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <img 
                                                    id="preview-imagen"
                                                    src="<?= base_url('public/img/jugadores/' . $jugador->imagen); ?>"
                                                    alt="Imagen del usuario"
                                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <h6 class="mb-3">Información extra:</h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="pierna_habil" class="form-label">Pierna hábil</label>
                                        <select id="pierna_habil" name="pierna_habil" class="form-select">
                                            <option value="">Seleccione una opción</option>
                                            <option value="1" <?= old('pierna_habil', $jugador->pierna_habil) == 1 ? 'selected' : '' ?>>Izquierda</option>
                                            <option value="2" <?= old('pierna_habil', $jugador->pierna_habil) == 2 ? 'selected' : '' ?>>Derecha</option>
                                            <option value="3" <?= old('pierna_habil', $jugador->pierna_habil) == 3 ? 'selected' : '' ?>>Ambas</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="posicion" class="form-label">Posición</label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            id="posicion" 
                                            name="posicion" 
                                            value="<?= old('posicion', $jugador->posicion); ?>" 
                                            placeholder="Ej. Mediocampista"
                                        >
                                    </div>

                                    <div class="col-md-3">
                                        <label for="altura" class="form-label">Altura (m)</label>
                                        <input 
                                            type="number" 
                                            step="0.01" 
                                            class="form-control" 
                                            id="altura" 
                                            name="altura" 
                                            value="<?= old('altura', $jugador->altura); ?>" 
                                            placeholder="1.80"
                                        >
                                    </div>

                                    <div class="col-md-3">
                                        <label for="peso" class="form-label">Peso (kg)</label>
                                        <input 
                                            type="number" 
                                            step="0.1" 
                                            class="form-control" 
                                            id="peso" 
                                            name="peso" 
                                            value="<?= old('peso', $jugador->peso); ?>" 
                                            placeholder="75.0"
                                        >
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a href="<?= site_url() ?>jugadores" class="btn btn-secondary ms-2">Cancelar</a>
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