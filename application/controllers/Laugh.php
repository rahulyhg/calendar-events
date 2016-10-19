<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laugh extends CI_Controller {
	public function index()
	{
		echo "hehe";
	}
    public function hello ($params = array ()) {
        print_r ($params);
    }
}
