<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Inicio::index');
$routes->get('form-login', 'Inicio::formLogin');
$routes->post('validate-login', 'Inicio::validateLogin');
$routes->get('logout', 'Inicio::logout');

//Torneos
$routes->get('torneos', 'Torneos::index');

// Equipos (requiere permiso 'equipo')
$routes->get('equipos', 'Equipos::index', ['filter' => 'auth:equipo']);

// Arbitros (requiere permiso 'arbitraje')
$routes->get('arbitros', 'Arbitros::index', ['filter' => 'auth:arbitraje']);

// Reportes (requiere permiso 'informes')
$routes->get('reportes', 'Reportes::index', ['filter' => 'auth:informes']);

$routes->group('', ['filter' => 'auth'], static function($routes) {
    $routes->get('nuevo-jugador', 'Jugadores::formNuevoJugador');
});
