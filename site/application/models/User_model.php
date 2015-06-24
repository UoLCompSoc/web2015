<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class User_model extends CI_Model {
	// core details
	var $id = -1;
	var $email = '';
	var $username = '';
	var $fullname = '';
	var $datejoined = '';
	var $permissions = 0x00;
	
	var $passwordhash = '';
	
	// social details
	var $githubID = '';
	var $linkedinURL = '';
	var $steamID = '';
	
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_by_email($email_to_fetch)
	{
		$query = $this->db->get_where('users', array('email' => $email_to_fetch));
		
		return $query->result_array();
	}
	
	public function login_verify($userdata) {
		$result = $this->get_by_email($userdata['email']);
		
		if(sizeof($result) != 1) {
			return FALSE;
		} else {
			$verified = password_verify($userdata['password'], $result[0]['passwordhash']);
			
			return $verified;
		}
	}
	
	public function insert($userdata) {
		$email_check = $this->db->get_where('users', 'email', $userdata['email']);
		
		if($email_check->num_rows() > 0) {
			syslog(LOG_INFO, "Attempt to create account with e-mail ${userdata['email']} collided with existing e-mail in DB. Form validation is probably off.");
			return FALSE;
		}
		
		$insertdata = array(
				'email' => $userdata['email'],
				'username' => explode('@', $userdata['email'])[0],
				'fullname' => $userdata['fname'] . ' ' . $userdata['lname'],
				'datejoined' => date('Y-m-d'),
				'permissions' => 0x00,
				'passwordhash' => password_hash($userdata['password'], PASSWORD_BCRYPT)
		);
		
		if(!$this->db->insert('users', $insertdata)) {
			syslog(LOG_ALERT, "Insert failed on database when creating user: " . $this->db->error()['message']);
			return FALSE;
		} else {
			syslog(LOG_INFO, "Successfully created user ${insertdata['email']}.");
			return TRUE;
		}
	}
}