<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\CampeonatoModel;
use App\Models\CategoriaModel;
use App\Models\CiudadModel;
use App\Models\EquipoModel;
use App\Models\JugadorModel;
use App\Models\LigaModel;
use App\Models\PaisModel;
use App\Models\PlantillaModel;
use App\Models\PresidenteModel;
use App\Models\ProvinciaModel;
use App\Models\RolModel;
use App\Models\TecnicoModel;
use App\Models\TemporadaModel;
use App\Models\TipoLigaModel;
use App\Models\UserModel;
use App\Models\VocaliaModel;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller {
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;
    protected $request;
    protected $helpers = ['form', 'url', 'html'];

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        date_default_timezone_set('America/Guayaquil');

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->db = \Config\Database::connect();
        $this->campeonatoModel = new CampeonatoModel($this->db);
        $this->categoriaModel = new CategoriaModel($this->db);
        $this->ciudadModel = new CiudadModel($this->db);
        $this->equipoModel = new EquipoModel($this->db);
        $this->jugadorModel = new JugadorModel($this->db);
        $this->ligaModel = new LigaModel($this->db);
        $this->paisModel = new PaisModel($this->db);
        $this->plantillaModel = new PlantillaModel($this->db);
        $this->presidenteModel = new PresidenteModel($this->db);
        $this->provinciaModel = new ProvinciaModel($this->db);
        $this->rolModel = new RolModel($this->db);
        $this->tecnicoModel = new TecnicoModel($this->db);
        $this->temporadaModel = new TemporadaModel($this->db);
        $this->tipoLigaModel = new TipoLigaModel($this->db);
        $this->userModel = new UserModel($this->db);
        $this->vocaliaModel = new VocaliaModel($this->db);
        // $this->session = service('session');


        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->image = \Config\Services::image();
    }
}
