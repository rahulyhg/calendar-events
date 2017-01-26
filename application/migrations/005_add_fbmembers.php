<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_fbmembers extends CI_Migration
{

    public function up()
    {
        $field = array(
            'users_id' => array(
                'type' => 'integer',
                'unsigned' => TRUE,
                'unique' => TRUE
            ),
            'fb_id' => array(
                'type' => 'varchar',
                'constraint' => '32'
            )
        );
        $this->dbforge->add_field($field);
        $this->dbforge->add_key('fb_id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (users_id) REFERENCES members(id)');
        $this->dbforge->create_table('fbmembers');
    }

    public function down()
    {
        $this->dbforge->drop_table('fbmembers');
    }
}
