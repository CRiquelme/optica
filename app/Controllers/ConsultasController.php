<?php namespace App\Controllers;

use CodeIgniter\Controller;

class ConsultasController extends BaseController
{
	public function index()
	{
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
            $data = $this->dataUser; 	// Variables de la session
			return view('cSalidaProductosView.php', $data);

		}  else {
			return redirect()->route('login');
        }		
	}
    
    public function cSalidaProductos()
    {
        if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
            $data = $this->dataUser; 	// Variables de la session
			return view('cSalidaProductosView.php', $data);

		}  else {
			return redirect()->route('login');
        }	
    }
	

	//--------------------------------------------------------------------

}