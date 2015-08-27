<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_logged_in ();

$CI = & get_instance ();
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

<title>CompSoc :: Profile</title>

</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<!-- Page Content -->
	<div class="container">

        <?php
								$this->load->view ( 'include/notification_message.php' );
								?>

        <?php
								$this->load->view ( 'include/account_confirmation_dialog.php' );
								?>

	<div class="row">
			<div class="col text-center">
				<h1>Profile</h1>
				<p>Logged in as <?php echo $CI->session->userdata('email'); ?>.</p>
			
			<?php if (Permissions::is_admin()): ?>
			<p>
					Go to <a href="/index.php/admin">your admin panel.</a>
				</p>
			<?php endif;?>
			
			<p>You have
			<?php
			Points::echo_pretty_points();
			?>.</p>
			</div>
		</div>
	
	<?php
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
	
	</div>
</body>
</html>
