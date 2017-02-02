<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller

class Events extends Member_Controller
{
	protected $_userid;

    function __construct($userid)
    {
        parent::__construct();
        $this->_userid = $userid;
        $this->load->model('event_mdl');
    }

    public function index()
    {
        echo "hello";
    }

    public function ofmonth($year, $month) {
    	;
    }

    public function ofyear() {}

    public function ofday() {}
}
