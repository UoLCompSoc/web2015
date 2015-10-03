<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Campaign_model extends CI_Model {
	// core details
	var $id = - 1;
	var $userid = '';
	var $campaign = '';
	var $size_id = '';
	var $paid = '';

	public function __construct() {
		parent::__construct ();
	}

	public function insert($campaigndata) {
		$insertdata = array (
				'name' => $campaigndata ['name'],
				'description' => $campaigndata ['desc'],
				'expiry_date' => $campaigndata ['date']
        );
		
		if (! $this->db->insert ( 'campaigns', $insertdata )) {
			log_message ( 'error', "Insert failed on database when creating campaign: " . $this->db->error () ['message'] );
			return FALSE;
		} else {
			syslog ( LOG_INFO, "Successfully created campaign for {$insertdata['name']}." );
			return TRUE;
		}
	}

	public function update($campaigndata) {
        $updatedata = array (
            'name' => $campaigndata ['name'],
            'description' => $campaigndata ['desc'],
            'expiry_date' => $campaigndata ['date']
        );

        $this->db->where ( 'id', $campaigndata['campaign_id'] );
		if (! $this->db->update ( 'campaigns', $updatedata )) {
			log_message ( 'error', "Update failed on database when updating campaign: " . $this->db->error () ['message'] );
			return FALSE;
		} else {
			syslog ( LOG_INFO, "Successfully updated campaign {$campaigndata['campaign_id']}." );
			return TRUE;
		}
	}

}
