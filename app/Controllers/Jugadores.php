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

    public function updateJugador(){

        $id = $this->request->getPost('id');

        $this->validation->setRuleGroup('formJugador');

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        // Los nombres de las claves corresponden a los campos de jugadores.
        $jugador = [
            'nombre' => strtoupper($this->request->getPost('nombre')),
            'apellido' => strtoupper($this->request->getPost('apellido')),
            'apodo' => $this->request->getPost('apodo'),
            'email' => $this->request->getPost('email'),
            'documento' => $this->request->getPost('documento'),
            'telf' => $this->request->getPost('telf'),
            'direccion' => $this->request->getPost('direccion'),
            'fecha_nac' => $this->request->getPost('fecha_nac'),
            'estado' => $this->request->getPost('estado'),
            'pierna_habil' => $this->request->getPost('pierna_habil'),
            'posicion' => $this->request->getPost('posicion'),
            'altura' => $this->request->getPost('altura'),
            'peso' => $this->request->getPost('peso'),
        ];

        // El campo de archivo llega por separado y se actualiza solo si se subió uno nuevo.
        $imagen = $this->request->getFile('imagen');
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            if ($imagen->move(FCPATH . 'public/img/jugadores', $nombreImagen)) {
                $jugador['imagen'] = $nombreImagen;
            }
        }

        $res = $this->jugadorModel->update($id, $jugador);

        if ($res) {
            return redirect()->to('jugadores');
        }

        return redirect()->back()->with('mensaje', 'Hubo un error. No se ha podido actualizar la información');
    }

}
