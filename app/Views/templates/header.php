<link rel="stylesheet" href="<?= site_url(); ?>public/css/header.css">
  <!--begin::App Wrapper-->
    <div class="app-wrapper">  
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="<?= site_url(); ?>" class="nav-link">Inicio</a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">

            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notificationes</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 15 nuevos mensajes
                  <span class="float-end text-secondary fs-7">3 minutoss</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> Ver todas las notificaciones </a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->

            <!--begin::Color Mode Toggle (#6010)-->
            <li class="nav-item dropdown">
              <a
                class="nav-link"
                href="#"
                id="bd-theme"
                aria-label="Toggle color scheme"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
              </a>
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="bd-theme"
                style="--bs-dropdown-min-width: 8rem"
              >
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="light"
                    aria-pressed="false"
                  >
                    <i class="bi bi-sun-fill me-2"></i>
                    Light
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="dark"
                    aria-pressed="false"
                  >
                    <i class="bi bi-moon-fill me-2"></i>
                    Dark
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center active"
                    data-bs-theme-value="auto"
                    aria-pressed="true"
                  >
                    <i class="bi bi-circle-half me-2"></i>
                    Auto
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
              </ul>
            </li>
            <!--end::Color Mode Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <?php 
                echo '<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                  <img
                    src="'.site_url().'adminLTE4/assets/img/user2-160x160.jpg"
                    class="user-image rounded-circle shadow"
                    alt="User Image"
                  />
                  <span class="d-none d-md-inline">Iniciar sesión</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                  <!--begin::User Image-->
                  <li class="user-header text-bg-primary">
                    <img
                      src="'.site_url().'adminLTE4/assets/img/user2-160x160.jpg"
                      class="rounded-circle shadow"
                      alt="User Image"
                    />
                    <p>
                      Iniciar sesión
                      <small>Member since Nov. 2023</small>
                    </p>
                  </li>
                  <!--end::User Image-->
                  <!--begin::Menu Body-->
                  <li class="user-body">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-4 text-center">
                        <a href="'.site_url().'">Liga favorita</a>
                      </div>
                    </div>
                    <!--end::Row-->
                  </li>
                  <!--end::Menu Body-->
                  <!--begin::Menu Footer-->
                  <li class="user-footer">
                    <a href="#" class="btn btn-outline-secondary">Profile</a>
                    <a href="#" class="btn btn-outline-danger float-end">Cerrar sesión</a>
                  </li>
                  <!--end::Menu Footer-->
                </ul>';
              ?>

            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
        