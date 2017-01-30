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
		$this->load->helper('np_date');
    }

    public function index()
    {
        echo "Hello from Calendar.php";
    }
	
	public function test() {
		echo $this->np_cal->np_get_month_name('01');
		print_r($this->np_cal->np_get_day_names());
	}
}
