<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Static navbar -->
	<nav class="navbar navbar-default" style="width:95%">
		<div class="container-fluid">
			<div class="navbar-header">
				<!-- Brand -->
			    <?php echo anchor(base_url(), config_item('site_name'), 'class="navbar-brand"'); ?>
			    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
			    </button>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
			    <ul class="nav navbar-nav">
			    	<!-- Home -->
					<li class="active navpage"><a href="#">Home</a></li>

					<!-- Calendar -->
					<li class="dropdown navpage">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Calendar <span class="caret"></span></a>
						<!-- Calendar DROPDOWN Menu -->
						<ul class="dropdown-menu navpage">
							<li><a href="#">Events</a></li>
							<li><a href="#">Select</a></li>
							<li><a href="#">Others</a></li>
						</ul>
					</li>

					<li class="dropdown navpage">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<span class="glyphicon glyphicon-user"></span>
							<?php echo ucfirst($this->session->username); ?>
							<span class="caret"></span>
						</a>
						<!-- User DROPDOWN Menu -->
						<ul class="dropdown-menu navpage">
							<li><a href="#">Profile</a></li>
							<li><?php echo anchor(base_url('users/logout'), 'Log out');?></li>
						</ul>
					</li>
			    </ul>

			    <!-- Navbar Right (Unused for now) -->
			    <!--
			    <ul class="nav navbar-nav navbar-right">
			      <li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>
			      <li><a href="../navbar-static-top/">Static top</a></li>
			      <li><a href="../navbar-fixed-top/">Fixed top</a></li>
			    </ul>
			    -->
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>