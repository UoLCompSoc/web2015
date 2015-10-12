<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Bits extends CI_Controller {

	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'transaction_model' );
	}

	public function index() {
		$data = array ();
		$data ['leaderboard'] = $this->_getPointLeaderboard ()->result ();
		
		$this->load->view ( 'bits', $data );
	}

	private function _getPointLeaderboard() {
		
		/**
		 * Query used to get a leaderboard of the top ten users
		 *
		 * SELECT fullname, users.userid, SUM(amount) as total FROM transactions
		 * JOIN users ON users.userid = transactions.userid
		 * GROUP BY userid
		 * ORDER BY total
		 * LIMIT 10;
		 */
		
		// TODO Make this less horrific
		// Gets a list of all of the points given to a user and associates the Full name of the assigner, as well as the type of the points given
		$this->db->select ( "u.fullname, u.userid, SUM(t.amount) as total" );
		$this->db->from ( 'transactions AS t' );
		$this->db->group_by ( 'u.userid' );
		$this->db->order_by ( 'total', "desc" );
		$this->db->join ( 'users as u', 't.userid = u.userid' );
		$this->db->limit ( 10 );
		return $this->db->get ();
	}
}
