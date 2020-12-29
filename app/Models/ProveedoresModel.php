<?php namespace App\Models;

use CodeIgniter\Model;

class ProveedoresModel extends Model {
    protected $table            = 'proveedores';
    protected $primaryKey       = 'id_proveedor';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['nombre_proveedor'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $validationRules  = [
        'nombre_proveedor'      => 'required|alpha_numeric_space|min_length[4]',
    ];

    protected $validationMessages = [];

    protected $skipValidation   = false;

} // class ProductosModel