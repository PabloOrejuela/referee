<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Jugadores extends BaseController {

    public function index(){

        $data['jugadores'] = $this->jugadorModel->select('jugadores.id as id,nombre,apellido,documento,telf_1,pierna_habil,posicion,altura,peso')
            ->join('users','users.id = jugadores.idusuario')
            ->findAll();

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
