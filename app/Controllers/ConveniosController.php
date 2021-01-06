<?php namespace App\Controllers;

use CodeIgniter\Controller;

class ConveniosController extends BaseController
{
	public function index()
	{
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
            $data = $this->dataUser; 	// Variables de la session
			return view('conveniosView', $data);

		}  else {
			return redirect()->route('login');
        }		
	}
	
	//--------------------------------------------------------------------

}
