<?php namespace App\Models;

use CodeIgniter\Model;

class SalidaProductosModel extends Model {
    protected $table            = 'productos_salida';
    protected $primaryKey       = 'id_producto_salida';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['producto_id', 'cantidad_producto', 'tienda_id', 'sobre_id'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $validationRules  = [
        
    ];

    protected $validationMessages = [];

    protected $skipValidation   = false;

} // class ProductosModel