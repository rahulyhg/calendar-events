<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct () {
	    parent :: __construct ();
        $this->load->helper('html');
        $this -> load -> helper ('form');
        //$this -> load -> library ('form_validation');
	}
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			//login unsuccessful
			$this->load->view('partials/header', array ('title' => 'Login', 'site_name' => config_item('site_name')));
			$this->load->view('login');
			$this->load->view('partials/footer');
		}
		else {
			//login success
			redirect ('member/home', 'refresh');
		}
	}
}
