<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\SobreModel;

class RestSobre extends MyRestApi
{
    protected $modelName = 'App\Models\SobreModel';
    protected $format	 = 'json'; 
    

    public function index() {
        return $this->genericResponse($this->model->findAll(), null, 200);
    }

    public function create() 
	{
        $sobre = new SobreModel();
        $id = $sobre->insert([
            'rut' 		=> $this->request->getPost('rut')
        ]);
    }

    public function delete($id=null)
	{
		$sobre = new SobreModel();

		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);
        }
        
		$sobre->delete($id);
		return $this->genericResponse("El producto ingresado ha sido eliminado.", null, 200);
    } // delete
    
    public function show($id=null)
	{
		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);
		}
		return $this->genericResponse($this->model->find($id), null, 200);

    } // show

    public function update($id = null) 
	{
		$sobre = new SobreModel();

		$data = $this->request->getRawInput();

		if ($this->validate('sobre')) {
			$sobre->update($id, [
				'cajon' 		=> $data['cajon'],
				'material' 		=> $data['material'],
				'potencia1'		=> $data['potencia1'],
				'potencia2' 	=> $data['potencia2'],
				'cantidad' 	    => $data['cantidad']
			]);
			// return $this->respond($this->model->find($id));
			return $this->genericResponse($this->model->find($id), null, 200);
		}

		$validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
	}
    
}
?>