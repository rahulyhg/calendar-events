<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_mdl extends MX_Model
{

    private $_action;

    public function __construct()
    {
        parent::__construct();
    }
    
    // check username/email and password is good for logging
    // @return bool
    public function login()
    {
        $this->_action = new Login_mdl(); // set values
        
        return $this->_action->isgood();
    }

    public function signup()
    {
        $this->_action = new signup_mdl();
        $check = $this->_action->is_taken();
        if ($check === '') {
            $this->_action->insert_to_verify(); // set values
        }
        return $check;
    }
}

// the login model
class Login_mdl extends Base_Model
{
    // override Base_Model variables
    protected $_table_name = 'members';

    protected $_primary_key = 'id';

    protected $_primary_filter = 'intval';

    protected $_order_by = 'id';

    protected $_rules = array();

    protected $_timestamps = TRUE;

    private $_loginby;

    private $_hash_pass;

    private $_errors;

    public function __construct()
    {
        parent::__construct();
        
        // set the values of member variables.
        $this->_loginby = $this->input->post('loginby');
        $this->_hash_pass = hash('sha512', config_item('encrypt_key8') . $this->input->post('password') . config_item('encrypt_key16') . 'ce-ncit' . config_item('encrypt_key32'));
    }

    public function isgood()
    {
        // check if email or username is entered.
        // assuming '@' is only possible in email and not username
        if (strpos($this->_loginby, '@') === TRUE) {
            return $this->_action->_login_by_email();
        } else {
            return $this->action->_login_by_username();
        }
    }
    
    // login by email if email was provided.
    // @return bool
    private function _login_by_email()
    {
        // if email was entered
        $userdata = $this->get_by(array(
            'email' => $this->_loginby,
            'hashpass' => $this->_hash_pass
        ));
    }
    
    // login by username if it was provided.
    // @return bool
    private function _login_by_username()
    {
        // if username was entered
        $userdata = $this->get_by(array(
            'username' => $this->_loginby,
            'hashpass' => $this->_hash_pass
        ));
    }
}

// the signup model
class Signup_mdl extends Base_Model
{
    // override Base_Model variables
    protected $_table_name = 'verifypending';

    protected $_primary_key = 'id';

    protected $_primary_filter = 'intval';

    protected $_order_by = 'id';

    protected $_rules = array();

    protected $_timestamps = TRUE;
    
    // data for rows
    private $_username;

    private $_email;

    private $_hashpass;

    private $_errors;
    
    // insert the registration data into verifypending table
    public function insert_to_verify()
    {
        // if username was entered
        $userdata = $this->get_by(array(
            'username' => $this->_loginby,
            'hashpass' => $this->_hash_pass
        ));
    }

    public function _setup_login()
    {
        $this->_loginby = array();
        $this->_hash_pass = hash('sha512', config_item('encrypt_key8') . $this->input->post('password') . config_item('encrypt_key16') . 'ce-ncit' . config_item('encrypt_key32'));
    }
    
    // checks if username/email is already registered.
    // @return array['answer', arrayOfTakenVals]
    public function istaken()
    {
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
