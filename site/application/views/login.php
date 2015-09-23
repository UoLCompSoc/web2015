<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Login</title>

</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<!-- Page Content -->
	<div class="container">
		<?php $this->load->view('include/sitewide_banner.php'); ?>
		
		<?php
		$validation_errors = validation_errors ();
		if ($validation_errors !== '' || isset ( $message )) :
		?>
		<div class="row alert alert-danger">
			<?php
			echo $validation_errors;
			echo (isset ( $message ) ? $message : '');
			?>
		</div>
		<?php endif; ?>
		
		<?php
		$this->load->view ( 'include/flashdata_message.php' );
		?>

		<div class="row">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="page-header">
						<h2>Register with CompSoc</h2>
					</div>
					
					<h4>Register</h4>
					<br>
					<?php echo form_open('login/register_process'); ?>
						<label for="reg_fname" class="sr-only">First Name</label>
						<input type="text" name="reg_fname" id="reg_fname" class="form-control" placeholder="First Name" value="<?php echo set_value('reg_fname');?>"><br>
						
						<label for="reg_lname" class="sr-only">Last Name</label>
						<input type="text" name="reg_lname" id="reg_lname" class="form-control" placeholder="Last Name" value="<?php echo set_value('reg_lname'); ?>"><br>
						
						<label for="reg_email" class="sr-only">E-Mail Address</label>
						<input type="text" name="reg_email" id="reg_email" class="form-control" placeholder="E-Mail Address" value="<?php echo set_value('reg_email'); ?>"><br>
						
						<label for="reg_password1" class="sr-only">Password</label>
						<input type="password" name="reg_password1" id="reg_password1" class="form-control" placeholder="Password"><br>
						
						<label for="reg_password2" class="sr-only">Confirm password</label>
						<input type="password" name="reg_password2" id="reg_password2" class="form-control" placeholder="Confirm Password"><br>
						
						<input type="submit" value="Register" name="reg_submit" id="reg_submit" class="btn btn-primary">
					<?php echo form_close(); ?>
					
					<br>
					
					<p>Already have an account? Login here!</p>
					<?php echo form_open('login/login_process'); ?>
						<label for="email" class="sr-only">E-mail Address</label>
						<input type="text" name="email" id="email" class="form-control" placeholder="E-Mail Address" value="<?php echo set_value('email'); ?>"><br>
						
						<label for="password" class="sr-only">Password</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password"><br>
						
						<input type="submit" value="Login" name="submit" id="submit" class="btn btn-primary">
					<?php echo form_close(); ?>
		
				</div>
			</div>
		</div>
	</div>
		
	<?php
	$this->load->view ( 'include/footer.php' );
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
</body>
</html>
