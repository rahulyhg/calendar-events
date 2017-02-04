<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_mdl extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    
    // check username/email and password is good for logging
    // @return bool
    public function login()
    {
        $this->load->model('login_mdl');
        
        return $this->login_mdl->isgood();
    }
	
	public function loggedin() {
		return (bool) $this->session->userdata('loggedin');
	}
	
	public function logout() {
		$this->session->sess_destroy();
	}

    public function signup()
    {
        $this->load->model('signup_mdl');
        $check = $this->signup_mdl->istaken();
        if ($check == '') {
            $result = $this->signup_mdl->insert_to_verifypending();
            
            // @todo send this ver_uri via email to $result['email']
            $ver_uri = base_url('users/verify/' . $result['id'] . '/' . $result['ver_key']);
            echo anchor($ver_uri, 'verify!');
        }
        return $check;
    }

    public function verify($id, $verifying_key)
    {
        $this->load->model('verify_mdl');
        $this->verify_mdl->verify_this($id);
        $id = $this->verify_mdl->verify_with($verifying_key);
    }
    
    public function fb($get_login_url = FALSE) {
        $this->load->model('fbverify_mdl');
        if ($get_login_url) {
            return $this->fbverify_mdl->get_login_url();
        }
        $this->fbverify_mdl->verify_fb();
    }
}

// the hasing function
function hashit($string)
{
    return hash('sha512', config_item('encrypt_key8') .
            $string . config_item('encrypt_key16') .
            'ce-ncit' . config_item('encrypt_key32')
        );
}

