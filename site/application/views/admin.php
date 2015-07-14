<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_admin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
/*
 * This should be the first "require" because it contains the charset,
 * which should come directly after the <head> tag.
 */
$this->load->view('include/head_common.php');
?>

<title>CompSoc :: Administrators</title>

</head>

<body>
	<?php
    $this->load->view('include/navbar.php');
	?>

	<!-- Page Content -->
	<div class="container">
	
	<?php if(Permissions::is_authorized(Permissions::USER_ADMIN)):?>
	<div class="row"><div class="col"><p><a href="/index.php/user/">User Admin</a></p></div></div>
	<?php endif; ?>
	
	<?php if (Permissions::is_authorized(Permissions::POINTS_ADMIN)):?>
        <div class="row">
            <div class="col"><p><a href="/index.php/point/">Points Admin</a></p></div>
        </div>
	<?php endif; ?>
	
	<?php if(Permissions::is_authorized(Permissions::PORTFOLIO_ADMIN)):?>
	<div class="row"><div class="col"><p>Portfolio Admin</p></div></div>
	<?php endif; ?>
	
	<?php if(Permissions::is_authorized(Permissions::BATCH_USER_CREATE)):?>
	<div class="row"><div class="col"><p>Batch User Creation</p></div></div>
	<?php endif; ?>

	</div>
		
	<?php
    $this->load->view('include/bootstrapjs.php');
	?>
</body>
</html>
