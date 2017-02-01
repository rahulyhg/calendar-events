<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends Base_Model
{
	protected $_userid;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('calendar/calendar_mdl');
    }

    public function ofmonth($month, $year='')
    {}

    public function ofday($month, $year='')
    {}

    public function ofyear($month, $year='')
    {}
}
