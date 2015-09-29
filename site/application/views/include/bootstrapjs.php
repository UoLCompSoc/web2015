<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
	style="display: none;">
	<div class="modal-dialog">
		<div class="loginmodal-container">
			<h1>Login to Your Account</h1>
			<br>
			<?php echo form_open('login/login_process'); ?>
				<label for="email" class="sr-only">E-Mail</label> <input type="text" name="email" id="email" placeholder="E-Mail"> <label
				for="password" class="sr-only">Password</label> <input type="password" name="password" id="password"
				placeholder="Password"> <input type="submit" name="submit" id="submit" class="login loginmodal-submit" value="Login">
			<?php echo form_close(); ?>

			<div>
				<a class="btn btn-danger btn-block" href="/login">Register</a>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
