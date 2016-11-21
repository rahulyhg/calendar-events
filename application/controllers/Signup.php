<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class signup extends CI_Controller {

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
		$config = array(
					array(
							'field' => 'username',
							'label' => 'Username',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide a <strong>%s</strong>.',
							)
					),
					array(
							'field' => 'password',
							'label' => 'Password',
							'rules' => 'required',
							'errors' => array(
									'required' => 'You must provide a <strong>%s</strong>.',
							)
					),
					array(
							'field' => 'passwordconf',
							'label' => 'Confirm Password',
							'rules' => 'required|matches[password]',
							'errors' => array(
									'required' => 'You must fill the <strong>%s</strong> field.',
									'matches' => 'The passwords do not match.'
							)
					),
			);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('partials/header', array ('title' => 'Sign up', 'site_name' => config_item('site_name')));
			$this->load->view('signup');
			$this->load->view('partials/footer');
		}
		else {
			$data = array('user' => $this->input->get('username'));
			$this->load->view('members/signup_success', $data);
		}
	}
}
