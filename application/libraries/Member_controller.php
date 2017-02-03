<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_Controller extends MX_Controller
{
	protected $_page_uri = '';

    function __construct()
    {
        parent::__construct();
        defined('USERKOTYPE') or define('USERKOTYPE', 'member'); // define this to deny direct script access to small modules
        $this->load->helper('security');
        //echo 'Member_controller___construct echo';

        if ($this->session->loggedin == FALSE) {
        	$this->session->set_flashdata('nextpage', $this->_page_uri);
        	redirect(base_url('login'), 'refresh');
        }
    }
}