<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_authorized ( Permissions::MAILER_ADMIN );
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Batch Mailer</title>
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
						<p><a href="/mailer/create">Compose</a></p>
						<p><a href="/mailer/view">View Past Mails</a></p>
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
