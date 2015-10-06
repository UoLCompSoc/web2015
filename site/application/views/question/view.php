<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
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
							<h2>Questions</h2>
						</div>
						
						<p>Got a question? Ask us here and get an answer from committee members and other site users!</p>
						<p>You can search by phrases or tags, as well as for answered and unanswered questions.</p>
						
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>Ask</h2>
						</div>
						
						<p>Can't find what you're looking for? Ask away!</p>
						<a href="/question/ask" class="btn btn-primary" role="button">Ask</a>
						
					</div>
				</div>
			</div>
		
		    <div class="row">
			    <div class="panel panel-default">
				    <div class="panel-body">
					    <div class="page-header">
						    <h2>Search</h2>
					    </div>
						
						<?php echo form_open('question/search_phrase'); ?>
						<div class="form-group">
						    <div class="form-group">
						        <label for="srch_phrase" class="sr-only">Question</label>
						        <input type="text" name="srch_phrase" id="srch_phrase" class="form-control" placeholder="Question" value="<?php echo set_value('srch_phrase');?>">
						    </div>
						    
						    <input type="submit" value="Search" name="srch_submit" id="srch_submit" class="btn btn-primary" style="margin-right: 6px">
						    <input type="reset" value="Reset" name="srch_reset" id="srch_reset" class="btn btn-secondary">
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
