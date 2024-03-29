<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\InventarioModel;
use App\Models\IngresoProductosModel;

class RestIngresoProductos extends MyRestApi
{
    protected $modelName = 'App\Models\IngresoProductosModel';
    protected $format	 = 'json'; 
    

    public function index() {
			$db = db_connect();
			$builder =	$db->table('productos_ingresos AS pi');
			$builder->select('pi.id_producto_ingreso, p.modelo, t.nombre_tienda, pi.producto_id, pi.tienda_id, pi.cantidad_producto, pi.factura, pi.created_at');
			$builder->join('productos as p', 'pi.producto_id = p.id_producto');
			$builder->join('tiendas AS t', 'pi.tienda_id = t.id_tienda');
			$builder->where('pi.deleted', null);
			//$builder->where('pi.created_at >', date('Y-m-d', strtotime('-2 months')));
			$builder->orderBy('pi.created_at', 'DESC');
			$query = $builder->get();
			return  $this->genericResponse($query->getResultArray(), null, 200);
    }

    public function create(){
			$ingresoProductos = new IngresoProductosModel();
			$inventario = new InventarioModel();


			if ($this->validate('ingresoProductos')) {
					$id = $ingresoProductos->insert([
			'producto_id' 			=> $this->request->getPost('producto_id'),
			'tienda_id' 			=> $this->request->getPost('tienda_id'),
			'cantidad_producto'		=> $this->request->getPost('cantidad_producto'),
			'factura' 	            => $this->request->getPost('factura')
		]);

			// return $this->respond($this->model->find($id));
			
			// Guardar en inventario
			$inventario->insert([
				'cantidad'			=> $this->request->getPost('cantidad_producto'),
				'producto_id'		=> $this->request->getPost('producto_id'),
				'tienda_id'			=> $this->request->getPost('tienda_id'),
				'ingreso_id'		=> $id,
				'tipo' 				=> 'Ent',
				'numero_factura'	=> $this->request->getPost('factura')
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
		$ingresoProductos = new IngresoProductosModel();
		$inventario = new InventarioModel();

		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);
		}

		$ingresoProductos->delete($id);

		$inventario->where('ingreso_id', $id);
		$inventario->delete();

		return $this->genericResponse("El producto ingresado ha sido eliminado.", null, 200);
	} // delete

	public function update($id = null) 
	{
		$ingresoProductos = new IngresoProductosModel();
		$inventario = new InventarioModel();

		$data = $this->request->getRawInput();

		if ($this->validate('ingresoProductos')) {
			$ingresoProductos->update($id, [
				'producto_id' 			=> $data['producto_id'],
				'tienda_id' 			=> $data['tienda_id'],
				'cantidad_producto'		=> $data['cantidad_producto'],
				'factura' 	            => $data['factura']
			]);

			$inventario->set([
				'cantidad'			=> $data['cantidad_producto'],
				'producto_id'		=> $data['producto_id'],
				'tienda_id'			=> $data['tienda_id'],
				// 'ingreso_id'		=> $id,
				'tipo' 				=> 'Ent',
				'numero_factura'	=> $data['factura']
			]);

			$inventario->where('ingreso_id', $id);
			$inventario->update();

			// return $this->respond($this->model->find($id));
			return $this->genericResponse($this->model->find($id), null, 200);
		}

		$validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
	}

	// Total de factura
	public function totalFatura($id = null)
	{
		$db = db_connect();
		$builder =	$db->table('productos_ingresos AS pi');
		$builder->select('pi.producto_id, pi.factura, pi.cantidad_producto, p.modelo, p.precio_unitario, sum(pi.cantidad_producto * p.precio_unitario) AS totalDeFactura');
		$builder->join('productos as p', 'pi.producto_id = p.id_producto');
		$builder->where('pi.deleted IS NULL');
		$builder->groupBy('pi.factura');
		$builder->having('pi.factura', $id);
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
	}
	
	// Detalle de factura
	public function detalleFatura($id = null)
	{
		$db = db_connect();
		$builder =	$db->table('productos_ingresos AS pi');
		$builder->select('pi.producto_id, pi.factura, pi.cantidad_producto, p.modelo, p.precio_unitario, pi.created_at');
		$builder->join('productos as p', 'pi.producto_id = p.id_producto');
		$builder->where('pi.deleted IS NULL');
		$builder->having('pi.factura', $id);
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
	}
}