<?php namespace App\Models;

use CodeIgniter\Model;

class CierreCajaModel  extends Model {
    protected $table            = 'cierre_caja';
    protected $primaryKey       = 'id_cierre_caja';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
      "id_cierre_caja",
      "tienda_id",
      "fecha_cierre",
    ];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}