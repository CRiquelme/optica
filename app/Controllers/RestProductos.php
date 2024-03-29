<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;

class RestProductos extends MyRestApi { 
  protected $modelName  = 'App\Models\ProductosModel';
	protected $format	    = 'json'; 

  public function index() {
    $db = db_connect();
    $builder = $db->table('productos');
            // Construir la consulta
            $builder->select('id_producto, modelo, nombre_cat_pro, group_concat(nombre_proveedor) as nombre_proveedor, marcas.nombre_marca, precio_unitario, precio_venta, stock_critico, cod_barra, productos.deleted, precio_venta, productos.created_at');
            $builder->join('categoria_productos', 'categoria_productos.id_cat_prod = productos.cat_prod_id', 'inner');
            $builder->join('proveedores', 'FIND_IN_SET(proveedores.id_proveedor, productos.proveedor_id) > 0', 'left');
            $builder->join('marcas', 'marcas.id_marca = productos.marca_id', 'inner');
            // $builder->where('productos.deleted', null);
            // $builder->where('productos.created_at >', date('Y-m-d', strtotime('-2 months')));
            $builder->orderBy('productos.created_at', 'DESC');
            $builder->groupBy("id_producto");
    $query    = $builder->get();
    return $this->genericResponse($query->getResultArray(), null, 200);
  }

  public function show($id=null) {
    if($this->model->find($id) == null) {
      return $this->genericResponse(null, array("Mensaje" => "No existen datos."), 500);
    }
    return $this->genericResponse($this->model->find($id), null, 200);
  }

  public function buscar_producto($producto=null) {
    $db = db_connect();
    $builder  =	$db->table('productos AS p');
    $builder->select('p.id_producto, m.nombre_marca, p.cod_barra, p.marca_id, p.modelo, p.created_at, p.precio_venta');
    $builder->join('marcas AS m', 'm.id_marca = p.marca_id');
    $builder->where('p.deleted', null);
    $builder->where('p.modelo', $producto);
    $builder->orWhere('p.cod_barra', $producto);
    $query    = $builder->get();
    return $this->genericResponse($query->getResultArray(), null, 200);
  }
}

?>