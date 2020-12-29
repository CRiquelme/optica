<?php namespace App\Models;

use CodeIgniter\Model;

class SobreModel extends Model {
    protected $table            = 'sobre';
    protected $primaryKey       = 'id_sobre';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'id_sobre', 'tipo_de_lente', 'nombre', 'rut', 'numero_pedido', 'fono', 'email', 'lejos_od', 'lejos_esf1', 'lejos_cil1', 'lejos_oi', 'lejos_esf2', 'lejos_cil2', 'cerca_od', 'cerca_esf1', 'carca_cil1', 'cerca_oi', 'cerca_esf2', 'cerca_cil2', 'cerca_add', 'cerca_dp', 'cerca_h', 'tipo_de_cristal', 'lejos', 'cerca', 'profesional', 'fecha_de_receta', 'armazon_lejos', 'armazon_cerca', 'total', 'abono', 'saldo', 'observaciones', 'forma_de_pago', 'numero_de_boleta', 'numero_de_transbank', 'numero_gdf', 'retira_conforme', 'avisado_fecha', 'nombre2'
    ];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}