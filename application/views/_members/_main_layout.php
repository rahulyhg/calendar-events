<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initialscale=1.0">
<!-- Bootstrap -->
	<?php echo link_tag('bootstrap/css/bootstrap.min.css'); ?>
</head>

<body>

	<div class="container">

		<div class="header" style="margin-bottom: 50px;">
			<a href="<?php echo base_url();?>"><?php echo img(base_url('site_images/logo.png'), FALSE, array('id' => 'logo', 'style' => 'margin: 0px;' ));?></a>
			<span
				style="font-size: 50px; line-height: 50px; vertical-align: middle"><?php echo $site_name;?></span>
		</div>

    <?php $this->load->view($page); ?>

</div>

</body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>jquery/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual
files as needed -->
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
</html>
