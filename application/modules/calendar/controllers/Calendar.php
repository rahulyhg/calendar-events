<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller

class Calendar extends Member_Controller
{
    protected $_page_uri = 'calendar';
    function __construct()
    {
        parent::__construct($this->_page_uri);
		$this->load->library('np_cal');
        $this->load->model('calendar_mdl');
    }

    public function index()
    {
        echo "Hello from Calendar.php";
    }
	
	public function test() {
		// echo $this->np_cal->np_get_month_name('01');

        // echo $this->calendar_mdl->get_days_in_year(2073, 'year');
        // echo $this->calendar_mdl->get_days_in_month(10);
        echo $this->calendar_mdl->np_generate('2080',1);
        // echo $this->calendar_mdl->np_convert_from_greg(array(1995,2,5));
        // echo $this->calendar_mdl->np_convert_to_greg(array(2051,8,6));
        // echo $this->calendar_mdl->np_convert_to_greg('2051-10-22');
        // echo $this->calendar_mdl->np_convert_from_greg('1994-11-22');
	}
}
