<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Inicio extends BaseController {

    public function index() {

        $usuario = [
            'is_logged' => 0
        ];
        
        $data['title']='Inicio';
        $data['main_content']='home/inicio';
        return view('dashboard/index', $data);
    }

    public function formLogin() {

        $data['title'] = 'Ingresar al sistema';
        $data['main_content'] = 'home/form_login';
        return view('dashboard/index', $data);
    }

    public function validateLogin() {

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('usuario', $username)->first();

        if (! $user || ! password_verify($password, $user->password)) {
            return redirect()->back()->with('error', 'Usuario o contraseña incorrectos.');
        }

        if ($user->estado != 1) {
            return redirect()->back()->with('error', 'El usuario no se encuentra activo.');
        }
        
        $session = session();
        $session->set([
            'isLoggedIn' => true,
            'user' => [
                'id' => $user->id,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'usuario' => $user->usuario,
                'email' => $user->email,
                'idrol' => $user->idrol,
                'estado' => $user->estado,
                'imagen' => $user->imagen,
            ],
        ]);

        $this->userModel->update($user->id, ['is_logged' => 1]);

        return redirect()->to(site_url('/'));
    }

    public function logout() {
        $session = session();
        $user = $session->get('user');

        if ($user !== null && isset($user['id'])) {
            $this->userModel->update($user['id'], ['is_logged' => 0]);
        }

        $session->destroy();
        return redirect()->to(site_url('/'));
    }
}
