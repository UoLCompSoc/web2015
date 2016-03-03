<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
Permissions::require_authorized ( Permissions::CLOTHING_ADMIN );
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
							<h2>Add Order for User</h2>
						</div>
                        <?php echo form_open('clothing/addorder/' . $campaign_id); ?>
                        <div class="form-group">
							<label for="email" class="sr-only">User Email:</label>
							<input id="email" name="email" type="text" class="form-control" placeholder="Email" value="<?php echo set_value('email', $email); ?>" />
						</div>

						<div class="form-group">
							<?php foreach($sizes as $row) { ?>
								<div class="radio">
									<label>
										<?php echo form_radio('size_id', $row->id, ($row->id == $size_id)); // Check if the selected type is this one ?>
									</label>
									<?php echo $row->name . ' - ' . $row->description; ?>
								</div>
							<?php } ?>

						</div>

						<div class="form-group">
							<label for="paid" class="sr-only">Paid:</label>
							<div class="radio">
								<label><?php echo form_radio('paid', true, $paid == true); ?> Paid </label>
							</div>
							<div class="radio">
								<label><?php echo form_radio('paid', false, $paid == false); ?> Not Paid</label>
							</div>
						</div>

						<button type="submit" class="btn btn-default">Add Order</button>

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

	<script>
		$("#email").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: "/autocomplete/email",
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
</body>
</html>
