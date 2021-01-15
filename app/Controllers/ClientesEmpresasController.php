<?php namespace App\Controllers;

use CodeIgniter\Controller;

class ClientesEmpresasController extends BaseController
{
	public function index()
	{
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
            $data = $this->dataUser; 	// Variables de la session
			return view('clientesEmpresasView', $data);

		}  else {
			return redirect()->route('login');
        }		
	}
	
	//--------------------------------------------------------------------

}
