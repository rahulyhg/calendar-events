<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

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
<input type="submit" class="btn btn-default"
	value="Sign up with above details" />
</form>
