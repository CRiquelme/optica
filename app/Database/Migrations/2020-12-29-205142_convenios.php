<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Convenios extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_convenio' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'	=> true,
			],
			'nombre_empresa' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '200',
			],
			'estado' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> '100',
			],
			'deleted' => [
				'type'				=> 'DATETIME',
				'null'				=> true,
			],
			'created_at datetime default current_timestamp on update current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp'
		]);
		$this->forge->addPrimaryKey('id_convenio', true);
		$this->forge->createTable('convenios');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('convenios');
	}
}
