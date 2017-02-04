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
        protected $_eventfull;

        function __construct($id)
        {
            parent::__construct();
            $this->_userid = $id;
            $this->load->model('event_mdl');
        }

        public function setbydate($date) {
            $this->_date = $date;

            $events = $this->event_mdl->getevents($this->_date);
            $this->_eventfull = $events;

            $event_date = array_map('intval', $date['start']);
            $data['date'] = array(
                'year' => $event_date[0],
                'month' => $event_date[1],
                'day' => $event_date[2]
            );
            $data['from'] = 'event';
            $this->load->module('calendar', $data);
            
            

            foreach ($this->_eventfull as $type => $events) {
                foreach ($events as $s => $event) {
                    $date = $this->calendar->convert_from_greg(date('Y-m-d', $event['meta_value']));
                    $this->_eventfull[$type][$s]['date'] = $date;

                }
            }              

            return $this->_eventfull;
        }

        public function setdatedevents($eventlist, $eventdata) {
            $this->_eventlist = $eventlist;
            $this->_eventdata = $eventdata;
        }

        public function geteventfull() {
            return $this->_eventfull;
        }

        public function index()
        {
            echo "hello";
        }

        public function eventbar() {

            $data = array(
                'date' => $this->_date,
                'eventlist' => $this->_eventfull
            );
            return $this->load->view('events_bar', $data, TRUE);
        }

        public function view($date, $id) {
            $id = (int) $id;
            $npdate= $date;

            $event_date = array_map('intval', explode('-', $date));
            $data['date'] = array(
                'year' => $event_date[0],
                'month' => $event_date[1],
                'day' => $event_date[2]
            );
            $data['from'] = 'event';
            $this->load->module('calendar', $data);
            $date = $this->calendar->convert_to_greg($event_date);
            $datearray = explode('-', $date);
            $timestamp = mktime(0,0,0,$datearray[1], $datearray[2], $datearray[0]);

            if (!$id && $date) {
                    $data = array(
                        'id' => 0,
                        'page' => 'events/view',
                        'event' => $this->event_mdl->getevent($this->_userid, $timestamp, TRUE)
                    );

                    $data['date'] = $npdate;
                    $data['single'] = FALSE;
                    //$data['event']
                    $this->viewpage($data);
                
            }
            elseif ($id){
                $p = $this->event_mdl->permissions($this->_userid, $id);

                if (substr($p, 0, 1) > 4) {
                    $data = array(
                        'id' => $id,
                        'page' => 'events/view',
                        'event' => $this->event_mdl->getevent($this->_userid, $id)
                    );

                    $data['event']['date'] = $npdate;

                    $data['date'] = $date;
                    $data['single'] = TRUE;
                    //$data['event']
                    $this->viewpage($data);
                }
                else {
                    echo 'no permissions to read';
                }
            } else {
                echo 'empty or invalid id';
            }
        }

        public function edit($eid) {
            $this->load->library('form_validation');
            $eid = (int) $eid;
            if ($eid) {
                $p = $this->event_mdl->permissions($this->_userid, $eid);

                if (!$this->input->post('title'))
                {
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
                    if ($this->form_validation->run() == FALSE) {
                        $data = array(
                            'name' => $this->input->post('title'),
                            'description' => $this->input->post('description'),
                            'loc' => $this->input->post('location')
                        );
                        $this->event_mdl->update($data, $eid);
                        $this->session->set_flashdata('success', 'Event Edited.');
                        redirect(base_url('users/home'), 'refresh');
                        exit();
                    }
                    else {
                        $data = array(
                            'id' => $eid,
                            'page' => 'events/edit',
                            'old' => $this->event_mdl->getevent($this->_userid, $eid),
                        );
    
                        $this->viewpage($data);
                    }
                }
            }
            else {
                echo 'empty or invalid id';
            }
        }

        public function delete($id) {
            if ($id) {
                $this->event_mdl->setinactive($id);
                $this->session->set_flashdata('success', 'Deleted Sucessfully');
                redirect(base_url('users/home'), 'refresh');
                exit();
            }
            else {
                echo 'invalid id';
                exit();
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
                    $this->session->set_flashdata('success', 'Event created successfully');
                    redirect(base_url('users/home'));
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
