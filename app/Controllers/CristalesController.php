<?php namespace App\Controllers;

use CodeIgniter\Controller;

class CristalesController extends BaseController
{
	public function index()
	{
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
            $data = $this->dataUser; 	// Variables de la session
			return view('cristalesView', $data);

		}  else {
			return redirect()->route('login');
        }		
	}
	
	

	//--------------------------------------------------------------------

	public function salida_Cristales() {
        $data = array();
        if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
            $data = $this->dataUser; 	// Variables de la session    
            
            return view('salidaCristalesView', $data);
        }  else {
			return redirect()->route('login');
        }
    }

}
