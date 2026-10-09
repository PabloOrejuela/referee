<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;

use App\Models\ArbitroModel;
use App\Models\ProvinciaModel;
use App\Models\RolModel;

class Arbitros extends BaseController {

    protected $arbitroModel;
    protected $provinciaModel;
    protected $rolModel;

    public function initController(...$params) {
        // Esto ejecuta el initController del BaseController (Carga DB, Sesión, ACL, etc.)
        parent::initController(...$params);

        // Instancias los modelos
        $this->arbitroModel = model(ArbitroModel::class);
        $this->provinciaModel = model(ProvinciaModel::class);
        $this->rolModel = model(RolModel::class);
    }

    public function index() {
        $data['session'] = $this->session;
        $data['arbitros'] = $this->arbitroModel
            ->select('arbitros.id as id,arbitros.nombre as nombre,documento,telf_1,calificacion_global,fecha_nac,estado')
            ->join('arbitros_calificaciones','arbitros_calificaciones.idarbitro = arbitros.id','left')
            ->findAll();

        $data['title'] = 'Arbitros';
        $data['main_content'] = 'arbitros/grid_arbitros';
        return view('dashboard/index', $data);
    }

    public function formCalificaArbitro(){
        $data['session'] = $this->session;
        $data['provincias'] = $this->provinciaModel->findAll();
        $data['roles'] = $this->rolModel->findAll();
        
        $data['title'] = 'Arbitros';
        $data['main_content'] = 'arbitros/form_califica_arbitro';
        return view('dashboard/index', $data);
    }

    public function formNuevoArbitro(){

        $data['provincias'] = $this->provinciaModel->findAll();
        $data['roles'] = $this->rolModel->findAll();
        
        $data['title'] = 'Arbitros';
        $data['main_content'] = 'arbitros/form_nuevo_arbitro';
        return view('dashboard/index', $data);
    }

    public function insertArbitro(){

        $this->validation->setRuleGroup('formArbitro');

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        // Preparo los datos para el update
        $arbitro = [
            'nombre' => strtoupper($this->request->getPost('nombre')),
            'documento' => $this->request->getPost('documento'),
            'telf_1' => $this->request->getPost('telf_1'),
            'fecha_nac' => $this->request->getPost('fecha_nac'),
            'estado' => $this->request->getPost('estado'),
        ];

        // update
        $res = $this->arbitroModel->insert($arbitro);

        if ($res) {
            return redirect()->to('arbitros');
        }

        $this->session->setFlashdata('mensaje', $data);
        return redirect()->back()->with('mensaje', 'Hubo un error. No se ha podido registrar el árbitro');
    }

    public function formEditArbitro($id){
        $data['arbitro'] = $this->arbitroModel->where('id', $id)->first();
        $data['provincias'] = $this->provinciaModel->findAll();
        $data['roles'] = $this->rolModel->findAll();

        $data['title'] = 'Arbitros';
        $data['main_content'] = 'arbitros/form_edit_arbitro';
        return view('dashboard/index', $data);
    }

    public function updateArbitro(){

        $id = $this->request->getPost('id');
        //echo '<pre>'.var_export($id, true).'</pre>';exit;

        $this->validation->setRuleGroup('formArbitro');

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        // Preparo los datos para el update
        $arbitro = [
            'nombre' => strtoupper($this->request->getPost('nombre')),
            'documento' => $this->request->getPost('documento'),
            'telf_1' => $this->request->getPost('telf_1'),
            'fecha_nac' => $this->request->getPost('fecha_nac'),
            'estado' => $this->request->getPost('estado'),
        ];

        // update
        $res = $this->arbitroModel->update($id, $arbitro);

        if ($res) {
            return redirect()->to('arbitros');
        }

        $this->session->setFlashdata('mensaje', $data);
        return redirect()->back()->with('mensaje', 'Hubo un error. No se ha podido actualizar la información');
    }

    public function formLoadArbitrosData() {
        
        $data['title'] = 'Arbitros';
        $data['subtitle']='Importar lista de Arbitros';
        $data['main_content'] = 'arbitros/form_load_arbitros';
        return view('dashboard/index', $data);
    }

    public function loadArbitrosData(){
        
        //Creo la ruta
        $ruta = './public/excel/';
        
        //Recibo el archivo excel
        $file = $this->request->getFile('excelEquipos');

        //Verifico que sea válido
        if (!$file->isValid()) {
            //throw new RuntimeException($file->getErrorString());
            return redirect()->to('form-load-arbitros');
        }else{
            //obtengo el nombre del archivo
            $nameFile = $file->getName();

            //Aseguro que la ruta termine con slash y exista
            $ruta = rtrim($ruta, '/').'/' ;
            if (!is_dir($ruta)) {
                mkdir($ruta, 0755, true);
            }

            // Si ya existe un archivo con el mismo nombre, lo elimino para sobrescribir
            $targetPath = $ruta . $nameFile;
            if (file_exists($targetPath)) {
                @unlink($targetPath);
            }

            //Muevo el archivo del temporal a la carpeta
            $file->move($ruta, $nameFile);

            //Verifico que se haya movido
            if ($file->hasMoved()) {
                
                //Creo qel reader
                $reader = new XlsxReader();

                //leo el archivo
                $spreadsheet = $reader->load($ruta.$nameFile);

                //Determino la pestaña 
                $sheet = $spreadsheet->getSheet(0);

                //Accedo a cada fila extrayendo los datos
                foreach ($sheet->getRowIterator(2) as $row) {

                    $i = $row->getRowIndex();

                    // Si la fila está vacía, detenemos la lectura
                    if ($this->rowIsEmpty($sheet, $i, ['A','B','C','D','E','F','G'])) {
                        break;
                    }

                    $datosExcel = [
                        'fila' => $i,
                        'nombre' => strtoupper(trim((string) $sheet->getCell('A'.$i)->getValue())),
                        'fecha_nac' => trim((string) $sheet->getCell('B'.$i)->getValue()),
                    ];

                    // Normalizo datos clave
                    $nombre = strtoupper(trim((string) ($datosExcel['nombre'] ?? '')));
                    $fecha_nac = trim((string) ($datosExcel['fecha_fundacion'] ?? ''));


                    // ---------------------------------------------------------
                    // ARBITRO
                    // ---------------------------------------------------------

                    $existArbitro = $this->arbitroModel
                        ->where('nombre', $nombre)
                        ->first();

                    if ($existArbitro) {

                        $arbitro = [
                            'nombre' => $nombre,
                            'fecha_nac' => $fecha_nac
                        ];

                        $this->arbitroModel->update($existArbitro->id, $arbitro);
                        $idarbitro = $existArbitro->id;

                    } else {

                        $arbitro = [
                            'nombre' => $nombre,
                            'fecha_nac' => $fecha_nac
                        ];

                        $idarbitro = $this->arbitroModel->insert($arbitro);
                    }
                }
                $data['mensaje'] = 'Los datos se han cargado revise el archivo de logs para ver si ha habido alguna novedad';
                
                $this->session->setFlashdata('mensaje', $data);
                
                return redirect()->back()->with('mensaje', 'Los datos se han cargado revise el archivo de logs para ver si ha habido alguna novedad');
            }
        } 
    }

    private function rowIsEmpty($sheet, int $rowIndex, array $columns): bool {
        foreach ($columns as $col) {
            $val = trim((string) $sheet->getCell($col.$rowIndex)->getValue());
            if ($val !== '') {
                return false;
            }
        }
        return true;
    }

}
