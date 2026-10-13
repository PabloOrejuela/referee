<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $formArbitro = [
        'nombre'   => 'required|alpha_space',
        //'documento'   => 'required',
        
    ]; 

    public $formArbitro_errors = [
        'nombre' => [
            'required' => 'El campo "Nombre" es obligatorio',
            'alpha_space' => 'El campo "Nombre" solo puede contener letras no simbolos ni números',
        ],
        // 'documento' => [
        //     'required' => 'El campo "documento" es obligatorio',
        // ],
    ];

    public $formJugador = [
        'nombre'   => 'required|alpha_space',
        //'documento'   => 'required',
        
    ]; 

    public $formJugador_errors = [
        'nombre' => [
            'required' => 'El campo "Nombre" es obligatorio',
            'alpha_space' => 'El campo "Nombre" solo puede contener letras no simbolos ni números',
        ],
        // 'documento' => [
        //     'required' => 'El campo "documento" es obligatorio',
        // ],
    ];

    public $formEquipo = [
        'nombre'   => 'required|alpha_space',
        'siglas'   => 'required|alpha_space',
        //'documento'   => 'required',
        
    ]; 

    public $formEquipo_errors = [
        'nombre' => [
            'required' => 'El campo "Nombre" es obligatorio',
            'alpha_space' => 'El campo "Nombre" solo puede contener letras no simbolos ni números',
        ],
        'siglas' => [
            'required' => 'El campo "Siglas" es obligatorio',
            'alpha_space' => 'El campo "Siglas" solo puede contener letras no simbolos ni números',
        ],
    ];

    public $formUsuario = [
        'nombre'   => 'required|alpha_space',
        'idrol'   => 'required|numeric',
        'estado'   => 'required|numeric',
    ]; 

    public $formUsuario_errors = [
        'nombre' => [
            'required' => 'El campo field es obligatorio',
            'alpha_space' => 'El campo field solo puede contener letras no simbolos ni números',
        ],
        // 'documento' => [
        //     'required' => 'El campo "documento" es obligatorio',
        // ],
    ];
}
