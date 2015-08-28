<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>

			<a class="navbar-brand" href="/index.php/">CompSoc</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="/index.php/about">About Us</a></li>
				<li><a href="/index.php/bits">Bits</a></li>
				<li><a href="/index.php/projects">Projects</a></li>
				<?php if (get_instance()->session->userdata('logged_in')):?>
				<li><a href="/index.php/profile">Profile</a></li>
				<li><a href="/index.php/login/logout">Logout</a></li>
				<?php else: ?>
				<li><a href="/index.php/login" data-toggle="modal" data-target="#login-modal" name="navbar-login" id="navbar-login">Login</a>
				<script>
					// we change the href to # so that if a user has javascript they get the fancy version
					// but if they don't they'll go to the regular login page.
					$(document).ready(function() {$("a.navbar-login").attr('href', '#');});
				</script>
				<?php endif;?>
				
				
				
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown">Social Media <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo Social::FACEBOOK_URL; ?>" target="_blank">Facebook</a></li>
						<li><a href="<?php echo Social::GITHUB_URL; ?>" target="_blank">GitHub</a></li>
						<li><a href="<?php echo Social::TWITTER_URL; ?>" target="_blank">Twitter</a></li>
						<li><a href="<?php echo Social::LINKEDIN_URL; ?>" target="_blank">LinkedIn</a></li>
						<li><a href="<?php echo Social::GPLUS_URL;?>" target="_blank">Google+</a></li>
						<li><a href="<?php echo Social::STEAM_URL; ?>" target="_blank">Steam</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>