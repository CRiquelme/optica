<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\MarcasModel;

class ProductosModel extends Model {
    protected $table            = 'productos';
    protected $primaryKey       = 'id_producto';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['id_producto', 'modelo', 'cat_prod_id', 'marca_id', 'proveedor_id', 'precio_unitario', 'precio_venta', 'stock_critico', 'stock'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $validationRules  = [
        'modelo'                => 'required|alpha_numeric_space|min_length[3]|is_unique[productos.modelo, productos.id_producto, {id_producto}]',
        'marca_id'              => 'required|alpha_numeric_space|min_length[3]',
        'proveedor_id'          => 'required',
        'cat_prod_id'           => 'required|min_length[3]',
    ];

    protected $validationMessages   = [
        'modelo'        => [
            'required'              => 'El producto es requerido.',
            'alpha_numeric_space'   => 'El producto es alfanumérico y con espacio.',
            'min_length'            => 'El producto debe contener mínimo 3 caracteres.',
            'is_unique'             => 'El producto ya está registrado.'
        ],
        'marca_id'      => [
            'required'              => 'La marca es requerida.',
            'alpha_numeric_space'   => 'La marca es alfanumérica y con espacio.',
            'min_length'            => 'La marca debe contener mínimo 3 caracteres.'
        ],
        'proveedor_id'  => [
            'required'              => 'Debe seleccionar al menos un proveedor'
        ],
        'cat_prod_id'   => [
            'required'              => 'La categoría es requerida.',
            'min_length'            => 'La categoría debe contener mínimo 3 caracteres.'
        ]
    ];

    protected $skipValidation   = false;

    protected $beforeInsert = ['getIdMarca', 'getIdCategoria', 'getIdProveedor', 'crea_barcode'];

    protected $beforeUpdate = ['getIdMarca', 'getIdCategoria', 'getIdProveedor'];

    protected function getIdMarca(array $data) {
        if ( !isset( $data['data']['marca_id']) ) return $data;
        
        // Buscar si existe para obtener el id
        $marca = $data['data']['marca_id'] ;
        $MarcasModel  = new MarcasModel($db);        
        $db      = \Config\Database::connect();
        $builder = $db->table('marcas');
        $builder->select('id_marca', 'nombre_marca');
        $builder->where('nombre_marca', $marca);
        $query = $builder->get();

        if( count($query->getResult()) > 0 ) {
            foreach($query->getResult() as $row) {
                $data['data']['marca_id'] = $row->id_marca;
            }
        } else {
            // Hacer el insert
            $new_marca = ['nombre_marca' => $marca];
            $builder->insert($new_marca);
            // Tomar el último id agregado y meterlo $data['data']['cat_prod_id']
            $data['data']['marca_id'] = $db->insertID();
        }
        return $data;
    }

    protected function getIdCategoria(array $data) {
        if ( !isset( $data['data']['cat_prod_id']) ) return $data;

        // Buscar si existe para obtener el id
        $nombre_cat_pro = $data['data']['cat_prod_id'];
        $db         = \Config\Database::connect();
        $builder    = $db->table('categoria_productos');
        $builder->select('id_cat_prod', 'nombre_cat_pro');
        $builder->where('nombre_cat_pro', $nombre_cat_pro);
        $query      = $builder->get();

        // Comprobar si la categoría existe en la tabla
        if( count($query->getResult()) > 0 ) {
            foreach($query->getResult() as $row) {
                $data['data']['cat_prod_id'] = $row->id_cat_prod;
            }
        } else { // Si no existe entonces
            // Hacer el insert
            $new_cat_pro = ['nombre_cat_pro' => $nombre_cat_pro];
            $builder->insert($new_cat_pro);
            // Tomar el último id agregado y meterlo $data['data']['cat_prod_id']
            $data['data']['cat_prod_id'] = $db->insertID();
        }
        return $data;
    }

    protected function getIdProveedor(array $data) {
        $prov = explode(',', $data['data']['proveedor_id']);
        $provs = array(); 
        foreach($prov as $row)
        {
            // Buscar si existe para obtener el id
            $db         = \Config\Database::connect();
            $builder    = $db->table('proveedores');
            $builder->select('id_proveedor');
            $builder->where('id_proveedor', $row);
            $query      = $builder->get();

            // Comprobar si la categoría existe en la tabla
            if( count($query->getResult()) > 0 ) {
                foreach($query->getResult() as $r) {
                    $provs[] = $r->id_proveedor;
                }
            } else { // Si no existe entonces
                // Hacer el insert
                $new_prov = ['nombre_proveedor' => $row];
                $builder->insert($new_prov);
                // Tomar el último id agregado
                $provs[] = $db->insertID();
            }
        } // Foreach
        $data['data']['proveedor_id'] = implode(",", $provs);
        return $data;
    }

    protected function crea_barcode(array $data) {
        $db      = \Config\Database::connect();
        $builder = $db->table('productos');
        $builder->selectCount('id_producto');
        $query = $builder->get();
        foreach($query->getResult() as $row) {
            $data['data']['cod_barra'] = ++$row->id_producto.date("is");
        }
        return $data;
    }
    
    function autocompletar_producto($query) {
        $query   = trim(str_replace("%20", " ", $query));
        $db      = \Config\Database::connect();
        $builder = $db->table('productos');
        $builder->select('modelo');
        $builder->like('modelo', "$query", 'both');
        $builder->where('deleted', null);
        $data = $builder->get();

        $datos = $data->getResultArray();
        $output = array();
        if(count($datos) > 0) {
            foreach($datos as $dato) {
                $output[] = $dato["modelo"];
            } // foreach
        } // if
        echo json_encode($output);
    } // autocompletar_producto

} // class ProductosModel