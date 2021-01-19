<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\ClientesEmpresasModel;

class RestClientesEmpresas extends MyRestApi
{
    protected $modelName = 'App\Models\ClientesEmpresasModel';
    protected $format	 = 'json';
    
    public function index()
	{
        $db = db_connect();
		$builder =	$db->table('clientes_empresas AS ce');
		$builder->select('ce.*');
        $builder->where('ce.deleted', null);
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
    }

    public function create() 
	{
        $clientesEmpresas = new ClientesEmpresasModel();
        if ($this->validate('clientesEmpresas')) {
            $id = $clientesEmpresas->insert([
				'nombre'    => $this->request->getPost('nombre'),
				'rut'       => $this->request->getPost('rut'),
				'direccion' => $this->request->getPost('direccion'),
				'telefono'  => $this->request->getPost('telefono'),
				'email'     => $this->request->getPost('email')
            ]);
            
			return $this->genericResponse($this->model->find($id), null, 200);
        }

        $validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
    } // Create

    public function update($id = null) 
	{
		$clientesEmpresas = new ClientesEmpresasModel();

        $data = $this->request->getRawInput();

		if ($this->validate('clientesEmpresas')) {
			$clientesEmpresas->update($id, [
                'nombre'    => $data['nombre'],
                'rut'       => $data['rut'],
                'direccion' => $data['direccion'],
                'telefono'  => $data['telefono'],
                'email'     => $data['email']
			]);
			// return $this->respond($this->model->find($id));
			return $this->genericResponse($this->model->find($id), null, 200);
		}

		$validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
	}

    public function delete($id=null)
	{
		$clientesEmpresas = new ClientesEmpresasModel();

		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Cliente empresa no existe."), 500);
		}
		
		$clientesEmpresas->delete($id);
		
		return $this->genericResponse("El cliente empresa ha sido eliminada.", null, 200);
    } // delete

    public function show($id=null)
	{
		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Cliente empresa no existe."), 500);
		}
		return $this->genericResponse($this->model->find($id), null, 200);

    } // show
}