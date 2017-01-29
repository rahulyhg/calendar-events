<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_Controller extends MX_Controller
{
	protected $_page_uri = '';

    function __construct($nextpage)
    {
        parent::__construct();
        $this->load->helper('security');
        //echo 'Member_controller___construct echo';
        var_dump($this->session->userdata());

        if ($this->session->loggedin == FALSE) {
        	$this->session->set_flashdata('nextpage', $nextpage);
        	//redirect(base_url('login'), 'refresh');
        }
    }
}