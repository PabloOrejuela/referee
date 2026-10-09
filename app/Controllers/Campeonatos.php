<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\CampeonatoModel;
use App\Models\LigaModel;
use App\Models\ProvinciaModel;

class Campeonatos extends BaseController {

    protected $provinciaModel;

    public function initController(...$params) {
        // Esto ejecuta el initController del BaseController (Carga DB, Sesión, ACL, etc.)
        parent::initController(...$params);

        // Instancias los modelos
        $this->campeonatoModel = model(CampeonatoModel::class);
        $this->ligaModel = model(LigaModel::class);
        $this->provinciaModel = model(ProvinciaModel::class);
    }

    public function index() {
        
        $data['session'] = $this->session;
        $data['provincias'] = $this->provinciaModel->findAll();
        
        $data['title'] = 'Campeonatos';
        $data['main_content'] = 'campeonatos/grid_campeonatos';
        return view('dashboard/index', $data);
    }

    public function getLigasByProvincia($idprovincia = null){
        if (empty($idprovincia) || !is_numeric($idprovincia)) {
            return $this->response->setJSON([]);
        }

        $ligas = $this->ligaModel
            ->select('ligas.id, ligas.nombre_liga, ligas.img_logo, ligas.idcategoria, ligas.idprovincia, provincias.provincia')
            ->join('provincias', 'provincias.id = ligas.idprovincia', 'left')
            ->where('ligas.idprovincia', $idprovincia)
            ->orderBy('ligas.nombre_liga', 'ASC')
            ->findAll();

        return $this->response->setJSON($ligas);
    }
}
