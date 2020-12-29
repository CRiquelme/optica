<?php namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model {
    protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    // Permite modificar e insertar (insert, update) estos campos
    protected $allowedFields = ['username', 'password'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted';

    protected $validationRules    = [
        'username'          => 'required|alpha_numeric_space|min_length[6]',
        'password'          => 'required|min_length[6]'
    ];

    protected $validationMessages = [
        'username'  => [
            'required'              => 'El nombre de usuario es requerido.',
            'alpha_numeric_space'   => 'El nombre de usuario es alfanumérico y con espacio.',
            'min_length'            => 'El nombre de usuario debe contener mínimo 6 caracteres.'
        ],
        
        'password'  => [
            'required'              => 'La contraseña es requerida.',
            'min_length'            => 'La contraseña debe contener mínimo 6 caracteres.'
        ]
    ];

    protected function hashPassword(array $data) {
        if ( !isset( $data['data']['password']) ) return $data;

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        echo $data['data']['password'] ;
        return $data;
    }

    protected $beforeFind = ['hashPassword'];

    protected $skipValidation     = false;

}