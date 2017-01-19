<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_mdl
{

    private $_action;
    
    // check username/email and password is good for logging
    // @return bool
    public function login()
    {
        $this->_action = new Login_mdl(); // set values
                               
        // check if email or username is entered.
        // assuming '@' is only possible in email and not username
        if (strpos($this->_loginby, '@') === TRUE) {
            return $this->_action->_login_by_email();
        } else {
            return $this->action->_login_by_username();
        }
    }

    public function signup()
    {

        $this->_action = new signup_mdl();
        $this->_setup_signup(); // set values
                                    
        //
    }
}

class Login_mdl extends Base_Model
{

    private $_loginby;
    private $_hash_pass;
    
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

    //set the values of member variables.
    private function __construct()
    {
        parent::__construct();
        
        $this->_loginby = $this->input->post('loginby');
        $this->_hash_pass = hash('sha512', config_item('encrypt_key8') . $this->input->post('password') . config_item('encrypt_key16') . 'ce-ncit' . config_item('encrypt_key32'));
    }
}

class Signup_mdl extends Base_Model
{

    private $_loginby;
    private $_hash_pass;

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

    private function _setup_login()
    {
        $this->_loginby = array();
        $this->_hash_pass = hash('sha512', config_item('encrypt_key8') . $this->input->post('password') . config_item('encrypt_key16') . 'ce-ncit' . config_item('encrypt_key32'));
    }
}
