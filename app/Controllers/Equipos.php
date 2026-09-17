<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\EquipoModel;

class Equipos extends BaseController {

    protected $equipoModel;

    public function initController(...$params) {
        // Esto ejecuta el initController del BaseController (Carga DB, Sesión, ACL, etc.)
        parent::initController(...$params);

        // Instancias los modelos
        $this->equipoModel = model(EquipoModel::class);
    }

    public function equipos() {
        //Este sería el grid de equipos

        $data['equipos'] = $this->equipoModel
            ->select('equipos.id as id,nombre,siglas,imagen,descripcion,fecha_fundacion,presidentes.presidente as presidente')
            ->join('presidentes', 'presidentes.idequipo=equipos.id','left')
            ->findAll();

        $data['title'] = 'Equipos';
        $data['main_content'] = 'equipos/grid_equipos';
        return view('dashboard/index', $data);
    }
}
