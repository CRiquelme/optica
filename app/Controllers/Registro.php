<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuariosModel;


class Registro extends BaseController {
    public function index()	{
        // $userModel  = new UsuariosModel($db);
        // $validation =  \Config\Services::validation();

        // $request= \Config\Services::request();
        // $data = array(
        //     'username'          => $request->getPostGet('username'),
        //     'email'             => $request->getPostGet('email'),
        //     'nombre'            => $request->getPostGet('nombre'),
        //     'ap_pat'            => $request->getPostGet('ap_pat'),
        //     'ap_mat'            => $request->getPostGet('ap_mat'),
        //     'password'          => $request->getPostGet('password'),
        //     'password_confirm'  => $request->getPostGet('password_confirm')
        // );
        
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') { // comprueba que se hizo submit
            
        //     if ($userModel->save($data) === false) {
                
        //         $data['errores'] = $userModel->errors();
            
        //     } else {
                
        //         $user = $userModel->where('email', $data['email'])->first();
                
        //         $newdata = [
        //             'id_usuario'    => $user['id_usuario'],
        //             'email'         => $user['email'],
        //             'nombre'        => $user['nombre'],
        //             'logged_in'     => TRUE
        //         ];

        //         $this->session->set($newdata);
                
        //         return redirect()->route('nuevo');
        //     }
        // }
        // $this->session->destroy();
        // return view('registro', $data);

        $data = array();

		// Trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
			$data = $this->dataUser; 	// Variables de la session

            return view('registro', $data);

		}  else {
			return redirect()->route('login');
		}
    }
    
    public function crear() {
        return view('crear');
    }

    public function password() {
        if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
            $data = $this->dataUser; 	// Variables de la session
            return view('passwordView', $data);
        }
        return redirect()->route('login');
    }


    public function logout(){
        $this->session->destroy();
        return redirect()->route('login');
       }  

	//--------------------------------------------------------------------

}