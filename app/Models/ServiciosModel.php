<?php namespace App\Models;

use CodeIgniter\Model;

class ServiciosModel extends Model {
    protected $table            = 'servicios';
    protected $primaryKey       = 'id_servicio';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['cliente_id', 'tipo_trabajo', 'descripcion_servicio', 'tecnico_id', 'firma_cliente'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}