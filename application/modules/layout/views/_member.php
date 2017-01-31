<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo ucfirst($page); ?></title>
<meta name="viewport" content="width=device-width, initialscale=1.0">
<!-- Bootstrap -->
	<?php echo link_tag('bootstrap/css/bootstrap.min.css'); ?>
</head>

<body>

	<div class="container">

		<div class="header" style="margin-bottom: 50px;">
			<a href="<?php echo base_url();?>"><?php echo img(base_url('site_images/logo.png'), FALSE, array('id' => 'logo', 'style' => 'margin: 0px;' ));?></a>
			<span
				style="font-size: 50px; line-height: 50px; vertical-align: middle"><?php echo config_item('site_name'); ?></span>
		</div>

		<div class="main well" style="width:95%">
			<div class="calparts row">
				<div class="caltbl col-sm-8">
					<?php $this->load->view("calendar/calendar_tbl", $caldata=''); ?>
				</div>
				<div class="ebar col-sm-4">
					<?php $this->load->view("calendar/events_bar"); ?>
				</div>
			</div>
		</div>

	</div>

</body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>jquery/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual
files as needed -->
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
</html>