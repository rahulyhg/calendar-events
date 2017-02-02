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
        if (isset($data['calendar'])) {
        }

        $this->load->module('calendar', $data['calendar']);
        $data['caltable'] = $this->calendar->gen();
        $data['eventbar'] = $this->calendar->geteventbar();

        $this->load->view('_member',$data);
    }

    public function alone ($page, $pagedata = null) {
        $data = array(
            'page' => $page,
            'pagedata' => $pagedata
        );
        $this->load->view('_alone', $data);
    }
}
