<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\TiendasModel;
use App\Models\ProductosModel;
use App\Models\TrasladosModel;
use App\Models\InventarioModel;

class RestTraslados extends MyRestApi
{
	protected $modelName = 'App\Models\TrasladosModel';
	protected $format	 = 'json'; 

    public function index()
	{
		// return $this->respond($this->model->findAll(), 404, "Sin datos");
		// genericResponse está en MyRestApi.php
		//return $this->genericResponse($this->model->orderBy('created_at', 'DESC')->findAll(), null, 200);

		$db = db_connect();

		$builder =	$db->table('productos_tiendas as pt');
					$builder->select('pt.*, p.modelo as modelo, to.nombre_tienda as tienda_origen, td.nombre_tienda as tienda_destino');
					$builder->join('productos as p', 'pt.producto_id = p.id_producto');
					$builder->join('tiendas as to', 'pt.tienda_id = to.id_tienda');
					$builder->join('tiendas as td', 'pt.tienda_destino_id = td.id_tienda');
					$builder->where('pt.deleted', null);
					$builder->orderBy('pt.created_at', 'DESC');
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
	}

	public function create() 
	{
		$traslado = new TrasladosModel();
		$inventario = new InventarioModel();

		$producto = new ProductosModel();

		// traslados está en validation.php
		if ($this->validate('traslados')) {
			// Que busque en el modelo de producto
			$queryProd = $producto->find($this->request->getPost('producto_id'));

			if($queryProd == null) {
				// no existe
				// genericResponse está en MyRestApi.php
				return $this->genericResponse(null, array("producto_id" => "Producto no existe."), 500);
			}

			$id = $traslado->insert([
				'producto_id' 			=> $this->request->getPost('producto_id'),
				'tienda_id' 			=> $this->request->getPost('tienda_id'),
				'tienda_destino_id'		=> $this->request->getPost('tienda_destino_id'),
				'cantidad_productos' 	=> $this->request->getPost('cantidad_productos')
			]);

			$inventario->insert([
				'cantidad'			=> $this->request->getPost('cantidad_productos'),
				'producto_id'		=> $this->request->getPost('producto_id'),
				'tienda_id'			=> $this->request->getPost('tienda_destino_id'),
				'traslado_id'		=> $id,
				'tipo' 				=> 'Ent'
			]);
			
			$inventario->insert([
				'cantidad'			=> ($this->request->getPost('cantidad_productos') * -1 ),
				'producto_id'		=> $this->request->getPost('producto_id'),
				'tienda_id'			=> $this->request->getPost('tienda_id'),
				'traslado_id'		=> $id,
				'tipo' 				=> 'Sal'
			]);

			// return $this->respond($this->model->find($id));
			return $this->genericResponse($this->model->find($id), null, 200);
		}

		$validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
		// return $this->respond($validation->getErrors());
	} // create

	public function show($id=null)
	{
		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("traslado" => "Traslado no existe."), 500);
		}
		return $this->genericResponse($this->model->find($id), null, 200);
	} // show

	public function delete($id=null)
	{
		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("traslado" => "Traslado no existe."), 500);
		}

		$traslado = new TrasladosModel();
		$inventario = new InventarioModel();

		$inventario->where('traslado_id', $id);
		$inventario->delete();


		$traslado->delete($id);
		return $this->genericResponse("Traslado eliminado.", null, 200);
	} // delete

	public function update($id = null) 
	{
		$traslado = new TrasladosModel();
		$producto = new ProductosModel();

		$data = $this->request->getRawInput();

		// traslados está en validation.php
		if ($this->validate('traslados')) {
			// Que busque en el modelo de producto
			$queryProd = $producto->find($data['producto_id']);
			$queryTras = $traslado->find($id);

			if($queryTras == null) {
				return $this->genericResponse(null, array("Traslado" => "Traslado no existe."), 500);
			}
			
			if($queryProd == null) { // no existe
				// genericResponse está en MyRestApi.php
				return $this->genericResponse(null, array("producto_id" => "Producto no existe."), 500);
			}

			$traslado->update($id, [
				'producto_id' 			=> $data['producto_id'],
				'tienda_id' 			=> $data['tienda_id'],
				'tienda_destino_id'		=> $data['tienda_destino_id'],
				'cantidad_productos' 	=> $data['cantidad_productos']
			]);

			// borrar el traslado con id = $id 
			$inventario = new InventarioModel();

			$inventario->where('traslado_id', $id)->delete('deleted',true); 
			// delete('deleted',true) fuerza el hard delete

			// hacer un nuevo insert con los datos del update
			$inventario->insert([
				'cantidad'			=> $data['cantidad_productos'],
				'producto_id'		=> $data['producto_id'],
				'tienda_id'			=> $data['tienda_destino_id'],
				'traslado_id'		=> $id,
				'tipo' 				=> 'Ent'
			]);
			
			$inventario->insert([
				'cantidad'			=> ($data['cantidad_productos'] * -1 ),
				'producto_id'		=> $data['producto_id'],
				'tienda_id'			=> $data['tienda_id'],
				'traslado_id'		=> $id,
				'tipo' 				=> 'Sal'
			]);	


			// return $this->respond($this->model->find($id));
			return $this->genericResponse($this->model->find($id), null, 200);
		}

		$validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
		// return $this->respond($validation->getErrors());
	} // update

	//--------------------------------------------------------------------

	public function tiendas() {
		$tiendas = new TiendasModel();
		return $this->genericResponse($tiendas->findAll(), null, 200);
	}
	public function productos() {
		$productos = new ProductosModel();
		return $this->genericResponse($productos->findAll(), null, 200);
	}

	public function producto_ingreso($buscar=null) {
		// return $this->genericResponse($buscar, null, 200);
		return 'asd ' . $buscar;
	}

}