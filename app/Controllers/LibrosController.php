<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class LibrosController extends BaseController
{
  public function index() {
		// Trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
			$data = $this->dataUser; 	// Variables de la session

			return view('libros/librosView', $data);

		}  else {
			return redirect()->route('login');
		}
	}

	//--------------------------------------------------------------------
	// Informes
	public function libro() {
	// 	$data = array();
		// Trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
			$data = $this->dataUser; 	// Variables de la session
			return view('libros/libroView', $data);
		}  else {
			return redirect()->route('login');
		}
	}

}