<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller
?>

<!-- the panel -->
<div class="panel panel-primary hidden-xs">
	<div class="panel-heading">
    <h3 class="panel-title">Events this month</h3>
  </div>

	<!-- panel body -->
  <div class="panel-body">

		<?php foreach ($eventlist as $day => $event): ?>
			<!-- the event thumbnail -->
			<div class="media thumbnail">
				<div class="media-left media-top">
					<a href="<?php echo $event;?>">
						<div>
							<small><i><?php echo $day > 9 ? $day : "0{$day}"; ?></i></small>
						</div>
					</a>
				</div>

				<!-- event details -->
				<div class="media-body">
					<h4 class="media-heading"><?php echo ucfirst($eventdata[$day]['title']); ?></h4>
					<?php echo $eventdata[$day]['description'] ?><br />
					<a data-toggle="collapse" data-target="#comments<?php echo $day; ?>" >Comments</a>

					<!-- collapsed comments -->
					<div class="collapse" id="comments<?php echo $day; ?>">
						<!-- Nested comment media object -->
						<div class="media">
							<div class="media-left">
								<span class="glyphicon glyphicon-user" width=50px height=50px></span>
							</div>

							<div class="media-body">
								<h4 class="media-heading">John Doe <small><i>February 21, 2016</i></small></h4>
								<?php echo $eventdata[$day]['comments']; ?>
							</div>
						</div>
					</div> <!-- end comments -->
				</div> <!-- end event details -->
			</div> <!-- end event thumbnail -->
		<?php endforeach; ?>

		<!-- add event thumbnail -->
		<a href="<?php echo base_url('events/create'); ?>">
			<div class="media thumbnail">
				<div class="media-left media-top">	
					<div>
						<span class="glyphicon glyphicon-plus"></span>
					</div>
				</div>

				<!-- add event link -->
				<div class="media-body">
					<h4 class="media-heading">Add new event</h4>
				</div>
			</div> <!-- end add event thumbnail -->
		<a>
  </div> <!-- end panel body -->
</div> <!-- end panel -->
