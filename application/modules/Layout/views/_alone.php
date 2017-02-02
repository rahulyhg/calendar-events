<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php $this->load->view('elements/header'); ?>

<div class="container">
	
	<?php $this->load->view('elements/navbar'); ?>
	<!-- Main -->
	<div class="main jumbotron" style="width:95%">
		<?php $this->load->view($page, $pagedata); ?>
	</div>
</div> <!-- end container -->

<?php $this->load->view('elements/footer'); ?>