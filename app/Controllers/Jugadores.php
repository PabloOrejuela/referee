<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Jugadores extends BaseController {

    public function index(){
        echo "Jugadores";
    }

    public function formNuevoJugador(){

        $data['provincias'] = $this->provinciaModel->findAll();
        
        $data['title'] = 'Usuarios';
        $data['main_content'] = 'jugadores/form_nuevo_jugador';
        return view('dashboard/index', $data);
    }

    public function insertNuevoJugador(){
        
    }
}
