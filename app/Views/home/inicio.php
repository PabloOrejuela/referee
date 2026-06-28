<link rel="stylesheet" href="<?= site_url(); ?>public/css/content.css">
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
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= site_url(); ?>">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Inicio</li>
                    </ol>
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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="fw-bold">Bienvenido !</h5>
                            
                            <div class="text-center">
                                <img src="<?= site_url() ?>public/img/logo-grande.png" alt="logo" id="logo-grande1">
                            </div>
                            <h4>Sobre la app</h4>
                            <p>
                                Aquí va un texto de bienvenida y abajo una explicación rápida de que encontrar en la app
                            </p>
                            <ul>
                                <li>
                                    Poner aquí Texto (Pedirle a Junior que se invente algo)
                                </li>
                                <li>
                                    Poner aquí Texto (Pedirle a Junior que se invente algo)
                                </li>
                                <li>
                                    Poner aquí Texto (Pedirle a Junior que se invente algo)
                                </li>
                            </ul>
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