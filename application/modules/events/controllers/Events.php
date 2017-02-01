<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller

class Events extends Member_Controller
{
	protected $_userid;

    function __construct($userid)
    {
        parent::__construct();
        $this->_userid = $userid;
    }

    public function index()
    {
        echo "hello";
    }
}
