<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller
?>
<?php if($pagedata['single']) :?>
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title"><?php echo "Event: {$pagedata['event']['name']}";?></h3>
	  </div>
	  <ul class="list-group">
	    <li class="list-group-item"><?php echo "Date: {$pagedata['event']['date']}"; ?></li>

	    <li class="list-group-item"><?php echo "Description: {$pagedata['event']['description']}"; ?></li>
	    <li class="list-group-item"><?php echo "Location: {$pagedata['event']['loc']}"; ?></li>
	  </ul>

	</div>


	<div>
		<a class="btn btn-default" href="<?php echo base_url('users/home/editevent/'). "{$pagedata['event']['id']}"; ?>" role="button">Edit</a>
	</div>

<?php else: ?>

<?php foreach ($pagedata['event'] as $event => $date): ?>
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title"><?php echo "Event: {$date['name']}";?></h3>
	  </div>
	  <ul class="list-group">
	    <li class="list-group-item"><?php echo "Date: ".$pagedata['date']; ?></li>

	    <li class="list-group-item"><?php echo "Description: {$date['description']}"; ?></li>
	    <li class="list-group-item"><?php echo "Location: {$date['loc']}"; ?></li>
	  </ul>

	</div>


	<div>
		<a class="btn btn-default" href="<?php echo base_url('users/home/editevent/'). "{$date['id']}"; ?>" role="button">Edit</a>
	</div>
<?php endforeach; ?>

<?php endif; ?>
