<?php
class Ce_Controller extends CI_Controller {
	function __construct () {
		parent::__construct();
        //load required helper and library for the site
		$this->load->helper(array('form', 'url', 'html'));
        $this->load->library('form_validation');
	}
}



