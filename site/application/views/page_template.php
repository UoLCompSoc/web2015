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
$this->load->view('include/head_common.php');
?>

<title>CompSoc :: CHANGEME</title>

</head>

<body>
	<?php
    $this->load->view('include/navbar.php');
	?>

	<!-- Page Content -->
	<div class="container">

	</div>
		
	<?php
    $this->load->view('include/bootstrapjs.php');
	?>
</body>
</html>
