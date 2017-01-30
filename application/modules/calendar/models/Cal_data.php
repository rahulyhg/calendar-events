<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Cal_data_model contains model and helper for nepali date
*/
class Cal_data extends Base_Model
{
	protected $_table_name = 'cal_data';
    protected $_primary_key = 'year';
    protected $_auto_increment = FALSE; // if auto_increment is TRUE, insert can't be done with given year.
    protected $_primary_filter = 'intval';
    protected $_order_by = 'year';
    protected $_rules = array();
    protected $_timestamps = FALSE;

    protected $_cur_date();

    public function __construct()
    {
        parent::__construct();
        $this->_cur_date() = '2073-10-10 12:12:12'; // only for testing
    }

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
    public function get_days_in_month ($param1, $param2 = 0)
    {
    	if ($param2 == 0) {
    		// year not given. get the current year.
    		$cur_year = $this->np_date('YYYY');
    		$year $this->get_days_in_year($cur_year, 'month');
    	}
    	else {
    		//year given.
    		$year = $param1;

    		$this->get($year, TRUE);
    	}
    }

    public function get_days_in_year ($year, $groupby = 'month') {
    	$result = $this->get($year, TRUE);

    	if (!count($result)) return null;

    	switch ($groupby) {
    		case 'month':
    			return $result;
    		case 'year':
    			return array_sum($result) - $year;
    		default:
    			return null;
    		break;
    	}
    }

// ------------------------------------------------------------------------

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
        
        $datestr = str_replace(array('YY', 'yy'), substr($this->_cur_date, 0, 2), $datestr);
        $datestr = str_replace(array('YYYY', 'yyyy'), substr($this->_cur_date, 0, 4), $datestr);
        
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
	}
}
