<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends Member_controller {
    public function __construct() {
        parent::__construct();
    }
    public function view($id = null) {
        echo $id;
    }
    public function add() {}
}
