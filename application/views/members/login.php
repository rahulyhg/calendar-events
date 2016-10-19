<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<?php echo link_tag('css/style.css'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container">

<div class="header">
	<?php echo img('images/logo.png', FALSE, 'id = "logo"'); ?>
	<div id="projectTitle">CEMS</div>
</div>


<div class="main">
	<div class="login">
    <?php echo form_open ('member/login', 'class=loginForm'); ?>
		<h1>Sign in</h1>
		<label>Username<input type="text" name="username" /></label>
		<label>Password<input type="password" name="password" /></label>
		<input type="submit" value="Log in" />
		<a href="">Forgot Password?</a>
    <?php echo form_close(); ?>
	</div>
</div>


</div>
</body>
</html>