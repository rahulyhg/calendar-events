<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
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
</form>
