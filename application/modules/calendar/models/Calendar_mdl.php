<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Cal_data_model contains model, library and helper for nepali date
*/
class Calendar_mdl extends Base_Model
{
	// the base model variables
	protected $_table_name = 'cal_data';
    protected $_primary_key = 'year';
    protected $_auto_increment = FALSE; // if auto_increment is TRUE, insert can't be done with given year.
    protected $_primary_filter = 'intval';
    protected $_order_by = 'year';
    protected $_rules = array();
    protected $_timestamps = FALSE;

    // the library variables
    public $template = '';
    public $language = 'english'; // default is english
    public $replacements = array();
    public $start_day = 'sunday';
    public $month_type = 'long';
    public $day_type = 'abr';
    public $show_next_prev = FALSE;
    public $next_prev_url = '';
    public $show_other_days = FALSE;
    protected $lang;

    // new variables
    protected $_cur_date;

    public function __construct()
    {
        parent::__construct();
        $this->_cur_date = '2073-10-10 12:12:12'; // only for testing
        $this->lang = new CI_Lang();
        $this->lang->load('cal', $this->language);
    }

//---------------model functions-----------------------------------------------------------------------------------

    /**
     * Get the days in a month. If only one parameter is supplied, it treats the year as current year
     * and the parameter as month. If both parameters are supplied, it treats the first parameter as 
     * year and the second parameter as month
     *
     * @param
     * 		int
     * @param
     * 		int
     *
     * @return int the days in the month
     *		
	*/
    public function get_days_in_month ($param1, $param2 = '')
    {
    	if ($param2 === '') {
    		// year not given. set month and get the current year.
    		$month = $param1;
    		$cur_year = $this->np_date('YYYY');
    		$days_in_year = $this->get_days_in_year($cur_year);
    		return $days_in_year[$param1];
    	}
    	else {
    		//year given.
    		$year = $param1;
    		$month = $param2;
    		$days_in_year = $this->get_days_in_year($year);
    		return $days_in_year[$month];
    	}
    }

    public function get_days_in_year ($year, $groupby = 'month') {
    	$result = $this->get($year);

    	if (!count($result)) return null;

    	switch ($groupby) {
    		case 'month':
    			echo 'month';
    			return array_values($result);
    		case 'year':
    			return array_sum($result) - $year;
    		default:
    			return null;
    		break;
    	}
    }

// ----------------------Helper functions--------------------------------------

	/**
	 * Converts nepali date B.S. to gregorian date A.D.
     *
     * @param
     *            string the nepali date format
     * @return string the english date format
     */
	function np_convert_to_greg($date) {
		
	}

	/**
	 * Converts nepali date B.S. to gregorian date A.D.
     *
     * @param
     *            string the english date
     * @return string the nepali date
     */
	function np_convert_from_greg($date) {
		
	}



    /**
     * returns nepali date
     *
     * @param
     *            string
     * @param
     *            int
     * @return int
     */
	 
    public function np_date($datestr = '')
    {
        if ($datestr === '') {
            return '';
        }
        
        $datestr = str_replace(array('YYYY', 'yyyy'), substr($this->_cur_date, 0, 4), $datestr);
        $datestr = str_replace(array('YY', 'yy'), substr($this->_cur_date, 0, 2), $datestr);
        $datestr = str_replace(array('Y', 'y'), substr($this->_cur_date, 0, 4), $datestr);
        
        $datestr = str_replace(array('MM', 'mm'), substr($this->_cur_date, 5, 2), $datestr);
        $datestr = str_replace(array('M', 'm'), substr($this->_cur_date, 5, 2), $datestr);

        return $datestr;
    }


// ------------------------------------------------------------------------



    /**
     * Number of days in a specified nepali month
     *
     * Takes a nepali month/year as input and returns the number of days
     * for the given month/year using the data in cal_data database table.
     *
     * @param
     *            int a numeric month
     * @param
     *            int a numeric year
     * @return int
     */
    public function np_days_in_month($month = 0, $year = '')
    {
        // @TODO write the whole function
        return $days_in_month;
    }

// ------------------------------------------------------------------------

    /**
	 * @TODO this looks good to have. SO, we'll modify this for nepali
     * Turns many "reasonably-date-like" strings into something
     * that is actually useful.
     * This only works for dates after unix epoch.
     *
     * @param
     *            string The terribly formatted date-like string
     * @param
     *            string Date format to return (same as php date function)
     * @return string
     */
    function np_nice_date($bad_date = '', $format = FALSE)
    {
	/*
        if (empty($bad_date)) {
            return 'Unknown';
        } elseif (empty($format)) {
            $format = 'U';
        }
        
        // Date like: YYYYMM
        if (preg_match('/^\d{6}$/i', $bad_date)) {
            if (in_array(substr($bad_date, 0, 2), array(
                '19',
                '20'
            ))) {
                $year = substr($bad_date, 0, 4);
                $month = substr($bad_date, 4, 2);
            } else {
                $month = substr($bad_date, 0, 2);
                $year = substr($bad_date, 2, 4);
            }
            
            return date($format, strtotime($year . '-' . $month . '-01'));
        }
        
        // Date Like: YYYYMMDD
        if (preg_match('/^(\d{2})\d{2}(\d{4})$/i', $bad_date, $matches)) {
            return date($format, strtotime($matches[1] . '/01/' . $matches[2]));
        }
        
        // Date Like: MM-DD-YYYY __or__ M-D-YYYY (or anything in between)
        if (preg_match('/^(\d{1,2})-(\d{1,2})-(\d{4})$/i', $bad_date, $matches)) {
            return date($format, strtotime($matches[3] . '-' . $matches[1] . '-' . $matches[2]));
        }
        
        // Any other kind of string, when converted into UNIX time,
        // produces "0 seconds after epoc..." is probably bad...
        // return "Invalid Date".
        if (date('U', strtotime($bad_date)) === '0') {
            return 'Invalid Date';
        }
        
        // It's probably a valid-ish date format already
        return date($format, strtotime($bad_date));
	*/
    }

//---------------------------------library functions--------------------------------------------------------------------
// --------------------------------------------------------------------
    
    
    // ------------Functions not needed to be overwritten------------------
    
    // public function initialize($config = array()){}
	
	// public function adjust_date($month, $year) {}
	
	// public function default_template() {}
    
    // --------------------------------------------------------------------
    
    /**
	 * @TODO change this for nepali
     * Generate the calendar
     *
     * @param
     *            int the year
     * @param
     *            int the month
     * @param
     *            array the data to be shown in the calendar cells
     * @return string
     */
    public function np_generate($year = '', $month = '', $data = array())
    {
        $local_time = time();
        
        // Set and validate the supplied month/year
        if (empty($year)) {
            $year = $this->np_date('Y');
        } elseif (strlen($year) === 1) {
            $year = '200' . $year;
        } elseif (strlen($year) === 2) {
            $year = '20' . $year;
        }
        
        if (empty($month)) {
            $month = $this->np_date('m');
        } elseif (strlen($month) === 1) {
            $month = '0' . $month;
        }

        // @TODO check if year and month are valid
        
        // Determine the total days in the month
        $total_days = $this->get_days_in_month($year, $month);
        
        // Set the starting day of the week

        $start_day = isset($start_days[$this->start_day]) ? $start_days[$this->start_day] : 0;

        // Set the starting day number
        // 1. Convert the nepali month day 1 to english date
        // 2. Get the day from english date
        $day = -5;
        //$day = $start_day + 1 - $date['wday'];
        
        // Set the current month/year/day
        // We use this to determine the "today" date
        $cur_year = $this->np_date('Y');
        $cur_month = $this->np_date('m');
        $cur_day = date('j', $local_time); // eng and nep both have same day
        
        $is_current_month = ($cur_year == $year && $cur_month == $month);
        
        // Generate the template data array
        $this->np_parse_template();
        
        // Begin building the calendar output
        $out = $this->replacements['table_open'] . "\n\n" . $this->replacements['heading_row_start'] . "\n";
        
        // "previous" month link
        if ($this->show_next_prev === TRUE) {
            // Add a trailing slash to the URL if needed
            $this->next_prev_url = preg_replace('/(.+?)\/*$/', '\\1/', $this->next_prev_url);
            
            $adjusted_date = $this->adjust_date($month - 1, $year);
            $out .= str_replace('{previous_url}', $this->next_prev_url . $adjusted_date['year'] . '/' . $adjusted_date['month'], $this->replacements['heading_previous_cell']) . "\n";
        }
        
        // Heading containing the month/year
        $colspan = ($this->show_next_prev === TRUE) ? 5 : 7;
        
        $this->replacements['heading_title_cell'] = str_replace('{colspan}', $colspan, str_replace('{heading}', $this->np_get_month_name($month) . '&nbsp;' . $year, $this->replacements['heading_title_cell']));
        
        $out .= $this->replacements['heading_title_cell'] . "\n";
        
        // "next" month link
        if ($this->show_next_prev === TRUE) {
            $adjusted_date = $this->adjust_date($month + 1, $year);
            $out .= str_replace('{next_url}', $this->next_prev_url . $adjusted_date['year'] . '/' . $adjusted_date['month'], $this->replacements['heading_next_cell']);
        }
        
        $out .= "\n" . $this->replacements['heading_row_end'] . "\n\n" . 
        // Write the cells containing the days of the week
        $this->replacements['week_row_start'] . "\n";
        
        $day_names = $this->np_get_day_names();
        
        for ($i = 0; $i < 7; $i ++) {
            $out .= str_replace('{week_day}', $day_names[($start_day + $i) % 7], $this->replacements['week_day_cell']);
        }
        
        $out .= "\n" . $this->replacements['week_row_end'] . "\n";
        
        // Build the main body of the calendar
        while ($day <= $total_days) {
            $out .= "\n" . $this->replacements['cal_row_start'] . "\n";
            
            for ($i = 0; $i < 7; $i ++) {
                if ($day > 0 && $day <= $total_days) {
                    $out .= ($is_current_month === TRUE && $day == $cur_day) ? $this->replacements['cal_cell_start_today'] : $this->replacements['cal_cell_start'];
                    
                    if (isset($data[$day])) {
                        // Cells with content
                        $temp = ($is_current_month === TRUE && $day == $cur_day) ? $this->replacements['cal_cell_content_today'] : $this->replacements['cal_cell_content'];
                        $out .= str_replace(array(
                            '{content}',
                            '{day}'
                        ), array(
                            $data[$day],
                            $day
                        ), $temp);
                    } else {
                        // Cells with no content
                        $temp = ($is_current_month === TRUE && $day == $cur_day) ? $this->replacements['cal_cell_no_content_today'] : $this->replacements['cal_cell_no_content'];
                        $out .= str_replace('{day}', $day, $temp);
                    }
                    
                    $out .= ($is_current_month === TRUE && $day == $cur_day) ? $this->replacements['cal_cell_end_today'] : $this->replacements['cal_cell_end'];
                } elseif ($this->show_other_days === TRUE) {
                    $out .= $this->replacements['cal_cell_start_other'];
                    
                    if ($day <= 0) {
                        // Day of previous month
                        $prev_month = $this->adjust_date($month - 1, $year);
                        $prev_month_days = $this->get_total_days($prev_month['month'], $prev_month['year']);
                        $out .= str_replace('{day}', $prev_month_days + $day, $this->replacements['cal_cell_other']);
                    } else {
                        // Day of next month
                        $out .= str_replace('{day}', $day - $total_days, $this->replacements['cal_cell_other']);
                    }
                    
                    $out .= $this->replacements['cal_cell_end_other'];
                } else {
                    // Blank cells
                    $out .= $this->replacements['cal_cell_start'] . $this->replacements['cal_cell_blank'] . $this->replacements['cal_cell_end'];
                }
                
                $day ++;
            }
            
            $out .= "\n" . $this->replacements['cal_row_end'] . "\n";
        }
        
        return $out .= "\n" . $this->replacements['table_close'];
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Get Month Name
     *
     * Generates a textual month name based on the numeric
     * month provided.
     *
     * @param
     *            int the month
     * @return string
     */
    public function np_get_month_name($month)
    {
        if ($this->month_type === 'short') {
            $month_names = array(
                '01' => 'cal_bai',
                '02' => 'cal_jes',
                '03' => 'cal_asa',
                '04' => 'cal_shr',
                '05' => 'cal_bha',
                '06' => 'cal_aso',
                '07' => 'cal_kar',
                '08' => 'cal_man',
                '09' => 'cal_pou',
                '10' => 'cal_mag',
                '11' => 'cal_fal',
                '12' => 'cal_cha'
            );
        } else {
            $month_names = array(
                '01' => 'cal_baisakh',
                '02' => 'cal_jestha',
                '03' => 'cal_asar',
                '04' => 'cal_shrawan',
                '05' => 'cal_bhadra',
                '06' => 'cal_asoj',
                '07' => 'cal_kartik',
                '08' => 'cal_mangshir',
                '09' => 'cal_poush',
                '10' => 'cal_magh',
                '11' => 'cal_falgun',
                '12' => 'cal_chaitra'
            );
        }
        
        return ($this->lang->line($month_names[$month]) === FALSE) ? ucfirst(substr($month_names[$month], 4)) : $this->lang->line($month_names[$month]);
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Get Day Names
     *
     * Returns an array of day names (Sunday, Monday, etc.) based
     * on the type. Options: long, short, abr
     *
     * @param
     *            string
     * @return array
     */
    public function np_get_day_names($day_type = '')
    {
        if ($day_type !== '') {
            $this->day_type = $day_type;
        }
        
        if ($this->day_type === 'long') {
            $day_names = array(
                'sunday',
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday'
            );
        } elseif ($this->day_type === 'short') {
            $day_names = array(
                'sun',
                'mon',
                'tue',
                'wed',
                'thu',
                'fri',
                'sat'
            );
        } else {
            $day_names = array(
                'su',
                'mo',
                'tu',
                'we',
                'th',
                'fr',
                'sa'
            );
        }
        
        $days = array();
        for ($i = 0, $c = count($day_names); $i < $c; $i ++) {
            $days[] = ($this->lang->line('cal_' . $day_names[$i]) === FALSE) ? ucfirst($day_names[$i]) : $this->lang->line('cal_' . $day_names[$i]);
        }
        
        return $days;
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Total days in a given month
     *
     * @param
     *            int the month
     * @param
     *            int the year
     * @return int
     */
    public function np_get_total_days($month, $year)
    {
        $this->load->helper('date'); // this helper is left to extend
        // return np_days_in_month($month, $year); // this function is left to write
    }

    // --------------------------------------------------------------------
    
    /**
     * Set Default Template Data
     *
     * This is used in the event that the user has not created their own template
     *
     * @return array
     */
    public function default_template()
    {
        return array(
            'table_open' => '<table border="0" cellpadding="4" cellspacing="0">',
            'heading_row_start' => '<tr>',
            'heading_previous_cell' => '<th><a href="{previous_url}">&lt;&lt;</a></th>',
            'heading_title_cell' => '<th colspan="{colspan}">{heading}</th>',
            'heading_next_cell' => '<th><a href="{next_url}">&gt;&gt;</a></th>',
            'heading_row_end' => '</tr>',
            'week_row_start' => '<tr>',
            'week_day_cell' => '<td>{week_day}</td>',
            'week_row_end' => '</tr>',
            'cal_row_start' => '<tr>',
            'cal_cell_start' => '<td>',
            'cal_cell_start_today' => '<td>',
            'cal_cell_start_other' => '<td style="color: #666;">',
            'cal_cell_content' => '<a href="{content}">{day}</a>',
            'cal_cell_content_today' => '<a href="{content}"><strong>{day}</strong></a>',
            'cal_cell_no_content' => '{day}',
            'cal_cell_no_content_today' => '<strong>{day}</strong>',
            'cal_cell_blank' => '&nbsp;',
            'cal_cell_other' => '{day}',
            'cal_cell_end' => '</td>',
            'cal_cell_end_today' => '</td>',
            'cal_cell_end_other' => '</td>',
            'cal_row_end' => '</tr>',
            'table_close' => '</table>'
        );
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Parse Template
     *
     * Harvests the data within the template {pseudo-variables}
     * used to display the calendar
     *
     * @return CI_Calendar
     */
    public function np_parse_template()
	{
        $this->replacements = $this->default_template();
        
        if (empty($this->template)) {
            return $this;
        }
        
        if (is_string($this->template)) {
            $today = array(
                'cal_cell_start_today',
                'cal_cell_content_today',
                'cal_cell_no_content_today',
                'cal_cell_end_today'
            );
            
            foreach (array(
                'table_open',
                'table_close',
                'heading_row_start',
                'heading_previous_cell',
                'heading_title_cell',
                'heading_next_cell',
                'heading_row_end',
                'week_row_start',
                'week_day_cell',
                'week_row_end',
                'cal_row_start',
                'cal_cell_start',
                'cal_cell_content',
                'cal_cell_no_content',
                'cal_cell_blank',
                'cal_cell_end',
                'cal_row_end',
                'cal_cell_start_today',
                'cal_cell_content_today',
                'cal_cell_no_content_today',
                'cal_cell_end_today',
                'cal_cell_start_other',
                'cal_cell_other',
                'cal_cell_end_other'
            ) as $val) {
                if (preg_match('/\{' . $val . '\}(.*?)\{\/' . $val . '\}/si', $this->template, $match)) {
                    $this->replacements[$val] = $match[1];
                } elseif (in_array($val, $today, TRUE)) {
                    $this->replacements[$val] = $this->replacements[substr($val, 0, - 6)];
                }
            }
        } elseif (is_array($this->template)) {
            $this->replacements = array_merge($this->replacements, $this->template);
        }
        
        return $this;
    }
}
