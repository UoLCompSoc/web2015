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
							<h2>Multi-Science Social MKIII</h2>
						</div>

						<p><strong><em>WE'RE BACK BABY!</em></strong></p>
						<p>This time it's going to be bigger than ever! For those of you who weren't there last year it was the biggest bar crawl outside of Rockstar, this year we aim to be bigger.</p>
						<p><strong><em>Route:</em></strong> To be announced.</p>
						<p>We are now taking pre-orders for t-shirts. T-shirts are £10 and include entry into Shabang!</p>
						<p>Contact any committee member to register your interest!</p>
						<p><a href="https://www.facebook.com/events/1691069531107125/">Click Here for the Facebook Event</a></p>
						<p>Checkout the Computer Science t-shirt designs below.</p>
						<div class="row">
							<div class="col-xs-12">
								<img class="img-responsive" src="<?=base_url();?>assets/img/barcrawl-front.jpg" alt="Multiscience barcrawl tshirt design">
							</div>
							<div class="col-xs-12">
								<img class="img-responsive" src="<?=base_url();?>assets/img/barcrawl-back.jpg" alt="Multiscience barcrawl tshirt design">
							</div>
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
