<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

Permissions::require_authorized(Permissions::USER_ADMIN);
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php
require_once 'include/head_common.php';
?>

<title>CompSoc :: Autocomplete Test</title>

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
					<label for="email">Email: </label> <input id="email">
				</div>

			</div>
			<!-- /.row -->

		</div>
		<!-- /.container -->
		
		<?php
		require_once 'include/bootstrapjs.php';
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

</body>
</html>
