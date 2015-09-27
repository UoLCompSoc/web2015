<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

$flashdata_message = get_instance ()->session->flashdata ( 'message' );

if ($flashdata_message !== NULL) :
	?>
<div class="row">
	<div class="col-lg-12 text-center alert alert-info">
		<?php
	echo $flashdata_message;
	?>
	</div>
</div>
<?php endif; ?>