<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_usuario' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'username' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '150',
			],
			'email' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '150',
			],
			'nombre' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '150',
			],
			'ap_pat' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '150',
			],
			'ap_mat' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '150',
			],
			'password' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '255',
			],
			'tipo_de_usuario' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
			],
			'deleted' => [
				'type'				=> 'DATETIME',
				'null'				=> true,
			],
			'created_at datetime default current_timestamp on update current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp'
		]);
		$this->forge->addPrimaryKey('id_usuario', true);
		$this->forge->createTable('usuarios');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('usuarios');
	}
}
