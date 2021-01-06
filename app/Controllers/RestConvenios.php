<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\ConveniosModel;

class RestConvenios extends MyRestApi
{
    protected $modelName = 'App\Models\ConveniosModel';
    protected $format	 = 'json'; 
    

    public function index()
	{
        $db = db_connect();
		$builder =	$db->table('convenios AS c');
		$builder->select('c.*');
        $builder->where('c.deleted', null);
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
    }

    public function create() 
	{
        $ingresoConvenios = new ConveniosModel();
        if ($this->validate('ingresoConvenios')) {
            $id = $ingresoConvenios->insert([
				'nombre_empresa'    => $this->request->getPost('nombre_empresa'),
				'estado' 		=> $this->request->getPost('estado')
            ]);
            
			return $this->genericResponse($this->model->find($id), null, 200);
        }

        $validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
    }

    public function delete($id=null)
	{
		$ingresoConvenios = new ConveniosModel();

		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Convenio no existe."), 500);
		}
		
		$ingresoConvenios->delete($id);
		
		return $this->genericResponse("El convenio ha sido eliminado.", null, 200);
    } // delete
    
    public function show($id=null)
	{
		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Convenio no existe."), 500);
		}
		return $this->genericResponse($this->model->find($id), null, 200);

    } // show

    public function update($id = null) 
	{
		$ingresoConvenios = new ConveniosModel();

		$data = $this->request->getRawInput();

		if ($this->validate('ingresoConvenios')) {
			$ingresoConvenios->update($id, [
				'nombre_empresa'    => $data['nombre_empresa'],
				'estado'            => $data['estado']
			]);
			// return $this->respond($this->model->find($id));
			return $this->genericResponse($this->model->find($id), null, 200);
		}

		$validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
	}
    
}
?>