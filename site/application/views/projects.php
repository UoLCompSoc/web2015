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

<title>CompSoc :: Projects</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<!-- Page Content -->
	<div class="container">
		<?php $this->load->view('include/sitewide_banner.php'); ?>
		
		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>CompSoc Projects</h2>
						</div>
						<p>Here we're building a project portfolio, so we can show off the cool stuff we've done. A great example is the
							portfolio itself: a CompSoc project with multiple team members taking part.</p>

						<p>
							Check out the progress <a href="https://github.com/UoLCompSoc/web2015" target="_blank">on <i class="fa fa-github"></i>GitHub
							</a> and throw us a star!
						</p>

						<p>
							<iframe src="https://ghbtns.com/github-btn.html?user=UoLCompSoc&repo=web2015&type=star&count=true&size=large"
								frameborder="0" scrolling="0" width="160px" height="30px"></iframe>
						</p>
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
