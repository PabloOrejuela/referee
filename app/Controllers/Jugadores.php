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

        $jugadorActual = $this->jugadorModel->find($id);
        if (!$jugadorActual) {
            return redirect()->to('jugadores')
                ->with('mensaje', 'No se encontró el jugador que se desea actualizar.');
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

        // La imagen es opcional al editar; se conserva la actual si no llega un archivo nuevo.
        $nombreImagenNueva = null;
        $imagen = $this->request->getFile('imagen');
        if ($imagen && $imagen->getError() !== UPLOAD_ERR_NO_FILE) {
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];

            if (!$imagen->isValid() || $imagen->hasMoved()) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['imagen' => 'No se pudo recibir la imagen.']);
            }

            if (!in_array($imagen->getMimeType(), $tiposPermitidos, true) || $imagen->getSizeByUnit('mb') > 2) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['imagen' => 'La imagen debe ser JPG, PNG o WEBP y pesar como máximo 2 MB.']);
            }

            $nombreImagen = uploadAndOptimizeImage(
                $imagen,
                FCPATH . 'public/img/jugadores',
                800,
                80
            );

            if (!$nombreImagen) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['imagen' => 'No se pudo procesar la imagen.']);
            }

            $nombreImagenNueva = $nombreImagen;
            $jugador['imagen'] = $nombreImagen;
        }

        $res = $this->jugadorModel->update($id, $jugador);

        if ($res) {
            // Borra la imagen anterior solo después de confirmar el cambio en la base de datos.
            $nombreImagenAnterior = $jugadorActual->imagen ?? null;
            if ($nombreImagenNueva && $nombreImagenAnterior && $nombreImagenAnterior !== $nombreImagenNueva) {
                $directorioImagenes = FCPATH . 'public/img/jugadores' . DIRECTORY_SEPARATOR;
                $rutaImagenAnterior = $directorioImagenes . basename($nombreImagenAnterior);

                if (is_file($rutaImagenAnterior)) {
                    @unlink($rutaImagenAnterior);
                }
            }

            return redirect()->to('jugadores');
        }

        // Si falló el update, elimina el archivo nuevo para no dejarlo huérfano.
        if ($nombreImagenNueva) {
            $rutaImagenNueva = FCPATH . 'public/img/jugadores' . DIRECTORY_SEPARATOR . basename($nombreImagenNueva);
            if (is_file($rutaImagenNueva)) {
                @unlink($rutaImagenNueva);
            }
        }

        return redirect()->back()->with('mensaje', 'Hubo un error. No se ha podido actualizar la información');
    }

}
