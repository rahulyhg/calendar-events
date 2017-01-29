<?php
defined('BASEPATH') or exit('No direct script access allowed');

// the login model
class Login_mdl extends Base_Model
{
    // override Base_Model variables
    protected $_table_name = 'members';

    protected $_primary_key = 'id';

    protected $_primary_filter = 'intval';

    protected $_order_by = 'id';

    protected $_rules = array();

    private $_loginby;

    private $_hashpass;

    private $_errors;

    public function __construct()
    {
        parent::__construct();

        // set the values of member variables.
        $this->_loginby = $this->input->post('loginby');
        $this->_hashpass = hashit($this->input->post('password'));
    }

    public function isgood()
    {
        // check if email or username is entered.
        // assuming '@' is only possible in email and not username
        if (strpos($this->_loginby, '@') !== FALSE) {
            return $this->_login_by_email();
        } else {
            echo 'login by username';
            return $this->_login_by_username();
        }
    }

    // login by email if email was provided.
    // @return bool
    private function _login_by_email()
    {
        // if email was entered
        $login_data = array(
            'email' => $this->_loginby,
            'hashpass' => $this->_hashpass
        );
        var_dump($login_data);
        $userdata = $this->get_by($login_data);

        if (count($userdata)) {
            // correct email password combination
            // echo 'email and password correct';
			$sesdata = array(
				'id' => $userdata->id,
				'username' => $userdata->username,
				'email' => $userdata->email,
				'loggedin' => TRUE
			);
			$this->session->set($sesdata);
            return TRUE;
        }
        return FALSE;
    }

    // login by username if it was provided.
    // @return bool
    private function _login_by_username()
    {
        // if username was entered
        $login_data = array(
            'username' => $this->_loginby,
            'hashpass' => $this->_hashpass
        );
        // var_dump ($login_data);
        $userdata = $this->get_by($login_data);

        if (count($userdata)) {
            // correct username password combination
            // echo 'login correct';
            return TRUE;
        }
        return FALSE;
    }
}