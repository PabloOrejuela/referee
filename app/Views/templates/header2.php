<link rel="stylesheet" href="<?= site_url(); ?>public/css/header.css">

<!-- App wrapper -->
<div class="app-wrapper">

  <!-- Main header -->
  <nav class="main-header navbar navbar-expand navbar-light bg-white">
    <div class="container-fluid">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
            <i class="bi bi-list"></i>
          </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
          <a href="<?= site_url(); ?>" class="nav-link">Inicio</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ms-auto">
        <!-- Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="bi bi-search"></i>
          </a>
        </li>

        <!-- Notifications -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-bs-toggle="dropdown" href="#">
            <i class="bi bi-bell-fill"></i>
            <span class="badge bg-warning text-dark">15</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg">
            <li class="dropdown-header">15 Notifications</li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-envelope me-2"></i>4 new messages <span class="float-end text-muted small">3 mins</span></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-people me-2"></i>8 friend requests <span class="float-end text-muted small">12 hours</span></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-text me-2"></i>3 new reports <span class="float-end text-muted small">2 days</span></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item dropdown-footer" href="#">See All Notifications</a></li>
          </ul>
        </li>

        <!-- Theme toggle -->
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="themeToggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-circle-half"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeToggle">
            <li><button class="dropdown-item" data-bs-theme-value="light">Light</button></li>
            <li><button class="dropdown-item" data-bs-theme-value="dark">Dark</button></li>
            <li><button class="dropdown-item active" data-bs-theme-value="auto">Auto</button></li>
          </ul>
        </li>

        <?php $usuario = session()->get('user'); ?>

        <!-- User menu -->
        <li class="nav-item dropdown user-menu">
          <?php if ($usuario): ?>
            <?php $usuarioName = is_array($usuario) ? ($usuario['nombre'] . (isset($usuario['apellido']) ? ' ' . $usuario['apellido'] : '')) : ($usuario->nombre . (isset($usuario->apellido) ? ' ' . $usuario->apellido : '')); ?>
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img src="<?= site_url(); ?>public/img/user-default.png" class="rounded-circle" alt="User Image" style="width:32px;height:32px;object-fit:cover;">
              <span class="d-none d-md-inline ms-1"><?= esc($usuarioName) ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li class="dropdown-header text-center">
                <strong><?= esc($usuarioName) ?></strong>
                <div class="small text-muted"><?= esc($usuario['email'] ?? $usuario->email ?? '') ?></div>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li class="px-3"><a class="btn btn-sm btn-outline-secondary w-100" href="#">Perfil</a></li>
              <li class="px-3 mt-2"><a class="btn btn-sm btn-outline-danger w-100" href="<?= site_url('logout') ?>">Cerrar sesión</a></li>
            </ul>
          <?php else: ?>
            <a href="<?= site_url('form-login'); ?>" class="nav-link">Ingresar</a>
          <?php endif; ?>
        </li>

      </ul>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="app-sidebar-wrapper">
    <aside class="app-sidebar bg-light shadow-sm" data-lte-toggle="collapse">
      <div class="sidebar-brand p-3 text-center">
        <a href="<?= site_url(); ?>" class="d-block">
          <img src="<?= site_url(); ?>public/img/logo.png" alt="logo" class="img-fluid" style="max-height:48px;">
        </a>
      </div>

      <div class="sidebar-menu px-2">
        <nav class="nav flex-column" aria-label="Main navigation">
          <h6 class="text-muted ps-2 mt-2">Menú</h6>
          <a class="nav-link" href="<?= site_url(); ?>torneos"><i class="bi bi-trophy me-2"></i>Campeonatos</a>

          <?php if (userHasPermission('equipo')): ?>
            <a class="nav-link" href="<?= site_url(); ?>equipos"><i class="bi bi-person-badge me-2"></i>Equipos</a>
          <?php endif; ?>

          <?php if (isLoggedIn()): ?>
            <a class="nav-link" href="<?= site_url(); ?>jugadores"><i class="bi bi-person-vcard me-2"></i>Jugadores</a>
          <?php endif; ?>

          <?php if (userHasPermission('arbitraje')): ?>
            <a class="nav-link" href="<?= site_url(); ?>arbitros"><i class="bi bi-people me-2"></i>Arbitros</a>
          <?php endif; ?>

          <?php if (userHasPermission('informes')): ?>
            <a class="nav-link" href="<?= site_url(); ?>reportes"><i class="bi bi-card-list me-2"></i>Reportes</a>
          <?php endif; ?>

        </nav>
      </div>
    </aside>
  </div>
</div>