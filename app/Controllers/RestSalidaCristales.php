<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\SalidaCristalesModel;
use App\Models\CristalesModel;

class RestSalidaCristales extends MyRestApi
{
    protected $modelName = 'App\Models\SalidaCristalesModel';
    protected $format	 = 'json';

    public function index()
	{
        // return $this->genericResponse($this->model->findAll(), null, 200);
        $db = db_connect();

		$builder =	$db->table('cristales_salida AS cs');
		$builder->select('cs.*, t.nombre_tienda');
					$builder->join('tiendas AS t', 'cs.tienda_id = t.id_tienda');
					$builder->where('cs.deleted', null);
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
    }

    public function create() 
	{
        $salidaCristales = new SalidaCristalesModel();
        $cristales = new CristalesModel();

        if ($this->validate('salidaCristales')) {
            $cristalId = $this->request->getPost('cristal_id');

            $nuevoStock = $this->request->getPost('stock') - $this->request->getPost('cantidad');

            $id = $salidaCristales->insert([
				'cristal_id' 	=> $this->request->getPost('cristal_id'),
				'tienda_id' 	=> $this->request->getPost('tienda_id'),
				'cantidad'		=> $this->request->getPost('cantidad')
            ]);

            $cristales->update($cristalId, [
				'cantidad' => $nuevoStock
			]);

            return $this->genericResponse($this->model->find($id), null, 200);
        }

        $validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
	}

	public function show($id=null)
	{
		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);
		}
		return $this->genericResponse($this->model->find($id), null, 200);

	} // show
	
	public function delete($id=null)
	{
        $salidaCristales = new salidaCristalesModel();
        $cristales = new CristalesModel();

		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);
		}

        $salidaCristales->delete($id);

		return $this->genericResponse("El producto ingresado ha sido eliminado.", null, 200);
	} // delete

	public function update($id = null) 
	{
		$salidaCristales = new SalidaCristalesModel();

		$data = $this->request->getRawInput();

		if ($this->validate('salidaCristales')) {
			$salidaCristales->update($id, [
				'producto_id' 			=> $data['producto_id'],
				'tienda_id' 			=> $data['tienda_id'],
				'cantidad_producto'		=> $data['cantidad_producto']
			]);

			return $this->genericResponse($this->model->find($id), null, 200);
		}

		$validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
	}

	// Consultas
	public function ultimo($id = null) 
	{
        $db = db_connect();

		$builder =	$db->table('cristales_salida AS cs');
		$builder->select('cs.id_cristal_salida, cs.cantidad, cs.created_at');
                $builder->where('cs.deleted', null);
                $builder->where('cs.cristal_id', $id);
                $builder->orderBy('cs.created_at', 'DESC');
                $builder->limit(1);
        $query = $builder->get();
        return  $this->genericResponse($query->getResultArray(), null, 200);
	}
}