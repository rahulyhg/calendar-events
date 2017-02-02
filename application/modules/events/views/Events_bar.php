<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller
?>

<!-- the panel -->
<div class="panel panel-primary">
	<div class="panel-heading">
    <h3 class="panel-title">Events this month</h3>
  </div>

	<!-- panel body -->
  <div class="panel-body">

		<?php foreach ($eventlist as $day => $event): ?>
			<!-- the event thumbnail -->
			<div class="media thumbnail">
				<div class="media-left media-top">
					<a href="<?php echo $event;?>" style="width: 64px; height: 64px;">
						<div class="text-center bg-danger" style="width: 64px; height: 32px; line-height:32px;">
							<?php echo $date['month']; ?>/
						</div>
						<div class="text-center text-danger bg-danger" style="width: 64px; height: 32px; line-height:32px;">
							<?php echo $day; ?>
						</div>
					</a>
				</div>

				<!-- event details -->
				<div class="media-body">
					<h4 class="media-heading"><?php echo $eventdata[$day]['title']; ?></h4>
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
			<div class="media thumbnail">
				<div class="media-left media-top">
					<a href="<?php echo $event;?>" style="width: 64px; height: 64px;">
						<div class="text-center bg-danger" style="width: 64px; height: 64px; line-height:64px;">
							<span class="glyphicon glyphicon-plus" style="width: 64px; height: 64px; line-height:64px;"></span>
						</div>
					</a>
				</div>

				<!-- add event link -->
				<div class="media-body">
					<a href="<?php echo $event;?>" style="width: 64px; height: 64px;">
						<h4 class="media-heading" style="line-height:64px;">Add new event</h4>
					</a>
				</div>
			</div> <!-- end add event thumbnail -->
  </div> <!-- end panel body -->
</div> <!-- end panel -->
