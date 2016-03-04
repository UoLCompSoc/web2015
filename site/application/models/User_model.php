<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class User_model extends CI_Model {
	// core details
	var $id = - 1;
	var $email = '';
	var $fullname = '';
	var $datejoined = '';
	var $permissions = 0x00;
	var $passwordhash = '';
	
	// social details
	var $githubID = '';
	var $linkedinURL = '';
	var $steamID = '';
	var $twitterID = '';

	public function __construct() {
		parent::__construct ();
	}

	/**
	 * Checks if the userdata given verifies correctly and returns the user's details if it does.
	 *
	 * @param $userdata an
	 *        	array containing an 'email' and a 'password' field
	 * @return boolean FALSE if verification failed, the user's details otherwise.
	 */
	public function login_verify($userdata) {
		$result = $this->get_by_email ( $userdata ['email'] );
		
		if ($result === null) {
			return FALSE;
		} else {
			$verified = password_verify ( $userdata ['password'], $result->passwordhash );
			
			return $verified ? $result : FALSE;
		}
	}

	public function get_by_email($email_to_fetch) {
		$query = $this->db->get_where ( 'users', array (
				'email' => $email_to_fetch 
		) );
		
		if ($query->num_rows () != 1) {
			log_message ( 'debug', "Email {$email_to_fetch} couldn't be found." );
			return null;
		}
		
		return $query->row ();
	}

	public function get_by_userid($id_to_fetch) {
		$query = $this->db->get_where ( 'users', array (
				'userid' => $id_to_fetch 
		) );
		
		if ($query->num_rows () != 1) {
			log_message ( 'debug', "Couldn't find user {$id_to_fetch}." );
			return null;
		}
		
		return $query->row ();
	}

	public function get_logged_in() {
		return $this->get_by_email ( $this->session->email );
	}

	public function insert($userdata) {
		$email_check = $this->db->get_where ( 'users', 'email', $userdata ['email'] );
		
		if ($email_check->num_rows () > 0) {
			log_message ( 'debug', "Attempt to create account with e-mail {$userdata['email']} collided with existing e-mail in DB. Form validation is probably off." );
			return FALSE;
		}
		
		$insertdata = array (
				'email' => $userdata ['email'],
				'fullname' => $userdata ['fname'] . ' ' . $userdata ['lname'],
				'datejoined' => date ( 'Y-m-d' ),
				'permissions' => 0x00,
				'passwordhash' => password_hash ( $userdata ['password'], PASSWORD_BCRYPT ) 
		);
		
		if (! $this->db->insert ( 'users', $insertdata )) {
			log_message ( 'error', "Insert failed on database when creating user: " . $this->db->error () ['message'] );
			return FALSE;
		} else {
			syslog ( LOG_INFO, "Successfully created user {$insertdata['email']}." );
			return TRUE;
		}
	}

	public function batch_insert($email, $fullname, $password) {
		$email_check = $this->db->get_where ( 'users', 'email', $email );
		
		if ($email_check->num_rows () > 0) {
			log_message ( 'debug', "Attempt to create accounts collided with existing e-mail in DB. Form validation is probably off." );
			return FALSE;
		}
		
		// Check if email/full name pair is complete
		if (isset ( $email ) && strlen ( $email ) && isset ( $fullname ) && strlen ( $fullname )) {
			$insertdata = array (
					'email' => $email,
					'fullname' => $fullname,
					'datejoined' => date ( 'Y-m-d' ),
					'permissions' => 0x00,
					'passwordhash' => password_hash ( $password, PASSWORD_BCRYPT ) 
			);
			
			if (! $this->db->insert ( 'users', $insertdata )) {
				log_message ( 'error', "Insert failed on database when creating user: " . $this->db->error () ['message'] );
				return FALSE;
			}
			
			if (! BatchHelper::send_batch_creation_email ( $email, $password )) {
				syslog ( LOG_ERR, "Couldn't send batch creation email, user {$email} is lost forever." );
				return FALSE;
			}
			
			syslog ( LOG_INFO, "Successfully created user {$email}." );
			return TRUE;
		} else {
			syslog ( LOG_INFO, "Invalid data in batch creation system." );
			return FALSE;
		}
	}

	public function update($userdata) {
		$existCheck = $this->db->get_where ( 'users', array (
				'userid' => $userdata ['userid'] 
		) );
		
		if ($existCheck->num_rows () != 1) {
			log_message ( 'info', "Attempt to edit account with e-mail {$userdata['email']} doesn't exist in DB." );
			return FALSE;
		}
		
		$this->db->flush_cache ();
		
		$this->db->where ( 'userid', $userdata ['userid'] );
		if (! $this->db->update ( 'users', $userdata )) {
			log_message ( 'error', "Update failed on database when updating user: " . $this->db->error () ['message'] );
			return FALSE;
		} else {
			syslog ( LOG_INFO, "Successfully updated user {$userdata['email']}." );
			return TRUE;
		}
	}

	public function change_password($newPassword) {
		$user = ( array ) $this->get_logged_in ();
		
		$user ["passwordhash"] = password_hash ( $newPassword, PASSWORD_BCRYPT );
		return $this->update ( $user );
	}

	public function change_password_for_user($userID, $newPassword) {
		$user = ( array ) $this->get_by_userid ( $userID );

		$user ["passwordhash"] = password_hash ( $newPassword, PASSWORD_BCRYPT );
		return $this->update ( $user );
	}
}
