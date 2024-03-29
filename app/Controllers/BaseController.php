<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];
	public $session = null;
	protected $dataUser = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		helper(['url', 'form', 'barcode']);

		$this->session = \Config\Services::session();

		// Variables de sesión para ser compartida en controladores
		if($this->session->has('id_usuario')) :
			$this->dataUser['id_usuario'] 			= $this->session->get('id_usuario');
			$this->dataUser['nombre'] 					= $this->session->get('nombre');
			$this->dataUser['tipo_de_usuario'] 	= $this->session->get('tipo_de_usuario');
			$this->dataUser['logged_in'] 				= $this->session->get('logged_in');
		endif;

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
	}
}
