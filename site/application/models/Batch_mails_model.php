<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Batch_mails_model extends CI_Model {
	var $id = -1;
	
	var $recipientCount = 0;
	var $emailText = '';
	
	var $sentDate = NULL;
	
	var $senderID = -1;
	
	public function __construct() {
		parent::__construct ();
	}
	
	public function insert($recipientCount, $emailText, $senderEmail) {
		$dbRes = $this->db->get_where ( 'users', 'email', $userdata ['email'] );
		
		$row = $dbRes->row();
		$senderID = $row->userid;
		
		$insertdata = array (
				'recipientCount' => $recipientCount,
				'emailText' => $emailText,
				'sentDate' => date ( 'Y-m-d' ),
				'senderID' => $senderID
		);
		
		if(!$this->db->insert('users', $insertdata)) {
			log_message('error', "Insert failed when creating batch mail record.");
			return FALSE;
		}
		
		syslog(LOG_INFO, 'Successfully created batch email record');
		return TRUE;
	}
}
