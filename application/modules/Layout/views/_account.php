<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('elements/header');
?>

<div class="container">

	<?php $this->load->view('elements/navbar'); ?>

	<div class="well" style="width:95%">
		<?php $this->load->view("{$data['src_module']}/{$data['src_action']}/{$data['view_page']}", $data); ?>
	</div>

</div>

<?php $this->load->view('elements/footer'); ?>