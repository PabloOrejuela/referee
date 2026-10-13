<!-- <link rel="stylesheet" href="<?= site_url(); ?>public/css/form-nueva-liga.css"> -->
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
                            <h5 class="mb-0">Registrar nuevo usuario</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('update-usuario') ?>" method="post">
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <h6 class="mb-3">Datos del usuario</h6>
                                    </div>
                                <?= csrf_field() ?>
                                <?php
                                    if ($user) {
                                        echo '
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Nombre completo</label>
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="nombre" name="nombre" 
                                                    value="'.$user->nombre.'" 
                                                    placeholder="Ingrese el nombre" 
                                                    required
                                                >
                                                <p id="error-message">'.session('errors.nombre').'</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="usuario" class="form-label">Usuario</label>
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="usuario" 
                                                    name="usuario" 
                                                    value="'.$user->usuario.'" 
                                                    placeholder="Ingrese nombre de usuario" 
                                                    required
                                                >
                                                <p id="error-message">'.session('errors.usuario').'</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Correo electrónico</label>
                                                <input 
                                                    type="email" 
                                                    class="form-control" 
                                                    id="email" 
                                                    name="email" 
                                                    value="'.$user->email.'" 
                                                    placeholder="usuario@correo.com" 
                                                    required
                                                >
                                                <p id="error-message">'.session('errors.email').'</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="documento" class="form-label">Documento</label>
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="documento" 
                                                    name="documento" 
                                                    value="'.$user->documento.'" 
                                                    placeholder="DNI, cédula o pasaporte"
                                                >
                                                <p id="error-message">'.session('errors.email').'</p>                                            
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telf_1" class="form-label">Teléfono</label>
                                                <input 
                                                    type="tel" 
                                                    class="form-control" 
                                                    id="telf_1" 
                                                    name="telf_1" 
                                                    value="'.$user->telf_1.'" 
                                                    placeholder="Ej. 0991234567"
                                                >
                                                <p id="error-message">'.session('errors.telf_1').'</p> 
                                            </div>

                                            <div class="col-12">
                                                <label for="direccion" class="form-label">Dirección</label>
                                                <textarea 
                                                    class="form-control" 
                                                    id="direccion" 
                                                    name="direccion" 
                                                    rows="2" 
                                                    placeholder="Ingrese la dirección">'.$user->direccion.'</textarea>
                                                <p id="error-message">'.session('errors.direccion').'</p> 
                                            </div>
                                            <div class="col-md-4">
                                                <label for="fecha_nac" class="form-label">Fecha de nacimiento</label>
                                                <input 
                                                    type="date" 
                                                    class="form-control" 
                                                    id="fecha_nac" 
                                                    name="fecha_nac" 
                                                    value="'.$user->fecha_nac.'"
                                                >
                                                <p id="error-message">'.session('errors.fecha_nac').'</p> 
                                            </div>
                                        ';
                                    }else{
                                        echo 'No se pudo encontrar datos del usuario';
                                    }
                                ?>
                                    <div class="col-md-4">
                                        <label for="idrol" class="form-label">Rol</label>
                                        <select id="idrol" name="idrol" class="form-select">
                                            <option value="">Seleccione un rol</option>
                                            <?php
                                                if (isset($roles)) {
                                                    foreach ($roles as $key => $rol) {
                                                        if ($rol->id == $user->idrol) {
                                                            echo '<option value="' . $rol->id . '" selected>' . $rol->rol . '</option>';
                                                        }else{
                                                            echo '<option value="' . $rol->id . '">' . $rol->rol . '</option>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <p id="error-message"><?=  session('errors.idrol'); ?></p> 
                                    </div>
                                <?php
                                    echo '<div class="col-md-4">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select id="estado" name="estado" class="form-select">
                                            <option value="1"'.((old('estado') ?: $user->estado) === '1' ? ' selected' : '').'>Activo</option>
                                            <option value="0"'.((old('estado') ?: $user->estado) === '0' ? ' selected' : '').'>Inactivo</option>
                                        </select>
                                        <p id="error-message">'.session('errors.estado').'</p> 
                                        <p id="error-message">'.session('errors.idrol').'</p> 
                                    </div>';
                                    
                                    echo form_hidden('id', $user->id);
                                ?>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a href="<?= site_url(); ?>usuarios" class="btn btn-secondary ms-2">Cancelar</a>
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