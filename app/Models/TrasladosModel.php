<?php namespace App\Models;

use CodeIgniter\Model;

class TrasladosModel extends Model {
    protected $table            = 'productos_tiendas';
    protected $primaryKey       = 'id_producto_tienda';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['id_producto_tienda', 'producto_id', 'tienda_id', 'tienda_destino_id', 'cantidad_productos'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}