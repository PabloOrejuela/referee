<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\EquipoModel;
use App\Models\JugadorModel;
use App\Models\ProvinciaModel;
use App\Models\RolModel;
use App\Models\TemporadaModel;

class Jugadores extends BaseController {

    protected $equipoModel;
    protected $jugadorModel;
    protected $provinciaModel;
    protected $rolModel;
    protected $temporadaModel;

    public function initController(...$params) {
        // Esto ejecuta el initController del BaseController (Carga DB, Sesión, ACL, etc.)
        parent::initController(...$params);

        // Instancias los modelos
        $this->equipoModel = model(EquipoModel::class);
        $this->jugadorModel = model(JugadorModel::class);
        $this->provinciaModel = model(ProvinciaModel::class);
        $this->rolModel = model(RolModel::class);
        $this->temporadaModel = model(TemporadaModel::class);
    }

    public function index(){
        
        $temporadaActual = $this->temporadaModel->where('estado', 1)->first();
        
        $data['jugadores'] = $this->jugadorModel
            ->select('jugadores.id as id,jugadores.nombre as nombre,apellido,apodo,documento,jugadores.imagen as imagen,jugadores.estado as estado,
                    pierna_habil,posicion,equipos.nombre as equipo,camiseta')
            ->join('plantillas','plantillas.idjugador=jugadores.id','left')
            ->join('equipos','equipos.id=plantillas.idequipo','left')
            ->where('idtemporada', $temporadaActual->id)
            ->findAll(); //echo $this->db->getLastQuery();

        //echo '<pre>'.var_export($data['jugadores'], true).'</pre>';exit;

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

    public function formEditJugador($id){

        $data['jugador'] = $this->jugadorModel->where('id', $id)->first();
        $data['provincias'] = $this->provinciaModel->findAll();
        $data['equipos'] = $this->equipoModel->findAll();
        
        $data['title'] = 'Jugadores';
        $data['main_content'] = 'jugadores/form_edit_jugador';
        return view('dashboard/index', $data);
    }

    public function insertNuevoJugador(){
        
    }

}
