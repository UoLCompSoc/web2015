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
				$senderEmail = $this->session->userdata ( 'email' );
				$maxRecipientCount = $this->db->get ( 'users' )->num_rows ();

				$actualRecipientCount = $this->_doBatchMail();

				$this->batch_mails_model->insert ( $subject, $body, $actualRecipientCount, $senderEmail );

				if($actualRecipientCount === $maxRecipientCount) {
					$output ['notification_message'] = "Send successful!";
				} else {
					$output ['notification_message'] = "Send was successful to " . $actualRecipientCount . " users but failed for " . ($maxRecipientCount - $actualRecipientCount) . " users.";
				}
			}
		}

		$this->load->view ( 'mailer/create.php', $output );
	}

	public function view() {
		$this->load->view ( 'mailer/view.php' );
	}

	private function _doBatchMail() {
		return 2;
	}
}
