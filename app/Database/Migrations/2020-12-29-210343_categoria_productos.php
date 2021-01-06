<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoriaProductos extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_cat_prod' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'nombre_cat_pro' => [
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
		$this->forge->addPrimaryKey('id_cat_prod', true);
		$this->forge->createTable('categoria_productos');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('categoria_productos');
	}
}
