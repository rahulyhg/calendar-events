<?php
class User_model extends CI_Model {
	public function __construct () {
		parent::__construct ();
	}
	public function user_create ($data = array()) {
		echo "add user code";
	}
	public function view_user () {
		echo "view users code";
		$query = $this->db->get ('cal_data', 10);
		return $query->result_array();
	}
	public function check_credentials () {
		
	}
}
