<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_logged_in();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
/*
 * This should be the first "require" because it contains the charset,
 * which should come directly after the <head> tag.
 */
require_once 'include/head_common.php';
?>

<title>CompSoc :: Profile</title>

</head>

<body>
	<?php
	require_once 'include/navbar.php';
	?>

	<!-- Page Content -->
	<div class="container">
	
	<?php 
	require_once 'include/notification_message.php';
	?>
	
	<?php 
	require_once 'include/account_confirmation_dialog.php';
	?>

	<div class="row">
		<div class="col text-center">
			<h1>Profile</h1>
			<p>Logged in as <?php echo get_instance()->session->userdata('email'); ?></p>
		</div>
	</div>
	
	</div>
		
	<?php
	require_once 'include/bootstrapjs.php';
	?>
</body>
</html>
