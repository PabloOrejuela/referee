<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Inicio::index');
$routes->get('form-login', 'Inicio::formLogin');
$routes->post('validate-login', 'Inicio::validateLogin');
$routes->get('logout', 'Inicio::logout');

//Torneos
$routes->get('campeonatos', 'Campeonatos::index');

//Usuarios
$routes->get('usuarios', 'Usuarios::index');
$routes->get('form-nuevo-usuario', 'Usuarios::formNuevoUsuario');
$routes->get('form-edit-usuario/(:num)', 'Usuarios::formEditUsuario/$1');

//Arbitros
$routes->get('arbitros', 'Arbitros::index');
$routes->get('form-califica-arbitro', 'Arbitros::formCalificaArbitro');
$routes->get('form-edit-arbitro/(:num)', 'Arbitros::formEditArbitro/$1');
$routes->get('form-nuevo-arbitro', 'Arbitros::formNuevoArbitro');
$routes->get('form-load-arbitros', 'Arbitros::formLoadArbitrosData');
$routes->post('insert-arbitro', 'Arbitros::insertArbitro');
$routes->post('load-arbitros', 'Arbitros::loadArbitrosData');
$routes->post('update-arbitro', 'Arbitros::updateArbitro');

//CAMPEONATOS
$routes->get('campeonatos/provincia/(:num)', 'Campeonatos::getLigasByProvincia/$1');

//Ligas
$routes->get('ligas', 'Ligas::index');
$routes->get('ligas/provincia/(:num)', 'Ligas::getLigasByProvincia/$1');
$routes->get('form-nueva-liga', 'Ligas::formNuevaLiga');
$routes->post('insert-liga', 'Ligas::insertLiga');


// Equipos (requiere permiso 'equipo')
$routes->get('equipos', 'Equipos::equipos');
$routes->get('form-load-equipos', 'Equipos::formLoadEquiposData');
$routes->post('load-equipos', 'Equipos::loadEquiposData');
//$routes->get('equipos', 'Equipos::index', ['filter' => 'auth:equipo']);

// Arbitros (requiere permiso 'arbitraje')
$routes->get('arbitros', 'Arbitros::index', ['filter' => 'auth:arbitraje']);

// Reportes (requiere permiso 'informes')
$routes->get('reportes', 'Reportes::index', ['filter' => 'auth:informes']);

//Jugadores
$routes->get('jugadores', 'Jugadores::index');
$routes->get('form-nuevo-jugador', 'Jugadores::formNuevoJugador');
$routes->get('form-edit-jugador/(:num)', 'Jugadores::formEditJugador/$1');

// $routes->group('', ['filter' => 'auth'], static function($routes) {
//     $routes->get('nuevo-jugador', 'Jugadores::formNuevoJugador');
// });
