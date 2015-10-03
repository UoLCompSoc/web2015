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

		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
                            <h2><?php echo $campaign->name; ?></h2>
                            <p><a href="/clothing/edit/<?php echo $campaign->id ?>"> Edit Campaign</a></p>
						</div>
                        <p><?php echo $campaign->description; ?></p>
                        <p>Orders:</p>

                        <table class="table table-striped">
                            <?php
                            foreach($aggregate as $size){ ?>
                                <tr>
                                    <td><?php echo $size->name . " (" . $size->description .")"; ?></td>
                                    <td><?php echo $size->total; ?></td>
                                </tr>
                            <?php } ?>

                        </table>

                        <table class="table table-striped">
                            <tr>
                                <th>Name:</th>
                                <th>Size:</th>
                                <th>Paid:</th>
                            </tr>
                            <?php
                            foreach($orders as $order){ ?>
                                <tr>
                                    <td><?php echo $order->fullname; ?></td>
                                    <td><?php echo $order->name; ?></td>
                                    <td><?php echo $order->paid; ?></td>
                                </tr>
                            <?php } ?>

                        </table>
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
