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

    public function __construct()
    {
        parent::__construct();

        // set the values of member variables.
        $this->_username = $this->input->post('username');
        $this->_hashpass = hashit($this->input->post('password'));
        $this->_email = $this->input->post('email');
    }

    // insert the registration data into verifypending table
    public function insert_to_verifypending()
    {
        // config the required params.
        $cur_datetime = date('Y-m-d H:i:s');
        $ver_key = hashit($this->input->post('username') . $this->input->post('password') . $cur_datetime);
        $id = $this->save(array(
            'username' => $this->_username,
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
        return '';
    }
}
