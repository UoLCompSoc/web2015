<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Mailer extends CI_Controller {

	public function index() {
		$this->load->view ( 'mailer/panel.php' );
	}

	public function create() {
		Permissions::require_authorized ( Permissions::MAILER_ADMIN );

		$output = array ();
		if ($this->input->post ( 'subject' ) != "" || $this->input->post ( 'body' ) != "") {
			$rules = array (
					array (
							'field' => 'subject',
							'label' => 'E-Mail Subject',
							'rules' => 'required|max_length[255]'
					),

					array (
							'field' => 'title',
							'label' => 'Body Title',
							'rules' => 'required|max_length[255]'
					),

					array (
							'field' => 'body',
							'label' => 'E-Mail Body',
							'rules' => 'required'
					)
			);

			if ($this->input->post ( 'specialRecipient', TRUE ) == 1) {
				array_push ( $rules, array (
						'field' => 'specialEmail',
						'label' => 'Extra Recipient Email',
						'rules' => 'required|max_length[255]|valid_email'
				) );
			}

			$this->form_validation->set_rules ( $rules );

			if ($this->form_validation->run () === TRUE) {
				$subject = $this->input->post ( 'subject', TRUE );
				$title = $this->input->post ( 'title', TRUE );
				$body = $this->input->post ( 'body', TRUE );
				$committeeOnly = ($this->input->post ( 'committeeOnly', TRUE ) == 1);
				$specialRecipient = ($this->input->post ( 'specialRecipient', TRUE ) == 1 ? $this->input->post ( 'specialEmail', TRUE ) : NULL);
				$senderEmail = $this->session->userdata ( 'email' );
				$maxRecipientCount = - 1;

				if ($specialRecipient) {
					$maxRecipientCount = 1;
				} else if ($committeeOnly) {
					$maxRecipientCount = $this->db->get_where ( 'users', array (
							'committee' => 1
					) )->num_rows ();
				} else {
					$maxRecipientCount = $this->db->get ( 'users' )->num_rows ();
				}

				$actualRecipientCount = $this->_doBatchMail ( $subject, $title, $body, $committeeOnly, $specialRecipient );

				$this->batch_mails_model->insert ( $subject, $title, $body, $committeeOnly, $specialRecipient, $actualRecipientCount, $senderEmail );

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
		Permissions::require_authorized ( Permissions::MAILER_ADMIN );

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

	public function viewRaw($mailID = -1) {
		Permissions::require_authorized ( Permissions::MAILER_ADMIN );

		if ($mailID > 0) {
			$result = $this->db->get_where ( 'batch_mails', array (
					'id' => $mailID
			) )->row_array ();

			$subject = $result ["subject"];
			$title = $result ["title"];
			$body = $result ["emailText"];

			$this->load->view ( 'mailer/viewraw.php', array (
					'mailBody' => BatchHelper::make_batch_mail_message ( $subject, $title, $body )
			) );
		} else {
			$this->load->view ( 'mailer/viewall.php' );
		}
	}

	private function _doBatchMail($subject, $title, $body, $committeeOnly = FALSE, $specialRecipient = NULL) {
		Permissions::require_authorized ( Permissions::MAILER_ADMIN );

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


		$recipients = array ();

		if ($specialRecipient != NULL) {
			array_push ( $recipients, $specialRecipient );
			log_message ( 'debug', 'Mail being sent to special recipient:' . $specialRecipient);
		} else {
			$result = NULL;
			if ($committeeOnly) {
				$result = $this->db->query ( "SELECT email FROM users WHERE committee=1;" );
			} else {
				$result = $this->db->query ( "SELECT email FROM users;" );
			}

			$result = $result->result ();

			foreach ( $result as $email ) {
				array_push ( $recipients, $email->email );
			}

			log_message ( 'debug', 'Batch mail being sent to ' . (sizeof ( $recipients )) . ' people' . ($committeeOnly ? ' (committee only)' : '') . '.' );
		}

		$this->email->bcc ( $recipients );
		$this->email->subject ( $subject );
		$this->email->message ( BatchHelper::make_batch_mail_message ( $subject, $title, $body ) );

		if (! $this->email->send ()) {
			log_message ( 'error', "Couldn't send batch mail." );
		}

		return sizeof ( $recipients );
	}
}
