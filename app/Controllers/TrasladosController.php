<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class TrasladosController extends BaseController
{
    public function index()
	{
		// $clientesModel  = new ClientesModel($db);

		$data = array();

		// Trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
			$data = $this->dataUser; 	// Variables de la session

			return view('trasladosView', $data);

		}  else {
			return redirect()->route('login');
		}
	}

	//--------------------------------------------------------------------

}