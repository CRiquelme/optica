<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\InventarioModel;
use App\Models\SalidaProductosModel;

class RestSalidaProductos extends MyRestApi
{
    protected $modelName = 'App\Models\SalidaProductosModel';
    protected $format	 = 'json'; 
    

    public function index()
	{
        // return $this->genericResponse($this->model->findAll(), null, 200);
        $db = db_connect();

		$builder =	$db->table('productos_salida AS ps');
		$builder->select('ps.id_producto_salida, p.modelo, t.nombre_tienda, ps.producto_id, ps.tienda_id, ps.cantidad_producto, ps.created_at');
					$builder->join('productos as p', 'ps.producto_id = p.id_producto');
					$builder->join('tiendas AS t', 'ps.tienda_id = t.id_tienda');
					$builder->where('ps.deleted', null);
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
    }

    public function create() 
	{
		$salidaProductos = new SalidaProductosModel();
		$inventario = new InventarioModel();

        if ($this->validate('salidaProductos')) {
            $id = $salidaProductos->insert([
				'producto_id' 			=> $this->request->getPost('producto_id'),
				'tienda_id' 			=> $this->request->getPost('tienda_id'),
				'cantidad_producto'		=> $this->request->getPost('cantidad_producto')
			]);

			// $getId = $id->getInsertID();

			// return $this->respond($this->model->find($id));
			
			$getId = $salidaProductos->insertID();
			
			// Guardar en inventario
			$inventario->insert([
				'cantidad'			=> $this->request->getPost('cantidad_producto') * -1,
				'producto_id'		=> $this->request->getPost('producto_id'),
				'tienda_id'			=> $this->request->getPost('tienda_id'),
				'salida_id'			=> 22222,
				'tipo' 				=> 'Salida'
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
		$salidaProductos = new salidaProductosModel();
		$inventario = new InventarioModel();

		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);
		}

		$salidaProductos->delete($id);

		$inventario->where('salida_id', $id);
		$inventario->delete();

		return $this->genericResponse("El producto ingresado ha sido eliminado.", null, 200);
	} // delete

	public function update($id = null) 
	{
		$salidaProductos = new SalidaProductosModel();
		$inventario = new InventarioModel();

		$data = $this->request->getRawInput();

		if ($this->validate('salidaProductos')) {
			$salidaProductos->update($id, [
				'producto_id' 			=> $data['producto_id'],
				'tienda_id' 			=> $data['tienda_id'],
				'cantidad_producto'		=> $data['cantidad_producto']
			]);

			$inventario->set([
				'cantidad'			=> $data['cantidad_producto'] * -1,
				'producto_id'		=> $data['producto_id'],
				'tienda_id'			=> $data['tienda_id'],
				'tipo' 				=> 'Sal'
			]);

			$inventario->where('salida_id', $id);
			$inventario->update();

			return $this->genericResponse($this->model->find($id), null, 200);
		}

		$validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
	}

	// Consultas
	public function fechas($fecha1 = null, $fecha2 = null) 
	{
		$db = db_connect();
		if($fecha1) $fecha1 = $fecha1.' 00:00:00';
		if($fecha2) $fecha2 = $fecha2.' 23:59:59';
		$builder =	$db->table('productos_salida AS ps');
					$builder->select('ps.id_producto_salida, ps.producto_id, ps.tienda_id, ps.cantidad_producto, ps.created_at, p.modelo, p.precio_venta, t.nombre_tienda, m.nombre_marca, p.cat_prod_id, cp.nombre_cat_pro');
					$builder->join('productos as p', 'ps.producto_id = p.id_producto');
					$builder->join('tiendas AS t', 'ps.tienda_id = t.id_tienda');
					$builder->join('marcas AS m', 'm.id_marca = p.marca_id', 'left');
					$builder->join('categoria_productos AS cp', 'cp.id_cat_prod = p.cat_prod_id', 'left');
					$builder->where('ps.deleted', null);
					$builder->where('ps.created_at >=', $fecha1);
					$builder->where('ps.created_at <=', $fecha2);
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
	}
}