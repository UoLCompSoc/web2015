<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Batch extends CI_Controller {

	public function __construct() {
		parent::__construct ();
	}

	public function index() {
        Permissions::require_authorized(Permissions::BATCH_USER_CREATE);

        $this->load->view ( 'batch/create' );
	}

	public function batch_register_process() {
        Permissions::require_authorized(Permissions::BATCH_USER_CREATE);

        $rules = array (
				array (
						'field' => 'reg_emailone',
						'label' => 'e-mail 1',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnameone',
						'label' => 'full name 1',
						'rules' => 'trim' 
				),
				array (
						'field' => 'reg_emailtwo',
						'label' => 'e-mail 2',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnametwo',
						'label' => 'full name 2',
						'rules' => 'trim' 
				),
				array (
						'field' => 'reg_emailthree',
						'label' => 'e-mail 3',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnamethree',
						'label' => 'full name 3',
						'rules' => 'trim' 
				),
				array (
						'field' => 'reg_emailfour',
						'label' => 'e-mail 4',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnamefour',
						'label' => 'full name 4',
						'rules' => 'trim' 
				),
				array (
						'field' => 'reg_emailfive',
						'label' => 'e-mail 5',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnamefive',
						'label' => 'full name 5',
						'rules' => 'trim' 
				) 
		);
		
		$this->form_validation->set_rules ( $rules );
		$userdata = $this->user_model->get_logged_in ();
		$arr = ( array ) $userdata;
		$arr ["notification_message"] = "";
		
		if ($this->form_validation->run () === TRUE) {
			// verify
			$passwordlength = 12;
			$batchuserdata = array (
					'emailone' => $this->input->post ( 'reg_emailone', TRUE ),
					'fullnameone' => $this->input->post ( 'reg_fullnameone', TRUE ),
					'passwordone' => substr ( preg_replace ( "/[^A-Za-z0-9 ]/", '', hash ( 'md5', time () ) ), 0, $passwordlength ),
					'emailtwo' => $this->input->post ( 'reg_emailtwo', TRUE ),
					'fullnametwo' => $this->input->post ( 'reg_fullnametwo', TRUE ),
					'passwordtwo' => substr ( preg_replace ( "/[^A-Za-z0-9 ]/", '', hash ( 'md5', time () - 1 ) ), 0, $passwordlength ),
					'emailthree' => $this->input->post ( 'reg_emailthree', TRUE ),
					'fullnamethree' => $this->input->post ( 'reg_fullnamethree', TRUE ),
					'passwordthree' => substr ( preg_replace ( "/[^A-Za-z0-9 ]/", '', hash ( 'md5', time () - 2 ) ), 0, $passwordlength ),
					'emailfour' => $this->input->post ( 'reg_emailfour', TRUE ),
					'fullnamefour' => $this->input->post ( 'reg_fullnamefour', TRUE ),
					'passwordfour' => substr ( preg_replace ( "/[^A-Za-z0-9 ]/", '', hash ( 'md5', time () - 3 ) ), 0, $passwordlength ),
					'emailfive' => $this->input->post ( 'reg_emailfive', TRUE ),
					'fullnamefive' => $this->input->post ( 'reg_fullnamefive', TRUE ),
					'passwordfive' => substr ( preg_replace ( "/[^A-Za-z0-9 ]/", '', hash ( 'md5', time () - 4 ) ), 0, $passwordlength ) 
			);
			
			$result = $this->user_model->batch_insert ( $batchuserdata ['emailone'], $batchuserdata ['fullnameone'], $batchuserdata ['passwordone'] );
			
			if ($result === TRUE) {
				$arr ["notification_message"] .= "Created user {$batchuserdata['emailone']}.</br>";
			} else if ($result === FALSE) {
				$arr ["notification_message"] .= "Could not create {$batchuserdata['emailone']}.</br>";
			}
			
			$result = $this->user_model->batch_insert ( $batchuserdata ['emailtwo'], $batchuserdata ['fullnametwo'], $batchuserdata ['passwordtwo'] );
			
			if ($result === TRUE) {
				$arr ["notification_message"] .= "Created user {$batchuserdata['emailtwo']}.</br>";
			} else if ($result === FALSE) {
				$arr ["notification_message"] .= "Could not create {$batchuserdata['emailtwo']}.</br>";
			}
			
			$result = $this->user_model->batch_insert ( $batchuserdata ['emailthree'], $batchuserdata ['fullnamethree'], $batchuserdata ['passwordthree'] );
			
			if ($result === TRUE) {
				$arr ["notification_message"] .= "Created user {$batchuserdata['emailthree']}.</br>";
			} else if ($result === FALSE) {
				$arr ["notification_message"] .= "Could not create {$batchuserdata['emailthree']}.</br>";
			}
			
			$result = $this->user_model->batch_insert ( $batchuserdata ['emailfour'], $batchuserdata ['fullnamefour'], $batchuserdata ['passwordfour'] );
			
			if ($result === TRUE) {
				$arr ["notification_message"] .= "Created user {$batchuserdata['emailfour']}.</br>";
			} else if ($result === FALSE) {
				$arr ["notification_message"] .= "Could not create {$batchuserdata['emailfour']}.</br>";
			}
			
			$result = $this->user_model->batch_insert ( $batchuserdata ['emailfive'], $batchuserdata ['fullnamefive'], $batchuserdata ['passwordfive'] );
			
			if ($result === TRUE) {
				$arr ["notification_message"] .= "Created user {$batchuserdata['emailfive']}.</br>";
			} else if ($result === FALSE) {
				$arr ["notification_message"] .= "Could not create {$batchuserdata['emailfive']}.</br>";
			}
			
			$_POST = array ();
		}
		
		$this->load->view ( 'batch/create', $arr );
	}
}
