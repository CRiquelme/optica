<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\ProductosModel;

class RestStock extends MyRestApi
{
    protected $modelName = 'App\Models\InventarioModel';
	protected $format	 = 'json'; 

    public function index()
	{
        // return $this->genericResponse($this->model->findAll(), null, 200);
        $db = db_connect();

		$builder =	$db->table('inventario AS i');
					$builder->select('i.producto_id, p.cod_barra, p.modelo AS producto, i.tienda_id, t.nombre_tienda AS tienda, SUM(i.cantidad) stock, m.nombre_marca, p.stock_critico AS stock_critico, i.tienda_id');
					$builder->join('productos as p', 'i.producto_id = p.id_producto');
					$builder->join('tiendas AS t', 'i.tienda_id = t.id_tienda');
					$builder->join('marcas AS m', 'm.id_marca = p.marca_id');
					$builder->where('i.deleted', null);
					$builder->where('p.deleted', null);
                    // $builder->orderBy('pt.created_at', 'DESC');
                    $builder->groupby('i.producto_id, i.tienda_id');
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
    }

    public function show($id=null)
	{
		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "No existen datos."), 500);
        }
        // return $this->genericResponse($this->model->find($id), null, 200);

        $db = db_connect();

		$builder =	$db->table('inventario AS i');
					$builder->select('i.producto_id, p.modelo AS producto, i.tienda_id, t.nombre_tienda AS tienda, SUM(i.cantidad) stock, m.nombre_marca, p.stock_critico AS stock_critico');
					$builder->join('productos as p', 'i.producto_id = p.id_producto');
					$builder->join('tiendas AS t', 'i.tienda_id = t.id_tienda');
					$builder->join('marcas AS m', 'm.id_marca = p.marca_id');
					$builder->where('i.deleted', null);
					$builder->where('i.producto_id', $id);
					$builder->where('p.deleted', null);
                    // $builder->orderBy('pt.created_at', 'DESC');
                    $builder->groupby('i.producto_id, i.tienda_id');
		$query = $builder->get();
		// return  $valor;
		return  $this->genericResponse($query->getResultArray(), null, 200);
        
	} // show
	
	public function showCodigo($id=null)
	{
		// $productos = new ProductosModel();

		$db = db_connect();
		
		if($id === null) {
			return $this->genericResponse(null, array("Mensaje" => "No existen datos..."), 500);
		}

		$builder =	$db->table('inventario AS i');
					$builder->select('i.producto_id, p.modelo AS producto, i.tienda_id, t.nombre_tienda AS tienda, SUM(i.cantidad) stock, m.nombre_marca, p.cod_barra, p.stock_critico AS stock_critico');
					$builder->join('productos as p', 'i.producto_id = p.id_producto');
					$builder->join('tiendas AS t', 'i.tienda_id = t.id_tienda');
					$builder->join('marcas AS m', 'm.id_marca = p.marca_id');
					$builder->where('i.deleted', null);
					$builder->where('p.cod_barra', $id);
					// $builder->where('i.producto_id', $id);
                    // $builder->orderBy('pt.created_at', 'DESC');
                    $builder->groupby('i.producto_id, i.tienda_id');
		$query = $builder->get();
		// return  $valor;
		return  $this->genericResponse($query->getResultArray(), null, 200);
        
	} // show

	//--------------------------------------------------------------------

	public function productos() {
		$productos = new ProductosModel();
		return $this->genericResponse($productos->findAll(), null, 200);
	}
}