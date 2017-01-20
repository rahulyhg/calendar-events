<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_mdl extends CI_Model
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
        $this->_action = new Signup_mdl();
        $check = $this->_action->istaken();
        if ($check == '') {
            $result = $this->_action->insert_to_verifypending();
            
            // @todo send this ver_uri via email to $result['email']
            $ver_uri = base_url('users/verify/' . $result['id'] . '/' . $result['ver_key']);
            echo anchor($ver_uri, 'verify!');
        }
        return $check;
    }

    public function verify($id, $verifying_key)
    {
        $this->_action = new Verify_mdl($id);
        $id = $this->_action->verify_with($verifying_key);
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

// the signup model
class Signup_mdl extends Base_Model
{
    // override Base_Model variables
    protected $_table_name = 'verifypending';

    protected $_primary_key = 'id';

    protected $_primary_filter = 'intval';

    protected $_order_by = 'id';

    protected $_rules = array();
    
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

// the hasing function
function hashit($string)
{
    return hash('sha512', config_item('encrypt_key8') . $string . config_item('encrypt_key16') . 'ce-ncit' . config_item('encrypt_key32'));
}

