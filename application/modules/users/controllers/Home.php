<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends Member_controller {
	protected $_page_uri = 'users/home';
	protected $data = array();
	
	public function __construct() {
		parent::__construct($this->_page_uri);
	}

	public function index() {
		$this->calendar();
	}

	/**
	 * It sets the year and month,
	 * creates an event module instance passes the userid to events module and
	 * passes the reference to the event object
	 * and passes the data to Calendar::gen
	 *
	*/

	public function calendar($param1 = '', $param2 = '') {
		/*
         * If no param is supplied, show cur month of cur year
         * If only one param is supplied show month of cur year
         * If both param supplied, param1 is year and param2 is month
        */
        $param1 = (int) $param1;
        $param2 = (int) $param2;

        $year = 0;

		if (!$param1) {
            // if $param is null, set date ko null. 
            $this->data['calendar']['date'] = null;
        }
        elseif (!$param2) {
        	// param1 is not null
         	// param2 is null
         	// month = param1

         	if ($param1>=1 && $param1<=12) {
         		// checking range of date 1-12
         		$this->data['calendar']['date'] = array(
	            	'month' => $param1,
	            	'year' => null
	            );
         	}
         	else {
         		$this->data['calendar']['date'] = null;
         	}
        }
        else {
        	// param1 is not null
        	// param2 is not null
        	// year = param1 and month = param2

        	// check range of year (later)

        	if ($param2>=1 && $param2<=12) {
         		// checking range of date 1-12
         		$this->data['calendar']['date'] = array(
	            	'month' => $param2,
	            	'year' => $param1
	            );
         	}

        }

        $this->load->module('events', $this->session->userdata('id')); // pass userid

        $this->data['calendar']['events'] = $this->events; // need date so events will be handled from calendar controller

		modules::load('layout')->member($this->data);
	}

	public function events($eventid) {
		$eventid = (int) $eventid;

		if (!$eventid) {
			// if event id is not valid or empty
			exit("invalid event selected");
		}

		modules::load('events')->showevent($eventid);
	}
}