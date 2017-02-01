<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('USERKOTYPE') or exit('No direct script access allowed'); // can only be accessed from child of member_controller
?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Events</h3>
  </div>
  <div class="panel-body">
    <div class="media">
	  <div class="media-left media-top">
		<a href="#">
			<div style="width: 64px; height: 64px; background-color: grey;">
				The date will be here
			</div>
	    </a>
		</div>
		<div class="media-body">
	    <h4 class="media-heading">Media heading</h4>
	    About the event<br />
	    <a data-toggle="collapse" data-target="#comments" >comments</a>

	    <div class="collapse" id="comments">
			<!-- Nested media object -->
			<div class="media">
				<div class="media-left">
					<span class="glyphicon glyphicon-user" width=50px height=50px></span>
				</div>
				<div class="media-body">
					<h4 class="media-heading">John Doe <small><i>February 21, 2016</i></small></h4>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				</div>
			</div>
		</div>
	  </div>
	</div>
  </div>
</div>
