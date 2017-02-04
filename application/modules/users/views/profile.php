<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller
?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Profile</h3>
  </div>
  <ul class="list-group">
  	<li class="list-group-item"><?php echo "Username: {$pagedata['user']['username']}";?></li>
    <li class="list-group-item"><?php echo "Name: {$pagedata['user']['name']}"; ?></li>

    <li class="list-group-item"><?php echo "Email: {$pagedata['user']['email']}"; ?></li>
    <li class="list-group-item"><?php echo "Registered date: {$pagedata['user']['register_date']}"; ?></li>
  </ul>

</div>

