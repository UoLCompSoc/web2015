<?php
Permissions::require_authorized(Permissions::MAILER_ADMIN);

echo $mailBody;

?>