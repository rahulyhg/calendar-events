<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends Member_controller {
	protected $_page_uri = 'users/home';
	public function __construct() {
		parent::__construct($this->_page_uri);
	}

	public function index() {
		modules::load('calendar')->test();
	}
}