<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Events Calendar</title>
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
							<h2>Events Calendar</h2>
						</div>

						<div class="responsive-iframe-container">
							<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;height=600&amp;wkst=2&amp;bgcolor=%23ffffff&amp;src=qnj1ebvrt9mvhng4pqhqr8npio%40group.calendar.google.com&amp;color=%2328754E&amp;ctz=Europe%2FLondon" style=" border-width:0 " frameborder="0" scrolling="no"></iframe>
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
