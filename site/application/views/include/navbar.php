<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>


			<div class="pull-left" style="margin-top: 5px;">
				<img src="<?=base_url();?>assets/img/icon.png" alt="Alien Icon">
			</div>
			<a class="navbar-brand" href="/"> CompSoc </a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/about">About Us</a></li>
				<li><a href="/bits">Bits</a></li>
                <li><a href="/projects">Projects</a></li>
                <li><a href="/calendar">Events Calendar</a></li>

				<?php if (get_instance()->session->userdata('logged_in')): ?>
                <li><a href="/clothing">Clothing</a></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="/profile">Profile</a></li>
						<li><a href="/profile/settings">Settings</a></li>
					</ul></li>
				<?php if (Permissions::is_admin()): ?>
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="/user">Users</a></li>
						<li><a href="/point">Points</a></li>
						<li><a href="/webhook/update">Update Projects</a></li>
						<li><a href="/batch">Batch User</a></li>
						<li><a href="/clothing/listview">Clothing</a></li>
					</ul></li>
				<?php endif; ?>
				<li><a href="/login/logout">Logout</a></li>
				<?php else: ?>
				<li><a href="/login" data-toggle="modal" data-target="#login-modal" id="navbar-login">Login</a> <script>
					// we change the href to # so that if a user has javascript they get the fancy version
					// but if they don't they'll go to the regular login page.
					$(document).ready(function() {$("a.navbar-login").attr('href', '#');});
				</script>

				<li><a href="/index.php/login">Register</a></li>
				<?php endif;?>

				<li><a href="http://www.leicesterunion.com/groups/computing" target="_blank">Pay Membership</a></li>

				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Social Media <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo Social::FACEBOOK_URL; ?>" target="_blank"><i class="fa fa-facebook"></i> Facebook</a></li>
						<li><a href="<?php echo Social::TWITTER_URL; ?>" target="_blank"><i class="fa fa-twitter"></i> Twitter</a></li>
						<li><a href="<?php echo Social::GITHUB_URL; ?>" target="_blank"><i class="fa fa-github"></i> GitHub</a></li>
						<li><a href="<?php echo Social::LINKEDIN_URL; ?>" target="_blank"><i class="fa fa-linkedin"></i> LinkedIn</a></li>
						<li><a href="<?php echo Social::GPLUS_URL;?>" target="_blank"><i class="fa fa-google-plus"></i> Google+</a></li>
						<li><a href="<?php echo Social::STEAM_URL; ?>" target="_blank"><i class="fa fa-steam"></i> Steam</a></li>
					</ul></li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>
