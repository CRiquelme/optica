<?php namespace App\Models;

use CodeIgniter\Model;

class CristalesModel extends Model {
    protected $table            = 'cristales';
    protected $primaryKey       = 'id_cristal';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['id_cristal', 'cajon', 'tienda_id', 'material', 'potencia1', 'potencia2', 'cantidad'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}