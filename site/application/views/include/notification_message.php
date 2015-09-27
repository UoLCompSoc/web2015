<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

if (isset ( $notification_message )) :
	?>
<div class="row">
	<div class="col-lg-12 text-center alert alert-info">
		<?php
	echo $notification_message;
	?>
	</div>
</div>
<?php endif; ?>