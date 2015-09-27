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

    <div class="row text-center">
			<h1>CompSoc @ University of Leicester</h1>
		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<h2><?php echo $user->fullname; ?> - Full User Details</h2>
				<br>

				<p>Email: <?php echo $user->email; ?></p>
				<p>Username: <?php echo $user->username; ?></p>
				<p>Github: <?php echo $user->githubID; ?></p>
				<p>Linkedin: <?php echo $user->linkedinURL; ?></p>
				<p>Steam: <?php echo $user->steamID; ?></p>
				<p>Twitter: <?php echo $user->twitterID; ?></p>

				<h3>Permissions</h3>
				<p>Confirmed User: <?php echo ($permissions['confirmed'] ? 'True': 'False'); ?></p>
				<p>User Admin: <?php echo ($permissions['user'] ? 'True': 'False'); ?></p>
				<p>Points Admin: <?php echo ($permissions['points'] ? 'True': 'False'); ?></p>
				<p>Portfolio Admin: <?php echo ($permissions['portfolio'] ? 'True': 'False'); ?></p>
				<p>Batch User Admin: <?php echo ($permissions['batch'] ? 'True': 'False'); ?></p>

				<h3>Points</h3>
				<table border="1">
					<tr>
						<th>Assigner</th>
						<th>Amount</th>
						<th>Type</th>
						<th>Date</th>
						<th>Comment</th>
					</tr>
                <?php
																
foreach ( $points as $row ) {
																	echo "<tr>
                            <td>{$row->Assigner}</td>
                            <td>{$row->amount}</td>
                            <td>{$row->type}</td>
                            <td>{$row->date}</td>
                            <td>{$row->comment}</td>
                          </tr>";
																}
																?>
            </table>
			</div>
		</div>
    <?php
				$this->load->view ( 'include/bootstrapjs.php' );
				?>
</div>
</body>
</html>
