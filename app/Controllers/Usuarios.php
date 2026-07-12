<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Usuarios extends BaseController {

    public function index(){

        $data['usuarios'] = $this->userModel->findAll();

        $data['title'] = 'Usuarios';
        $data['main_content'] = 'usuarios/grid_usuarios';
        return view('dashboard/index', $data);
    }

    public function formNuevoUsuario(){

        $data['provincias'] = $this->provinciaModel->findAll();
        $data['roles'] = $this->rolModel->findAll();
        
        $data['title'] = 'Usuarios';
        $data['main_content'] = 'usuarios/form_nuevo_usuario';
        return view('dashboard/index', $data);
    }

    
}
