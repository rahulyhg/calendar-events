<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Member_Controller {

	public function __construct () {
	    parent :: __construct ();
	}
	public function index()	{
		if ($this->form_validation->run() == FALSE) {
			//login unsuccessful
			
			$data = array ('site_name' => config_item('site_name'), 'title' => 'Login', 'page' => 'login');
			$this->load->view('_guests/_main_layout', $data);
		}
		else {
			//login success
			redirect (base_url('member/home'), 'refresh');
		}
	}
}
