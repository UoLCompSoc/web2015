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
				<li><a href="#">Bits</a></li>
				<li><a href="#">Projects</a></li>
				<?php if (get_instance()->session->userdata('logged_in')):?>
				<li><a href="/index.php/profile">Profile</a></li>
				<li><a href="/index.php/login/logout">Logout</a></li>
				<?php else: ?>
				<li><a href="/index.php/login">Login</a>
				<?php endif;?>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>