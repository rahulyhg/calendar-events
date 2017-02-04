<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

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
<!-- <div class="checkbox">
	<label><input type="checkbox" name="remember"> Remember me</label>
</div> -->
<br />
<input type="submit" class="btn btn-info" value="Log in with the password" />
<!-- OR: <?php echo anchor(htmlspecialchars($fb_url), 'Login with facebook','class="btn btn-primary" role="button"'); ?>
<br /> -->

OR: <?php echo anchor(base_url('signup'), 'Signup for an account', 'class="btn btn-primary" role="button"'); ?>
<br /> 

</form>
<br />
<div><a href="<?php echo base_url('forgotpassword'); ?>">Forgot Password?</a></div>
