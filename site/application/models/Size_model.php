<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Size_model extends CI_Model {
	// core details
	var $id = - 1;
	var $userid = '';
	var $campaign = '';
	var $size_id = '';
	var $paid = '';

	public function __construct() {
		parent::__construct ();
	}

	public function insert($sizedata) {
		$insertdata = array (
				'name' => $sizedata ['name'],
				'description' => $sizedata ['desc'] 
		);
		
		if (! $this->db->insert ( 'clothing_sizes', $insertdata )) {
			log_message ( 'error', "Insert failed on database when creating order: " . $this->db->error () ['message'] );
			return FALSE;
		} else {
			syslog ( LOG_INFO, "Successfully created order for {$insertdata['name']}." );
			return TRUE;
		}
	}

	public function update($sizedata) {
		$updatedata = array (
				'name' => $sizedata ['name'],
				'description' => $sizedata ['desc'] 
		);
		
		$this->db->where ( 'id', $sizedata ['size_id'] );
		if (! $this->db->update ( 'clothing_sizes', $updatedata )) {
			log_message ( 'error', "Update failed on database when updating size: " . $this->db->error () ['message'] );
			return FALSE;
		} else {
			syslog ( LOG_INFO, "Successfully updated size {$sizedata['name']}." );
			return TRUE;
		}
	}
}
