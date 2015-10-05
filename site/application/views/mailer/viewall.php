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

<title>CompSoc :: View Past Mails</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<!-- Page Content -->
	<div class="container">
		<?php $this->load->view('include/sitewide_banner.php'); ?>
		<?php $this->load->view('include/notification_message.php'); ?>

		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>Past Batch Mails</h2>
						</div>

						<table class="table table-striped">
							<tr>
								<th>ID #</th>
								<th>Author</th>
								<th>Date Sent</th>
								<th>Subject</th>
								<th>Raw Version</th>
							</tr>

						<?php foreach ($pastMails as $mail) {?>
							<tr>
								<td><?php echo $mail["id"]; ?> </td>
								<td><?php echo $mail["email"]; ?></td>
								<td><?php echo $mail["sentDate"]; ?></td>
								<td><a href="/mailer/view/<?php echo $mail["id"]; ?>"><?php echo $mail["subject"]; ?></a></td>
								<td><a href="/mailer/viewraw/<?php echo $mail["id"]; ?>">View Raw</a></td>
							</tr>
						<?php } ?>
						</table>
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
