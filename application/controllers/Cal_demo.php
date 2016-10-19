<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cal_demo extends CI_Controller {
	public function index()
	{
		date_default_timezone_set("Asia/Kathmandu");
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		
		$t = mktime(9,50,10,10,10,2016);
		$this->load->library('cal', array($t));
		$days = $this->cal->getDaysMonth();
		$start = $this->cal->getStartDay();

		$data = array(
						'days' => $days,
						'start' => $start,
						'title' => 'haha'
					);
		$this->load->view ('calendar/cal_gen.php', $data);
	}
}
