<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class StockController extends BaseController
{
    public function index()
	{

		$data = array();

		// Trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
			$data = $this->dataUser; 	// Variables de la session

			return view('stockView', $data);

		}  else {
			return redirect()->route('login');
		}
	}

	//--------------------------------------------------------------------
	// Informes
	public function informeStockPrecios()
	{
		$data = array();

		// Trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
			$data = $this->dataUser; 	// Variables de la session

			return view('informeStockPrecios', $data);

		}  else {
			return redirect()->route('login');
		}
	}

}