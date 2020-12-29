<?php namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model {
    protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    // Permite modificar e insertar (insert, update) estos campos
    protected $allowedFields = ['username', 'email', 'password', 'nombre', 'ap_pat', 'ap_mat', 'tipo_de_usuario'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted';

    protected $validationRules    = [
        // 'username'          => 'alpha_numeric_space|min_length[6]',
        // 'email'             => 'valid_email|is_unique[usuarios.email]',
        // 'password'          => 'min_length[6]',
        // 'password_confirm'  => 'required_with[password]|matches[password]'
    ];

    protected $validationMessages = [
        // 'username'  => [
        //     'required'              => 'Requerido.',
        //     'alpha_numeric_space'   => 'Alfanumérico y con espacio.',
        //     'min_length'            => 'Debe contener mínimo 6 caracteres.'
        // ],
        // 'email'     => [
        //     'is_unique'             => 'Registrado.',
        //     'valid_email'           => 'Debe ser válido.',
        //     'is_unique'             => 'Registrado.'
        // ],
        // 'password'  => [
        //     'required'              => 'Requerida.',
        //     'min_length'            => 'Debe contener mínimo 6 caracteres.'
        // ],
        // 'password_confirm' => [
        //     'required_with'         => 'La contraseña es requerida.',
        //     'required'              => 'Requerida.',
        //     'matches'               => 'La confirmación de contraseña no coincide con la contraseña ingresada.'
        // ],
        // 'nombre' => [
        //     'required'              => 'Requerido.'
        // ],
        // 'ap_pat' => [
        //     'required'              => 'Requerido.'
        // ]
    ];

    protected function hashPassword(array $data) {
        if ( !isset( $data['data']['password']) ) return $data;

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected $skipValidation     = false;

}