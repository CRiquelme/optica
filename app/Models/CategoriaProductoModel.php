<?php namespace App\Models;

use CodeIgniter\Model;

class CategoriaProductoModel extends Model {
    protected $table            = 'categoria_productos';
    protected $primaryKey       = 'id_cat_prod';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = ['nombre_cat_pro'];

    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted';

    protected $validationRules  = [
        'modelo'                => 'required|alpha_numeric_space|min_length[4]',
    ];

    protected $validationMessages = [];

    protected $skipValidation   = false;

    function autocompletar_categoria($query) {

        $query = trim(str_replace("%20", " ", $query));

        $db      = \Config\Database::connect();
        $builder = $db->table('categoria_productos');
        $builder->select('nombre_cat_pro');
        $builder->like('nombre_cat_pro', "$query", 'both');
        $builder->where('deleted', null);
        $data = $builder->get();

        $datos = $data->getResultArray();
        $output = array();
        if(count($datos) > 0) {
            foreach($datos as $dato)
            {
                $output[] = $dato["nombre_cat_pro"];
            } // foreach
        } // if
        echo json_encode($output);
    } // autocompletar_producto
}