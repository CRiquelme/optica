<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	public $traslados = [
		'producto_id'          	=> 'required|numeric',
		'tienda_id' 			=> 'required',
		'tienda_destino_id' 	=> 'required',
		'cantidad_productos' 	=> 'required'
	];
	
	public $traslados_errors = [
        'producto_id' => [
			'required'    	=> 'El producto es requerido',
			'numeric'		=> 'El producto solo debe ser numérico'
        ],
        'tienda_id'    => [
            'required' 		=> 'La tienda de origen es requerida'
		],
		'tienda_destino_id' => [
			'required' 		=> 'La tienda de destino es requerida'
		],
		'cantidad_productos' => [
			'required' 		=> 'La cantidad de productos es requerida'
		]
	];


	public $ingresoProductos = [
		'producto_id'	 		=> 'required',
		'tienda_id'				=> 'required',
		'cantidad_producto' 	=> 'required|numeric',
		'factura' 				=> 'required'
	];
	
	public $salidaProductos = [
		'producto_id'	 		=> 'required',
		'tienda_id'				=> 'required',
		'cantidad_producto' 	=> 'required|numeric'
	];

	public $ingresoCristales = [
		'cajon'	=> 'required',
		'material' => 'required',
		'potencia1' => 'required',
		'potencia2' => 'required',
		'cantidad' => 'required|numeric'
	];

	public $salidaCristales = [
		'cristal_id'	=> 'required',
		'tienda_id'		=> 'required',
		'cantidad'		=> 'required|numeric'
	];

	public $ingresoUsuario = [
		'username'          => 'required',
        'email'             => 'required',
        'password'          => 'required'
	];

	public $ingresoUsuario_errors = [
		'username'  => [
            'required'              => 'Requerido.',
            'alpha_numeric_space'   => 'Alfanumérico y con espacio.',
            'min_length'            => 'Debe contener mínimo 6 caracteres.'
        ],
        'email'     => [
            'is_unique'             => 'Registrado.',
            'valid_email'           => 'Debe ser válido.',
            'is_unique'             => 'Registrado.'
        ],
        'password'  => [
            'required'              => 'Requerida.',
            'min_length'            => 'Debe contener mínimo 6 caracteres.'
        ],
        'password_confirm' => [
            'required_with'         => 'La contraseña es requerida.',
            'required'              => 'Requerida.',
            'matches'               => 'La confirmación de contraseña no coincide con la contraseña ingresada.'
        ],
        'nombre' => [
            'required'              => 'Requerido.'
        ],
        'ap_pat' => [
            'required'              => 'Requerido.'
        ]
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
}
