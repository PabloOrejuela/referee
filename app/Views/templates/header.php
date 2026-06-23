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
                    src="<?= site_url(); ?>adminLTE4/assets/img/user2-160x160.jpg"
                    class="user-image rounded-circle shadow"
                    alt="User Image"
                  />
                  <span class="d-none d-md-inline">Alexander Pierce</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                  <!--begin::User Image-->
                  <li class="user-header text-bg-primary">
                    <img
                      src="<?= site_url(); ?>adminLTE4/assets/img/user2-160x160.jpg"
                      class="rounded-circle shadow"
                      alt="User Image"
                    />
                    <p>
                      Alexander Pierce - Web Developer
                      <small>Member since Nov. 2023</small>
                    </p>
                  </li>
                  <!--end::User Image-->
                  <!--begin::Menu Body-->
                  <li class="user-body">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-4 text-center">
                        <a href="#">Liga favorita</a>
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

      <!--begin::Sidebar -->
      <aside class="app-sidebar bg-body-cesped shadow-sm" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <a href="<?= site_url(); ?>" class="brand-link">
            <img
              src="<?= site_url(); ?>public/img/logo.png"
              alt="Referee logo"
              class="brand-image opacity-85"
              style="max-height:48px;"
            />
          </a>
        </div>
        <!--end::Sidebar Brand-->

        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!-- Back to preview CTA -->
            <div class="px-3 pb-2">
              <a
                href="../index.html"
                class="btn btn-sm btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2"
              >
                <i class="bi bi-arrow-left" aria-hidden="true"></i>
                Back to live preview
              </a>
            </div>

            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Documentation navigation"
              data-accordion="false"
              id="docs-navigation"
            >
              <li class="nav-header">START HERE</li>
              <li class="nav-item">
                <a href="../docs/introduction.html" class="nav-link">
                  <i class="nav-icon bi bi-download"></i>
                  <p>Installation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../docs/getting-started.html" class="nav-link">
                  <i class="nav-icon bi bi-rocket-takeoff"></i>
                  <p>Getting Started</p>
                </a>
              </li>

              <li class="nav-header">FOUNDATIONS</li>
              <li class="nav-item">
                <a href="../docs/layout.html" class="nav-link active">
                  <i class="nav-icon bi bi-grip-horizontal"></i>
                  <p>Layout Classes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../docs/layout-blueprint.html" class="nav-link">
                  <i class="nav-icon bi bi-diagram-3"></i>
                  <p>Layout Blueprint</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../docs/customization.html" class="nav-link">
                  <i class="nav-icon bi bi-palette"></i>
                  <p>Customization</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../docs/color-mode.html" class="nav-link">
                  <i class="nav-icon bi bi-star-half"></i>
                  <p>Color Mode</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../docs/rtl.html" class="nav-link">
                  <i class="nav-icon bi bi-text-paragraph"></i>
                  <p>RTL Support</p>
                </a>
              </li>

              <li class="nav-header">BUILDING</li>
              <li class="nav-item">
                <a href="../docs/recipes.html" class="nav-link">
                  <i class="nav-icon bi bi-clipboard-check"></i>
                  <p>Recipes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-ui-checks-grid"></i>
                  <p>
                    Components
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../docs/components/main-header.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Main Header</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../docs/components/main-sidebar.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Main Sidebar</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-filetype-js"></i>
                  <p>
                    JavaScript Plugins
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../docs/javascript/plugins-overview.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Overview</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../docs/javascript/layout.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Layout</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../docs/javascript/pushmenu.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>PushMenu</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../docs/javascript/treeview.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Treeview</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../docs/javascript/card-widget.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Card Widget</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../docs/javascript/direct-chat.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Direct Chat</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../docs/javascript/fullscreen.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Fullscreen</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../docs/javascript/accessibility.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Accessibility</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="../docs/integrations.html" class="nav-link">
                  <i class="nav-icon bi bi-puzzle"></i>
                  <p>Integrations</p>
                </a>
              </li>

              <li class="nav-header">SHIPPING</li>
              <li class="nav-item">
                <a href="../docs/migration.html" class="nav-link">
                  <i class="nav-icon bi bi-arrow-up-right-square"></i>
                  <p>Migration from v3</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../docs/deployment.html" class="nav-link">
                  <i class="nav-icon bi bi-cloud-upload"></i>
                  <p>Deployment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../docs/browser-support.html" class="nav-link">
                  <i class="nav-icon bi bi-browser-chrome"></i>
                  <p>Browser Support</p>
                </a>
              </li>

              <li class="nav-header">RESOURCES</li>
              <li class="nav-item">
                <a href="../docs/faq.html" class="nav-link">
                  <i class="nav-icon bi bi-question-circle"></i>
                  <p>FAQ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../docs/how-to-contribute.html" class="nav-link">
                  <i class="nav-icon bi bi-people"></i>
                  <p>Contributing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../docs/license.html" class="nav-link">
                  <i class="nav-icon bi bi-patch-check"></i>
                  <p>License</p>
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="https://github.com/ColorlibHQ/AdminLTE"
                  target="_blank"
                  rel="noopener"
                  class="nav-link"
                >
                  <i class="nav-icon bi bi-github"></i>
                  <p>
                    GitHub
                    <i class="bi bi-box-arrow-up-right ms-1" aria-hidden="true"></i>
                  </p>
                </a>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar (docs mode)--> 