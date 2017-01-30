<?php
defined('BASEPATH') or exit('No direct script access allowed');

// the verify model
class Fbverify_mdl extends Base_Model
{
    // These Base_Model variables may be overwritten
    protected $_primary_key = 'id'; // fb_id for 'fbmembers'
    protected $_primary_filter = 'intval'; // varchar for 'fbmembers'
    protected $_auto_increment = TRUE; // FALSE for 'fbmembers'
    
    protected $_fbmembers_row = '';
    protected $_fb = '';
    protected $_user = '';
    protected $_access_token = '';

    public function __construct()
    {
        parent::__construct();

        $this->_fb = new Facebook\Facebook([
            'app_id' => config_item('app_id'), // app_id and app_secret from config/fb_config.php
            'app_secret' => config_item('app_secret'),
            'default_graph_version' => 'v2.8',
            'persistent_data_handler' => new CIFacebookPersistentDataHandler()
        ]);
    }
    
    // function to verify facebook login / signup
    public function verify_fb()
    {
        $fields = array(
            'id',
            'name',
            'email',
            'timezone'
        );
        $this->_retrieve($fields);

        // get fb id from response
        $fb_id = $this->_user['id'];
        
        // get fbmembers row from its table
        $this->_table_name = 'fbmembers';
        $this->_primary_key = 'fb_id';
        $this->_fbmembers_row = $this->get($fb_id, TRUE); // it will be null for no match found
        
        if (! $this->_fbmembers_row) {
            // if fb user is not registered, then register
            $this->_signup_with_fb();
        } else {
            // if fb user is registered, then login
            $this->_login_with_fb();
        }
    }

    public function get_login_url() {
        $helper = $this->_fb->getRedirectLoginHelper();
        
        $permissions = [ // Optional permissions
            'email'
        ]; 
        return $helper->getLoginUrl(base_url('users/fb_callback'), $permissions);
    }

    protected function _login_with_fb()
    {
        // set session data and redirect
        echo 'login now';
    }

    protected function _signup_with_fb()
    {
        $fields = array(
            'id',
            'name',
            'email',
            'timezone'
        );
        $this->_retrieve($fields);

        echo "fb_id: {$this->_user['id']}";
        echo "fb_email: {$this->_user['email']}";
        
        // first add to members
        $this->_table_name = 'members'; // setup tablename
        $this->_primary_key = 'id'; // setup pk
        
        $id = $this->save(array(
            'username' => 'fbuser_' . $this->_user['id'],
            'hashpass' => hashit(''),
            'email' => $this->_user['email'],
            'register_date' => date('Y-m-d H:i:s'),
            'is_active' => '1'
        ) // 1 means active
        );
        
        echo 'successfully added with id = ' . $id;
        
        try {
            // insert to fbmembers
            $this->_table_name = 'fbmembers';
            $this->_primary_key = 'fb_id';
            $this->_auto_increment = FALSE;
            
            $to_add = array(
                'fb_id' => "{$this->_user['id']}",
                'users_id' => $id
            );
            
            var_dump($to_add['fb_id']);
            
            $this->_user = $this->save($to_add); //this will dismiss $user and get id
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        finally {
            echo 'this->_user: '.$this->_user;
            if ($this->_user) {
                echo "fb id registered: {$this->_user}";
            } else {
                echo 'in finally';
                if ($id) {
                    echo 'deleting from members because of fail';
                    $this->_table_name = 'members'; // setup tablename
                    $this->_primary_key = 'id'; // setup pk
                    $this->delete($id); // remove the unsuccessful login
                }
            }
        }
    }

    protected function _get_access_token()
    {
        // Choose your app context helper
        $helper = $this->_fb->getRedirectLoginHelper();

        isset($_GET['state']) && $_SESSION['FBRLH_state']=$_GET['state'];

        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit();
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
            exit();
        }
        
        // Logged in
        // echo '<h3>Access Token</h3>';
        // var_dump($accessToken->getValue());
        
        $this->_authorize($accessToken); // validate $accessToken
                                         // will call exit() if not valid
        
        $this->_access_token = $accessToken;
    }

    protected function _authorize($accessToken)
    {
        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $this->_fb->getOAuth2Client();
        
        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        // echo '<h3>Metadata</h3>';
        // var_dump($tokenMetadata);
        
        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId(config_item('app_id')); // app_id from config/fb_config.php
                                                              
        // If you know the user ID this access token belongs to, you can validate it here
                                                              // $tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();
        
        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit();
            }
            
            // echo '<h3>Long-lived</h3>';
            // var_dump($accessToken->getValue());
        }
        
        $_SESSION['fb_access_token'] = (string) $accessToken;
        
        // ---------------- from fb manual (discard)-------------------------
        // User is logged in with a long-lived access token.
        // You can redirect them to a members-only page.
        // redirect(base_url('users/home'), 'refresh');
        // -------------------------------------------------------------------
    }

    protected function _retrieve($fields)
    {
        $this->_get_access_token();
        $get_them = implode(',', $fields);
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $this->_fb->get('/me?fields=' . $get_them, $this->_access_token);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit();
        }
        
        $this->_user = $response->getGraphUser();
    }
}
