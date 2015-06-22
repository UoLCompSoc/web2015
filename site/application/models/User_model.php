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
	
	// password salt
	var $salt = '';
	
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
		
		return $query->result();
	}
}