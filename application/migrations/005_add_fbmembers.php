<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_fbmembers extends CI_Migration
{

    public function up()
    {
        $field = array(
            'users_id' => array(
                'type' => 'integer',
                'unsigned' => TRUE
            ),
            'fb_id' => array(
                'type' => 'bigint',
                'unsigned' => 'true'
            )
        );
        $this->dbforge->add_field($field);
        $this->dbforge->add_key(array('users_id', 'fb_id'));
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (users_id) REFERENCES members(id)');
        $this->dbforge->create_table('fbmembers');
    }

    public function down()
    {
        $this->dbforge->drop_table('fbmembers');
    }
}
