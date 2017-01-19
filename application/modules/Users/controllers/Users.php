<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends Form_Controller
{

    function __construct()
    {
        parent::__construct();
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
            //valid form
            $this->load->model('user_model');
            
            if ($this->user_model->login() == FALSE) {
                //incorrect credentials
                $this->loginform($this->input->post('loginby', 'TRUE'), 'Wrong Username or Password');
            } else {
                //login successful
                redirect(base_url('home'), 'refresh');
            }
            echo 'valid form';
        }
    }
    
    private function signupform($username, $email, $errors) {
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
            $this->signupform(
                    $this->input->post('username', 'TRUE'),
                    $this->input->post('email', 'TRUE'),
                    validation_errors()
                );
        } else {
            // valid form
            redirect(base_url('member/home'), 'refresh');
        }
    }
    
    public function forgot() {
        echo 'forgot';
    }
    
    public function reset() {
        echo 'reset';
    }
    
    public function deactivate() {
        echo 'deactivate';
    }
}
