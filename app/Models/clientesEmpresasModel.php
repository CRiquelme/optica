<?php namespace App\Models;

use CodeIgniter\Model;

class ClientesEmpresasModel extends Model {
    protected $table            = 'clientes_empresas';
    protected $primaryKey       = 'id_cliente_empresa';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['id_cliente_empresa', 'nombre', 'rut', 'direccion', 'telefono', 'email'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}