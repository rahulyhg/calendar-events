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

    public function __construct()
    {
        parent::__construct();
        $this->load->model('calendar/calendar_mdl');
    }

    public function getevents($month, $year='')
    {}

    public function create_event() {
        echo $this->input->post('type');
        switch($this->input->post('type')) {
            case 'onetime':
                $this->insertonetime();
            case 'repeating':
            default:
                echo "how?";
                exit();
        }
    }

    private function insertonetime() {
        // config the required params.
        $cur_datetime = date('Y-m-d H:i:s');

        $this->_table_name = 'events';
        $this->_primary_key = 'id';

        $id = $this->save(array(
            'status' => -1,
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'creation_time' => $cur_datetime,
            'last_modified' => $cur_datetime
        ));

        $this->_table_name = 'event_meta';
        $this->_primary_key = 'id';

        $metaid = $this->save(array(
            'event_id' => $id,
            'meta_key' => 'one_time',
            'meta_value' => 1
        ));

        $this->_table_name = 'events_membership';
        $this->_primary_key = '';
        $this->_auto_increment = FALSE;

        $memid = $this->save(array(
            'event_id' => $id,
            'users_id' => $this->session->userdata('id'),
            'events_membership' => 1
        ));

        if ($id && $metaid && $memid) return $id;
    }
}
