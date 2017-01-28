<?php
/**
 * This will extend the CI_date_helper
**/
defined('BASEPATH') or exit('No direct script access allowed');

// ------------------------------------------------------------------------

if (! function_exists('mdate')) {

    /**
     * Need to cite this --------------------
     *
     * @param
     *            string
     * @param
     *            int
     * @return int
     */
    function mdate($datestr = '', $time = '')
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

if (! function_exists('np_date_range')) {

    /**
     * Date range
     *
     * Returns a list of dates within a specified period.
     *
	 * @TODO customize this thing or else convert to gregorian and then run date_range
	 *
     * @param
     *            int unix_start UNIX timestamp of period start date
     * @param
     *            int unix_end|days UNIX timestamp of period end date
     *            or interval in days.
     * @param
     *            mixed is_unix Specifies whether the second parameter
     *            is a UNIX timestamp or a day interval
     *            - TRUE or 'unix' for a timestamp
     *            - FALSE or 'days' for an interval
     * @param
     *            string date_format Output date format, same as in date()
     * @return array
     */
    function np_date_range($unix_start = '', $mixed = '', $is_unix = TRUE, $format = 'Y-m-d')
	{}
    // {
	
        // if ($unix_start == '' or $mixed == '' or $format == '') {
            // return FALSE;
        // }
        
        // $is_unix = ! (! $is_unix or $is_unix === 'days');
        
        Validate input and try strtotime() on invalid timestamps/intervals, just in case
        // if ((! ctype_digit((string) $unix_start) && ($unix_start = @strtotime($unix_start)) === FALSE) or (! ctype_digit((string) $mixed) && ($is_unix === FALSE or ($mixed = @strtotime($mixed)) === FALSE)) or ($is_unix === TRUE && $mixed < $unix_start)) {
            // return FALSE;
        // }
        
        // if ($is_unix && ($unix_start == $mixed or date($format, $unix_start) === date($format, $mixed))) {
            // return array(
                // date($format, $unix_start)
            // );
        // }
        
        // $range = array();
        
        // /*
         // * NOTE: Even though the DateTime object has many useful features, it appears that
         // * it doesn't always handle properly timezones, when timestamps are passed
         // * directly to its constructor. Neither of the following gave proper results:
         // *
         // * new DateTime('<timestamp>')
         // * new DateTime('<timestamp>', '<timezone>')
         // *
         // * --- available in PHP 5.3:
         // *
         // * DateTime::createFromFormat('<format>', '<timestamp>')
         // * DateTime::createFromFormat('<format>', '<timestamp>', '<timezone')
         // *
         // * ... so we'll have to set the timestamp after the object is instantiated.
         // * Furthermore, in PHP 5.3 we can use DateTime::setTimestamp() to do that and
         // * given that we have UNIX timestamps - we should use it.
         // */
        // $from = new DateTime();
        
        // if (is_php('5.3')) {
            // $from->setTimestamp($unix_start);
            // if ($is_unix) {
                // $arg = new DateTime();
                // $arg->setTimestamp($mixed);
            // } else {
                // $arg = (int) $mixed;
            // }
            
            // $period = new DatePeriod($from, new DateInterval('P1D'), $arg);
            // foreach ($period as $date) {
                // $range[] = $date->format($format);
            // }
            
            // /*
             // * If a period end date was passed to the DatePeriod constructor, it might not
             // * be in our results. Not sure if this is a bug or it's just possible because
             // * the end date might actually be less than 24 hours away from the previously
             // * generated DateTime object, but either way - we have to append it manually.
             // */
            // if (! is_int($arg) && $range[count($range) - 1] !== $arg->format($format)) {
                // $range[] = $arg->format($format);
            // }
            
            // return $range;
        // }
        
        // $from->setDate(date('Y', $unix_start), date('n', $unix_start), date('j', $unix_start));
        // $from->setTime(date('G', $unix_start), date('i', $unix_start), date('s', $unix_start));
        // if ($is_unix) {
            // $arg = new DateTime();
            // $arg->setDate(date('Y', $mixed), date('n', $mixed), date('j', $mixed));
            // $arg->setTime(date('G', $mixed), date('i', $mixed), date('s', $mixed));
        // } else {
            // $arg = (int) $mixed;
        // }
        // $range[] = $from->format($format);
        
        // if (is_int($arg)) // Day intervals
// {
            // do {
                // $from->modify('+1 day');
                // $range[] = $from->format($format);
            // } while (-- $arg > 0);
        // } else // end date UNIX timestamp
// {
            // for ($from->modify('+1 day'), $end_check = $arg->format('Ymd'); $from->format('Ymd') < $end_check; $from->modify('+1 day')) {
                // $range[] = $from->format($format);
            // }
            
            Our loop only appended dates prior to our end date
            // $range[] = $arg->format($format);
        // }
        
        // return $range;
    // }
// }
