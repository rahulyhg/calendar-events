<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Start extends CI_Controller
{

    public function index()
    {
        $this->load->library('table');
        $this->load->model('user_model');
        $this->user_model->user_create();
        $this->load->view('table', array(
            'result' => $this->user_model->view_user()
        ));
    }

    public function hello($params = array ())
    {
        phpinfo();
    }
}
