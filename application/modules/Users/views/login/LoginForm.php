<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="fb-root"></div>

<h1>Log in</h1>
<?php if ( $errors != ''):?>
<div class="alert alert-danger"><?php echo $errors; ?></div>
<?php endif;?>
<?php echo form_open (base_url ('login'), array('class' => 'form', 'role' => 'form')); ?>
<div class="form-group">
	<label>Username / Email: <input type="text" class="form-control"
		name="loginby" value="<?php echo $loginby; ?>" /></label>
</div>
<div class="form-group">
	<label>Password: <input type="password" class="form-control"
		name="password" /></label>
</div>
<div class="checkbox">
	<label><input type="checkbox" name="remember"> Remember me</label>
</div>
<br />
<input type="submit" class="btn btn-info" value="Log in" />
<br />
<br />
<div class="form-group">
Or Login with facebook: 
<div type="submit" class="fb-login-button btn" data-max-rows="2" data-size="medium" data-show-faces="false" data-auto-logout-link="false"></div>
</div>

</form>
<br />
<div><a href="<?php echo base_url('forgotpassword'); ?>">Forgot Password?</a></div>


<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '385804648438360',
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<script type="text/javascript">
<!--

//-->

function checkLoginState() {
	  FB.getLoginStatus(function(response) {
	    statusChangeCallback(response);
	  });
	}

FB.login(function(response){
	if (response.status === 'connected') {
	    // Logged into your app and Facebook.
	    
	  } else if (response.status === 'not_authorized') {
	    // The person is logged into Facebook, but not your app.
	  } else {
	    // The person is not logged into Facebook, so we're not sure if
	    // they are logged into this app or not.
	  }
	});
</script>


<!--
for login with facebook
<script type="text/javascript" src="<?php echo base_url ('jscript/facebook.js'); ?>">
</script>

/*
Taken from the sample code above, here's some of the code that's run during page load to check a person's login status:
FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});
The response object that's provided to your callback contains a number of fields:
{
    status: 'connected',
    authResponse: {
        accessToken: '...',
        expiresIn:'...',
        signedRequest:'...',
        userID:'...'
    }
}
status specifies the login status of the person using the app. The status can be one of the following:
connected - the person is logged into Facebook, and has logged into your app.
not_authorized - the person is logged into Facebook, but has not logged into your app.
unknown - the person is not logged into Facebook, so you don't know if they've logged into your app or FB.logout() was called before and therefore, it cannot connect to Facebook.
authResponse is included if the status is connected and is made up of the following:
accessToken - contains an access token for the person using the app.
expiresIn - indicates the UNIX time when the token expires and needs to be renewed.
signedRequest - a signed parameter that contains information about the person using the app.
userID - the ID of the person using the app.
Once your app knows the login status of the person using it, it can do one of the following:
If the person is logged into Facebook and your app, redirect them to your app's logged in experience.
If the person isn't logged into your app, or isn't logged into Facebook, prompt them with the Login dialog with FB.login() or show them the Login Button.
*/

//-->


