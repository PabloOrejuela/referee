<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Ligas extends BaseController {

    public function index(){
        $data['provincias'] = $this->provinciaModel->findAll();
        
        $data['title'] = 'Ligas';
        $data['main_content'] = 'ligas/grid_ligas';
        return view('dashboard/index', $data);
    }

    public function formNuevaLiga(){
        $data['categorias'] = $this->categoriaModel->findAll();
        
        $data['title'] = 'Ligas';
        $data['main_content'] = 'ligas/form_nueva_liga';
        return view('dashboard/index', $data);
    }

    public function insertLiga(){
        // helper('image');

        // 1. Reglas de validación del FORMULARIO
        $this->validation->setRules([
            'nombre_liga' => [
                'label' => 'Nombre de la liga',
                'rules' => 'required|min_length[3]|max_length[100]'
            ],
            'idcategoria' => [
                'label' => 'Categoría',
                'rules' => 'required|integer'
            ],
            'img_logo' => [
                'label' => 'Logo',
                'rules' => 'uploaded[img_logo]'
                    . '|is_image[img_logo]'
                    . '|max_size[img_logo,2048]'
                    . '|mime_in[img_logo,image/jpg,image/jpeg,image/png,image/webp]'
            ],
        ]);

        // 2. Ejecutar validación
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        // Subo Archivo
        $imagenLiga = $this->request->getFile('img_logo');
        
        // Upload de la imágen usando el helper
        $nombreImagen = uploadAndOptimizeImage(
            $imagenLiga,
            FCPATH . 'public/img/usuarios',
            800,
            80
        );

        // Seguridad: si falla upload
        if (!$nombreImagen) {
            return redirect()->back()
                ->withInput()
                ->with('errors', ['img_logo' => 'Error al procesar la imagen']);
        }

        // Preparo los datos para el insert
        $liga = [
            'nombre_liga' => strtoupper($this->request->getPost('nombre_liga')),
            'idcategoria' => $this->request->getPost('idcategoria'),
            'img_logo' => $nombreImagen,
        ];

        // Insert
        $res = $this->ligaModel->insert($liga);

        if ($res) {
            return redirect()->to('ligas');
        }

        return redirect()->to('error-registro');
    }

}
