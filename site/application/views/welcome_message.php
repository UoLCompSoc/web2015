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

<title>CompSoc :: Home</title>

</head>

<body>
	<?php
    $this->load->view('include/navbar.php');
	?>

	<!-- Page Content -->
	<div class="container">

        <?php
        $this->load->view('include/notification_message.php');
	?>
	
	<?php
    $this->load->view('include/flashdata_message.php');
		?>

		<div class="row text-center">
			<h1>CompSoc @ University of Leicester</h1>
		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<?php				
				if (ENVIRONMENT === 'development') {
                    $this->load->view('welcome/devwelcome.php');
				}

                $this->load->view('welcome/welcome.php');
				
				?>
			
			</div>
			<!-- /.row -->

		</div>
		
		</div>
		<!-- /.container -->
		
		<?php
        $this->load->view('include/bootstrapjs.php');
		?>

</body>
</html>
