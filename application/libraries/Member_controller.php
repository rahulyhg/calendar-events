<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_Controller extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('security');
        //echo 'Member_controller___construct echo';
    }
}