<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**Users
 *
 * This contains the user account access methods
 *
 * @TODO add better security
 *
*/
class Users extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        
        //$this->load->library('session');
        // load the modules/Users/models/users_mdl.php/Users_mdl
        $this->load->model('users_mdl');
		$this->load->library('form_validation');

        $page = base_url('users/home'); // if user is logged in, redirect to $page

        // if the method is not logout and user is already logged in
        if ($this->uri->segment(2) != 'logout' && $this->users_mdl->loggedin()) {
            echo "User logged in so redirecting to {$page}";
            redirect($page, 'refresh'); // code after this should not run
            exit();                     // so exit is used just in case
        }
        
        // for verification
        // $this->load->model('Email_mdl');
    }

//-----------------------------------------------------------------------------

    /**loginform
     * Will show the login form with the layout
     * @param
     *      loginby the loginby field that will be repopulated in the form
     *      errors  errors that will be displayed
     *      fb_url  the fb login url
    */
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

//-----------------------------------------------------------------------------

    /**Login
     *Checks for session cookie, form validation, login credentials
     *and logs in or shows loginform accordingly
     *
    */
    public function login()
    {
        $flashnext = $this->session->flashdata('nextpage');
        $this->session->set_flashdata('nextpage', $flashnext);
		$afterlogin = $flashnext != ''? $flashnext :'users/home'; // the next page after login successful
        $afterlogin = base_url($afterlogin); // generate the next page with base_url()
	
        $fbloginUrl = $this->users_mdl->fb(TRUE); // get the login url for login with fb button
        
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
                redirect($afterlogin, 'refresh'); // code after this should not run
                exit();                           // so exit is used just in case
            }
        }
    }

//-----------------------------------------------------------------------------

    /**Logout
     *
     * This will logout the user
     *
    */
    public function logout () {
        $this->users_mdl->logout();
        redirect(base_url('login'), 'refresh');
    }

//-----------------------------------------------------------------------------

    /**signupform
     *
     * @TODO add the full name field
     *
     * @param
     *      username    the username that will be repopulated in the form
     *      email       the email that will be repopulated in the form
     *      errors      errors that will be displayed
     *      fb_url      fb url for the signup with fb button
    */
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

    //-----------------------------------------------------------------------------


    /**Signup
     *
     * This checks for various things and shows
     * signup form or sends to verification page
    */
    public function signup()
    {
        $errors = '';

        $fbloginUrl = $this->users_mdl->fb(TRUE); // get the login url for login with fb button
        
        // check recaptcha
        $response = $this->input->post('g-recaptcha-response');
        if ($response != '') {
            $recaptcha = new \ReCaptcha\ReCaptcha('6LcdHxMUAAAAAHcJ8Ai6WhV-VXsWtHzenRaN-jRY');
            $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            if ($resp->isSuccess()) {
                //verified!
                if ($this->form_validation->run() == FALSE) {
                    // invalid form
                    $errors .= validation_errors();
                } elseif ($errors == '') {
                    // valid form and no errors
                    $check = $this->users_mdl->signup();
                    if ($check != '') {
                        // username/email already registered.
                        $errors .= $check . ' already taken <br />';
                    } else {
                        // signup successful
                        echo 'signup success';
                        //redirect(base_url('users/verify'), 'refresh');
                        exit();
                        // lines after this will only be executed if signup was unsuccessful
                    }
                }
           }
            else {
                $errors .= "Recaptcha test Failed!<br />";
            }
            
        }

        $this->signupform( $this->input->post('username', TRUE),
                            $this->input->post('email', TRUE),
                            $errors,
                            $fbloginUrl
            );
    }

    function verify($id = '', $verificationText = '')
    {
        if ($id == '' || $verificationText == '')
            echo 'no params';
        $this->users_mdl->verify($id, $verificationText);
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
