<?php namespace App\Models;

use CodeIgniter\Model;

class RendicionCajaModel  extends Model {
    protected $table            = 'rendicion_caja';
    protected $primaryKey       = 'id_rendicion_caja';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
      "id_rendicion_caja",
      "fecha",
      "rut",
      "nombre_cliente",
      "total_folio",
      "saldo_folio",
      "numero_folio",
      "numero_voucher",
      "n_voucher_efectivo",
      "n_voucher_tarjeta",
      "numero_boleta",
      "numero_operacion_tbk",
      "numero_guia_despacho",
      "numero_factura",
      "efectivo",
      "tbk",
      "tbkSombra",
      "cheques",
      "webpay",
      "tf",
      "oc",
      "saldo",
      "sobre_id",
      "tienda_id",
      "comentario",
    ];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}