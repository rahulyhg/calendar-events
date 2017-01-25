<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_Controller extends Ce_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        //echo 'Member_controller___construct echo';
    }
}