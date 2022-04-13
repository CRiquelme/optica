<?php namespace App\Models;

use CodeIgniter\Model;

class LibrosModel extends Model {
    protected $table            = 'libros';
    protected $primaryKey       = 'id_libro';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
      'cliente_id',
      'lejosODEsferico',
      'lejosODCilindrico',
      'lejosODEje',
      'lejosODTriangulo',
      'lejosODBase',
      'lejosODDp',
      'cercaODEsferico',
      'cercaODCilindrico',
      'cercaODEje',
      'cercaODTriangulo',
      'cercaODBase',
      'cercaODDp',
      'lejosOIEsferico',
      'lejosOICilindrico',
      'lejosOIEje',
      'lejosOITriangulo',
      'lejosOIBase',
      'lejosOIDp',
      'cercaOIEsferico',
      'cercaOICilindrico',
      'cercaOIEje',
      'cercaOITriangulo',
      'cercaOIBase',
      'cercaOIDp',
      'doctor',
      'armazon',
      'cristales',
      'observaciones'
    ];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $skipValidation   = false;
}