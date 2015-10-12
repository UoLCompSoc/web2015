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
	
	public function details() {
	    $this->load->view ( 'question/details' );
	}
	
	public function search_phrase() {
	    $rules = array (
	                        'field' => 'srch_phrase',
	                        'label' => 'phrase',
	                        'rules' => 'trim|htmlspecialchars|required'
	    );
	    
	    $this->form_validation->set_rules ( $rules );
	    
	    if ($this->form_validation->run () === TRUE) {
	        $phrase = $this->input->post ( 'srch_phrase' );
	        $answered = $this->input->post ( 'srch_answered' );
	    
	        if ((int) $answered == 0) {
	            $results = $this->get_by_phrase($phrase);
	        } else {
	            $results = $this->get_by_answered($phrase, $answered);
	        }
	    }
	}
	
	public function search_tag() {
	
	}
	
	public function search_all() {
	    $results = $this->get_all();
	}
	
	public function ask_question() {
		$rules = array (
		        array(
	                        'field' => 'qstn_title',
	                        'label' => 'title',
	                        'rules' => 'trim|htmlspecialchars|required'
	            ),
	            
	            array(
	                        'field' => 'qstn_body',
	                        'label' => 'body',
	                        'rules' => 'trim|htmlspecialchars|required'
	            )
	    );
	    
	    $this->form_validation->set_rules ( $rules );
	    
	    if ($this->form_validation->run () === TRUE) {
	        $questiondata = array (
	            'title' => $this->input->post ( 'qstn_title' ),
	            'body' => $this->input->post ( 'qstn_body' )
	        );
	        
	        $result = $this->insert_question($questiondata);
	        $arr ["notification_message"] = "";
	        
	        if ($result === TRUE) {
	            $arr ["notification_message"] .= "Success! Your question has been submitted.";
	        } else if ($result === FALSE) {
	            $arr ["notification_message"] .= "Something went wrong, please try again.";
	        }
	    }  
	    
	}
	
}
