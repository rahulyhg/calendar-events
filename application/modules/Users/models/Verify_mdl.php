<?php
defined('BASEPATH') or exit('No direct script access allowed');

// the verify model
class Verify_mdl extends Base_Model
{
    // override Base_Model variables
    protected $_table_name;

    protected $_primary_key = 'id';

    protected $_primary_filter = 'intval';

    protected $_order_by = 'id';

    protected $_rules = array();

    private $_verifying_row = '';

    protected $_auto_increment = TRUE;

    public function __construct()
    {
        parent::__construct();
        $this->_table_name = 'verifypending';
    }

    public function verify_this($id)
    {
        // set the values of member variables.
        $this->_verifying_row = $this->get($id, TRUE);
    }

    public function verify_with($verifying_key)
    {
        $afterverify = base_url('users/home'); // @TODO create a step 2 for additional profile and change this to it
        if ($this->_verifying_row && $this->_verifying_row->verifying_key == $verifying_key) {
            // ready to verify
            
            // first add to members
            $this->_table_name = 'members'; // setup tablename
            
            $id = $this->save(array(
                'username' => $this->_verifying_row->username,
                'hashpass' => $this->_verifying_row->hashpass,
                'email' => $this->_verifying_row->email,
                'register_date' => $this->_verifying_row->register_date,
                'is_active' => TRUE
            ));
            
            // then delete from verifypending
            $this->_table_name = 'verifypending'; // setup tablename
            echo $this->_verifying_row->id;
            $this->delete($this->_verifying_row->id);
            
            echo 'successfully added with id = ' . $id;

            redirect($afterverify, 'refresh');
        } else {
            // key not matched
            echo 'key not matched';
        }
    }
}
