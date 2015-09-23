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

<title>CompSoc :: Profile</title>
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
		?>
	
		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h4 class="pull-right">
								<a href="/index.php/profile/settings" title="Account Settings">
									<i class="fa fa-cog"></i>
								</a>
							</h4>
							
							<h2>Profile</h2>
						</div>

						<p>Logged in as <?php echo $CI->session->userdata('email'); ?>.</p>
						
						<?php if (Permissions::is_admin()): ?>
						<p>
							Go to <a href="/index.php/admin">your admin panel.</a>
						</p>
						<?php endif; ?>
						
						<p>You have <?php Points::echo_pretty_points(); ?>.</p>
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
