<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Productos extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_producto' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'cat_prod_id' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '50',
			],
			'proveedor_id' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '50',
			],
			'marca_id' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '50',
			],
			'modelo' => [
				'type'				=> 'CHAR',
				'constraint'		=> '200',
			],
			'precio_unitario' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
			],
			'precio_venta' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
			],
			'stock' => [
				'type'				=> 'INT',
				'constraint'		=> 9,
			],
			'stock_critico' => [
				'type'				=> 'INT',
				'constraint'		=> 9,
			],
			'cod_barra' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '50',
			],
			'deleted' => [
				'type'				=> 'DATETIME',
				'null'				=> true,
			],
			'created_at datetime default current_timestamp on update current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp'
		]);
		$this->forge->addPrimaryKey('id_producto', true);
		$this->forge->createTable('productos');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('productos');
	}
}
