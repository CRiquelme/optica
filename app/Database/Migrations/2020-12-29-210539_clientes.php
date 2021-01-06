<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clientes extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_cliente' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'nombre_cliente' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '200',
			],
			'rut' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '50',
			],
			'direccion' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '300',
			],
			'telefono' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '20',
			],
			'celular' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '20',
			],
			'deleted' => [
				'type'				=> 'DATETIME',
				'null'				=> true,
			],
			'created_at datetime default current_timestamp on update current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp'
		]);
		$this->forge->addPrimaryKey('id_cliente', true);
		$this->forge->createTable('clientes');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('clientes');
	}
}
