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
        
        $data['usuarios'] = $this->userModel
            ->select('users.id as id,nombre,direccion,rol,documento,email,telf_1,estado')
            ->join('roles','roles.id=users.idrol')
            ->findAll();

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

    public function insertUsuario(){

        $this->validation->setRuleGroup('formUsuario');

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        // Preparo los datos para el update
        $usuario = [
            'nombre' => strtoupper($this->request->getPost('nombre')),
            'usuario' => $this->request->getPost('usuario'),
            'email' => $this->request->getPost('email'),
            'documento' => $this->request->getPost('documento'),
            'telf_1' => $this->request->getPost('telf_1'),
            'direccion' => $this->request->getPost('direccion'),
            'fecha_nac' => $this->request->getPost('fecha_nac'),
            'idrol' => $this->request->getPost('idrol'),
            'estado' => $this->request->getPost('estado'),
        ];

        // update
        $res = $this->userModel->insert($usuario);

        if ($res) {
            return redirect()->to('usuarios');
        }

        $this->session->setFlashdata('mensaje', $data);
        return redirect()->back()->with('mensaje', 'Hubo un error. No se ha podido actualizar la información');
    }

    public function formEditUsuario($id){
        $data['user'] = $this->userModel->where('id', $id)->first();
        $data['provincias'] = $this->provinciaModel->findAll();
        $data['roles'] = $this->rolModel->findAll();

        $data['title'] = 'Usuarios';
        $data['main_content'] = 'usuarios/form_edit_usuario';
        return view('dashboard/index', $data);
    }

    public function updateUsuario(){

        $id = $this->request->getPost('id');
        
        

        $this->validation->setRuleGroup('formUsuario');

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        // Preparo los datos para el update
        $usuario = [
            'nombre' => strtoupper($this->request->getPost('nombre')),
            'usuario' => $this->request->getPost('usuario'),
            'email' => $this->request->getPost('email'),
            'documento' => $this->request->getPost('documento'),
            'telf_1' => $this->request->getPost('telf_1'),
            'direccion' => $this->request->getPost('direccion'),
            'fecha_nac' => $this->request->getPost('fecha_nac'),
            'idrol' => $this->request->getPost('idrol'),
            'estado' => $this->request->getPost('estado'),
        ];

        // update
        $res = $this->userModel->update($id, $usuario);

        if ($res) {
            return redirect()->to('usuarios');
        }

        $this->session->setFlashdata('mensaje', $data);
        return redirect()->back()->with('mensaje', 'Hubo un error. No se ha podido actualizar la información');
    }
}
