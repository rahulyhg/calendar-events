<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (defined('USERKOTYPE')) {
// if accessed from home controller
    class Events extends Member_Controller
    {
        protected $_userid;
        protected $_date;
        protected $_eventlist;
        protected $_eventdata;

        function __construct($id)
        {
            parent::__construct();
            $this->_userid = $id;
            $this->load->model('event_mdl');
        }

        public function setbydate($date) {
            $this->_date = $date;
            $this->_eventlist = array(
                3  => 'http://example.com/news/article/2006/06/03/',
                7  => 'http://example.com/news/article/2006/06/07/',
                13 => 'http://example.com/news/article/2006/06/13/',
                26 => 'http://example.com/news/article/2006/06/26/'
            );

            $this->_eventdata = array (
                3 => array (
                        'title' => 'event 3',
                        'comments' => 'comments',
                        'description' => 'description'
                    ),
                7 => array (
                        'title' => 'event 7',
                        'comments' => 'comments',
                        'description' => 'description'
                    ),
                13 => array (
                        'title' => 'event 13',
                        'comments' => 'comments',
                        'description' => 'description'
                    ),
                26 => array (
                        'title' => 'event 26',
                        'comments' => 'comments',
                        'description' => 'description'
                    )
            );
        }

        public function geteventlist() {
            return $this->_eventlist;
        }

        public function index()
        {
            echo "hello";
        }

        public function create() {
            ;
        }

        public function eventbar() {
            $data = array(
                'date' => $this->_date,
                'eventlist' => $this->_eventlist,
                'eventdata' => $this->_eventdata
            );
            return $this->load->view('events_bar', $data, TRUE);
        }
    } // end class
} // end if

else {
// if called directly
    class Events extends Member_controller {
        protected $_userid;
        protected $_date;
        protected $_eventlist;
        protected $_eventdata;

        public function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('event_mdl');
        }

        public function index() {
            echo 'jadu';
        }
        public function create() {
            $errors = '';
            if ($this->form_validation->run() == FALSE) {
            // invalid form
                $errors .= validation_errors();
            } else {
            // valid form
                if ($check = $this->event_mdl->create_event()) {
                    echo 'event created';
                    exit();
                }
                else {
                    $errors .= $check;
                }
            }
            $this->viewpage(array('errors' => $errors));
        }
        public function viewpage($pagedata = null) {
            $data['uri'] = 'events/create';
            $data['pagedata'] = $pagedata;
            echo modules::run('layout/alone', $data);
        }
        public function view($id = null) {
            $id = (int) $id;
            if (!$id) {
                $this->viewpage('layout/alone', $data);
            }
        }
    }
}
