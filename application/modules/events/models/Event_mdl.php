<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event_mdl extends Base_Model
{
    // override Base_Model variables
    protected $_table_name = 'verifypending';

    protected $_primary_key = 'id';

    protected $_primary_filter = 'intval';

    protected $_order_by = 'id';

    protected $_rules = array();

    protected $_auto_increment = TRUE;

    public $repeatcode = array(
            'daily' => 11,
            'weekly' => 7,
            'monthly'=> 10,
            'yearly' => 100
    );


    protected $_date;
    protected $_range;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('calendar/calendar_mdl');
    }

    public function getevent($uid, $eid)
    {
        if (!$eid || !$uid) {
            echo 'invalid id';exit();
        }
        $tables = array(
            'events' => array('id', 'name', 'description', 'loc', 'creation_time', 'last_modified'),
            'event_meta' => array('meta_value')
        );

        $select = ''; // the select fields

        foreach ($tables as $table => $fields) {
            foreach ($fields as $field) {
                $select .= "`{$table}`.`{$field}`,";
            }
        }

        trim($select, ",");

        $start = $this->_range['start'];
        $end = $this->_range['end'];

        $where = array(
            'events.status' => 1,
            'event_membership.users_id' => $uid,
            'events.id'=> $eid
        );

        $query = $this->db->select($select)
                -> join ('event_membership', "`event_membership`.`event_id` = `events`.`id` = {$uid}", 'INNER')
                -> join ('event_meta', "`event_meta`.`event_id` = `events`.`id`", 'INNER')
                -> where ($where)
                -> get('events');
        return $query->row_array();
    }

    public function getevents($range)
    {
        $this->_range = $range;
        $events['onetime'] = $this->get('weekly');
        // return the events in an array;
        $events['daily'] = $this->get('daily');
        return $events;
    }


    public function get($type) {
        $tables = array(
            'events' => array('id', 'name', 'description', 'loc', 'creation_time', 'last_modified'),
            'event_meta' => array('meta_value')
        );

        $select = ''; // the select fields

        foreach ($tables as $table => $fields) {
            foreach ($fields as $field) {
                $select .= "`{$table}`.`{$field}`,";
            }
        }

        trim($select, ",");

        $start = $this->_range['start'];
        $end = $this->_range['end'];

        $where = array(
            'events.status' => 1,
            'event_membership.users_id' => (int)$this->session->userdata('id'),
            'event_meta.meta_key' => $this->repeatcode[$type],
            'event_meta.meta_value >' => mktime(0,0,0,$start[1], $start[2], $start[0]),
            'event_meta.meta_value <' => mktime(23,59,59,$end[1], $end[2], $end[0])
        );

        $query = $this->db->select($select)
                -> join ('event_membership', "`event_membership`.`event_id` = `events`.`id`", 'INNER')
                -> join ('event_meta', "`event_meta`.`event_id` = `events`.`id`", 'INNER')
                -> where ($where)
                -> get('events');
        return $query->result_array();
    }


    public function create_event($date) {
        
        switch($this->input->post('type')) {
            case 'onetime':
                return $this->insert($date);
                break;
            case 'repeating':
                return $this->insert($date);
                break;
            default:
                echo "how?";
                exit();
        }
    }

    private function insert($date)
    {
        

        // config the required params.
        $cur_datetime = date('Y-m-d H:i:s');
        $event_date = explode('-', $date); // y-m-d

        $this->_table_name = 'events';
        $this->_primary_key = 'id';

        $id = $this->save(array(
            'status' => -1,
            'name' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            // 'loc' => $this
            'creation_time' => $cur_datetime,
            'last_modified' => $cur_datetime
        ));

        $this->_table_name = 'event_meta';
        $this->_primary_key = 'id';



        $metaid = $this->save(array(
            'event_id' => $id,
            'meta_key' => $this->repeatcode[$this->input->post('repeat')],
            'meta_value' => mktime(0, 0, 0, $event_date[1], $event_date[2], $event_date[0])
        ));

        $this->_table_name = 'event_membership';
        $this->_primary_key = 'event_id';
        $this->_auto_increment = FALSE;

        $memid = $this->save(array(
            'event_id' => $id,
            'users_id' => $this->session->userdata('id'),
            'events_membership' => 1
        ));

        if ($id && $metaid && $memid) {
            $data = array(
                'status' => 1
            );
            $this->update($data, $id);
            return $id;
        }
        return '';
    }

    protected function update($data, $id= null, $single=FALSE)
    {
        $this->db->update('events', $data, "id = {$id}");
    }

    public function permissions($uid, $eid) {
        $where = array(
            'users_id' => $uid,
            'event_id' => $eid
        );
        $query = $this->db->where($where)
                -> get('event_membership')
                -> result_array();
        if (count($query)) {
            return '777';
        }

        return 000;
    }
}
