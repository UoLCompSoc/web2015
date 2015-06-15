<?php
class User_model extends CI_Model {
	// core details
	var $username = '';
	var $fullname = '';
	var $email = '';
	var $datejoined = '';
	var $permissions = 0;
	
	// social details
	var $githubID = '';
	var $linkedinID = '';
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