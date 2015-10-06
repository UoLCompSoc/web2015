<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Question extends CI_Controller {

	public function __construct() {
		parent::__construct ();
	}

	public function index() {
		$this->load->view ( 'question/view' );
	}
	
	public function ask() {
	    $this->load->view ( 'question/ask' );
	}
	
	public function search_phrase() {
	    $rules = array (
	                        'field' => 'srch_phrase',
	                        'label' => 'phrase',
	                        'rules' => 'trim|required|alpha_dash'
	    );
	    
	    $this->form_validation->set_rules ( $rules );
	    
	    if ($this->form_validation->run () === TRUE) {
	        $phrase = $this->input->post ( 'srch_phrase' );
	    }
	    
	}
	
	public function ask_question() {
	
	}
}
