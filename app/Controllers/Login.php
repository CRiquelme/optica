<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;

class Login extends BaseController {
	public function index() {
		$userModel  = new LoginModel($db);
		$validation = \Config\Services::validation();
		$request		= \Config\Services::request();

		$data = array(
			'username'	=> $request->getPostGet('username'),
			'password'	=> $request->getPostGet('password'),
			'uri' 			=> $this->request->uri->getSegment(1)
		);

		$username = $request->getPostGet('username');
		$password = $request->getPostGet('password');
		$user 		= $userModel->where(['username' => $username])->first();

		if ($_SERVER['REQUEST_METHOD'] == 'POST') { // comprueba que se hizo submit
			if (password_verify($password, $user['password'])) {
				$data['errores'] = null;
				// Variables de session
				$newdata = [
                    'id_usuario'    	=> $user['id_usuario'],
                    'email'         	=> $user['email'],
                    'nombre'        	=> $user['nombre'],
                    'tipo_de_usuario' => $user['tipo_de_usuario'],
										'logged_in'     	=> TRUE
										];
				$this->session->set($newdata);
				// Entrar al dashboard
				return redirect()->route('dashboard');
			} else {
				$data['errores'] = ['Verifica que los datos ingresados son los correctos.'];
			}
		}
		return view('login', $data);
	}
}