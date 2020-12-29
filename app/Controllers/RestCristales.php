<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\CristalesModel;
use App\Models\SalidaCristalesModel;

class RestCristales extends MyRestApi
{
    protected $modelName = 'App\Models\CristalesModel';
    protected $format	 = 'json'; 
    

    public function index()
	{
        $db = db_connect();
		$builder =	$db->table('cristales AS c');
		$builder->select('c.*, t.nombre_tienda');
				$builder->join('tiendas AS t', 'c.tienda_id = t.id_tienda', 'left');
				$builder->where('c.deleted', null);
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
    }

    public function create() 
	{
        $ingresoCristales = new CristalesModel();
        if ($this->validate('ingresoCristales')) {
            $id = $ingresoCristales->insert([
				'cajon' 		=> $this->request->getPost('cajon'),
				'material' 		=> $this->request->getPost('material'),
				'potencia1'		=> $this->request->getPost('potencia1'),
				'potencia2' 	=> $this->request->getPost('potencia2'),
				'cantidad' 	    => $this->request->getPost('cantidad')
            ]);
            
			return $this->genericResponse($this->model->find($id), null, 200);
        }

        $validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
    }

    public function delete($id=null)
	{
		$ingresoCristales = new CristalesModel();
		$salidaCristales = new salidaCristalesModel();

		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);
		}
		
		$ingresoCristales->delete($id);
		
		$salidaCristales->where('cristal_id', $id)->delete();
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
		$ingresoCristales = new CristalesModel();

		$data = $this->request->getRawInput();

		if ($this->validate('ingresoCristales')) {
			$ingresoCristales->update($id, [
				'cajon' 		=> $data['cajon'],
				'tienda_id'		=> $data['tienda_id'],
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