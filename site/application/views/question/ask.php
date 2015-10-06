<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Questions</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<div class="container">
		<?php $this->load->view('include/sitewide_banner.php'); ?>
		<div class="col-lg-9">
		
		    <div class="row">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>Questions</h2>
						</div>
						
						<p>Got a question? Ask us here and get an answer from committee members and other site users!</p>
						
					</div>
				</div>
			</div>
        </div>
		<?php $this->load->view('include/social_sidebar.php'); ?>	
	</div>


	<?php
	$this->load->view ( 'include/footer.php' );
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
	</div>
</body>
</html>
