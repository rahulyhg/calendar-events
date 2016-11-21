<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct () {
		parent::__construct ();	
	}

	public function login () {
		//function to login a user

		//get credentials, i.e. username and a hashed password
		$user = $this->get_by ( array(
			'username' => $this->input->post('username'),
			'password' => $this->hashed($this->input->post('password'))
		), TRUE);

		//
		if (count($user)) {
			//login user here

			//setup cookie data
			$data = array(
				'name' => $user->name,
				'email' => $user->email,
				'id' => $user->id,
				'LoggedIn' => TRUE
			);

			//set the session cookie with $data
			$this->session->set_userdata($data);
		}
	}

	public function logout () {
		$this->session->sess_destroy();
	}

	public function isLoggedIn () {
		return (bool) $this->session->userdata('isLoggedIn');
	}

	private function hashed ($raw) {
		return hash('sha512', config_item('site_name') . $raw . config_item('encryption_key'));
	}


	protected $_table_name = 'users';
	protected $_order_by = 'name';
}
