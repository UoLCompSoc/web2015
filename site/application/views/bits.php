<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
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

<title>CompSoc :: Bits</title>

</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<!-- Page Content -->
	<div class="container">
		<div class="row text-center">
			<h1>Bits @ CompSoc</h1>
		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<p>Bits are a bonus you get from interacting with CompSoc! By coming to events, joining us on socials or by participating in projects, you earn bits.</p>
				<p>At certain points throughout the year, people with a lot of bits could be in for some cool prizes and rewards, all totally for free!</p>
				<p>All you need to do is be a member and do stuff; you collect bits just by joining in, so why not get involved?</p>
			</div>
		</div>
	</div>
		
	<?php
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
</body>
</html>
