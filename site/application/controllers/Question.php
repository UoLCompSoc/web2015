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
	                        'rules' => 'trim|htmlspecialchars|required'
	    );
	    
	    $this->form_validation->set_rules ( $rules );
	    
	    if ($this->form_validation->run () === TRUE) {
	        $phrase = $this->input->post ( 'srch_phrase' );
	    }
	    
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
	        $title = $this->input->post ( 'qstn_title' );
	        $body = $this->input->post ( 'qstn_body' );
	    }
	}
}

//Yeah someone asks a question and it's put up to be answered, potentially by anyone. I'd say a question should have tags hinting what it's about, a title and a description

//Then users can list open questions, search for relevant stuff including searching by tags

//Question has a submitter, a list of tags, a date asked, title and body. Answer has date, body, submitter, and parent question
