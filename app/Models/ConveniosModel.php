<?php namespace App\Models;

use CodeIgniter\Model;

class ConveniosModel extends Model {
    protected $table            = 'convenios';
    protected $primaryKey       = 'id_convenio';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['id_convenio', 'nombre_empresa', 'estado'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}