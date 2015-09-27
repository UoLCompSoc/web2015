<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_authorized ( Permissions::POINTS_ADMIN );
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

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

<!-- Page Content -->
	<div class="container">

    <?php
				$this->load->view ( 'include/notification_message.php' );
				?>

    <?php
				$validation_errors = validation_errors ();
				if ($validation_errors !== '' || isset ( $errormessage )) :
					?>
        <div class="row">
			<div class="col-lg-12 text-center alert alert-danger">
                <?php
					echo $validation_errors;
					echo (isset ( $errormessage ) ? $errormessage : '');
					?>
            </div>
		</div>
    <?php endif; ?>

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

    <div class="row text-center">
			<h1>CompSoc @ University of Leicester</h1>
		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<h4>Points Details for <?php echo $user->fullname; ?> (<?php echo $total; ?> Points)</h4>
				<br>
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

    <script>
        $("#email").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "/index.php/autocomplete/email",
                    data: {
                        emailQuery: request.term
                    },
                    success: function(data) {
                        response(data);
                    },
                    dataType: "json"
                });
            }
        });
    </script>
	</div>
</body>
</html>
