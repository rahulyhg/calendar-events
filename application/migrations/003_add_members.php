<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_members extends CI_Migration
{

    public function up()
    {
        $field = array(
            'id' => array(
                'type' => 'integer',
                'unsigned' => TRUE,
                'auto_increment' =>TRUE
            ),
            'username' => array(
                'type' => 'varchar',
                'constraint' => '128',
                'unique' => TRUE
            ),
            'name' => array(
                'type' => 'varchar',
                'constraint' => '128'
            ),
            'hashpass' => array(
                'type' => 'char',
                'constraint' => '128',
            ),
            'email' => array(
                'type' => 'varchar',
                'constraint' => '254',
                'unique' => TRUE
            ),
            'register_date' => array(
                'type' => 'datetime'
            ),
            'is_active' => array(
                'type' => 'tinyint'
            )
        );
        $this->dbforge->add_field($field);
        $this->dbforge->add_key(array(
            'username',
            'email'
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('members');
    }

    public function down()
    {
        $this->dbforge->drop_table('members');
    }
}
