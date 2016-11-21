<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_Controller extends Ce_Controller {
	function __construct () {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->helper('security');
	}
}