<?php
	
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_session extends CI_Migration {

	public function up()
	{
		$field = array(
				'id' => array(
						'type' => 'varchar',
						'constraint' => '40'
				),
				'ip_address' => array(
						'type' => 'varchar',
						'constraint' => '45'
				),
				'timestamp' => array(
						'type' => 'int',
						'constraint' => '10',
						'unsigned' => TRUE,
						'default' => '0'
				),
				'data' => array(
						'type' => 'blob'
				)
		);
		$this->dbforge->add_field($field);
		$this->dbforge->add_key(array('id', 'ip_address'), TRUE);
		$this->dbforge->add_key(array('cekosessions','timestamp'));
		$this->dbforge->create_table('cekosessions');
	}

	public function down()
	{
			$this->dbforge->drop_table('cekosessions');
	}
}
