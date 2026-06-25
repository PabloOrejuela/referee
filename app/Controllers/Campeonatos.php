<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Campeonatos extends BaseController {

    public function index() {

        $data['provincias'] = $this->provinciaModel->findAll();
        
        $data['title'] = 'Campeonatos';
        $data['main_content'] = 'campeonatos/grid_campeonatos';
        return view('dashboard/index', $data);
    }
}
