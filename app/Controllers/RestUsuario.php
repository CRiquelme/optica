<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\UsuariosModel;

class RestUsuario extends MyRestApi
{
    protected $modelName = 'App\Models\UsuariosModel';
    protected $format	 = 'json'; 
    

    public function index()
	{
        return $this->genericResponse($this->model->findAll(), null, 200);
	}

	public function create() 
	{
        $ingresoUsuario = new UsuariosModel();
        
		$id = $ingresoUsuario->insert([
			'nombre' 			=> $this->request->getPost('nombre'),
			'ap_pat' 			=> $this->request->getPost('ap_pat'),
			'ap_mat'			=> $this->request->getPost('ap_mat'),
			'email' 			=> $this->request->getPost('email'),
			'username' 	    	=> $this->request->getPost('username'),
			'tipo_de_usuario'	=> $this->request->getPost('tipo_de_usuario'),
			'password' 	    	=> $this->request->getPost('password')
		]);
		
		return $this->genericResponse($this->model->find($id), null, 200);
        

        // $validation = \Config\Services::validation();
		// return $this->genericResponse(null, $validation->getErrors(), 500);
    }
	
	public function update($id = null) 
	{
		$ingresoUsuario = new UsuariosModel();
        
        if($id === null) {
			return $this->genericResponse(null, array("Mensaje" => "No existen datos."), 500);
		}

		$data = $this->request->getRawInput();

		$query = $ingresoUsuario->find($id);
		
		isset($data['username']) 		? $username 		= $data['username'] 		: $username = $query['username'];
		isset($data['nombre']) 			? $nombre 			= $data['nombre'] 			: $nombre 	= $query['nombre'];
		isset($data['password']) 		? $password 		= $data['password'] 		: $password = $query['password'];
		isset($data['email']) 			? $email			= $data['email'] 			: $email = $query['email'];
		isset($data['tipo_de_usuario'])	? $tipo_de_usuario	= $data['tipo_de_usuario'] 	: $tipo_de_usuario = $query['tipo_de_usuario'];

		// if ($this->validate('ingresoUsuario')) {
			$ingresoUsuario->update($id, [
				'username'			=> $username,
				'nombre'			=> $nombre,
				'password' 	    	=> $password,
				'email' 	    	=> $email,
				'tipo_de_usuario'	=> $tipo_de_usuario

			]);
			return $this->genericResponse($this->model->find($id), null, 200);
		// }
		
			// return $this->genericResponse($email, null, 200);
		
		// $validation = \Config\Services::validation();
		// return $this->genericResponse(null, $validation->getErrors(), 500);
	}

	public function show($id=null) {
		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Sin datos."), 500);
		}
		return $this->genericResponse($this->model->find($id), null, 200);

    } // show

    public function delete($id=null) {
		$ingresoUsuario = new UsuariosModel();

		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "No existe."), 500);
        }
        
		$ingresoUsuario->delete($id);
		return $this->genericResponse("El usuario ha sido eliminado.", null, 200);
    } // delete

}
?>