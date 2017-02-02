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
				<?php echo $caltable; ?>
			</div>
			<div class="ebar col-sm-4">
				<?php echo $eventbar; ?>
			</div>
		</div>
	</div>
</div> <!-- end container -->

<?php $this->load->view('elements/footer'); ?>