<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
abstract class BatchHelper {

	public static function send_batch_creation_email($email, $password) {
		$ci = & get_instance ();
		$ci->load->library ( 'email' );

		$config = array (
				'protocol' => 'sendmail',
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'wordwrap' => TRUE
		);

		$ci->email->initialize ( $config );

		$ci->email->from ( 'webmaster@ulcompsoc.org.uk', 'CompSoc Committee' );
		$ci->email->to ( $email );
		$ci->email->subject ( 'Verify Your CompSoc Account' );
		$ci->email->message ( '<p>Hi there!</p>

		<p>We got your details and we\'ve made a CompSoc account for you, ready for you to start getting involved!</p>

		<p><em>IMPORTANT:</em> We generated a password for you, but you SHOULD CHANGE IT ASAP. There isn\'t really a better way of sending it to you unfortunately.</p>

		<p>Your password is "' . $password . '" and you can now log in with this e-mail address at <a href="https://ulcompsoc.org.uk">the CompSoc site</a> and change it!</p>
		<p>Cheers,</p>
		<p>The CompSoc Committee</p>' );

		$retval = $ci->email->send ();

		if (! $retval) {
			log_message ( 'error', "Couldn't send confirmation e-mail to " . $email );
		}

		return $retval;
	}
}
