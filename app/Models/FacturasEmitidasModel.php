<?php namespace App\Models;

use CodeIgniter\Model;

class FacturasEmitidasModel extends Model {
    protected $table            = 'facturas_emitidas';
    protected $primaryKey       = 'id_factura_emitida';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['id_factura_emitida', 'nc', 'anula_factura', 'numero_factura', 'fecha', 'cliente_id', 'monto', 'forma_pago', 'numero_documento', 'fecha_emision', 'fecha_recibo_documento', 'comentario', 'tienda_id'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}