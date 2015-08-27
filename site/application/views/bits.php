<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Bits</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>
	
	<div class="container">
		<?php
		$this->load->view ( 'include/sitewide_banner.php' );
		?>
		
		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>Bits @ CompSoc</h2>
						</div>

						<p>Bits are a bonus you get from interacting with CompSoc! By
							coming to events, joining us on socials or by participating in
							projects, you earn bits.</p>
						<p>At certain points throughout the year, people with a lot of
							bits could be in for some cool prizes and rewards, all totally
							for free!</p>
						<p>All you need to do is be a member and do stuff; you collect
							bits just by joining in, so why not get involved?</p>
					</div>
				</div>
			</div>
	
		<?php $this->load->view('include/social_sidebar.php'); ?>
		</div>
	</div>
	
	<?php
	$this->load->view ('include/footer.php');
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
</body>
</html>
