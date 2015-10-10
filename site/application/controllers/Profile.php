<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Profile extends CI_Controller {

	public function index() {
		$this->load->view ( "profile" );
	}

	public function settings($showSuccess = FALSE) {
		$userdata = $this->user_model->get_logged_in ();
		$userdata->passwordhash = null;
		
		$arr = ( array ) $userdata;
		if ($showSuccess) {
			$arr ["notification_message"] = "Update successful!";
		}
		
		$this->load->view ( "settings", $arr );
	}

	public function update_profile() {
		$userdata = ( array ) $this->user_model->get_logged_in ();
		
		$rules = array (
				array (
						'field' => 'steamID',
						'label' => 'Steam ID',
						'rules' => 'trim' 
				),
				
				array (
						'field' => 'linkedInID',
						'label' => 'LinkedIn URL',
						'rules' => 'prep_url|trim' 
				),
				
				array (
						'field' => 'githubID',
						'label' => 'GitHub ID',
						'rules' => 'max_length[39]|trim' 
				),
				
				array (
						'field' => 'twitterID',
						'label' => 'Twitter Handle',
						'rules' => 'max_length[15]|trim' 
				) 
		);
		
		$this->form_validation->set_rules ( $rules );
		
		if ($this->form_validation->run () === FALSE) {
			$this->settings ( FALSE );
			return;
		}
		
		$steamID = $this->input->post ( "steamID", TRUE );
		$linkedInID = $this->input->post ( "linkedInID", TRUE );
		$githubID = $this->input->post ( "githubID", TRUE );
		$twitterID = $this->input->post ( "twitterID", TRUE );
		
		if (strlen ( $twitterID ) > 0) {
			if (substr ( $twitterID, 0, 1 ) != '@') {
				$twitterID = '@' . $twitterID;
			}
		}
		
		$userdata ["steamID"] = $steamID;
		$userdata ["linkedinURL"] = $linkedInID;
		$userdata ["githubID"] = $githubID;
		$userdata ["twitterID"] = $twitterID;
		
		$this->settings ( $this->user_model->update ( $userdata ) );
	}

	public function change_password() {
		$rules = array (
				// array (
				// 'field' => 'oldPassword',
				// 'label' => 'Old Password',
				// 'rules' => 'required|min_length[5]'
				// ),
				array (
						'field' => 'newPassword1',
						'label' => 'New Password',
						'rules' => 'required|min_length[5]' 
				),
				array (
						'field' => 'newPassword2',
						'label' => 'Repeated Password',
						'rules' => 'required|matches[newPassword1]' 
				) 
		);
		
		$this->form_validation->set_rules ( $rules );
		if ($this->form_validation->run () === FALSE) {
			$this->settings ( FALSE );
			return;
		}
		
		$this->settings ( $this->user_model->change_password ( $this->input->post ( 'newPassword1' ) ) );
	}
}