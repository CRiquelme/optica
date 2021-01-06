<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Proveedores extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_proveedor' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'nombre_proveedor' => [
				'type'				=> 'CHAR',
				'constraint'		=> '200',
			],
			'deleted' => [
				'type'				=> 'DATETIME',
				'null'				=> true,
			],
			'created_at datetime default current_timestamp on update current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp'
		]);
		$this->forge->addPrimaryKey('id_proveedor', true);
		$this->forge->createTable('proveedores');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('proveedores');
	}
}
