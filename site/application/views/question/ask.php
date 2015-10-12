<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_logged_in ();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Questions</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<div class="container">
		<?php $this->load->view('include/sitewide_banner.php'); ?>
		<div class="col-lg-9">
			
		    <div class="row">
			    <div class="panel panel-default">
				    <div class="panel-body">
					    <div class="page-header">
						    <h2>Ask a question</h2>
					    </div>
					    
					    <p>Got a question? Ask us here and get an answer from committee members and other site users!</p>
						
						<?php echo form_open('question/ask_question'); ?>
						<div class="form-group">
						    <div class="form-group">
						        <label for="qstn_title">Question</label>
						        <input type="text" name="qstn_title" id="qstn_title" class="form-control" placeholder="Question" value="<?php echo set_value('qstn_title');?>" autofocus>
						    </div>
						    
						    <div class="form-group">
							    <label for="qstn_body">Details</label>
							    <textarea rows="10" cols="10" name="qstn_body" id="qstn_body" class="form-control"></textarea>
						    </div>
						    
						    <input type="submit" value="Submit" name="qstn_submit" id="qstn_submit" class="btn btn-primary" style="margin-right: 6px">
						    <input type="reset" value="Reset" name="qstn_reset" id="qstn_reset" class="btn btn-secondary">
						<?php echo form_close(); ?>
			            </div>

					</div>
				</div>
			</div>
			
        </div>
		<?php $this->load->view('include/social_sidebar.php'); ?>	
	</div>


	<?php
	$this->load->view ( 'include/footer.php' );
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
	</div>
</body>
</html>
