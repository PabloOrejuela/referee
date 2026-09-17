<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\CategoriaModel;
use App\Models\LigaModel;
use App\Models\ProvinciaModel;

class Ligas extends BaseController {


    // Declaro las propiedades aquí arriba
    protected $ligaModel;

    //Constructor no abreviado
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
        // Esto ejecuta el initController del BaseController (Carga DB, Sesión, ACL, etc.)
        parent::initController($request, $response, $logger);

        // Instancias tus modelos
        $this->categoriaModel = model(CategoriaModel::class);
        $this->ligaModel = model(LigaModel::class);
        $this->provinciaModel = model(ProvinciaModel::class);
    }

    public function index(){
        $data['provincias'] = $this->provinciaModel->findAll();
        
        $data['title'] = 'Ligas';
        $data['main_content'] = 'ligas/grid_ligas';
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

    public function formNuevaLiga(){
        $data['categorias'] = $this->categoriaModel->findAll();
        $data['provincias'] = $this->provinciaModel->findAll();
        
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
            FCPATH . 'public/img/ligas',
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
