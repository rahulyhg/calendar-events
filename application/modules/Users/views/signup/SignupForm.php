<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="fb-root"></div>
<!-- load the recaptcha js -->
<script src='https://www.google.com/recaptcha/api.js'></script>

<h1>Sign up</h1>
<?php if ( validation_errors() != ''):?>
<div class="alert alert-danger"><?php echo validation_errors(); ?></div>
<?php endif;?>
<?php echo form_open (base_url ('signup'), array('class' => 'form', 'role' => 'form')); ?>
<div class="form-group">
	<label>Full Name: <input type="text" class="form-control"
		name="fullname" /></label>
</div>
<div class="form-group">
	<label>Username: <input type="text" class="form-control"
		name="username" /></label>
</div>
<div class="form-group">
	<label>Email: <input type="text" class="form-control" name="email" /></label>
</div>
<div class="form-group">
	<label>Password: <input type="password" class="form-control"
		name="password" /></label>
</div>
<div class="form-group">
	<label>Confirm Password: <input type="password" class="form-control"
		name="passwordconf" /></label>
</div>

<div class="g-recaptcha form-group"
	data-sitekey="6LcdHxMUAAAAAFzUB2c9fgiGle63jUdLYWUDrYq_"></div>

<div class="form-group">
	<input type="submit" class="btn btn-info"
		value="Sign up with above details" />
		OR: <?php echo anchor(htmlspecialchars($fb_url), 'Login with facebook','class="btn btn-primary" role="button"'); ?>
</div>
</form>