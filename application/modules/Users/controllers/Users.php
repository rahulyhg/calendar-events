<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends Form_Controller
{

    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('users_mdl');
        // for verification
        // $this->load->model('Email_mdl');
    }

    private function loginform($loginby, $errors = '', $fb_url = '')
    {
        $data = array(
            'loginby' => $loginby,
            'src_module' => 'users',
            'src_action' => 'login',
            'view_page' => 'loginform',
            'errors' => $errors,
            'fb_url' => $fb_url
        );
        echo Modules::run('layout/account', $data);
    }

    public function login()
    {
        $fb = new Facebook\Facebook([
            'app_id' => config_item('app_id'), // Replace {app-id} with your app id
            'app_secret' => config_item('app_secret'),
            'default_graph_version' => 'v2.8',
        ]);
        
        $helper = $fb->getRedirectLoginHelper();
        
        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl(base_url('users/fb_callback'), $permissions);
        
        //$loginUrl = htmlspecialchars($loginUrl) ;
        
        if ($this->form_validation->run() == FALSE) {
            // invalid form
            $this->loginform($this->input->post('loginby', 'TRUE'), validation_errors(), htmlspecialchars($loginUrl));
        } else {
            // valid form
            
            if ($this->users_mdl->login() == FALSE) {
                // incorrect credentials
                $this->loginform($this->input->post('loginby', 'TRUE'), 'Wrong Username or Password');
            } else {
                // login successful
                // redirect(base_url('home'), 'refresh');
            }
        }
    }

    private function signupform($username, $email, $errors = '', $fb_url = '')
    {
        $data = array(
            'username' => $username,
            'email' => $email,
            'src_module' => 'users',
            'src_action' => 'signup',
            'view_page' => 'signupform',
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
            'default_graph_version' => 'v2.8',
        ]);
        
        $helper = $fb->getRedirectLoginHelper();
        
        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl(base_url('users/fb_callback'), $permissions);
        
        //$loginUrl = htmlspecialchars($loginUrl) ;
        
        
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
            $this->signupform($this->input->post('username', 'TRUE'), $this->input->post('email', 'TRUE'), validation_errors(), htmlspecialchars($loginUrl));
        } else {
            // valid form
            $check = $this->users_mdl->signup();
            if ($check != '') {
                // username/email already registered.
                $this->loginform($this->input->post('loginby', 'TRUE'), $check . ' already taken');
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

    public function login_by_fb()
    {
        $fb = new Facebook\Facebook([
            'app_id' => config_item('app_id'), // Replace {app-id} with your app id
            'app_secret' => config_item('app_secret'),
            'default_graph_version' => 'v2.8',
        ]);
        
        $helper = $fb->getRedirectLoginHelper();
        
        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl(base_url('users/fb_callback'), $permissions);
        
        echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
    }
    
    public function fb_callback () {
        $fb = new Facebook\Facebook([
            'app_id' => config_item('app_id'), // Replace {app-id} with your app id
            'app_secret' => config_item('app_secret'),
            'default_graph_version' => 'v2.8',
        ]);
        
        $helper = $fb->getRedirectLoginHelper();
        
        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        
        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        
        // Logged in
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());
        
        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        echo '<h3>Metadata</h3>';
        var_dump($tokenMetadata);
        
        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId(config_item('app_id')); // Replace {app-id} with your app id
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();
        
        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }
        
            echo '<h3>Long-lived</h3>';
            var_dump($accessToken->getValue());
        }
        
        $_SESSION['fb_access_token'] = (string) $accessToken;
        
        // User is logged in with a long-lived access token.
        // You can redirect them to a members-only page.
        //header('Location: https://example.com/members.php');
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
