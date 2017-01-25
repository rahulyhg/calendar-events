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
        $this->load->view('_account', $data);
        //$this->load->view("{$data['src_module']}/{$data['src_action']}/{$data['view_page']}", $data);
        //$this->load->view('_foot');
    }
}
