<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_authorized ( Permissions::MAILER_ADMIN );
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
/*
 * This should be the first "require" because it contains the charset,
 * which should come directly after the <head> tag.
 */
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Compose a Mail</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<!-- Page Content -->
	<div class="container">
		<?php $this->load->view('include/sitewide_banner.php'); ?>
		<?php
		$this->load->view('include/notification_message.php');
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
								<h2>Batch Mailer</h2>
							</div>
						<?php echo form_open('mailer/create'); ?>
						<div class="form-group">
								<label for="subject">Subject</label> <input type="text" id="subject" name="subject" class="form-control"
									placeholder="Subject">
							</div>

							<div class="form-group">
								<label for="body">Body</label>
								<textarea rows="10" cols="10" name="body" id="body" class="form-control"></textarea>
							</div>

							<input type="submit" value="Send" name="send" id="send" class="btn btn-primary">
						<?php echo form_close(); ?>
					</div>
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
