<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CristalesSalida extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_cristal_salida' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'cristal_id' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
			],
			'tienda_id' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
			],
			'cantidad' => [
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
		$this->forge->addPrimaryKey('id_cristal_salida', true);
		$this->forge->createTable('cristales_salida');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('cristales_salida');
	}
}
