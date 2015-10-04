<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
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
		
		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>Batch Mailer</h2>
						</div>
						<?php echo form_open('mailer/create'); ?>
						<div class="form-group">
							<label for="subject">Subject</label> <input type="text"
								id="subject" name="subject" class="form-control"
								placeholder="Subject">
						</div>
						
						<div class="form-group">
							<label for="body">Body</label>
							<textarea rows="10" cols="10" name="body" id="body" class="form-control"></textarea>
						</div>

						<input type="submit" value="Register" name="reg_submit"
							id="reg_submit" class="btn btn-primary">
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
