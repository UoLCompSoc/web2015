<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch extends CI_Controller {

    public function __construct() {
        parent::__construct ();
    }
    
    public function index() {
        $this->load->view('batch/create');
    }
    
    public function batch_register_process() {
		$rules = array (
				array (
						'field' => 'reg_emailone',
						'label' => 'e-mail',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnameone',
						'label' => 'full name',
						'rules' => 'trim'
				),
				array (
						'field' => 'reg_emailtwo',
						'label' => 'e-mail',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnametwo',
						'label' => 'full name',
						'rules' => 'trim'
				),
				array (
						'field' => 'reg_emailthree',
						'label' => 'e-mail',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnamethree',
						'label' => 'full name',
						'rules' => 'trim'
				),
				array (
						'field' => 'reg_emailfour',
						'label' => 'e-mail',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnamefour',
						'label' => 'full name',
						'rules' => 'trim'
				),
				array (
						'field' => 'reg_emailfive',
						'label' => 'e-mail',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnamefive',
						'label' => 'full name',
						'rules' => 'trim'
				)
		);
		
		$this->form_validation->set_rules ( $rules );
		
		if ($this->form_validation->run () === TRUE) {
			// verify
			$passwordlength = 12;
			$batchuserdata = array(
					'emailone' => $this->input->post('reg_emailone'),
					'fullnameone' => $this->input->post('reg_fullnameone'),
					'passwordone' => substr(preg_replace("/[^A-Za-z0-9 ]/", '', hash('md5', date('H:m:s'))), 0, $passwordlength),
					'emailtwo' => $this->input->post('reg_emailtwo'),
					'fullnametwo' => $this->input->post('reg_fullnametwo'),
					'passwordtwo' => substr(preg_replace("/[^A-Za-z0-9 ]/", '', hash('md5', date('H:m:s'))), 0, $passwordlength),
					'emailthree' => $this->input->post('reg_emailthree'),
					'fullnamethree' => $this->input->post('reg_fullnamethree'),
					'passwordthree' => substr(preg_replace("/[^A-Za-z0-9 ]/", '', hash('md5', date('H:m:s'))), 0, $passwordlength),
					'emailfour' => $this->input->post('reg_emailfour'),
					'fullnamefour' => $this->input->post('reg_fullnamefour'),
					'passwordfour' => substr(preg_replace("/[^A-Za-z0-9 ]/", '', hash('md5', date('H:m:s'))), 0, $passwordlength),
					'emailfive' => $this->input->post('reg_emailfive'),
					'fullnamefive' => $this->input->post('reg_fullnamefive'),
					'passwordfive' => substr(preg_replace("/[^A-Za-z0-9 ]/", '', hash('md5', date('H:m:s'))), 0, $passwordlength)
			);
			
			//Get the user's profile to show success/fail messages
	        $userdata = $this->user_model->get_logged_in ();
			$arr = ( array ) $userdata;
			$arr ["notification_message"] = "";
			
			$result = $this->user_model->batch_insert($batchuserdata['emailone'], $batchuserdata['fullnameone'], $batchuserdata['passwordone']);
			
			if ($result === TRUE) {
				$arr ["notification_message"] .= "Created user {$batchuserdata['emailone']}.\r\n";
			} else if ($result === FALSE) {
			    $arr ["notification_message"] .= "Could not create {$batchuserdata['emailone']}.\r\n";
			}
			
			$result = $this->user_model->batch_insert($batchuserdata['emailtwo'], $batchuserdata['fullnametwo'], $batchuserdata['passwordtwo']);
			
			if ($result === TRUE) {
				$arr ["notification_message"] .= "Created user {$batchuserdata['emailtwo']}.\r\n";
			} else if ($result === FALSE) {
			    $arr ["notification_message"] .= "Could not create {$batchuserdata['emailtwo']}.\r\n";
			}
			
			$result = $this->user_model->batch_insert($batchuserdata['emailthree'], $batchuserdata['fullnamethree'], $batchuserdata['passwordthree']);
			
			if ($result === TRUE) {
				$arr ["notification_message"] .= "Created user {$batchuserdata['emailthree']}.\r\n";
			} else if ($result === FALSE) {
			    $arr ["notification_message"] .= "Could not create {$batchuserdata['emailthree']}.\r\n";
			}
			
			$result = $this->user_model->batch_insert($batchuserdata['emailfour'], $batchuserdata['fullnamefour'], $batchuserdata['passwordfour']);
			
			if ($result === TRUE) {
				$arr ["notification_message"] .= "Created user {$batchuserdata['emailfour']}.\r\n";
			} else if ($result === FALSE) {
			    $arr ["notification_message"] .= "Could not create {$batchuserdata['emailfour']}.\r\n";
			}
			
			$result = $this->user_model->batch_insert($batchuserdata['emailfive'], $batchuserdata['fullnamefive'], $batchuserdata['passwordfive']);
			
			if ($result === TRUE) {
				$arr ["notification_message"] .= "Created user {$batchuserdata['emailfive']}.\r\n";
			} else if ($result === FALSE) {
			    $arr ["notification_message"] .= "Could not create {$batchuserdata['emailfive']}.\r\n";
			}
			
			$this->load->view('batch/create', $arr);
		}
		
    }
}
