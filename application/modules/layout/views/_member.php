<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php $this->load->view('elements/header'); ?>

<div class="container">
	
	<?php $this->load->view('elements/navbar'); ?>
	<!-- Main -->
	<div class="main jumbotron" style="width:95%">
		<div class="calparts row">
			<div class="caltbl col-sm-8">
				<?php $this->load->view("calendar/calendar_tbl", $caldata=''); ?>
			</div>
			<div class="ebar col-sm-4">
				<?php $this->load->view("calendar/events_bar"); ?>
			</div>
		</div>
	</div>
</div> <!-- end container -->

<?php $this->load->view('elements/footer'); ?>