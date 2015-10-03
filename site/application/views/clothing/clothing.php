<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Clothing</title>
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
							<h2>Clothing Campaigns</h2>
							<?php if(Permissions::is_authorized(Permissions::CLOTHING_ADMIN)):?>
							<p>
								<a href="/clothing/sizelistview/"><i class="fa fa-cog"></i> Admin: View Size List</a>
							</p>
							<?php endif; ?>
						</div>
						<?php
						if ($campaigns == NULL) {
							?>
						<p>There aren't currently any clothing campaigns running.</p>
						<p>Normally this page is where you'll be able to reserve your t-shirts for bar crawls. Keep checking back for our
							next clothing campaign!</p>
						<?php
						} else {
							foreach ( $campaigns as $campaign ) {
								?>
						<h3>
							<a href="/clothing/details/<?php echo $campaign->id; ?>"><?php echo $campaign->name; ?></a>
						</h3>
						<h4><?php echo $campaign->description; ?></h4>
						<h5>Expires on <?php echo $campaign->expiry_date; ?></h5>

<?php if(Permissions::is_authorized(Permissions::CLOTHING_ADMIN)):?>
<p>
							<a href="/clothing/listview/<?php echo $campaign->id; ?>">View List</a>
						</p>
<?php endif; ?>


<?php }} ?>
						<p></p>
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
