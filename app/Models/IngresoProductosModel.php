<?php namespace App\Models;

use CodeIgniter\Model;

class IngresoProductosModel extends Model {
    protected $table            = 'productos_ingresos';
    protected $primaryKey       = 'id_producto_ingreso';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['producto_id', 'cantidad_producto', 'factura', 'tienda_id'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $validationRules  = [
        
    ];

    protected $validationMessages = [];

    protected $skipValidation   = false;

} // class ProductosModel