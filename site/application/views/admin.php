<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_admin ();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Administrators</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<!-- Page Content -->
	<div class="container">
    <?php if(Permissions::is_authorized(Permissions::USER_ADMIN)):?>
	    <div class="row">
			<div class="col">
				<p>
					<a href="/user/">User Admin</a>
				</p>
			</div>
		</div>
	<?php endif; ?>

	<?php if (Permissions::is_authorized(Permissions::POINTS_ADMIN)):?>
        <div class="row">
			<div class="col">
				<p>
					<a href="/point/">Points Admin</a>
				</p>
			</div>
		</div>
	<?php endif; ?>

	<?php if(Permissions::is_authorized(Permissions::PORTFOLIO_ADMIN)):?>
	    <div class="row">
			<div class="col">
				<p>
					<a href="/webhook/update">Update Projects</a>
				</p>
			</div>
		</div>
	<?php endif; ?>

	<?php if(Permissions::is_authorized(Permissions::BATCH_USER_CREATE)):?>
	<div class="row">
			<div class="col">
				<p>
					<a href="/batch/">Batch User Creation</a>
				</p>
			</div>
		</div>
	<?php endif; ?>

    <?php if(Permissions::is_authorized(Permissions::CLOTHING_ADMIN)):?>
        <div class="row">
			<div class="col">
				<p>
					<a href="/clothing/listview/">Clothing Admin</a>
				</p>
			</div>
		</div>
    <?php endif; ?>
    
    <?php if(Permissions::is_authorized(Permissions::MAILER_ADMIN)): ?>
		<div class="row">
			<div class="col">
				<p>
					<a href="/mailer">Batch Mailing</a>
				</p>
			</div>
		</div>
    
    <?php endif; ?>

	</div>

	<?php
	$this->load->view ( 'include/footer.php' );
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
</body>
</html>
