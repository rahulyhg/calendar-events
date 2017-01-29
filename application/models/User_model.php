<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends Base_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    
    public function loggedin()
    {
        return (bool) $this->session->userdata('loggedin');
    }
}
