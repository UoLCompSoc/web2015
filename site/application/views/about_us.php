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
require_once 'include/head_common.php';
?>

<title>CompSoc :: About</title>

</head>

<body>
	<?php
	require_once 'include/navbar.php';
	?>

	<!-- Page Content -->
	<div class="container">

		<div class="row text-center">
			<h1>CompSoc @ University of Leicester</h1>
		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<p>
					CompSoc is <em>your</em> academic society at the University of
					Leicester if you do any kind of programming!
				</p>
				<p>We run regular academic sessions from extracurricular group
					projects to lectures to help you get the most from your time at the
					University of Leicester, and ideally get everyone good jobs after
					they graduate!</p>
				<p>But of course, we recognise that it's not all about work, and we
					have regular scheduled social events both by ourselves and also
					mixed with other great societies at Leicester, meaning there's always a way for you to get involved.</p>
			</div>
			<!-- /.row -->

		</div>
		<!-- /.container -->
		
		<?php
		require_once 'include/bootstrapjs.php';
		?>



</body>
</html>
