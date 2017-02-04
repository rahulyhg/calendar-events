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
  <?php if($eventlist): ?>
  		<?php foreach ($eventlist as $type => $events): ?>
  			<div><?php echo ucfirst($type).' Events'; ?></div>
			<?php foreach ($events as $s => $event): ?>
				<?php $date = explode('-', $event['date']); ?>
				<?php $id = $event['id'];?>
					<!-- the event thumbnail -->
					<div class="media thumbnail">
						<div class="media-left media-top">
							<div>
								<small class="text-danger"><?php echo $date[1] > 9 ? $date[1] : "0{$date[1]}"; ?></small>
							</div>
							<div>
								<small><i><?php echo $date[2] > 9 ? $date[2] : "0{$date[2]}"; ?></i></small>
							</div>
						</div>

						<!-- event details -->
						<div class="media-body">
							<h4 class="media-heading"><a href="<?php echo base_url('users/home/events/'.$event['date'].'/'.$id); ?>"><?php echo ucfirst($event['name']); ?></a></h4>
							<?php echo $event['description'] ?><br />
							<!-- <a data-toggle="collapse" data-target="#comments<?php echo $id; ?>" >Comments</a> -->

							<!-- collapsed comments -->
							<!-- <div class="collapse" id="comments<?php echo $id; ?>"> -->
								<!-- Nested comment media object -->
								<!-- <div class="media">
									<div class="media-left">
										<span class="glyphicon glyphicon-user" width=50px height=50px></span>
									</div>

									<div class="media-body">
										<h4 class="media-heading">John Doe <small><i>February 21, 2016</i></small></h4>
										comments
									</div>
								</div> -->
							<!-- </div>  --><!-- end comments -->
						</div> <!-- end event details -->
					</div> <!-- end event thumbnail -->
			<?php endforeach; ?>
		<?php endforeach; ?>
	<?php endif; ?>

		<!-- add event thumbnail -->
		<!-- <a href="<?php echo base_url('events/create'); ?>">
			<div class="media thumbnail">
				<div class="media-left media-top">	
					<div>
						<span class="glyphicon glyphicon-plus"></span>
					</div>
				</div>

				<div class="media-body">
					<h4 class="media-heading">Add new event</h4>
				</div>
			</div> --> <!-- end add event thumbnail -->
		<a>
  </div> <!-- end panel body -->
</div> <!-- end panel -->
