<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
Permissions::require_authorized ( Permissions::CLOTHING_ADMIN);
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
/*
 * This should be the first "require" because it contains the charset,
 * which should come directly after the <head> tag.
 */
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Clothing</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<!-- Page Content -->
	<div class="container">
		<?php $this->load->view('include/sitewide_banner.php'); ?>


        <?php
        if (isset ( $errormessage )) :
            ?>
            <div class="row">
                <div class="col-lg-12 text-center alert alert-danger">
                    <?php
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


		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
                            <h2>Add New Size</h2>
                            <p><a href="/clothing/sizelistview">View All Sizes</a></p>
						</div>
                        <?php echo form_open('clothing/addsize'); ?>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input name="name" type="text" class="form-control" id="name" value="<?php echo $name; ?>">
                        </div>

                        <div class="form-group">
                            <label for="desc">Description:</label>
                            <input name="desc" type="text" class="form-control" id="desc" value="<?php echo $desc; ?>">
                        </div>

                        <button type="submit" class="btn btn-default">Add Size</button>

                        <?php echo form_close(); ?>
					</div>
				</div>
			</div>
			
			<?php $this->load->view('include/social_sidebar.php'); ?>
		</div>
	</div>
	
	<?php
	$this->load->view ( 'include/footer.php' );
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
</body>
</html>
