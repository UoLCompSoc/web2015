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
            <h4>List User Details</h4><br>

            <table border="1">
                <tbody>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Points</th>
                    <th>View User</th>
                    <th>Edit User</th>
                    <th>Reset Password</th>
                </tr>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?php echo $user->fullname; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->username; ?></td>
                        <?php //TODO add points to user list ?>
                        <td>{POINTS}</td>
                        <td><a href="/index.php/user/view/<?php echo $user->userid; ?>">View</a></td>
                        <td><a href="/index.php/user/edit/<?php echo $user->userid; ?>">Edit</a></td>
                        <td><a href="/index.php/user/reset/<?php echo $user->userid; ?>">Reset</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        $this->load->view('include/bootstrapjs.php');
    ?>
</body>
</html>
