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

<title>CompSoc :: Past Mail #<?php echo $mail["id"]; ?></title>
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
							<h2>Past Mail #<?php echo $mail["id"]; ?></h2>
						</div>
						<table class="table table-striped">
							<tr>
								<td><strong>Sent:</strong> <?php echo $mail["sentDate"]; ?>

								<td><strong>By:</strong> <?php echo $mail["email"]; ?></td>

								<td><strong>Commitee Only?</strong> <i class="fa fa-<?php echo ($mail["committeeOnly"] ? 'check': 'times'); ?>"></i></td>
							</tr>

							<tr>
								<td colspan="3"><strong>Subject:</strong> <?php echo $mail["subject"]; ?></td>
							</tr>

							<tr>
								<td colspan="3"><?php echo htmlspecialchars($mail["emailText"]); ?></td>
							</tr>
						</table>
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
