<?php
/**
 * This will extend the CI_date_helper
**/
defined('BASEPATH') or exit('No direct script access allowed');

$load = new CI_loader();
$load->model('cal_data');

// ------------------------------------------------------------------------

if (! function_exists('np_convert_to_greg')) {
	/**
	 * Converts nepali date B.S. to gregorian date A.D.
     *
     * @param
     *            string the nepali date format
     * @return string the english date format
     */
	function np_convert_to_greg($date) {
		
	}
}

if (! function_exists('np_convert_from_greg')) {
	/**
	 * Converts nepali date B.S. to gregorian date A.D.
     *
     * @param
     *            string the english date
     * @return string the nepali date
     */
	function np_convert_from_greg($date) {
		
	}
}

if (! function_exists('np_date')) {

    /**
     * Need to cite this --------------------
     *
     * @param
     *            string
     * @param
     *            int
     * @return int
     */
	 
    function np_date()
    {
        if ($datestr === '') {
            return '';
        } elseif (empty($time)) {
            $time = now();
        }
        
        $datestr = str_replace('%\\', '', preg_replace('/([a-z]+?){1}/i', '\\\\\\1', $datestr));
        
        return date($datestr, $time);
    }
}

// ------------------------------------------------------------------------

if (! function_exists('np_days_in_month')) {

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
    function np_days_in_month($month = 0, $year = '')
    {
        // @TODO write the whole function
        return $days_in_month;
    }
}

// ------------------------------------------------------------------------

if (! function_exists('np_nice_date')) {

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

// ------------------------------------------------------------------------
