<?php
/**
 * This will extend the CI_Calendar library
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter Calendar Class
 */
class Np_Cal
{

    /**
     * as it is variables
     */
    public $template = '';
	
	public $language = 'english'; // default is english

    public $replacements = array();

    public $start_day = 'sunday';

    public $month_type = 'long';

    public $day_type = 'abr';

    public $show_next_prev = FALSE;

    public $next_prev_url = '';

    public $show_other_days = FALSE;
	
	public $CI= '';
	
	public $lang = '';
    
    // --------------------------------------------------------------------
    
    /**
     * Class constructor
     *
     * Loads the calendar language file and sets the default time reference.
     *
     * @uses cal_lang::$is_loaded
     *      
     * @param array $config
     *            Calendar options
     * @return void
     */
    public function __construct($config = array()) // overrides the CI_Calendar class
    {
		// set the instances to load CI classes 
		$this->CI =& get_instance();
		$this->lang = new CI_Lang();
		
		// @TODO add support for other lang (nep) later..
        $this->lang->load('cal', $this->language);

    }
    
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
            $year = date('Y', $local_time);
        } elseif (strlen($year) === 1) {
            $year = '200' . $year;
        } elseif (strlen($year) === 2) {
            $year = '20' . $year;
        }
        
        if (empty($month)) {
            $month = date('m', $local_time);
        } elseif (strlen($month) === 1) {
            $month = '0' . $month;
        }
        
        $adjusted_date = $this->adjust_date($month, $year);
        
        $month = $adjusted_date['month'];
        $year = $adjusted_date['year'];
        
        // Determine the total days in the month
        $total_days = $this->get_total_days($month, $year);
        
        // Set the starting day of the week
        $start_days = array(
            'sunday' => 0,
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6
        );
        $start_day = isset($start_days[$this->start_day]) ? $start_days[$this->start_day] : 0;
        
        // Set the starting day number
        $local_date = mktime(12, 0, 0, $month, 1, $year);
        $date = getdate($local_date);
        $day = $start_day + 1 - $date['wday'];
        
        while ($day > 1) {
            $day -= 7;
        }
        
        // Set the current month/year/day
        // We use this to determine the "today" date
        $cur_year = date('Y', $local_time);
        $cur_month = date('m', $local_time);
        $cur_day = date('j', $local_time);
        
        $is_current_month = ($cur_year == $year && $cur_month == $month);
        
        // Generate the template data array
        $this->parse_template();
        
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
        
        $this->replacements['heading_title_cell'] = str_replace('{colspan}', $colspan, str_replace('{heading}', $this->get_month_name($month) . '&nbsp;' . $year, $this->replacements['heading_title_cell']));
        
        $out .= $this->replacements['heading_title_cell'] . "\n";
        
        // "next" month link
        if ($this->show_next_prev === TRUE) {
            $adjusted_date = $this->adjust_date($month + 1, $year);
            $out .= str_replace('{next_url}', $this->next_prev_url . $adjusted_date['year'] . '/' . $adjusted_date['month'], $this->replacements['heading_next_cell']);
        }
        
        $out .= "\n" . $this->replacements['heading_row_end'] . "\n\n" . 
        // Write the cells containing the days of the week
        $this->replacements['week_row_start'] . "\n";
        
        $day_names = $this->get_day_names();
        
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
     * Parse Template
     *
     * Harvests the data within the template {pseudo-variables}
     * used to display the calendar
     *
     * @return CI_Calendar
     */
    public function np_parse_template() {}
    /* need a closer look
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
	*/
}
