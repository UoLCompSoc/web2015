<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?> 
<!DOCTYPE html>
<html lang="en">

<head>

<?php
/*
 * This should be the first "require" because it contains the charset,
 * which should come directly after the <head> tag.
 */
require_once 'include/head_common.php';
?>

<title>CompSoc :: Home</title>

</head>

<body>
	<?php
	require_once 'include/navbar.php';
	?>

	<!-- Page Content -->
	<div class="container">
	
	<?php 
	require_once 'include/notification_message.php';
	?>
	
	<?php 
		require_once 'include/flashdata_message.php';
		?>

		<div class="row text-center">
			<h1>CompSoc @ University of Leicester</h1>
		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="ui-widget">
                    <label for="email">Email: </label>
                    <input id="email">
                </div>
			    
			</div>
			<!-- /.row -->

		</div>
		<!-- /.container -->
		
		<?php
		require_once 'include/bootstrapjs.php';
		?>
		
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script>
    $("#email").autocomplete({
        source: function(request, response) {
            $.ajax({
              url: "/compsoc/site/index.php/autocomplete/email",
              data: {
                emailQuery: request.term
              },
              success: function(data) {
                response(data);
              },
              dataType: "json"
            });
          },
    });
    </script>
</body>
</html>
