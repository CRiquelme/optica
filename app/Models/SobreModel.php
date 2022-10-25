<?php namespace App\Models;

use CodeIgniter\Model;

class SobreModel extends Model {
    protected $table            = 'sobre';
    protected $primaryKey       = 'id_sobre';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        "cliente_id",
        "rut",
        "nombre",
        "tipo_de_lente",
        "numero_pedido",
        "fono",
        "email",
        "fecha",
        "lejos_od",
        "lejos_esf1",
        "lejos_cil1",
        "lejos_oi",
        "lejos_esf2",
        "lejos_cil2",
        "cerca_od",
        "cerca_esf1",
        "cerca_cil1",
        "cerca_oi",
        "cerca_esf2",
        "cerca_cil2",
        "cerca_add",
        "cerca_dp",
        "cerca_h",
        "tipo_de_cristal",
        "lejos",
        "cerca",
        "profesional",
        "fecha_de_receta",
        "armazon_lejos",
        "armazon_lejos_id",
        "armazon_lejos_cantidad",
        "armazon_cerca",
        "armazon_cerca_id",
        "armazon_cerca_cantidad",
        "total",
        "abono",
        "saldo",
        "observaciones",
        "forma_de_pago",
        "n_folio",
        "n_voucher",
        "n_voucher_efectivo",
        "n_voucher_tarjeta",
    ];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}