<?php
defined('BASEPATH') or exit('No direct script access allowed');

// the signup model
class Signup_mdl extends Base_Model
{
    // override Base_Model variables
    protected $_table_name = 'verifypending';

    protected $_primary_key = 'id';

    protected $_primary_filter = 'intval';

    protected $_order_by = 'id';

    protected $_rules = array();

    protected $_auto_increment = TRUE;

    // data for rows
    private $_username;

    private $_email;

    private $_hashpass;

    private $_name;

    public function __construct()
    {
        parent::__construct();

        // set the values of member variables.
        $this->_username = $this->input->post('username');
        $this->_hashpass = hashit($this->input->post('password'));
        $this->_email = $this->input->post('email');
        $this->_name = $this->input->post('fullname');
    }

    // insert the registration data into verifypending table
    public function insert_to_verifypending()
    {
        $taken = $this->istaken();
        if ($taken) {
            return $taken;
        }

        // config the required params.
        $this->_table_name = 'verifypending';
        $cur_datetime = date('Y-m-d H:i:s');
        $ver_key = hashit($this->input->post('username') . $this->input->post('password') . $cur_datetime);
        $id = $this->save(array(
            'username' => $this->_username,
            'name' => $this->_name,
            'hashpass' => $this->_hashpass,
            'email' => $this->_email,
            'register_date' => $cur_datetime,
            'verifying_key' => $ver_key
        ));

        return array(
            'id' => $id,
            'ver_key' => $ver_key,
            'email' => $this->_email
        );
    }

    // checks if username/email is already registered.
    // @return array['answer', arrayOfTakenVals]
    public function istaken()
    {
        // @todo code to check if the username and email is available
        /*
         * //output will be used as "@return already taken" if not null
         * Used as follows:
         * return 'Username and email';
         * return 'Username';
         * return 'Email';
         * return '';
         */

        // for test only.. more code required
        $this->_table_name = 'members';
        $signup_data = array(
            'username' => $this->_username
        );
        $usercheck = $this->get_by($signup_data, 'row_array');
        $signup_data = array(
            'email' => $this->_email
        );
        $emailcheck = $this->get_by($signup_data, 'row_array');


        $taken = '';
        if (count($usercheck)) {
            if (count($emailcheck)) {
                $this->_table_name = 'verifypending';
                $taken = 'Username and Email';
            }
            else {
                $taken = 'Username';
            }
        }
        else {
            if (count($emailcheck)) {
                $this->_table_name = 'verifypending';
                $taken = 'Email';
            }
            else {
                $taken = '';
            }
        }

        return $taken;
    }
}
