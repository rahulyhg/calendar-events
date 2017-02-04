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

            $events = $this->event_mdl->getevents($this->_date);

            foreach ($events as $type => $events) {
                foreach ($events as $event => $fields) {
                    $this->_eventlist[$fields['meta_value']] = base_url("events/view/{$fields['id']}");
                    $this->_eventdata[$fields['meta_value']] = array(
                        'title' => $fields['name'],
                        'comments' => 'comments',
                        'description' => $fields['description']
                    );
                }
            }

            return array('elist' => $this->_eventlist, 'edata' => $this->_eventdata);
        }

        public function setdatedevents($eventlist, $eventdata) {
            $this->_eventlist = $eventlist;
            $this->_eventdata = $eventdata;
        }

        public function geteventlist() {
            return $this->_eventlist;
        }

        public function index()
        {
            echo "hello";
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
            echo $id;
            exit();
            if (!$id) {
                $this->viewpage('layout/alone', $data);
            }
        }
    }
}
