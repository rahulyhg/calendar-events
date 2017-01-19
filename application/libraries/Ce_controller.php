<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ce_Controller extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        // load required helper and library for the site
        $this->load->helper(array(
            'html'
        ));
        //echo 'CE_controller___construct';
    }
}



