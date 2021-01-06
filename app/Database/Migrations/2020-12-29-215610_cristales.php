<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cristales extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_cristal' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'cajon' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '200',
			],
			'material' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '50',
			],
			'tienda_id' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
			],
			'potencia1' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '50',
			],
			'potencia2' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '50',
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
		$this->forge->addPrimaryKey('id_cristal', true);
		$this->forge->createTable('cristales');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('cristales');
	}
}
