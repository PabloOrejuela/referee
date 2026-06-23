<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?= $title; ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= site_url(); ?>">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h4 class="fw-bold">Acceso al sistema</h4>
                                <p class="text-muted mb-0">Ingrese sus credenciales para continuar</p>
                            </div>

                            <?php if (session()->getFlashdata('error')) : ?>
                                <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
                            <?php endif; ?>

                            <form action="<?= site_url('validate-login'); ?>" method="post" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Usuario</label>
                                    <div class="input-group shadow-sm rounded-3 overflow-hidden border border-1 border-secondary-subtle">
                                        <span class="input-group-text bg-white border-0"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" class="form-control border-0" id="username" name="username" placeholder="Ingrese su usuario" required>
                                    </div>
                                    <div class="invalid-feedback">Por favor ingrese su usuario.</div>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group shadow-sm rounded-3 overflow-hidden border border-1 border-secondary-subtle">
                                        <span class="input-group-text bg-white border-0"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" class="form-control border-0" id="password" name="password" placeholder="Ingrese su contraseña" required>
                                    </div>
                                    <div class="invalid-feedback">Por favor ingrese su contraseña.</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="rememberMe" name="remember_me">
                                        <label class="form-check-label" for="rememberMe">Recordarme</label>
                                    </div>
                                    <a href="#" class="text-decoration-none">Olvidé mi contraseña</a>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Ingresar</button>
                            </form>
                        </div>
                    </div>
                    <div class="text-center mt-3 text-muted small">
                        ¿No tienes cuenta? <a href="#" class="text-decoration-none">Regístrate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--end::App Main-->