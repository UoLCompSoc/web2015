<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Mailer extends CI_Controller {

	public function index() {
		$this->load->view ( 'mailer/panel.php' );
	}

	public function create() {
		$output = array ();
		if ($this->input->post ( 'subject' ) != "" || $this->input->post ( 'body' ) != "") {
			$rules = array (
					array (
							'field' => 'subject',
							'label' => 'E-Mail Subject',
							'rules' => 'required|max_length[255]'
					),

					array (
							'field' => 'body',
							'label' => 'E-Mail Body',
							'rules' => 'required'
					)
			);

			$this->form_validation->set_rules ( $rules );

			if ($this->form_validation->run () === TRUE) {
				$subject = $this->input->post ( 'subject' );
				$body = $this->input->post ( 'body' );
				$committeeOnly = ($this->input->post('committeeOnly') == 1);
				$senderEmail = $this->session->userdata ( 'email' );
				$maxRecipientCount = -1;

				if($committeeOnly) {
					$maxRecipientCount = $this->db->get_where('users', array('committee' => 1))->num_rows();
				} else {
					$maxRecipientCount = $this->db->get ( 'users' )->num_rows ();
				}

				$actualRecipientCount = $this->_doBatchMail ( $subject, $body, $committeeOnly);

				$this->batch_mails_model->insert ( $subject, $body, $committeeOnly, $actualRecipientCount, $senderEmail );

				if ($actualRecipientCount === $maxRecipientCount) {
					$output ['notification_message'] = "Send successful!";
					$this->load->view ( 'mailer/panel.php', $output );
					return;
				} else {
					$output ['notification_message'] = "Send was successful to " . $actualRecipientCount . " users but failed for " . ($maxRecipientCount - $actualRecipientCount) . " users.";
					$this->load->view ( 'mailer/panel.php', $output );
					return;
				}
			}
		}

		$this->load->view ( 'mailer/create.php', $output );
	}

	public function view($mailID = -1) {
		if ($mailID > 0) {
			$result = $this->db->query ( "select batch_mails.*, users.email FROM batch_mails,users WHERE batch_mails.senderID=users.userid AND batch_mails.id=?;
					", array (
					$mailID
			) );

			if ($result->num_rows () == 0) {
				$this->load->view ( 'mailer/viewall.php', array (
						'notification_message' => "Couldn't find specified mail id ({$mailID})."
				) );
				return;
			}

			$output = $result->row_array ();

			$this->load->view ( 'mailer/viewsingle.php', array (
					'mail' => $output
			) );
		} else {
			$result = $this->db->query ( "select batch_mails.*, users.email FROM batch_mails,users WHERE batch_mails.senderID=users.userid order by id DESC
					" );

			$output = $result->result_array ();

			$this->load->view ( 'mailer/viewall.php', array (
					'pastMails' => $output
			) );
		}
	}

	private function _doBatchMail($subject, $body, $committeeOnly = FALSE) {
		$this->load->library ( 'email' );

		$config = array (
				'protocol' => 'sendmail',
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'wordwrap' => TRUE,
				'bcc_batch_mode' => TRUE
		);

		$this->email->initialize ( $config );

		$this->email->from ( 'webmaster@ulcompsoc.org.uk', 'CompSoc Committee' );

		$result = NULL;

		if ($committeeOnly) {
			$result = $this->db->query("SELECT email FROM users WHERE committee=1;");
		} else {
			$result = $this->db->query ( "SELECT email FROM users;" );
		}

		$result = $result->result ();

		$recipients = array ();

		foreach ( $result as $email ) {
			array_push ( $recipients, $email->email );
		}

		log_message('debug', 'Batch mail being sent to ' . (sizeof($recipients)) . ' people' . ($committeeOnly ? ' (committee only)' : '') . '.');

		$this->email->bcc ( $recipients );
		$this->email->subject ( $subject );
		$this->email->message ( $body );

		if (! $this->email->send ()) {
			log_message ( 'error', "Couldn't send batch mail." );
		}

		return sizeof ( $recipients );
	}
}
