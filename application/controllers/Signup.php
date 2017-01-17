<?php
defined('BASEPATH') or exit('No direct script access allowed');

class signup extends Member_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->form_validation->run() == FALSE) {
            // signup unsuccessful
            
            $data = array(
                'site_name' => config_item('site_name'),
                'title' => 'signup',
                'page' => 'signup'
            );
            $this->load->view('_guests/_main_layout', $data);
        } else {
            $data = array(
                'user' => $this->input->get('username')
            );
            $this->load->view('members/signup_success', $data);
        }
    }
}
