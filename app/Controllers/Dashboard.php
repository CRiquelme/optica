<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClientesModel;
use App\Models\ServiciosModel;

class Dashboard extends BaseController {
	public function index() {
		$data = array();

		// Trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
			$data = $this->dataUser; 	// Variables de la session
			return view('dashboardView', $data);
		}  else {
			return redirect()->route('login');
		}
	}

	public function clientes()
	{
		$clientesModel  = new ClientesModel($db);

		$data = array();

		// Trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
			$data = $this->dataUser; 	// Variables de la session

			$clientes = $clientesModel->findAll();
			$data['clientes'] = $clientes;
			return view('clientesView', $data);
			$this->bar128($data);

		}  else {
			return redirect()->route('login');
		}
	}


	public function servicios()
	{
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
			$data 				= $this->dataUser; 	// Variables de la session
			$ServiciosModel  	= new ServiciosModel($db);

			$uri 				= $this->request->uri->getSegment(3);
			$data['uri'] 		= $this->request->uri->getSegment(3);
			$data['servicios'] 	= $ServiciosModel->where(['cliente_id' => $uri])->findall();
			return view('servicios', $data);
		}  else {
			return redirect()->route('login');
		}
	}

	public function cliente_add() 
	{
		$request= \Config\Services::request();
		$clientesModel  = new ClientesModel($db);
		$data = array(
			'nombre_cliente' 	=> $request->getPostGet('nombre_cliente'),
			'rut' 						=> $request->getPostGet('rut'),
			'direccion'				=> $request->getPostGet('direccion'),
			'telefono'				=> $request->getPostGet('telefono'),
			'celular'					=> $request->getPostGet('celular')
		);
		if ($clientesModel->save($data) === false) {
			echo json_encode(array("status" => FALSE, 'mensaje' => 'Información no se guardó.'));
			$data['errores'] = $clientesModel->errors();
		} else {
			echo json_encode(array("status" => TRUE, 'mensaje' => 'Información guardada.'));
		}
	}
	
	public function cliente_delete($id) 
	{ 
        $request= \Config\Services::request();
		$clientesModel  = new ClientesModel($db);
		
		// $this->Book_model->delete_by_id($id);
		$clientesModel->delete(['id_cliente' => $id]);
        echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id) 
	{
		$request= \Config\Services::request();
		$clientesModel  = new ClientesModel($db);
 
		// $data = $this->Book_model->get_by_id($id);
		$data = $clientesModel->find($id);
 
        echo json_encode($data);

	}

	public function cliente_update() {
		$request= \Config\Services::request();
		$clientesModel  = new ClientesModel($db);
		$data = array(
			'nombre_cliente' 	=> $request->getPostGet('nombre_cliente'),
			'rut' 				=> $request->getPostGet('rut'),
			'direccion'			=> $request->getPostGet('direccion'),
			'telefono'			=> $request->getPostGet('telefono'),
			'celular'			=> $request->getPostGet('celular')
		);
		$clientesModel->update($request->getPostGet('id_cliente'), $data);
		echo json_encode(array("status" => TRUE));
	}


	//--------------------------------------------------------------------

}