<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_alleventnmembership extends CI_Migration
{

    public function up()
    {
        $this->add_events();
        $this->add_event_meta(); // has FK
        $this->add_event_comments(); // has FK

        $this->add_membership_in_event();

        $this->add_event_membership(); // has FK
    }

    public function down()
    {
        $this->dbforge->drop_table('events');
        $this->dbforge->drop_table('event_meta');
        $this->dbforge->drop_table('event_comments');
        $this->dbforge->drop_table('membership_in_event');
        $this->dbforge->drop_table('event_membership');

    }

    private function add_events () {
        $field = array(
            'id' => array (
                'type' => 'integer',
                'unsigned' => TRUE,
                'unique' => TRUE,
                'auto_increment' => TRUE
            ),
            'status' => array(
                'type' => 'int'
            ),
            'name' => array(
                'type' => 'varchar',
                'constraint' => '128',
                'null' => TRUE
            ),
            'description' => array(
                'type' => 'varchar',
                'constraint' => '1024',
                'null' => TRUE
            ),
            'loc' => array(
                'type' => 'varchar',
                'constraint' => '128',
                'null' => TRUE
            ),
            'creation_time' => array(
                'type' => 'datetime'
            ),
            'last_modified' => array (
                'type' => 'datetime'
            )
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('events');
    }

    private function add_event_meta () {
        $field = array(
            'id' => array(
                'type' => 'integer',
                'unsigned' => TRUE,
                'unique' => TRUE,
                'auto_increment' => TRUE
            ),
            'event_id' => array(
                'type' => 'integer',
                'unsigned' => TRUE
            ),
            'meta_key' => array(
                'type' => 'integer', // type of event (signed integer because thinking of -ve value for passed events)
                'null' => FALSE
            ),
            'meta_value' => array(
                'type' => 'integer',
                'unsigned' => TRUE,
                'null' => FALSE
            )
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (event_id) REFERENCES events(id)');

        $this->dbforge->create_table('event_meta');
    }

    private function add_event_comments () {
        $field = array(
            'id' => array(
                'type' => 'integer',
                'unsigned' => TRUE,
                'unique' => TRUE,
                'auto_increment' => TRUE
            ),
            'event_id' => array(
                'type' => 'integer',
                'unsigned' => TRUE
            ),
            'users_id' => array(
                'type' => 'integer',
                'unsigned' => TRUE
            ),
            'comment' => array(
                'type' => 'varchar',
                'constraint' => '1024'
            ),
            'post_time' => array(
                'type' => 'datetime'
            )
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (event_id) REFERENCES events(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (users_id) REFERENCES members(id)');

        $this->dbforge->create_table('event_comments');
    }

    private function add_membership_in_event () {
        $field = array(
            'id' => array(
                'type' => 'integer',
                'unsigned' => TRUE
            ),
            'membership_name' => array(
                'type' => 'varchar',
                'constraint' => 32
            )
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('membership_in_event');
    }

    private function add_event_membership () {
        $field = array(
            'users_id' => array(
                'type' => 'integer',
                'unsigned' => TRUE
            ),
            'event_id' => array(
                'type' => 'integer',
                'unsigned' => TRUE
            ),
            'events_membership' => array(
                'type' => 'integer',
                'unsigned' => TRUE
            )
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (users_id) REFERENCES members(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (event_id) REFERENCES events(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (events_membership) REFERENCES membership_in_event(id)');

        $this->dbforge->create_table('event_membership');
    }
}
