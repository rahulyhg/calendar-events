<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends Member_Controller
{

    function __construct()
    {
        parent::__construct();
        
        //$this->load->library('session');
        // load the modules/Users/models/users_mdl.php/Users_mdl
        $this->load->model('users_mdl');
		$this->load->library('form_validation');
        
        // for verification
        // $this->load->model('Email_mdl');
    }

    private function loginform($loginby, $errors = '', $fb_url = '')
    {
        $data = array(
            'loginby' => $loginby,
            'src_module' => 'users',
            'src_action' => 'login',
            'view_page' => 'LoginForm',
            'errors' => $errors,
            'fb_url' => $fb_url
        );
        echo Modules::run('layout/account', $data);
    }

    public function login()
    {
		var_dump($this->session->userdata());
		$afterlogin = base_url('users/home');
		// if user is already logged in
		if ($this->users_mdl->loggedin()) {
			echo "User logged in so redirecting to {$afterlogin}";
			redirect($afterlogin, 'refresh'); // code after this should not run
			return TRUE;
		}
	
        $fbloginUrl = $this->users_mdl->fb(TRUE);
        
        // $loginUrl = htmlspecialchars($loginUrl) ;
        
        if ($this->form_validation->run() == FALSE) {
            // invalid form
            $this->loginform($this->input->post('loginby', 'TRUE'), validation_errors(), $fbloginUrl);
        } else {
            // valid form
            
            if ($this->users_mdl->login() == FALSE) {
                // incorrect credentials
                $this->loginform($this->input->post('loginby', 'TRUE'), 'Wrong Username or Password', $fbloginUrl);
            } else {
                // login successful
				echo "Redirecting you to {$afterlogin}";
                redirect($afterlogin, 'refresh');
            }
        }
    }

    //@TODO add the full name field
    private function signupform($username, $email, $errors = '', $fb_url = '')
    {
        $data = array(
            'username' => $username,
            'email' => $email,
            'src_module' => 'users',
            'src_action' => 'signup',
            'view_page' => 'SignupForm',
            'errors' => $errors,
            'fb_url' => $fb_url
        );
        echo Modules::run('layout/account', $data);
    }

    public function signup()
    {
        $fb = new Facebook\Facebook([
            'app_id' => config_item('app_id'), // Replace {app-id} with your app id
            'app_secret' => config_item('app_secret'),
            'default_graph_version' => 'v2.8'
        ]);
        
        $helper = $fb->getRedirectLoginHelper();
        
        $permissions = [
            'email'
        ]; // Optional permissions
        $loginUrl = $helper->getLoginUrl(base_url('users/fb_callback'), $permissions);
        
        // $loginUrl = htmlspecialchars($loginUrl) ;
        
        // check recaptcha
        $response = $this->input->post('g-recaptcha-response');
        if ($response != '') {
            $recaptcha = new \ReCaptcha\ReCaptcha('6LcdHxMUAAAAAHcJ8Ai6WhV-VXsWtHzenRaN-jRY');
            $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            if ($resp->isSuccess()) {
                // verified!
                echo 'verified';
            } else {
                $errors = $resp->getErrorCodes();
            }
        }
        
        if ($this->form_validation->run() == FALSE) {
            // invalid form
            $this->signupform($this->input->post('username', 'TRUE'), $this->input->post('email', 'TRUE'), validation_errors(), $loginUrl);
        } else {
            // valid form
            $check = $this->users_mdl->signup();
            if ($check != '') {
                // username/email already registered.
                $this->signupform($this->input->post('loginby', 'TRUE'), $check . ' already taken');
            } else {
                // signup successful
                // redirect(base_url('home'), 'refresh');
                echo 'signup success';
            }
        }
    }

    function verify($id = '', $verificationText = '')
    {
        if ($id == '' || $verificationText == '')
            echo 'no params';
        $this->users_mdl->verify($id, $verificationText);
        /*
         * $noRecords = $this->HomeModel->verifyEmailAddress($verificationText);
         * if ($noRecords > 0) {
         * $error = array(
         * 'success' => "Email Verified Successfully!"
         * );
         * } else {
         * $error = array(
         * 'error' => "Sorry Unable to Verify Your Email!"
         * );
         * }
         * $data['errormsg'] = $error;
         * $this->load->view('index.php', $data);
         */
    }

    public function fb_callback()
    {
        $this->users_mdl->fb();
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
