<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductosSalida extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_producto_salida' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'producto_id' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
			],
			'tienda_id' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
			],
			'cantidad_producto' => [
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
		$this->forge->addPrimaryKey('id_producto_salida', true);
		$this->forge->createTable('productos_salida');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('productos_salida');
	}
}
