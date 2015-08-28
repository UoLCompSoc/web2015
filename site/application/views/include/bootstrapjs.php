<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true"
	style="display: none;">
	<div class="modal-dialog">
		<div class="loginmodal-container">
			<h1>Login to Your Account</h1>
			<br>
			<?php echo form_open('login/login_process'); ?>
				<input type="text" name="email" id="email" placeholder="Username">
				<input type="password1" name="password" id="password" placeholder="Password">
				<input type="submit" name="submit" id="submit" class="login loginmodal-submit"
					value="Login">
			<?php echo form_close(); ?>

			<div class="login-help">
				<a href="/index.php/login">Register</a>
			</div>
		</div>
	</div>
</div>
 
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script
	src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
	integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ=="
	crossorigin="anonymous"></script>
