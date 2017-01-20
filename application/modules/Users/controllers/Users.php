<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends Form_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_mdl');
        // for verification
        // $this->load->model('Email_mdl');
    }

    private function loginform($loginby, $errors = '')
    {
        $data = array(
            'loginby' => $loginby,
            'src_module' => 'users',
            'src_action' => 'login',
            'view_page' => 'loginform',
            'errors' => $errors
        );
        echo Modules::run('layout/account', $data);
    }

    public function login()
    {
        if ($this->form_validation->run() == FALSE) {
            // invalid form
            $this->loginform($this->input->post('loginby', 'TRUE'), validation_errors());
        } else {
            // valid form
            
            if ($this->users_mdl->login() == FALSE) {
                // incorrect credentials
                $this->loginform($this->input->post('loginby', 'TRUE'), 'Wrong Username or Password');
            } else {
                // login successful
                //redirect(base_url('home'), 'refresh');
            }
        }
    }

    private function signupform($username, $email, $errors)
    {
        $data = array(
            'username' => $username,
            'email' => $email,
            'src_module' => 'users',
            'src_action' => 'signup',
            'view_page' => 'signupform',
            'errors' => $errors
        );
        echo Modules::run('layout/account', $data);
    }

    public function signup()
    {
        if ($this->form_validation->run() == FALSE) {
            // invalid form
            $this->signupform($this->input->post('username', 'TRUE'), $this->input->post('email', 'TRUE'), validation_errors());
        } else {
            //valid form
            $check = $this->users_mdl->signup();
            if ($check != '') {
                // username/email already registered.
                $this->loginform($this->input->post('loginby', 'TRUE'), $check . ' already taken');
            } else {
                // signup successful
                //redirect(base_url('home'), 'refresh');
                echo 'signup success';
            }
        }
    }

    function verify($id = '', $verificationText = '')
    {
        if ($id == '' || $verificationText == '') echo 'no params';
        $this->users_mdl->verify($id, $verificationText);
        /* $noRecords = $this->HomeModel->verifyEmailAddress($verificationText);
        if ($noRecords > 0) {
            $error = array(
                'success' => "Email Verified Successfully!"
            );
        } else {
            $error = array(
                'error' => "Sorry Unable to Verify Your Email!"
            );
        }
        $data['errormsg'] = $error;
        $this->load->view('index.php', $data); */
    }

    public function forgot()
    {
        echo 'forgot';
    }

    public function reset()
    {
        echo 'reset';
    }

    public function deactivate()
    {
        echo 'deactivate';
    }
}
