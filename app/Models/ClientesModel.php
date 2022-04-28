<?php namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model {
    protected $table            = 'clientes';
    protected $primaryKey       = 'id_cliente';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['nombre_cliente', 'rut', 'direccion', 'telefono', 'celular'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $validationRules  = [];

    protected $validationMessages = [];

    protected $skipValidation   = false;
}