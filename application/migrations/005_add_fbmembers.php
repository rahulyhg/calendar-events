<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_verifypending extends CI_Migration
{

    public function up()
    {
        $field = array(
            'users_id' => array(
                'type' => 'varchar',
                'unsigned' => TRUE
            ),
            'access_token' => array(
                'type' => 'bigint'
            )
        );
        $this->dbforge->add_field($field);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (users_id) REFERENCES members(id)');
        $this->dbforge->create_table('fbmembers');
    }

    public function down()
    {
        $this->dbforge->drop_table('fbmembers');
    }
}
