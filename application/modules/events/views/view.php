<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller
?>



<div>
	<h3><?php echo "Day: {$pagedata['event']['day']}";?></h3>
	<?php unset($pagedata['event']['day']); ?>
	<h3><?php echo "Name: {$pagedata['event']['name']}";?></h3>
	<?php unset($pagedata['event']['name']); ?>
	<br />
	<div>
		<?php foreach ($pagedata['event'] as $key => $value): ?>
			<div><?php echo "{$key}: {$value}"; ?></div>
		<?php endforeach; ?>
	</div>

	<a class="btn btn-default" href="<?php echo base_url('users/home/editevent/'). "{$pagedata['event']['id']}"; ?>" role="button">Edit</a>
</div>
