<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tiendas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tienda' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'nombre_tienda' => [
				'type'				=> 'CHAR',
				'constraint'		=> '50',
			],
			'deleted' => [
				'type'				=> 'DATETIME',
				'null'				=> true,
			],
			'created_at datetime default current_timestamp on update current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp'
		]);
		$this->forge->addPrimaryKey('id_tienda', true);
		$this->forge->createTable('tiendas');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tiendas');
	}
}
