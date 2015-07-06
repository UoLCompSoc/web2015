<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_authorized(Permissions::USER_ADMIN);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        $this->load->view('include/head_common.php');
    ?>

    <title>CompSoc :: Edit User</title>

</head>

<body>
<?php
    $this->load->view('include/navbar.php');
?>

<!-- Page Content -->
<div class="container">

    <?php
        $this->load->view('include/notification_message.php');
    ?>

    <?php
        $this->load->view('include/flashdata_message.php');
    ?>

    <div class="row text-center">
        <h1>CompSoc @ University of Leicester</h1>
    </div>

    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>View User Details</h2><br>

            <p>Fullname: <?php echo $user->fullname; ?></p>
            <p>Email: <?php echo $user->email; ?></p>
            <p>Username: <?php echo $user->username; ?></p>
            <p>Github: <?php echo $user->githubID; ?></p>
            <p>Linkedin: <?php echo $user->linkedinURL; ?></p>
            <p>Steam: <?php echo $user->steamID; ?></p>

            <h3>Permissions</h3>
            <p>Confirmed User: <?php echo ($permissions['confirmed'] ? 'True': 'False'); ?></p>
            <p>User Admin: <?php echo ($permissions['user'] ? 'True': 'False'); ?></p>
            <p>Points Admin: <?php echo ($permissions['points'] ? 'True': 'False'); ?></p>
            <p>Portfolio Admin: <?php echo ($permissions['portfolio'] ? 'True': 'False'); ?></p>
            <p>Batch User Admin: <?php echo ($permissions['batch'] ? 'True': 'False'); ?></p>

            <h3>Points</h3>
            <table border="1">
                <tbody>
                    <tr>
                        <th>Points</th>
                        <th>Type</th>
                        <th>By</th>
                        <th>Date</th>
                        <th>Comment</th>
                    </tr>
                    <tr>
                        <td>0</td>
                        <td>Academic</td>
                        <td>Someone</td>
                        <td>05/07/2015</td>
                        <td>Comment</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        $this->load->view('include/bootstrapjs.php');
    ?>
</body>
</html>
