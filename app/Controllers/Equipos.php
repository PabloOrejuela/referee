<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;

use App\Models\CampeonatoModel;
use App\Models\EquipoModel;
use App\Models\EquipoCampeonatoModel;
use App\Models\EquipoCampeonatoTecnicoModel;
use App\Models\PresidenteModel;
use App\Models\TemporadaModel;
use App\Models\TecnicoModel;

class Equipos extends BaseController {

    protected $campeonatoModel;
    protected $equipoModel;
    protected $equipoCampeonatoModel;
    protected $equipoCampeonatoTecnicoModel;
    protected $presidenteModel;
    protected $tecnicoModel;
    protected $temporadaModel;

    public function initController(...$params) {
        // Esto ejecuta el initController del BaseController (Carga DB, Sesión, ACL, etc.)
        parent::initController(...$params);

        // Instancias los modelos
        $this->campeonatoModel = model(CampeonatoModel::class);
        $this->equipoModel = model(EquipoModel::class);
        $this->equipoCampeonatoModel = model(EquipoCampeonatoModel::class);
        $this->equipoCampeonatoTecnicoModel = model(EquipoCampeonatoTecnicoModel::class);
        $this->presidenteModel = model(PresidenteModel::class);
        $this->tecnicoModel = model(TecnicoModel::class);
        $this->temporadaModel = model(TemporadaModel::class);
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

    public function formLoadEquiposData() {

        $data['temporada'] = $this->temporadaModel->where('estado', 1)->first();
        $data['campeonatos'] = $this->campeonatoModel
            ->select('campeonatos.id as id,campeonato,idcategoria,temporada')
            ->join('temporadas','temporadas.id=campeonatos.idtemporada')
            ->where('temporadas.estado', 1)
            ->findAll();
        // echo '<pre>'.var_export($data['campeonatos'], true).'</pre>';exit;
        
        $data['title'] = 'Equipos';
        $data['subtitle']='Importar listas de equipos';
        $data['main_content'] = 'equipos/form_load_equipos';
        return view('dashboard/index', $data);
    }

    public function loadEquiposData(){

        $temporada = $this->temporadaModel->where('estado', 1)->first();
        $campeonato = $this->request->getPost('campeonato');
        
        //Creo la ruta
        $ruta = './public/excel/';
        
        //Recibo el archivo excel
        $file = $this->request->getFile('excelEquipos');

        //Verifico que sea válido
        if (!$file->isValid()) {
            //throw new RuntimeException($file->getErrorString());
            return redirect()->to('form-load-equipos');
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
                        'siglas' => trim((string) $sheet->getCell('B'.$i)->getValue()),
                        'imagen' => trim((string) $sheet->getCell('C'.$i)->getValue()),
                        'descripcion' => trim((string) $sheet->getCell('D'.$i)->getValue()),
                        'fecha_fundacion' => trim((string) $sheet->getCell('E'.$i)->getValue()),
                        'presidente' => strtoupper(trim((string) $sheet->getCell('F'.$i)->getValue())),
                        'tecnico' => strtoupper(trim((string) $sheet->getCell('G'.$i)->getValue())),
                    ];

                    // Normalizo datos clave
                    $nombre = strtoupper(trim((string) ($datosExcel['nombre'] ?? '')));
                    $siglas = strtoupper(trim((string) ($datosExcel['siglas'] ?? '')));
                    $imagen = trim((string) ($datosExcel['imagen'] ?? ''));
                    $descripcion = strtoupper(trim((string) ($datosExcel['descripcion'] ?? '')));
                    $fecha_fundacion = trim((string) ($datosExcel['fecha_fundacion'] ?? ''));
                    $presidente = strtoupper(trim((string) ($datosExcel['presidente'] ?? '')));
                    $tecnico = strtoupper(trim((string) ($datosExcel['tecnico'] ?? '')));


                    // ---------------------------------------------------------
                    // EQUIPO
                    // ---------------------------------------------------------

                    $existEquipo = $this->equipoModel
                        ->where('nombre', $nombre)
                        ->first();

                        

                    if ($existEquipo) {

                        $equipo = [
                            'nombre' => $nombre,
                            'siglas' => $siglas,
                            'imagen' => $imagen,
                            'descripcion' => $descripcion,
                            'fecha_fundacion' => $fecha_fundacion
                        ];

                        $this->equipoModel->update($existEquipo->id, $equipo);
                        $idequipo = $existEquipo->id;

                    } else {

                        $equipo = [
                            'nombre' => $nombre,
                            'siglas' => $siglas,
                            'imagen' => $imagen,
                            'descripcion' => $descripcion,
                            'fecha_fundacion' => $fecha_fundacion
                        ];

                        $idequipo = $this->equipoModel->insert($equipo);
                    }


                    // ---------------------------------------------------------
                    // EQUIPO - CAMPEONATO
                    // ---------------------------------------------------------

                    $existEquipoCampeonato = $this->equipoCampeonatoModel
                        ->where('idequipo', $idequipo)
                        ->where('idcampeonato', $campeonato)
                        ->first();

                    if ($existEquipoCampeonato) {

                        $idequipocampeonato = $existEquipoCampeonato->id;

                    } else {

                        $equipo_campeonato = [
                            'idequipo' => $idequipo,
                            'idcampeonato' => $campeonato
                        ];

                        $idequipocampeonato = $this->equipoCampeonatoModel->insert($equipo_campeonato);
                    }


                    // ---------------------------------------------------------
                    // TÉCNICO
                    // ---------------------------------------------------------

                    $existTecnico = $this->tecnicoModel
                        ->where('tecnico', $tecnico)
                        ->first();

                    if ($existTecnico) {

                        $this->tecnicoModel->update($existTecnico->id, [
                            'tecnico' => $tecnico
                        ]);

                        $idtecnico = $existTecnico->id;

                    } else {

                        $idtecnico = $this->tecnicoModel->insert([
                            'tecnico' => $tecnico
                        ]);
                    }


                    // ---------------------------------------------------------
                    // EQUIPO - CAMPEONATO - TÉCNICO
                    // ---------------------------------------------------------

                    $existEquipoCampeonatoTecnico = $this->equipoCampeonatoTecnicoModel
                        ->where('idequipocampeonato', $idequipocampeonato)
                        ->first();

                    if ($existEquipoCampeonatoTecnico) {

                        // Si ya existe la relación, actualizo el técnico
                        $this->equipoCampeonatoTecnicoModel->update(
                            $existEquipoCampeonatoTecnico->id,
                            [
                                'idtecnico' => $idtecnico
                            ]
                        );

                    } else {

                        $equipo_campeonato_tecnico = [
                            'idequipocampeonato' => $idequipocampeonato,
                            'idtecnico' => $idtecnico
                        ];

                        $this->equipoCampeonatoTecnicoModel->insert($equipo_campeonato_tecnico);
                    }


                    // ---------------------------------------------------------
                    // PRESIDENTE
                    // ---------------------------------------------------------

                    $existPresidente = $this->presidenteModel
                        ->where('idequipo', $idequipo)
                        ->where('idtemporada', $temporada->id)
                        ->first();

                    if ($existPresidente) {

                        // Si existe, actualizo el presidente
                        $this->presidenteModel->update($existPresidente->id, [
                            'presidente' => $presidente
                        ]);

                    } else {

                        // Si no existe, inserto el presidente
                        $this->presidenteModel->insert([
                            'presidente' => $presidente,
                            'idequipo' => $idequipo,
                            'idtemporada' => $temporada->id
                        ]);
                    }
                }
                $data['mensaje'] = 'Los datos se han cargado revise el archivo de logs para ver si ha habido alguna novedad';
                // //return redirect()->to('frm-importar-datos-ventas');
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

    public function formNewEquipo(){

        //$data['provincias'] = $this->provinciaModel->findAll();
        
        $data['title'] = 'Equipos';
        $data['main_content'] = 'equipos/form_new_equipo';
        return view('dashboard/index', $data);
    }

    public function insertEquipo(){
        $this->validation->setRuleGroup('formEquipo');

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $equipo = [
            'nombre' => strtoupper($this->request->getPost('nombre')),
            'siglas' => strtoupper($this->request->getPost('siglas')),
            'descripcion' => $this->request->getPost('descripcion'),
            'fecha_fundacion' => $this->request->getPost('fecha_fundacion'),
        ];

        $nombreImagen = null;
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
                FCPATH . 'public/img/equipos',
                800,
                80
            );

            if (!$nombreImagen) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['imagen' => 'No se pudo procesar la imagen.']);
            }

            $equipo['imagen'] = $nombreImagen;
        }

        if ($this->equipoModel->insert($equipo)) {
            return redirect()->to('equipos')
                ->with('mensaje', 'El equipo se registró correctamente.');
        }

        if ($nombreImagen) {
            $rutaImagen = FCPATH . 'public/img/equipos' . DIRECTORY_SEPARATOR . basename($nombreImagen);
            if (is_file($rutaImagen)) {
                @unlink($rutaImagen);
            }
        }

        return redirect()->back()
            ->withInput()
            ->with('mensaje', 'Hubo un error. No se ha podido registrar el equipo.');
    }

    public function formEditEquipo($id){

        $data['equipo'] = $this->equipoModel->where('id', $id)->first();
        //$data['provincias'] = $this->provinciaModel->findAll();
        
        $data['title'] = 'Equipos';
        $data['main_content'] = 'equipos/form_edit_equipo';
        return view('dashboard/index', $data);
    }

    public function updateEquipo($id){

        $this->validation->setRuleGroup('formEquipo');

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $equipoActual = $this->equipoModel->find($id);
        if (!$equipoActual) {
            return redirect()->to('equipos')
                ->with('mensaje', 'No se encontró el equipo que se desea actualizar.');
        }

        // Los nombres corresponden a los campos permitidos por EquipoModel.
        $equipo = [
            'nombre' => strtoupper($this->request->getPost('nombre')),
            'siglas' => strtoupper($this->request->getPost('siglas')),
            'descripcion' => $this->request->getPost('descripcion'),
            'fecha_fundacion' => $this->request->getPost('fecha_fundacion'),
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
                FCPATH . 'public/img/equipos',
                800,
                80
            );

            if (!$nombreImagen) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['imagen' => 'No se pudo procesar la imagen.']);
            }

            $nombreImagenNueva = $nombreImagen;
            $equipo['imagen'] = $nombreImagen;
        }

        $res = $this->equipoModel->update($id, $equipo);

        if ($res) {
            // Borra la imagen anterior solo después de confirmar el cambio en la base de datos.
            $nombreImagenAnterior = $equipoActual->imagen ?? null;
            if ($nombreImagenNueva && $nombreImagenAnterior && $nombreImagenAnterior !== $nombreImagenNueva) {
                $directorioImagenes = FCPATH . 'public/img/equipos' . DIRECTORY_SEPARATOR;
                $rutaImagenAnterior = $directorioImagenes . basename($nombreImagenAnterior);

                if (is_file($rutaImagenAnterior)) {
                    @unlink($rutaImagenAnterior);
                }
            }

            return redirect()->to('equipos');
        }

        // Si falló el update, elimina el archivo nuevo para no dejarlo huérfano.
        if ($nombreImagenNueva) {
            $rutaImagenNueva = FCPATH . 'public/img/equipos' . DIRECTORY_SEPARATOR . basename($nombreImagenNueva);
            if (is_file($rutaImagenNueva)) {
                @unlink($rutaImagenNueva);
            }
        }

        return redirect()->back()->with('mensaje', 'Hubo un error. No se ha podido actualizar la información');
    }
}
