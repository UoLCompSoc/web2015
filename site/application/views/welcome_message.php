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
require_once 'head_common.php';
?>

<title>CompSoc :: Home</title>

</head>

<body>
	<?php
	require_once 'navbar.php';
	?>

	<!-- Page Content -->
	<div class="container">

		<div class="row text-center">
			<h1>CompSoc @ University of Leicester</h1>
		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<?php
				require_once 'welcome/welcome.php';
				
				if (ENVIRONMENT === 'development') {
					require_once 'welcome/devwelcome.php';
				}
				
				?>
			
			</div>
			<!-- /.row -->

		</div>
		<!-- /.container -->
		
		<?php
		require_once 'bootstrapjs.php';
		?>

</body>
</html>
