<!--begin::Sidebar -->
      <aside class="app-sidebar bg-body-dark" data-bs-theme="dark">
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
          <nav class="nav flex-column mt-2 ">

            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Documentation navigation"
              data-accordion="true"
              id="docs-navigation"
            >

            <h5 class="nav-header">Menú</h5>
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-person-badge"></i>
                  <p>
                    Administración
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>usuarios" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Usuarios</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>form-nuevo-usuario" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Registrar un usuario</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="<?= site_url(); ?>campeonatos" class="nav-link">
                  <i class="nav-icon bi bi-trophy"></i>
                  <p>Campeonatos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-person-badge"></i>
                  <p>
                    Ligas
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>ligas" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Ver ligas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>form-nueva-liga" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Registrar una liga</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>form-nueva-liga" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Registrar ingresos/gastos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>form-nueva-liga" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Informe financiero</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-person-badge"></i>
                  <p>
                    Equipos
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>equipos" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Ver equipos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>form-nuevo-equipo" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Registrar un eqiupo</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-person-vcard"></i>
                  <p>
                    Jugadores
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>jugadores" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Lista de jugadores</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>form-nuevo-jugador" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Registrar un jugador</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-people"></i>
                  <p>
                    Arbitros
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>arbitros" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Lista de Arbitros</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>form-nuevo-arbitro" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Registrar un árbitro</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>form-califica-arbitro" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Calificar árbitro</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-list"></i>
                  <p>
                    Reportes
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url(); ?>vocalias" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Informes de vocalía</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar (docs mode)--> 