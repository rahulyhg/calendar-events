<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="well">
<h1>Log in</h1>
<?php if ( validation_errors() != ''):?>
	<div class="alert alert-danger">Wrong Username / Password</div>
<?php endif;?>
<?php echo form_open (base_url ('login'), array('class' => 'form', 'role' => 'form')); ?>
	<div class="form-group"><label>Username / Email: <input type="text" class="form-control" name="loginby" /></label></div>
	<div class="form-group"><label>Password: <input type="password" class="form-control" name="pass" /></label></div>
	<div class="checkbox"><label><input type="checkbox" name="remember"> Remember me</label></div>
	<input type="submit" class="btn btn-default" value="Log in" />
</form>
</div>
<a href="">Forgot Password?</a>



