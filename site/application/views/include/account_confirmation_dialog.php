<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

if (! Permissions::is_authorized ( Permissions::USER_CONFIRMED )) :
	?>

<div class="row">
	<div class="col alert alert-warning">
		<p>
			<em>NOTE:</em> Your account hasn't yet been confirmed by the committee so your features might be slightly limited
			until it is. It'll be done soon, no worries!
		</p>
	</div>
</div>




<?php 
endif;
?>