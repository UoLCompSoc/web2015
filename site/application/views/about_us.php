<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: About</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<div class="container">
		<?php $this->load->view('include/sitewide_banner.php'); ?>
		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>CompSoc @ University of Leicester</h2>
						</div>

						<p>
							CompSoc is <em>your</em> academic society at the University of
							Leicester if you do any kind of programming!
						</p>
						<p>We run regular academic sessions from extracurricular group
							projects to lectures to help you get the most from your time at
							the University of Leicester, and ideally get everyone good jobs
							after they graduate!</p>
						<p>But of course, we recognise that it's not all about work, and
							we have regular scheduled social events both by ourselves and
							also mixed with other great societies at Leicester, meaning
							there's always a way for you to get involved.</p>
					</div>
				</div>
			</div>
			
			<?php $this->load->view('include/social_sidebar.php'); ?>
		</div>
	</div>
		
	<?php
	$this->load->view ( 'include/footer.php' );
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
</body>
</html>
