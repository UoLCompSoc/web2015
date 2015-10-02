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
                                echo "<tr>
                                    <td>{$row->fullname}</td>
                                    <td>{$row->total}</td>
                                  </tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
        $this->load->view ( 'include/bootstrapjs.php' );
    ?>
	</div>
</body>
</html>
