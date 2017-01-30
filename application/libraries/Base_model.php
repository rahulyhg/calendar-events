<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base_model extends CI_Model {
    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_auto_increment = FALSE; // auto_increment type of pk
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    protected $_rules = array();
    protected $_timestamps = FALSE;
    
    function __construct() {
        parent::__construct();
    }
    
    public function get($id = NULL, $method = 'result'){
        if ($id != NULL) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row_array';
        }
    
        if (!count($this->db->order_by($this->_order_by))) {
            $this->db->order_by($this->_order_by);
        }
        return $this->db->get($this->_table_name)->$method();
    }
    
    public function get_by($where, $single = FALSE){
        $this->db->where($where);
        return $this->get(NULL, $single);
    }
    
    public function save($data, $id = NULL){
    
        // Set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }
    
        // Insert
        if ($id === NULL) {
            // insert with pk = null
            if ($this->_auto_increment == TRUE) {
                !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
                $this->db->set($data);
                $this->db->insert($this->_table_name);
                $id = $this->db->insert_id();
            }
            // insert with pk from $data
            else {
                if (isset($data[$this->_primary_key])) {
                    $this->db->set($data);
                    $this->db->insert($this->_table_name);
                    $id = $data[$this->_primary_key];
                }
                else {
                    echo 'field required: ' . $this->_primary_key;
                }
            }
        }
        // Update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }
    
        return $id;
    }
    
    public function delete($id){
        $filter = $this->_primary_filter;
        $id = $filter($id);
    
        if (!$id) {
            return FALSE;
        }
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }
    
}