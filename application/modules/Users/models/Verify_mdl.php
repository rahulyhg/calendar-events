<?php
defined('BASEPATH') or exit('No direct script access allowed');

//the verify model
class Verify_mdl extends Base_Model
{
    // override Base_Model variables
    protected $_table_name;

    protected $_primary_key = 'id';

    protected $_primary_filter = 'intval';

    protected $_order_by = 'id';

    protected $_rules = array();

    private $_verifying_row;

    public function __construct($id = null)
    {
        parent::__construct();
        $this->_table_name = 'verifypending';
        // set the values of member variables.
        $this->_verifying_row = $this->get($id, TRUE);
    }

    public function verify_with($verifying_key)
    {
        if ($this->_verifying_row->verifying_key == $verifying_key) {
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
        } else {
            // key not matched
            echo 'key not matched';
        }
    }
}
