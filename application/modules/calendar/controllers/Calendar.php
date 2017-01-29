<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calendar extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "Hello from Calendar.php";
    }
	
	public function test() {
		$this->load->library('np_cal');
		$this->load->helper('np_date_helper');
		echo $this->np_cal->np_get_month_name('01');
		var_dump( $this->np_cal->np_get_day_names());
	}
}
