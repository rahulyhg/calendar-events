<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<script src='https://www.google.com/recaptcha/api.js'></script>
<div id="fb-root"></div>
<h1>Sign up</h1>
<?php if ( validation_errors() != ''):?>
<div class="alert alert-danger"><?php echo validation_errors(); ?></div>
<?php endif;?>
<?php echo form_open (base_url ('signup'), array('class' => 'form', 'role' => 'form')); ?>
<div class="form-group">
	<label>Username: <input type="text" class="form-control"
		name="username" /></label>
</div>
<div class="form-group">
	<label>Email: <input type="text" class="form-control"
		name="email" /></label>
</div>
<div class="form-group">
	<label>Password: <input type="password" class="form-control"
		name="password" /></label>
</div>
<div class="form-group">
	<label>Confirm Password: <input type="password" class="form-control"
		name="passwordconf" /></label>
</div>
<div class="g-recaptcha" data-sitekey="6LcdHxMUAAAAAFzUB2c9fgiGle63jUdLYWUDrYq_"></div>
<input type="submit" class="btn btn-default"
	value="Sign up with above details" />
<div class="form-group">
OR login facebook to singup using facebook details: 
<div type="submit" class="fb-login-button btn" data-max-rows="2" data-size="medium" data-show-faces="false" data-auto-logout-link="false"></div>
</div>
<br />
<?php echo anchor(htmlspecialchars($fb_url), 'Login with facebook'); ?>
</form>


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
