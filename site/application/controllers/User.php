<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class User extends CI_Controller {

	public function __construct() {
		parent::__construct ();
	}

	public function index() {
		Permissions::require_authorized ( Permissions::USER_ADMIN );
		
		$this->listview ();
	}

	public function listview() {
		Permissions::require_authorized ( Permissions::USER_ADMIN );
		
		$query = $this->db->query ( "SELECT users.userid,fullname,email FROM users;" );
		$data ['users'] = $query->result ();
		
		$this->load->view ( 'user/list', $data );
	}

	public function view($userid) {
		Permissions::require_authorized ( Permissions::USER_ADMIN );
		
		$userid = $this->security->xss_clean ( $userid );
		
		// TODO Check the id is of the correct format
		$query = $this->db->get_where ( 'users', array (
				'userid' => $userid 
		) );
		$user = $query->row ();
		$data ['user'] = $user;
		
		$data ['points'] = $this->_getPointResult ( $userid )->result ();
		
		$data ['permissions'] = $this->_permissions_to_array ( $user->permissions );
		$this->load->view ( 'user/view', $data );
	}

	private function _getPointResult($userid) {
		$userid = $this->security->xss_clean ( $userid );
		
		// TODO Make this less horrific
		// Gets a list of all of the points given to a user and associates the Full name of the assigner, as well as the type of the points given
		$this->db->select ( "a.fullname AS Assigner, t.amount, t.transaction_comment AS comment, p.title AS type, t.timecreated AS date" );
		$this->db->from ( 'transactions AS t' );
		$this->db->order_by ( 't.timecreated' );
		$this->db->where ( 't.userid', $userid );
		$this->db->join ( 'point_types as p', 't.pointtype = p.id' );
		$this->db->join ( 'users as a', 't.assignerid = a.userid' );
		return $this->db->get ();
	}

	private function _permissions_to_array($permissions) {
		$return ['confirmed'] = ($permissions & Permissions::USER_CONFIRMED) == Permissions::USER_CONFIRMED;
		$return ['user'] = ($permissions & Permissions::USER_ADMIN) == Permissions::USER_ADMIN;
		$return ['points'] = ($permissions & Permissions::POINTS_ADMIN) == Permissions::POINTS_ADMIN;
		$return ['portfolio'] = ($permissions & Permissions::PORTFOLIO_ADMIN) == Permissions::PORTFOLIO_ADMIN;
		$return ['batch'] = ($permissions & Permissions::BATCH_USER_CREATE) == Permissions::BATCH_USER_CREATE;
		$return ['clothing'] = ($permissions & Permissions::CLOTHING_ADMIN) == Permissions::CLOTHING_ADMIN;
		$return ['mailer'] = ($permissions & Permissions::MAILER_ADMIN) == Permissions::MAILER_ADMIN;
		return $return;
	}

	public function edit($userid = -1) {
		Permissions::require_authorized ( Permissions::USER_ADMIN );
		
		$userid = $this->security->xss_clean ( $userid );
		
		// TODO add check for integer
		if ($userid == - 1 && ($this->input->server ( 'REQUEST_METHOD' ) != 'POST')) {
			$this->listview ();
			return;
		}
		
		$rules = array (
				array (
						'field' => 'userid',
						'label' => 'userid',
						'rules' => 'required' 
				),
				
				array (
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'required' 
				),
				
				array (
						'field' => 'fullname',
						'label' => 'Full Name',
						'rules' => 'required' 
				),
				
				array (
						'field' => 'githubID',
						'label' => 'Github ID',
						'rules' => 'trim' 
				),
				
				array (
						'field' => '$linkedinURL',
						'label' => 'Linkedin URL',
						'rules' => 'trim' 
				),
				
				array (
						'field' => 'steamID',
						'label' => 'Steam ID',
						'rules' => 'trim' 
				),
				
				array (
						'field' => 'twitterID',
						'label' => 'Twitter Handle',
						'rules' => 'trim' 
				) 
		);
		$this->form_validation->set_rules ( $rules );
		
		if ($this->form_validation->run () === FALSE) {
			$query = $this->db->get_where ( 'users', array (
					'userid' => $userid 
			) );
			
			$user = $query->row ();
			
			$userdata = array (
					'userid' => $user->userid,
					'email' => $user->email,
					'fullname' => $user->fullname,
					'githubID' => $user->githubID,
					'linkedinURL' => $user->linkedinURL,
					'steamID' => $user->steamID,
					'twitterID' => $user->twitterID,
					'permissions' => $this->_permissions_to_array ( $user->permissions ) 
			);
			
			$this->load->view ( 'user/edit', $userdata );
		} else {
			$permissionValue = 0;
			
			$this->input->post ( 'p_confirmed', TRUE ) == 1 ? $permissionValue += Permissions::USER_CONFIRMED : NULL;
			$this->input->post ( 'p_user', TRUE ) == 1 ? $permissionValue += Permissions::USER_ADMIN : NULL;
			$this->input->post ( 'p_points', TRUE ) == 1 ? $permissionValue += Permissions::POINTS_ADMIN : NULL;
			$this->input->post ( 'p_portfolio', TRUE ) == 1 ? $permissionValue += Permissions::PORTFOLIO_ADMIN : NULL;
			$this->input->post ( 'p_batch', TRUE ) == 1 ? $permissionValue += Permissions::BATCH_USER_CREATE : NULL;
			$this->input->post ( 'p_clothing', TRUE ) == 1 ? $permissionValue += Permissions::CLOTHING_ADMIN : NULL;
			$this->input->post ( 'p_mailer', TRUE ) == 1 ? $permissionValue += Permissions::MAILER_ADMIN : NULL;
			
			$userdata = array (
					'userid' => $this->input->post ( 'userid', TRUE ),
					'email' => $this->input->post ( 'email', TRUE ),
					'fullname' => $this->input->post ( 'fullname', TRUE ),
					'githubID' => $this->input->post ( 'githubID', TRUE ),
					'linkedinURL' => $this->input->post ( '$linkedinURL', TRUE ),
					'steamID' => $this->input->post ( 'steamID', TRUE ),
					'twitterID' => $this->input->post ( 'twitterID', TRUE ),
					'permissions' => $permissionValue 
			);
			
			$updated = $this->user_model->update ( $userdata );
			
			$userdata ['permissions'] = $this->_permissions_to_array ( $permissionValue );
			
			if ($updated !== FALSE) {
				$userdata ['message'] = "Update Successful";
				$this->load->view ( 'user/edit', $userdata );
			} else {
				$userdata ['errormessage'] = "Update Failed: " . $this->db->_error_message ();
				$this->load->view ( 'user/edit', $userdata );
			}
		}
	}

	public function reset($userid = -1) {
	}
}
