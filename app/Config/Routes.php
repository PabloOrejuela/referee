<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Inicio::index');
$routes->get('login', 'Inicio::formLogin');
$routes->get('form-login', 'Inicio::formLogin');
$routes->post('validate-login', 'Inicio::validateLogin');
$routes->get('logout', 'Inicio::logout');


//Arbitros
$routes->get('arbitros', 'Arbitros::index');
$routes->get('form-califica-arbitro', 'Arbitros::formCalificaArbitro', ['filter' => 'auth:arbitraje']);
$routes->get('form-edit-arbitro/(:num)', 'Arbitros::formEditArbitro/$1', ['filter' => 'auth:arbitraje']);
$routes->get('form-nuevo-arbitro', 'Arbitros::formNuevoArbitro', ['filter' => 'auth:arbitraje']);
$routes->get('form-load-arbitros', 'Arbitros::formLoadArbitrosData', ['filter' => 'auth:arbitraje']);
$routes->post('insert-arbitro', 'Arbitros::insertArbitro', ['filter' => 'auth:arbitraje']);
$routes->post('load-arbitros', 'Arbitros::loadArbitrosData', ['filter' => 'auth:arbitraje']);
$routes->post('update-arbitro', 'Arbitros::updateArbitro', ['filter' => 'auth:arbitraje']);

//CAMPEONATOS
$routes->get('campeonatos/provincia/(:num)', 'Campeonatos::getLigasByProvincia/$1');

// Equipos (requiere permiso 'equipo')
$routes->get('equipos', 'Equipos::equipos');
$routes->get('form-edit-equipo/(:num)', 'Equipos::formEditEquipo/$1', ['filter' => 'auth:equipo']);
$routes->get('form-load-equipos', 'Equipos::formLoadEquiposData', ['filter' => 'auth:equipo']);
$routes->get('form-nuevo-equipo', 'Equipos::formNewEquipo', ['filter' => 'auth:equipo']);
$routes->post('insert-equipo', 'Equipos::insertEquipo', ['filter' => 'auth:equipo']);
$routes->post('load-equipos', 'Equipos::loadEquiposData', ['filter' => 'auth:equipo']);
$routes->post('update-equipo/(:num)', 'Equipos::updateEquipo/$1', ['filter' => 'auth:equipo']);

//Jugadores
$routes->get('form-load-jugadores', 'Jugadores::formLoadJugadoresData', ['filter' => 'auth:jugador']);
$routes->get('jugadores/campeonatos/(:num)', 'Jugadores::getCampeonatosByLiga/$1', ['filter' => 'auth:jugador']);
$routes->get('jugadores/equipos/(:num)', 'Jugadores::getEquiposByCampeonato/$1', ['filter' => 'auth:jugador']);
$routes->get('form-nuevo-jugador', 'Jugadores::formNuevoJugador', ['filter' => 'auth:jugador']);
$routes->get('form-edit-jugador/(:num)', 'Jugadores::formEditJugador/$1', ['filter' => 'auth:jugador']);
$routes->get('jugadores', 'Jugadores::index');
$routes->post('load-jugadores', 'Jugadores::loadJugadoresData', ['filter' => 'auth:jugador']);
$routes->post('update-jugador', 'Jugadores::updateJugador', ['filter' => 'auth:jugador']);

//Ligas
$routes->get('ligas', 'Ligas::index');
$routes->get('ligas/provincia/(:num)', 'Ligas::getLigasByProvincia/$1');
$routes->get('form-nueva-liga', 'Ligas::formNuevaLiga', ['filter' => 'auth:liga']);
$routes->post('insert-liga', 'Ligas::insertLiga', ['filter' => 'auth:liga']);

// Reportes (requiere permiso 'informes')
$routes->get('reportes', 'Reportes::index', ['filter' => 'auth:informes']);

//Torneos
$routes->get('campeonatos', 'Campeonatos::index');

//Usuarios
$routes->get('usuarios', 'Usuarios::index', ['filter' => 'auth:*']);
$routes->post('insert-usuario', 'Usuarios::insertUsuario', ['filter' => 'auth:*']);
$routes->get('form-nuevo-usuario', 'Usuarios::formNuevoUsuario', ['filter' => 'auth:*']);
$routes->get('form-edit-usuario/(:num)', 'Usuarios::formEditUsuario/$1', ['filter' => 'auth:*']);
$routes->post('update-usuario', 'Usuarios::updateUsuario', ['filter' => 'auth:*']);

