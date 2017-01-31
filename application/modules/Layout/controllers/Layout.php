<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layout extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "hello";
    }
    
    public function account($data) {
        $this->load->view('_account', array('data' => $data));
    }

    public function member($data) {
        // data will contain
        // page = the page loaded
        $this->load->view('_member',$data);
    }
}
