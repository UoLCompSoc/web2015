<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php
$this->load->view ( 'include/head_common.php' );
?>

	<title>CompSoc :: View Points</title>

</head>

<body>
<?php
$this->load->view ( 'include/navbar.php' );
?>

	<div class="container">

	<?php
	$this->load->view ( 'include/notification_message.php' );
	?>

	<?php if(isset($message)): ?>
		<div class="row">
			<div class="col-lg-12 text-center alert alert-success">
				<?php
		echo (isset ( $message ) ? $message : '');
		?>
			</div>
		</div>
	<?php endif; ?>

	<?php
	$this->load->view ( 'include/flashdata_message.php' );
	?>

	<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>Current Leaderboard</h2>
						</div>
						<table class="table table-striped">
							<tr>
								<th>Name</th>
								<th>Total</th>
							</tr>
				<?php
				foreach ( $leaderboard as $row ) {
					echo "<tr><td>{$row->fullname}</td><td>{$row->total}</td></tr>";
				}
				?>
			</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
$this->load->view ( 'include/footer.php' );
$this->load->view ( 'include/bootstrapjs.php' );
?>
</body>
</html>
