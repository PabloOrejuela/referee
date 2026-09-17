<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\JugadorModel;
use App\Models\ProvinciaModel;
use App\Models\RolModel;

class Jugadores extends BaseController {

    protected $jugadorModel;
    protected $provinciaModel;

    public function initController(...$params) {
        // Esto ejecuta el initController del BaseController (Carga DB, Sesión, ACL, etc.)
        parent::initController(...$params);

        // Instancias los modelos
        $this->jugadorModel = model(JugadorModel::class);
        $this->provinciaModel = model(ProvinciaModel::class);
        $this->rolModel = model(RolModel::class);
    }

    public function index(){

        $data['jugadores'] = $this->jugadorModel->findAll();

        $data['title'] = 'Jugadores';
        $data['main_content'] = 'jugadores/grid_jugadores';
        return view('dashboard/index', $data);
    }

    public function formNuevoJugador(){

        $data['provincias'] = $this->provinciaModel->findAll();
        $data['roles'] = $this->rolModel->findAll();
        
        $data['title'] = 'Jugadores';
        $data['main_content'] = 'jugadores/form_nuevo_jugador';
        return view('dashboard/index', $data);
    }

    public function insertNuevoJugador(){
        
    }
}
