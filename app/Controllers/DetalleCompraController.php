<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class DetalleCompraController extends BaseController
{
  public function index() {
		// Trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
			$data = $this->dataUser; 	// Variables de la session
			return view('detalleCompraView', $data);
		}  else {
			return redirect()->route('login');
		}
	}
}