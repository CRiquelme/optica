<?php namespace App\Models;

use CodeIgniter\Model;

class InventarioModel extends Model {
    protected $table            = 'inventario';
    protected $primaryKey       = 'id_inventario';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['cantidad', 'producto_id', 'tienda_id', 'tipo', 'ingreso_id', 'traslado_id', 'salida_id', 'numero_factura', 'traslado_id' ];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $validationRules  = [
        
    ];

    protected $validationMessages = [];

    protected $skipValidation   = false;

} // class ProductosModel