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
                    $this->_eventlist[$fields['meta_value']] = base_url("users/home/events/a{$fields['meta_value']}/{$fields['id']}");
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

        public function view($day, $id) {
            $id = (int) $id;
            $day = (int) $day;
            if ($id && $day) {
                $p = $this->event_mdl->permissions($this->_userid, $id);

                if (substr($p, 0, 1) > 4) {
                    $data = array(
                        'id' => $id,
                        'page' => 'events/view',
                        'event' => $this->event_mdl->getevent($this->_userid, $id)
                    );
                    $data['event']['day'] = $day;
                    $this->viewpage($data);
                }
                else {
                    echo 'no permissions to read';
                }
                
            }
            else {
                echo 'empty or invalid id';
            }
        }

        public function edit($eid) {
            $this->load->library('form_validation');
            $eid = (int) $eid;
            if ($eid) {
                $p = $this->event_mdl->permissions($this->_userid, $eid);
                echo $this->input->post('name');
                if (!$this->input->post('name'))
                {
                    echo 'show';
                    // show the edit form 
                    if (substr($p, 0, 1) > 5) {
                        $data = array(
                            'id' => $eid,
                            'page' => 'events/edit',
                            'old' => $this->event_mdl->getevent($this->_userid, $eid),
                        );
    
                        $this->viewpage($data);
                    }
                    else {
                        echo 'no permissions to edit';
                    }
                }
                else {
                    // update the supplied values
                    echo 'update';
                    if ($this->form_validation->run()) {
                        echo 'form good';
                        exit();
                    }
                    else {
                        echo 'bad_form';
                    }
                }
            }
            else {
                echo 'empty or invalid id';
            }
        }

        private function viewpage($pagedata) {
            $data['uri'] = $pagedata['page'];
            $data['pagedata'] = $pagedata;
            echo modules::run('layout/alone', $data);
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
                $event_date = array_map('intval', explode('-', $this->input->post('date')));
                $data['date'] = array(
                    'year' => $event_date[0],
                    'month' => $event_date[1],
                    'day' => $event_date[2]
                );
                $data['from'] = 'event';
                $this->load->module('calendar', $data);
                $date = $this->calendar->convert_to_greg($event_date);
                if ($check = $this->event_mdl->create_event($date)) {
                    echo 'event created';
                    exit();
                }
                else {
                    $errors .= $check;
                }
            }
            $this->viewpage(array('errors' => $errors));
        }
        private function viewpage($pagedata) {
            $data['uri'] = 'events/create';
            $data['pagedata'] = $pagedata;
            echo modules::run('layout/alone', $data);
        }
        
    }
}
