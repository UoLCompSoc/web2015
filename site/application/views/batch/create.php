<?php
    defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

    Permissions::require_authorized(Permissions::BATCH_USER_CREATE);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
            $this->load->view ( 'include/head_common.php' );
        ?>

        <title>CompSoc :: Batch User Creation</title>
    </head>

    <body>
        <?php
            $this->load->view('include/navbar.php');
        ?>
        
        <!-- Page Content -->
	    <div class="container">
	    
	        <?php
		        $this->load->view ( 'include/notification_message.php' );
		    ?>
	    
	    	<div class="row">
			    <div class="panel panel-default">
				    <div class="panel-body">
					    <div class="page-header">
						    <h2>Batch User Creation</h2>
					    </div>
					
					    <br>
					    <?php echo form_open('batch/batch_register_process'); ?>
					        <h4>#1</h4>
						    <label for="reg_fullnameone" class="sr-only">Full Name</label>
						    <input type="text" name="reg_fullnameone" id="reg_fullnameone" class="form-control" placeholder="Full Name" value="<?php echo set_value('reg_fullnameone');?>"><br>
						
						    <label for="reg_emailone" class="sr-only">E-Mail Address</label>
						    <input type="text" name="reg_emailone" id="reg_emailone" class="form-control" placeholder="E-Mail Address" value="<?php echo set_value('reg_emailone'); ?>"><br>
						
						    <h4>#2</h4>    
						    <label for="reg_fullnametwo" class="sr-only">Full Name</label>
						    <input type="text" name="reg_fullnametwo" id="reg_fullnametwo" class="form-control" placeholder="Full Name" value="<?php echo set_value('reg_fullnametwo');?>"><br>
						
						    <label for="reg_emailtwo" class="sr-only">E-Mail Address</label>
						    <input type="text" name="reg_emailtwo" id="reg_emailtwo" class="form-control" placeholder="E-Mail Address" value="<?php echo set_value('reg_emailtwo'); ?>"><br>
						
						    <h4>#3</h4>    
						    <label for="reg_fullnamethree" class="sr-only">Full Name</label>
						    <input type="text" name="reg_fullnamethree" id="reg_fullnamethree" class="form-control" placeholder="Full Name" value="<?php echo set_value('reg_fullnamethree');?>"><br>
						
						    <label for="reg_emailthree" class="sr-only">E-Mail Address</label>
						    <input type="text" name="reg_emailthree" id="reg_emailthree" class="form-control" placeholder="E-Mail Address" value="<?php echo set_value('reg_emailthree'); ?>"><br>
						
						    <h4>#4</h4>    
						    <label for="reg_fullnamefour" class="sr-only">Full Name</label>
						    <input type="text" name="reg_fullnamefour" id="reg_fullnamefour" class="form-control" placeholder="Full Name" value="<?php echo set_value('reg_fullnamefour');?>"><br>
						
						    <label for="reg_emailfour" class="sr-only">E-Mail Address</label>
						    <input type="text" name="reg_emailfour" id="reg_emailfour" class="form-control" placeholder="E-Mail Address" value="<?php echo set_value('reg_emailfour'); ?>"><br>
						    
						    <h4>#5</h4>
						    <label for="reg_fullnamefive" class="sr-only">Full Name</label>
						    <input type="text" name="reg_fullnamefive" id="reg_fullnamefive" class="form-control" placeholder="Full Name" value="<?php echo set_value('reg_fullnamefive');?>"><br>
						
						    <label for="reg_emailfive" class="sr-only">E-Mail Address</label>
						    <input type="text" name="reg_emailfive" id="reg_emailfive" class="form-control" placeholder="E-Mail Address" value="<?php echo set_value('reg_emailfive'); ?>"><br>
						    
						    <input type="submit" value="Create Users" name="reg_submit" id="reg_submit" class="btn btn-primary" style="margin-right: 24px">
						    <input type="reset" value="Reset Form" name="reg_reset" id = "reg_reset" class = "btn btn-secondary">
					    <?php echo form_close(); ?>
					    
					    </br>
					    
	        	    </div>
			    </div>
		    </div>
	    </div>
        
        <?php
	        $this->load->view('include/footer.php');
	        $this->load->view('include/bootstrapjs.php');
	    ?>
	    
    </body>
    
</html>
