﻿<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller

class Calendar extends Member_Controller
{
    protected $_page_uri = 'calendar';
    protected $year = '';
    protected $month = '';
    protected $day = '';

    protected $initdata = array();

    function __construct($data)
    {
        parent::__construct($this->_page_uri);
		$this->load->library('np_cal');
        $this->load->model('calendar_mdl');
        $this->initdata = $data;
        $this->initdata['events']->setbydate($date);
    }

    public function index()
    {
        echo "Hello from Calendar.php";
    }
	
    /**
     * gets ref to event instance from parameter and then get the user's events
     * processes the events and sets preferences and data for calendar_mdl :: generate
    */
	public function gen() {
        // data to be passed to the view
        $data['prefs'] = $this->getprefs(); // get the preferences
        $data['events'] = $this->initdata['eventlist'];

        // feed the data to view and return it
        return $this->load->view('calendar_tbl', $data, TRUE);
	}

    public function geteventbar() {
        return $this->initdata['events']->eventbar();
    }

    

    public function test() {
        // echo $this->np_cal->np_get_month_name('01');
        // echo $this->calendar_mdl->get_days_in_year(2073, 'year');
        // echo $this->calendar_mdl->get_days_in_month(10);
        // echo $this->calendar_mdl->np_generate('2080',1);
        // echo $this->calendar_mdl->np_convert_from_greg(array(1995,2,5));
        // echo $this->calendar_mdl->np_convert_to_greg(array(2051,8,6));
        // echo $this->calendar_mdl->np_convert_to_greg('2051-10-22');
        // echo $this->calendar_mdl->np_convert_from_greg('1994-11-22');
        //echo "test called with data : {$data}";
    }

    public function getprefs() {
        $prefs['show_other_days'] = TRUE;
        $prefs['show_next_prev']  = TRUE;
        $prefs['next_prev_url']   = base_url('users/home');

        $prefs['template'] = array(
                'table_open' => '<table class="table-bordered caltable">',

                'heading_row_start' => '<tr class="text-primary bg-primary">',

                'heading_previous_cell' => '<th class="text-primary"><a href="{previous_url}" style="color: white;"><span class="glyphicon glyphicon-chevron-left pull-right"></span></a></th>',
                'heading_title_cell' => '<th colspan="{colspan}" class="text-center text-md-left">{heading}</th>',
                'heading_next_cell' => '<th class="text-primary"><a href="{next_url}" style="color: white;"><span class="glyphicon glyphicon-chevron-right pull-left"></span></a></th>',

                'heading_row_end' => '</tr>',

                'week_row_start' => '<tr class="text-info text-right">',
                'week_day_cell' => '<td class="info">{week_day}</td>',
                'week_row_end' => '</tr>',

                // <tr> start for cells
                'cal_row_start' => '<tr>',
                'cal_cell_start' => '<td class="col-xs-0 square text-right">',
                'cal_cell_start_today' => '<td class="col-xs-0 square text-right bg-success text-success" title="Today">',
                'cal_cell_start_other' => '<td class="col-xs-0 other-month square text-right text-muted">',

                // cell with contents
                'cal_cell_content' => '{day}<a href="{content}" title="Event here"><span alt="{content}" class="glyphicon glyphicon-tasks pull-right"></span></a>',
                'cal_cell_content_today' => '<a href="{content}" style="color:red;">{day}</a>',

                // cell with no contents
                'cal_cell_no_content' => '{day}',
                'cal_cell_no_content_today' => '<div>{day}</div>',

                // blank cells
                'cal_cell_blank' => '&nbsp;',

                // other cells
                'cal_cell_other' => '{day}',

                // closing tags
                'cal_cell_end' => '</td>',
                'cal_cell_end_today' => '</td>',
                'cal_cell_end_other' => '</td>',
                'cal_row_end' => '</tr>',
                'table_close' => '</table>'
        );

        return $prefs;
    }
}
