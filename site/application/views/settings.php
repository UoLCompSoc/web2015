<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_logged_in ();

$CI = & get_instance ();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Account Settings</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>
	
	<div class="container">
		<?php
		$this->load->view ( 'include/sitewide_banner.php' );
		$this->load->view ( 'include/notification_message.php' );
		$this->load->view ( 'include/account_confirmation_dialog.php' );
		
		$validation_errors = validation_errors ();
		if ($validation_errors !== '') :
			?>
		<div class="row alert alert-danger">
			<?php
			echo $validation_errors;
			?>
		</div>
		<?php endif; ?>
	
		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>Settings</h2>
						</div>

						<h3><?php echo $fullname; ?></h3>
						<h4><?php echo $email;?></h4>
						<p>Member since <?php echo $datejoined; ?></p>

						<h3>Update Social Media Details</h3>
						
						<?php echo form_open("profile/update_profile"); ?>
							<div class="form-group">
							<label for="steamID" class="control-label">Steam ID <i class="fa fa-steam"></i></label> <input type="text"
								name="steamID" id="steamID" class="form-control" placeholder="Steam ID" value="<?php echo $steamID;?>"><br>
						</div>

						<div class="form-group">
							<label for="linkedInID">LinkedIn URL <i class="fa fa-linkedin"></i></label> <input type="text" name="linkedInID"
								id="linkedInID" class="form-control" placeholder="LinkedIn ID" value="<?php echo $linkedinURL;?>"><br>
						</div>

						<div class="form-group">
							<label for="githubID">GitHub ID <i class="fa fa-github"></i></label> <input type="text" name="githubID"
								id="githubID" class="form-control" placeholder="GitHub ID" value="<?php echo $githubID; ?>" maxlength="39"><br>
						</div>

						<div class="form-group">
							<label for="twitterID">Twitter Handle <i class="fa fa-twitter"></i></label>
							<!-- Max length = 16 to include the @ -->
							<input type="text" name="twitterID" id="twitterID" class="form-control" placeholder="Twitter ID"
								value="<?php echo $twitterID;?>" maxlength="16"><br>
						</div>

						<input type="submit" value="Update Details" name="updateDetails" id="updateDetails" class="btn btn-primary">
						<?php echo form_close(); ?>
						
						<h3>Change Password</h3>
						
						<?php echo form_open("profile/change_password"); ?>
						<!-- <div class="form-group">
								<label for="oldPassword">Old Password</label>
								<input type="password" name="oldPassword" id="oldPassword" class="form-control" placeholder="Old Password">
							</div>
							 -->

						<div class="form-group">
							<label for="newPassword1">New Password</label> <input type="password" name="newPassword1" id="newPassword1"
								class="form-control" placeholder="New Password">
						</div>

						<div class="form-group">
							<label for="newPassword2">New Password (again)</label> <input type="password" name="newPassword2"
								id="newPassword2" class="form-control" placeholder="New Password (again)">
						</div>

						<input type="submit" value="Change Password" name="updateDetails" id="updateDetails" class="btn btn-primary">
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
			
			<?php $this->load->view('include/social_sidebar.php'); ?>
		</div>
	</div>
	
	<?php
	$this->load->view ( 'include/footer.php' );
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
</body>
</html>
