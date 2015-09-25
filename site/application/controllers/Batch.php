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
						'rules' => 'required|valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnameone',
						'label' => 'first name',
						'rules' => 'required|trim'
				),
				array (
						'field' => 'reg_emailtwo',
						'label' => 'e-mail',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnametwo',
						'label' => 'first name',
						'rules' => 'trim'
				),
				array (
						'field' => 'reg_emailthree',
						'label' => 'e-mail',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnamethree',
						'label' => 'first name',
						'rules' => 'trim'
				),
				array (
						'field' => 'reg_emailfour',
						'label' => 'e-mail',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnamefour',
						'label' => 'first name',
						'rules' => 'trim'
				),
				array (
						'field' => 'reg_emailfive',
						'label' => 'e-mail',
						'rules' => 'valid_email|trim|is_unique[users.email]' 
				),
				array (
						'field' => 'reg_fullnamefive',
						'label' => 'first name',
						'rules' => 'trim'
				)
		);
		
		$this->form_validation->set_rules ( $rules );
		
		if ($this->form_validation->run () === TRUE) {
			// verify
			$batchuserdata = array(
					'emailone' => $this->input->post('reg_emailone'),
					'fullnameone' => $this->input->post('reg_fullnameone'),
					'emailtwo' => $this->input->post('reg_emailtwo'),
					'fullnametwo' => $this->input->post('reg_fullnametwo'),
					'emailthree' => $this->input->post('reg_emailthree'),
					'fullnamethree' => $this->input->post('reg_fullnamethree'),
					'emailfour' => $this->input->post('reg_emailfour'),
					'fullnamefour' => $this->input->post('reg_fullnamefour'),
					'emailfive' => $this->input->post('reg_emailfive'),
					'fullnamefive' => $this->input->post('reg_fullnamefive')			
			);
			
			$result = $this->user_model->batch_insert($batchuserdata);
			
			if ($result === TRUE) {
			    $userdata['message'] = "Accounts created successfully.";    
			} else {
			    $userdata['message'] = "Could not create accounts. Please check for duplicate email addresses.";
			}
		}
		
		redirect('batch');
    }
}
