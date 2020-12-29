<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;

class Perfil extends BaseController
{
	// public function __construct(){
	// }


	public function index()
	{

		$data = array();
		// trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { // Comprobar si tenemos sesión si no redirige a login
			$data = $this->dataUser;
			return view('perfil', $data);
		}  else {
			return redirect()->route('login');
		}

		
		
	}
	

	//--------------------------------------------------------------------

}