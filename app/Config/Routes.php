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

//Arbitros
$routes->get('arbitros', 'Arbitros::index');
$routes->get('form-nuevo-arbitro', 'Arbitros::formNuevoArbitro');

//Ligas
$routes->get('ligas', 'Ligas::index');
$routes->get('ligas/provincia/(:num)', 'Ligas::getLigasByProvincia/$1');
$routes->get('form-nueva-liga', 'Ligas::formNuevaLiga');
$routes->post('insert-liga', 'Ligas::insertLiga');


// Equipos (requiere permiso 'equipo')
$routes->get('equipos', 'Equipos::index', ['filter' => 'auth:equipo']);

// Arbitros (requiere permiso 'arbitraje')
$routes->get('arbitros', 'Arbitros::index', ['filter' => 'auth:arbitraje']);

// Reportes (requiere permiso 'informes')
$routes->get('reportes', 'Reportes::index', ['filter' => 'auth:informes']);

//Jugadores
$routes->get('jugadores', 'Jugadores::index');
$routes->get('form-nuevo-jugador', 'Jugadores::formNuevoJugador');

// $routes->group('', ['filter' => 'auth'], static function($routes) {
//     $routes->get('nuevo-jugador', 'Jugadores::formNuevoJugador');
// });
