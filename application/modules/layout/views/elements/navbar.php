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

			<?php if (defined('USERKOTYPE')): ?>
				<div id="navbar" class="navbar-collapse collapse">
				    <ul class="nav navbar-nav pull-right">

						<li class="dropdown navpage">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<span class="glyphicon glyphicon-user"></span>
								<?php echo ucfirst($this->session->username); ?>
								<span class="caret"></span>
							</a>
							<!-- User DROPDOWN Menu -->
							<ul class="dropdown-menu navpage">
								<li><a href="<?php echo base_url('users/profile');?>">Profile</a></li>
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
			<?php endif; ?>
		</div><!--/.container-fluid -->
	</nav>

	<?php if ($this->session->flashdata('success')): ?>
		<p class="bg-success text-success" style="width: 95%;">
			<?php echo $this->session->flashdata('success'); ?>
		</p>
	<?php endif; ?>
