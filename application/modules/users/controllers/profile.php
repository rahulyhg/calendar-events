<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends Member_controller {
    protected $_page_uri = 'users/home';
    protected $data = array();
    
    public function __construct() {
        parent::__construct($this->_page_uri);
    }

    public function index() {
        $query = $this->db->where('id', $this->session->userdata('id'))-> get('members')->row_array();
        $data = array(
            'id' => $this->session->userdata('id'),
            'page' => 'users/profile',
            'user' => $query,
        );

        $data['uri'] = 'users/profile';
        $data['pagedata'] = $data;
        echo modules::run('layout/alone', $data);
    }
}
