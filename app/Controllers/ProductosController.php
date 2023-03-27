<?php
namespace App\Controllers;

use App\Models\MarcasModel;
use App\Models\ProductosModel;
use App\Models\InventarioModel;
use App\Models\IngresoProductosModel;
use App\Models\ProveedoresModel;
use App\Models\CategoriaProductoModel;

class ProductosController extends BaseController
{

	public function index()
	{
        $productosModel     = new ProductosModel($db);
        $catproductosModel  = new CategoriaProductoModel($db);
        $proveedoresModel   = new ProveedoresModel($db);

		// Trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
            $data = $this->dataUser; 	// Variables de la session
            
            $db      = \Config\Database::connect();
            $builder = $db->table('productos');
            // Construir la consulta
            $builder->select('id_producto, modelo, nombre_cat_pro, group_concat(nombre_proveedor) as nombre_proveedor, marcas.nombre_marca, precio_unitario, precio_venta, stock_critico, cod_barra, productos.deleted, precio_venta, productos.created_at');
            $builder->join('categoria_productos', 'categoria_productos.id_cat_prod = productos.cat_prod_id', 'inner');
            $builder->join('proveedores', 'FIND_IN_SET(proveedores.id_proveedor, productos.proveedor_id) > 0', 'left');
            $builder->join('marcas', 'marcas.id_marca = productos.marca_id', 'inner');
            // $builder->where('productos.deleted', null);
            $builder->orderBy('productos.created_at', 'DESC');
            $builder->groupBy("id_producto");
            $productos   = $builder->get()->getResultArray();  // Produces: SELECT * FROM mytable
            
            $data['productos']      = $productos;
            $data['cat_productos']  = $catproductosModel->findAll();
            $data['proveedores']    = $proveedoresModel->findAll();
            
			return view('productos', $data);
			//$this->bar128($data);

		}  else {
			return redirect()->route('login');
        }
        
    } // Index

    public function producto_add() 
	{
		$request= \Config\Services::request();
        $productosModel         = new productosModel($db);
        $inventarioModel        = new InventarioModel($db);
        $IngresoProductosModel  = new IngresoProductosModel($db);

        if ( $request->getPostGet('proveedor_id') != null ) {
            $proveedor = $separado_por_comas = implode(",", $request->getPostGet('proveedor_id') );
        } else {
            $proveedor = null;
        }

		$data = array(
			'modelo' 	        => $request->getPostGet('modelo'),
			'marca_id' 			=> $request->getPostGet('marca_id'),
			'cat_prod_id'		=> $request->getPostGet('cat_prod_id'),
			'proveedor_id'		=> $proveedor,
			'precio_unitario'   => $request->getPostGet('precio_unitario'),
			'precio_venta'		=> $request->getPostGet('precio_venta'),
			'stock_critico'		=> $request->getPostGet('stock_critico'),
			'stock'			    => $request->getPostGet('stock')
		);
		if ($productosModel->save($data) === false) {
            $errores = $productosModel->errors();
            echo json_encode( array( 'status' => FALSE, 'mensaje' => '<b><i class="fas fa-exclamation-circle"></i> LA INFO. NO SE GUARDÓ.</b>', 'errores' => $errores ));
		} else {
            // Guardar en el inventario 
            $last_id = $productosModel->insertID();
            
			echo json_encode(array("status" => TRUE, 'mensaje' => 'Información guardada.'));
        }
        
        if($last_id) {
            $dataIngresoProducto = array(
                'producto_id'       => $last_id,
                'cantidad_producto' => $request->getPostGet('stock'),
                'factura'           => $request->getPostGet('factura'),
                'tienda_id'         => 1
            );
            $IngresoProductosModel->save($dataIngresoProducto);
            $last_id_ingreso = $IngresoProductosModel->insertID();

            $dataInventario = array(
                'cantidad'			=> $request->getPostGet('stock'),
                'producto_id'       => $last_id,
                'tienda_id'         => 1,
                'ingreso_id'        => $last_id_ingreso,
                'tipo'              => 'Ent'
            );
            $inventarioModel->save($dataInventario);

            
        }
    }
    
    public function producto_update() {
		$request= \Config\Services::request();
        $productosModel  = new productosModel($db);
        if ( $request->getPostGet('proveedor_id') != null ) {
            $proveedor = $separado_por_comas = implode(",", $request->getPostGet('proveedor_id') );
        } else {
            $proveedor = null;
        }
		$data = array(
            'id_producto'       => $request->getPostGet('id_producto'),
			'modelo' 	        => $request->getPostGet('modelo'),
			'marca_id' 		    => $request->getPostGet('marca_id'),
			'cat_prod_id'	    => $request->getPostGet('cat_prod_id'),
			'proveedor_id'	    => $proveedor,
			'precio_unitario'   => $request->getPostGet('precio_unitario'),
			'precio_venta'	    => $request->getPostGet('precio_venta'),
			'stock_critico'	    => $request->getPostGet('stock_critico')
		);
		if ($productosModel->update($request->getPostGet('id_producto'), $data) ) {
            echo json_encode(array("status" => TRUE, 'mensaje' => 'Información guardada.'));
        } else {
            $errores = $productosModel->errors();
            echo json_encode(array("status" => TRUE, 'mensaje' => '<b><i class="fas fa-exclamation-circle"></i> LA INFO. NO SE GUARDÓ. asdasd</b>', 'errores' => $errores ));
            console.log('error');
        }			
    }
    
    public function ajax_edit($id) 
	{
		$request= \Config\Services::request();
        $productoModel  = new ProductosModel($db);
        $MarcasModel  = new MarcasModel($db);
        $catproductosModel  = new CategoriaProductoModel($db);
 
        $data = $productoModel->find($id);
        
        // Marca
        $data_marca = $MarcasModel->find($data['marca_id']);
        $data['marca_id'] = $data_marca['nombre_marca'];

        // Categoría
        $data_categoria = $catproductosModel->find($data['cat_prod_id']);
        $data['cat_prod_id'] = $data_categoria['nombre_cat_pro'];
 
        echo json_encode($data);

    } // Edición del producto
    
    public function producto_delete($id) { 
		$productoModel  = new ProductosModel($db);		
        // $this->Book_model->delete_by_id($id);
        $productoModel->delete(['id_producto' => $id]);
        echo json_encode(array("status" => TRUE, "id" => $id));
    } // producto_delete
    
    public function reactivar_producto_deleted($id) { 
        $productosModel  = new ProductosModel($db);
        $data_producto = $productosModel->withDeleted()->find((integer)$id);
        $data = [
            'modelo'        => $data_producto['modelo'],
            'marca_id'      => $data_producto['marca_id'],
            'proveedor_id'  => $data_producto['proveedor_id'],
            'cat_prod_id'   => $data_producto['cat_prod_id'],
            'deleted'       => null
        ];
        
        if($productosModel->update((integer) $data_producto['id_producto'], $data)) 
        {
            echo json_encode(array("status" => TRUE, "id" => $id));
        }
    } // reactivar_producto_deleted
    
    public function autocompletar_producto() {
        $productoModel  = new ProductosModel($db);
        $request= \Config\Services::request();

        $uri = $this->request->uri->getSegment(3);
        echo $productoModel->autocompletar_producto($uri);
    }
    
    public function autocompletar_cat_prod_id() {
        $CategoriaProductoModel  = new CategoriaProductoModel($db);
        $request= \Config\Services::request();

        $uri = $this->request->uri->getSegment(3);
        echo $CategoriaProductoModel->autocompletar_categoria($uri);
    }
    
    public function autocompletar_marcas() {
        $MarcasModel  = new MarcasModel($db);
        $request= \Config\Services::request();

        $uri = $this->request->uri->getSegment(3);
        echo $MarcasModel->autocompletar_marcas($uri);
    }

    // -------------------------------------------------------

    public function ingreso_productos() {
        $data = array();
        if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
            $data = $this->dataUser; 	// Variables de la session    
            
            return view('ingresoProductosView', $data);
        }  else {
			return redirect()->route('login');
        }
    }
    
    public function salida_productos() {
        $data = array();
        if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
            $data = $this->dataUser; 	// Variables de la session    
            
            return view('salidaProductosView', $data);
        }  else {
			return redirect()->route('login');
        }
    }
    
    public function salidasDiaria()
	{
		$data = array();

		// Trabajar con las variables de sesión que vienen de basecontroller
		if($this->dataUser) { 			// Comprobar si tenemos sesión si no redirige a login
			$data = $this->dataUser; 	// Variables de la session

			return view('salidasDiaria', $data);

		}  else {
			return redirect()->route('login');
		}
	}

  public function listProducts() {
    $data = array();
		if($this->dataUser) {
			$data = $this->dataUser;
			return view('listaDeProductosView', $data);
		}  else {
			return redirect()->route('login');
		}
	}


}

?>