<?php
class Member_Controller extends CI_Controller {
	function __construct () {
		parent::__construct();
		$this->load->library('session');
	}
}