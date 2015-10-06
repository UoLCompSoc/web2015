<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
Permissions::require_logged_in ();

?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Lectures</title>
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
							<h2>Lectures Available</h2>
						</div>
						<?php foreach ($lectures as $lecture) { ?>
						<h3>
							<a href="/lectures/display/<?php echo $lecture->id; ?>"><?php echo $lecture->name; ?></a>
						</h3>
                        <?php } ?>
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
