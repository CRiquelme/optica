<?php namespace App\Models;

use CodeIgniter\Model;

class SalidaCristalesModel extends Model {
    protected $table            = 'cristales_salida';
    protected $primaryKey       = 'id_cristal_salida';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['id_cristal_salida', 'cristal_id', 'tienda_id', 'cantidad'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}