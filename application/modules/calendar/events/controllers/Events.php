<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller

class Events extends Member_Controller
{
    protected $_userid;
    protected $_date;
    protected $_eventlist;

    function __construct($id)
    {
        parent::__construct();
        $this->_userid = $id;
        $this->load->model('event_mdl');
    }

    public function setbydate($date) {
        $this->_date = $date;
    }

    public function index()
    {
        echo "hello";
    }

    public function create() {
    	;
    }

    public function eventbar() {
    	$this->load->view('events_bar', );
    }

    private function geteventlist() {
        $this->initdata['eventlist'] = array(
                3  => 'http://example.com/news/article/2006/06/03/',
                7  => 'http://example.com/news/article/2006/06/07/',
                13 => 'http://example.com/news/article/2006/06/13/',
                26 => 'http://example.com/news/article/2006/06/26/'
        );
    }
}
