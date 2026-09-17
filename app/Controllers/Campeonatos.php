<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ProvinciaModel;

class Campeonatos extends BaseController {

    protected $provinciaModel;

    public function initController(...$params) {
        // Esto ejecuta el initController del BaseController (Carga DB, Sesión, ACL, etc.)
        parent::initController(...$params);

        // Instancias los modelos
        $this->provinciaModel = model(ProvinciaModel::class);
    }

    public function index() {

        $data['provincias'] = $this->provinciaModel->findAll();
        
        $data['title'] = 'Campeonatos';
        $data['main_content'] = 'campeonatos/grid_campeonatos';
        return view('dashboard/index', $data);
    }
}
