<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ProvinciaModel;
use App\Models\RolModel;
use App\Models\UserModel;

class Usuarios extends BaseController {

    protected $provinciaModel;
    protected $rolModel;
    protected $userModel;

    public function initController(...$params) {
        // Esto ejecuta el initController del BaseController (Carga DB, Sesión, ACL, etc.)
        parent::initController(...$params);

        // Instancias los modelos
        $this->provinciaModel = model(ProvinciaModel::class);
        $this->rolModel = model(RolModel::class);
        $this->userModel = model(UserModel::class);
    }

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
