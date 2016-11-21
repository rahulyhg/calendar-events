<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Member_Controller {

    public function __construct () {
        parent :: __construct();
    }

    public function index()
    {
        $data = array ('site_name' => config_item('site_name'), 'title' => 'Home', 'page' => 'member_pages/home');
        $this->load->view('_members/_main_layout', $data);
    }
}
