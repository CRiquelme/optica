<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
	public function index()
	{
		return view('home');
	}
	
	public function create()
	{
		if(empty($this->session)){
			return redirect()->route('registro');
		}

		$data = array();
		// trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) {
			$data = $this->dataUser;
		} 
		
		return view('nuevo', $data);
	}

	//--------------------------------------------------------------------

}
