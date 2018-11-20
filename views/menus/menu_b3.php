<!DOCTYPE html>
<html lang="en">
<head>	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>
		<?php echo $page_title; ?>
	</title>	
	
	<link rel="stylesheet" href="<?php echo base_url()?>components/css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>components/css/bootstrap-theme.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>components/css/b3.css" />
	
	<!--<link rel="stylesheet" href="?php echo base_url()?>components/css/anstyle.css" />-->
	
	<script src="<?php echo base_url()?>components/js/jquery-2.1.1.js"></script>
	<script src="<?php echo base_url()?>components/js/bootstrap.js"></script>
	<script src="<?php echo base_url()?>components/js/b3.js"></script>		
</head>

<body>
	<!-- Inverse icons navigation bar -->	
	<nav class="navbar navbar-inverse" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->			
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">sims</a>
		</div>
		
		<!-- All the menus from Database -->
		<?php echo $this->dynamic_menu->build_menu(); ?>

		<!-- User settings menu -->
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">					
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> </a>
				<ul class="dropdown-menu">	
					<li><a href="#"><span class="glyphicon glyphicon-cog"></span> Settings </a></li>
					<li class="divider"></li>
					<li><a href="<?=site_url('logout')?>"><span class="glyphicon glyphicon-log-out"></span> Log out </a></li>					
				</ul>
			</li>
			<!-- Search form dropdown -->
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-search"></span> </a>
				<ul class="dropdown-menu">
					<form class="navbar-form" role="search">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">Go!</button>
							</span>
						</div>
					</form>
				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav><!-- /.navbar -->