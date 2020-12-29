<?php namespace App\Models;

use CodeIgniter\Model;

class TiendasModel extends Model {
    protected $table            = 'tiendas';
    protected $primaryKey       = 'id_tienda';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['nombre_tienda'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $validationRules  = [
        'nombre_tienda'          => 'required|alpha_numeric_space|min_length[4]',
    ];

    protected $validationMessages = [];

    protected $skipValidation   = false;

    // function autocompletar_marcas($query) {

    //     $query = trim(str_replace("%20", " ", $query));

    //     $db      = \Config\Database::connect();
    //     $builder = $db->table('marcas');
    //     $builder->select('nombre_marca');
    //     $builder->like('nombre_marca', "$query", 'both');
    //     $builder->where('deleted', null);
    //     $data = $builder->get();

    //     $datos = $data->getResultArray();
    //     $output = array();
    //     if(count($datos) > 0) {
    //         foreach($datos as $dato)
    //         {
    //             $output[] = $dato["nombre_marca"];
    //         } // foreach
    //     } // if
    //     echo json_encode($output);
    // } // autocompletar_marca

} // class TiendasModel