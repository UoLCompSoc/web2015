<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
Permissions::require_logged_in ();
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
							<h2><?php echo $campaign->name; ?></h2>
						</div>
						<p>
							<strong>About this campaign: </strong><?php echo $campaign->description; ?></p>

                        <?php if($user_choice->size_id == 0): ?>
                        <div class="alert alert-info" role="alert">You haven't made a selection!</div>
                        <?php endif; ?>
                        <p>Your choice:</p>

                        <?php echo form_open('clothing/details'); ?>

                        <input type="hidden" name="campaign_id" value="<?php echo $campaign->id; ?>" />

						<div class="input-group">
							<input name="size" type="radio" aria-label="..."
								<?php if ($user_choice->size_id == 0){ echo 'checked="checked"'; } ?> value="0"> No selection <br />
                        <?php
																								foreach ( $clothing_sizes as $clothing_size ) {
																									?>
                                <input name="size" type="radio" aria-label="..."
								<?php if ($clothing_size->id == $user_choice->size_id){ echo 'checked="checked"'; } ?>
								value="<?php echo $clothing_size->id; ?>">
                                <?php echo $clothing_size->name; ?> (<?php echo $clothing_size->description; ?>) <br />
                           <?php } ?>
                        </div>


						<button type="submit" class="btn btn-default">Save Choice</button>

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
