<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Arbitros extends BaseController {

    public function index() {

        $data['arbitros'] = $this->arbitroModel->select('arbitros.id as id,nombre,apellido,documento,telf_1,calificacion')
            ->join('users','users.id = arbitros.idusuario')
            ->findAll();

        $data['title'] = 'Arbitros';
        $data['main_content'] = 'arbitros/grid_arbitros';
        return view('dashboard/index', $data);
    }

    public function formNuevoArbitro(){

        $data['provincias'] = $this->provinciaModel->findAll();
        $data['roles'] = $this->rolModel->findAll();
        
        $data['title'] = 'Arbitros';
        $data['main_content'] = 'arbitros/form_nuevo_arbitro';
        return view('dashboard/index', $data);
    }
}
