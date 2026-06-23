<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Torneos extends BaseController {

    public function index() {

        $data['provincias'] = $this->provinciaModel->findAll();
        
        $data['title'] = 'Torneos';
        $data['main_content'] = 'torneos/grid_torneos';
        return view('dashboard/index', $data);
    }
}
