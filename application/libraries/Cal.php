<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Calendar class
 */
class Cal

{
	/*
	Date and time will be extracted in constructor.
	Two Date arrays. One for English Date and one for Nepali Date.
	Both will be calculated with own algorithm.
	Time will be the same for both, hence a separate common array is taken.
	*
	Index of Date arrays
	[0] -> year
	[1] -> month
	[2] -> day
	*
	Index of time array
	[0] -> hour
	[1] -> min
	[2] -> sec
	[3] -> am/pm
	*/
	private $gregDate = array();
	private $nepDate = array();
	private $time = array();
	/*
	This is the constructor for the calendar class.
	It saves date and time to the member variable.
	@param array()
	@return none
	*/
	public function __construct($param)
	{
		$this->gregDate = explode('/', date('Y/n/j', $param[0]));
		// $this->nepDate = convertToNep($this->gregDate);   //call to outside function with param
		$this->time = explode(':', date('h:i:s:A', $param[0]));
	}

	public function getStartDay()
	{
		return 1;
	}

	/*
	Calculates whether english year is leap year or not
	Will be made Outside function
	@param integer $year
	@return boolean
	*/
	private function isLeapYear()
	{
		$a = $this->gregDate[0];
		if ($a % 100 == 0) {
			return ($a % 400 == 0) ? TRUE : FALSE;
		}
		else {
			return ($a % 4 == 0) ? TRUE : FALSE;
		}
	}
	/**
	 * returns the number of days in a month of a year
	 *
	 * @param integer $year
	 * @return integer
	 */
	public function getDaysMonth()
	{
		$DaysWholeYear = $this->getDaysWholeYear();
		return $DaysWholeYear[$this->gregDate[1]];
	}
	/**
	 * returns the number of days in all month of a year
	 *
	 * @return array
	 */
	private function getDaysWholeYear()
	{
		/*
		* return arrays containing data for either greg or nep
		* array will be replaced later by connecting to database
		*/
		$leapYear = $this->isLeapYear($this->gregDate[0]) ? 1 : 0;
		// Year number at index 0
		// Number of years from index 1 Baisakh throught index 12 Chait
		$DaysWholeYear = $this->getDaysFromData();
		return $DaysWholeYear[$this->gregDate[0] - 2000]; //year 2000 is indexed zero
	}

	/**
	 * returns the number of days in a month of a year.
	 * Will be modified to return starting day of month and weeks
	 *
	 * @return integer
	 */
	private function getDaysFromData()
	{
		return array(
			/*Gregorian Year
			*At index 0, 1 if leapyear and 0 otherwise
			*Number of years from index 1 Baisakh throught index 12 Chait
			*/
			// 'greg' => array($leapYear ,31, 28 + $leapYear,31,30,31,30,31,31,30,31,30,31),
			/*Nepali year
			*Year number at index 0
			*Number of years from index 1 Baisakh throught index 12 Chait
			*/
			//'eng' => array(
						array(2000,30,32,31,32,31,30,30,30,29,30,29,31),
						array(2001,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2002,31,31,32,32,31,30,30,29,30,29,30,30),
						array(2003,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2004,30,32,31,32,31,30,30,30,29,30,29,31),
						array(2005,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2006,31,31,32,32,31,30,30,29,30,29,30,30),
						array(2007,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2008,31,31,31,32,31,31,29,30,30,29,29,31),
						array(2009,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2010,31,31,32,32,31,30,30,29,30,29,30,30),
						array(2011,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2012,31,31,31,32,31,31,29,30,30,29,30,30),
						array(2013,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2014,31,31,32,32,31,30,30,29,30,29,30,30),
						array(2015,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2016,31,31,31,32,31,31,29,30,30,29,30,30),
						array(2017,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2018,31,32,31,32,31,30,30,29,30,29,30,30),
						array(2019,31,32,31,32,31,30,30,30,29,30,29,31),
						array(2020,31,31,31,32,31,31,30,29,30,29,30,30),
						array(2021,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2022,31,32,31,32,31,30,30,30,29,29,30,30),
						array(2023,31,32,31,32,31,30,30,30,29,30,29,31),
						array(2024,31,31,31,32,31,31,30,29,30,29,30,30),
						array(2025,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2026,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2027,30,32,31,32,31,30,30,30,29,30,29,31),
						array(2028,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2029,31,31,32,31,32,30,30,29,30,29,30,30),
						array(2030,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2031,30,32,31,32,31,30,30,30,29,30,29,31),
						array(2032,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2033,31,31,32,32,31,30,30,29,30,29,30,30),
						array(2034,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2035,30,32,31,32,31,31,29,30,30,29,29,31),
						array(2036,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2037,31,31,32,32,31,30,30,29,30,29,30,30),
						array(2038,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2039,31,31,31,32,31,31,29,30,30,29,30,30),
						array(2040,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2041,31,31,32,32,31,30,30,29,30,29,30,30),
						array(2042,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2043,31,31,31,32,31,31,29,30,30,29,30,30),
						array(2044,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2045,31,32,31,32,31,30,30,29,30,29,30,30),
						array(2046,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2047,31,31,31,32,31,31,30,29,30,29,30,30),
						array(2048,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2049,31,32,31,32,31,30,30,30,29,29,30,30),
						array(2050,31,32,31,32,31,30,30,30,29,30,29,31),
						array(2051,31,31,31,32,31,31,30,29,30,29,30,30),
						array(2052,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2053,31,32,31,32,31,30,30,30,29,29,30,30),
						array(2054,31,32,31,32,31,30,30,30,29,30,29,31),
						array(2055,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2056,31,31,32,31,32,30,30,29,30,29,30,30),
						array(2057,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2058,30,32,31,32,31,30,30,30,29,30,29,31),
						array(2059,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2060,31,31,32,32,31,30,30,29,30,29,30,30),
						array(2061,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2062,30,32,31,32,31,31,29,30,29,30,29,31),
						array(2063,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2064,31,31,32,32,31,30,30,29,30,29,30,30),
						array(2065,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2066,31,31,31,32,31,31,29,30,30,29,29,31),
						array(2067,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2068,31,31,32,32,31,30,30,29,30,29,30,30),
						array(2069,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2070,31,31,31,32,31,31,29,30,30,29,30,30),
						array(2071,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2072,31,32,31,32,31,30,30,29,30,29,30,30),
						array(2073,31,32,31,32,31,30,30,30,29,29,30,31),
						array(2074,31,31,31,32,31,31,30,29,30,29,30,30),
						array(2075,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2076,31,32,31,32,31,30,30,30,29,29,30,30),
						array(2077,31,32,31,32,31,30,30,30,29,30,29,31),
						array(2078,31,31,31,32,31,31,30,29,30,29,30,30),
						array(2079,31,31,32,31,31,31,30,29,30,29,30,30),
						array(2080,31,32,31,32,31,30,30,30,29,29,30,30),
						array(2081,31,31,32,32,31,30,30,30,29,30,30,30),
						array(2082,30,32,31,32,31,30,30,30,29,30,30,30),
						array(2083,31,31,32,31,31,30,30,30,29,30,30,30),
						array(2084,31,31,32,31,31,30,30,30,29,30,30,30),
						array(2085,31,32,31,32,30,31,30,30,29,30,30,30),
						array(2086,30,32,31,32,31,30,30,30,29,30,30,30),
						array(2087,31,31,32,31,31,31,30,30,29,30,30,30),
						array(2088,30,31,32,32,30,31,30,30,29,30,30,30),
						array(2089,30,32,31,32,31,30,30,30,29,30,30,30),
						array(2090,30,32,31,32,31,30,30,30,29,30,30,30)
			//)
		);
	}
}
?>