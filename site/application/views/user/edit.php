<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_authorized ( Permissions::USER_ADMIN );
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Edit User</title>
</head>

<body>
<?php
$this->load->view ( 'include/navbar.php' );
?>

<div class="container">

    <?php
				$this->load->view ( 'include/notification_message.php' );
				?>

    <?php
				$validation_errors = validation_errors ();
				if ($validation_errors !== '' || isset ( $errormessage )) :
					?>
        <div class="row">
			<div class="col-lg-12 text-center alert alert-danger">
                <?php
					echo $validation_errors;
					echo (isset ( $errormessage ) ? $errormessage : '');
					?>
            </div>
		</div>
    <?php endif; ?>

    <?php if(isset($message)): ?>
        <div class="row">
			<div class="col-lg-12 text-center alert alert-success">
                <?php
					echo (isset ( $message ) ? $message : '');
					?>
            </div>
		</div>
    <?php endif; ?>

    <?php
				$this->load->view ( 'include/flashdata_message.php' );
				?>

    <div class="row text-center">
			<h1>CompSoc @ University of Leicester</h1>
		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<h4>Edit User Details</h4>
				<br>
            <?php echo form_open('user/edit'); ?>

            <input id="userid" name="userid" type="hidden" value="<?php echo set_value('userid', $userid);?>" /> <label
					for="email" class="sr-only">Email:</label> <input id="email" name="email" type="text" class="form-control"
					placeholder="Email" value="<?php echo set_value('email', $email); ?>" /><br> <label for="fullname" class="sr-only">Full
					Name:</label> <input id="fullname" name="fullname" type="text" class="form-control" placeholder="Full Name"
					value="<?php echo set_value('fullname', $fullname); ?>" /><br> <br> <label for="githubID" class="sr-only">Github
					ID:</label> <input id="githubID" name="githubID" type="text" class="form-control" placeholder="Github ID"
					value="<?php echo set_value('githubID', $githubID); ?>" /><br> <label for="linkedinURL" class="sr-only">Linkedin
					URL:</label> <input id="linkedinURL" name="linkedinURL" type="text" class="form-control" placeholder="Linkedin URL"
					value="<?php echo set_value('linkedinURL', $linkedinURL); ?>" /><br> <label for="steamID" class="sr-only">Steam ID:</label>
				<input id="steamID" name="steamID" type="text" class="form-control" placeholder="Steam ID"
					value="<?php echo set_value('steamID' , $steamID); ?>" /><br> <label for="twitterID" class="sr-only">Twitter
					Handle:</label> <input id="twitterID" name="twitterID" type="text" class="form-control"
					placeholder="Twitter Handle" value="<?php echo set_value("twitterID", $twitterID); ?>"><br>


				<h5>Permissions:</h5>

				<label for="p_confirmed">Confirmed:</label> <input id="p_confirmed" name="p_confirmed" type="checkbox" value="1"
					<?php echo ($permissions['confirmed'] == 1 ? 'checked':''); ?> /><br> <label for="p_user">User Admin:</label> <input
					id="p_user" name="p_user" type="checkbox" value="1" <?php echo ($permissions['user'] == 1 ? 'checked':''); ?> /><br>

				<label for="p_points">Points Admin:</label> <input id="p_points" name="p_points" type="checkbox" value="1"
					<?php echo ($permissions['points'] == 1 ? 'checked':''); ?> /><br> <label for="p_portfolio">Portfolio Admin:</label>
				<input id="p_portfolio" name="p_portfolio" type="checkbox" value="1"
					<?php echo ($permissions['portfolio'] == 1 ? 'checked':''); ?> /><br> <label for="p_batch">Batch User Admin:</label>
				<input id="p_batch" name="p_batch" type="checkbox" value="1"
					<?php echo ($permissions['batch'] == 1 ? 'checked':''); ?> /><br> <input type="submit" value="Update" name="submit"
					id="submit" class="btn btn-primary">
			</div>
			<!-- /.row -->
        <?php echo form_close(); ?>
    </div>
	</div>
    <?php
				$this->load->view ( 'include/footer.php' );
				$this->load->view ( 'include/bootstrapjs.php' );
				?>
</body>
</html>
