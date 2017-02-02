<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event_mdl extends Base_Model
{
	protected $_userid;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('calendar/calendar_mdl');
    }

    public function getevents($month, $year='')
    {}
}
