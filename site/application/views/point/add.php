<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_authorized(Permissions::POINTS_ADMIN);
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

    <?php
    $this->load->view('include/head_common.php');
    ?>

    <title>CompSoc :: Add Points</title>

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
    $validation_errors = validation_errors();
    if ($validation_errors !== '' || isset($errormessage)):
        ?>
        <div class="row">
            <div class="col-lg-12 text-center alert alert-danger">
                <?php
                echo $validation_errors;
                echo (isset($errormessage) ? $errormessage : '');
                ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if(isset($message)): ?>
        <div class="row">
            <div class="col-lg-12 text-center alert alert-success">
                <?php
                echo (isset($message) ? $message : '');
                ?>
            </div>
        </div>
    <?php endif; ?>

    <?php
        $this->load->view('include/flashdata_message.php');
    ?>

    <div class="row text-center">
        <h1>CompSoc @ University of Leicester</h1>
    </div>

    <div class="row">
        <div class="col-lg-12 text-center">
            <h4>Add Points Details</h4><br>
            <?php echo form_open('point/add'); ?>

            <label for="email" class="sr-only">Email:</label>
            <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="<?php echo set_value('email', $email); ?>"/><br>

            <label for="amount" class="sr-only">Amount:</label>
            <input id="amount" name="amount" type="number" class="form-control" placeholder="Amount" value="<?php echo set_value('amount', $amount); ?>" /><br>

            <label for="pointtype" class="sr-only">Point Type:</label>
            <div class="controls">
                <?php foreach($pointtypes as $row) { ?>
                    <div class="radio">
                        <label>
                            <?php echo form_radio('pointtype', $row->id, ($row->id == $pointtype)); // Check if the selected type is this one ?>
                        </label>
                        <?php echo $row->title . ' - ' . $row->description; ?>
                    </div>
                <?php } ?>
            </div>

            <label for="comment" class="sr-only">Comment:</label>
            <textarea id="comment" name="comment" class="form-control" placeholder="Comment"><?php echo set_value('comment', $comment); ?></textarea>
            <br />
            <input type="submit" value="Add Points" name="submit" id="submit" class="btn btn-primary">
        </div>
        <!-- /.row -->
        <?php echo form_close(); ?>
    </div>
    <?php
        $this->load->view('include/bootstrapjs.php');
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
