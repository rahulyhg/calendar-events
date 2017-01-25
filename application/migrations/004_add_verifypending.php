<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_verifypending extends CI_Migration
{

    public function up()
    {
        $field = array(
            'id' => array(
                'type' => 'varchar',
                'unsigned' => TRUE,
                'auto_increment' =>TRUE
            ),
            'username' => array(
                'type' => 'varchar',
                'constraint' => '128'
            ),
            'hashpass' => array(
                'type' => 'char',
                'constraint' => '128',
            ),
            'email' => array(
                'type' => 'varchar',
                'constraint' => '254'
            ),
            'register_date' => array(
                'type' => 'datetime'
            ),
            'verifying_key' => array(
                'type' => 'char',
                'constraint' =>'254'
            )
        );
        $this->dbforge->add_field($field);
        $this->dbforge->add_key(array(
            'username',
            'email'
        ));
        $this->dbforge->add_key(array(
            'id'
        ));
        $this->dbforge->create_table('verify_pending');
    }

    public function down()
    {
        $this->dbforge->drop_table('verify_pending');
    }
}
