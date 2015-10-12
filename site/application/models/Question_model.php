<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Question_model extends CI_Model {
    // core details
    var $id = -1;
    var $submitterID = -1;
    var $datePosted = '';
    var $title = '';
    var $body = '';
    
    public function __construct() {
		parent::__construct ();
	}
	
	//Questions
	
	public function insert_question($questiondata) {
	    $user = ( array ) $this->user_model->get_logged_in ();
		$insertdata = array (
		        'submitterID' => $user ['userid'],
				'dateAsked' => date ( 'Y-m-d' ),
				'title' => $questiondata ['title'],
				'body' => $questiondata ['body'],
				'answered' => 0
		);

		if (! $this->db->insert ( 'questions', $insertdata )) {
			log_message ( 'error', "Insert failed on database when creating question: " . $this->db->error () ['message'] );
			return FALSE;
		} else {
			syslog ( LOG_INFO, "Successfully created question {$insertdata['title']}." );
			return TRUE;
		}
	}
	
	public function get_by_phrase($phrase_to_fetch) {
	    $this->db->like('title', $phrase_to_fetch);
	    $this->db->or_like('body', $phrase_to_fetch);
	    $this->db->order_by('dateAsked', 'desc');
		$query = $this->db->get ( 'questions' );
		
		if ($query->num_rows() > 0) {
		    return $query->result();
		} else {
		    return null;
		}
	}
	
	public function get_by_tag($tags_to_fetch) {
	
	}
	
	public function get_by_answered($phrase_to_fetch, $answered) {
	    $this->db->like('title', $phrase_to_fetch);
	    $this->db->or_like('body', $phrase_to_fetch);
	    $this->db->order_by('dateAsked', 'desc');
		$query = $this->db->get_where ( 'questions', array (
				'answered' => $answered
		) );
		
		if ($query->num_rows() > 0) {
		    return $query->result();
		} else {
		    return null;
		}
	}
	
	public function get_all() {
	    $this->db->order_by('dateAsked', 'desc');
		$query = $this->db->get ( 'questions' );
		
		if ($query->num_rows() > 0) {
		    return $query->result();
		} else {
		    return null;
		}	    
	}
	
	public function mark_answered($questiondata) {
	    
	}
	
	//Answers
	
    public function insert_answer($answerdata) {
	    $user = ( array ) $this->user_model->get_logged_in ();
		$insertdata = array (
		        'submitterID' => $user ['userid'],
				'questionID' => $answerdata ['id'],
				'dateAnswered' => date ( 'Y-m-d' ),
				'body' => $answerdata ['body'],
				'helpful' => 0
		);

		if (! $this->db->insert ( 'questions', $insertdata )) {
			log_message ( 'error', "Insert failed on database when adding answer: " . $this->db->error () ['message'] );
			return FALSE;
		} else {
			syslog ( LOG_INFO, "Successfully added answer to question {$insertdata['questionID']}." );
			return TRUE;
		}	
	}
	
	public function get_answers($questiondata) {
	    $this->db->order_by('helpful', 'desc');
		$query = $this->db->get_where ( 'answers', array (
				'questionID' => $questiondata ["questionID"]
		) );
		
		if ($query->num_rows() > 0) {
		    return $query->result();
		} else {
		    return null;
		}	
	}
	
	public function mark_helpful($answerdata) {
	
	}
}
