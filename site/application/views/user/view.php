<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_authorized ( Permissions::USER_ADMIN );
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php
				$this->load->view ( 'include/head_common.php' );
				?>

    <title>CompSoc :: View User</title>

</head>

<body>
<?php
$this->load->view ( 'include/navbar.php' );
?>

<!-- Page Content -->
	<div class="container">

	<?php
	$this->load->view ( 'include/notification_message.php' );
	?>

	<?php
	$this->load->view ( 'include/flashdata_message.php' );
	?>


		<div class="row">
			<div class="col-lg-12 text-center">
				<h2><?php echo $user->fullname; ?> <a href="/user/edit/<?php echo $user->userid; ?>"><i
						class="fa fa-cog"></i></a>
				</h2>
				<h4>Full User Details</h4>
				<br>

				<p>User ID: <?php echo $user->userid; ?></p>
				<p>Email: <?php echo $user->email; ?></p>
				<p>Github: <?php echo $user->githubID; ?></p>
				<p>Linkedin: <?php echo $user->linkedinURL; ?></p>
				<p>Steam: <?php echo $user->steamID; ?></p>
				<p>Twitter: <?php echo $user->twitterID; ?></p>
				<h3>Permissions</h3>
				<p>Confirmed User: <i class="fa fa-<?php echo ($permissions['confirmed'] ? 'check': 'times'); ?>"></i></p>
				<p>User Admin: <i class="fa fa-<?php echo ($permissions['user'] ? 'check': 'times'); ?>"></i></p>
				<p>Points Admin: <i class="fa fa-<?php echo ($permissions['points'] ? 'check': 'times'); ?>"></i></p>
				<p>Portfolio Admin: <i class="fa fa-<?php echo ($permissions['portfolio'] ? 'check': 'times'); ?>"></i></p>
				<p>Batch User Admin: <i class="fa fa-<?php echo ($permissions['batch'] ? 'check': 'times'); ?>"></i></p>
				<p>Batch Mailer: <i class="fa fa-<?php echo ($permissions['batch'] ? 'check': 'times'); ?>"></i></p>

				<h3>Points</h3>
				<table class="table table-striped">
					<tr>
						<th>Assigner</th>
						<th>Amount</th>
						<th>Type</th>
						<th>Date</th>
						<th>Comment</th>
					</tr>
						<?php
						foreach ( $points as $row ) :
							?>
						<tr>
						<td><?php echo $row->Assigner; ?></td>
						<td><?php echo $row->amount; ?></td>
						<td><?php echo $row->type; ?></td>
						<td><?php echo $row->date; ?></td>
						<td><?php echo $row->comment; ?></td>
					</tr>
						<?php endforeach; ?>
				</table>
			</div>
		</div>
	<?php
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
</div>
</body>
</html>
