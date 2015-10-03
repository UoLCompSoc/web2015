<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Order_model extends CI_Model {
	// core details
	var $id = - 1;
	var $userid = '';
	var $campaign = '';
	var $size_id = '';
	var $paid = '';

	public function __construct() {
		parent::__construct ();
	}

	public function insert($orderdata) {
		$insertdata = array (
				'userid' => $orderdata ['userid'],
				'campaign_id' => $orderdata ['campaign_id'],
				'size_id' => $orderdata ['size_id'],
				'paid' => false
        );
		
		if (! $this->db->insert ( 'orders', $insertdata )) {
			log_message ( 'error', "Insert failed on database when creating order: " . $this->db->error () ['message'] );
			return FALSE;
		} else {
			syslog ( LOG_INFO, "Successfully created order for {$insertdata['userid']}." );
			return TRUE;
		}
	}

	public function update($orderdata) {
        $this->db->where ( 'userid', $orderdata ['userid'] );
        $this->db->where ( 'campaign_id', $orderdata ['campaign_id'] );
		if (! $this->db->update ( 'orders', $orderdata )) {
			log_message ( 'error', "Update failed on database when updating order: " . $this->db->error () ['message'] );
			return FALSE;
		} else {
			syslog ( LOG_INFO, "Successfully updated order {$orderdata['userid']}." );
			return TRUE;
		}
	}

    public function delete ($order_id){
        if(!$this->db->delete('orders', array('id' => $order_id))){
            log_message ( 'error', "Delete failed on database when deleting order: " . $this->db->error () ['message'] );
            return FALSE;
        } else {
            syslog ( LOG_INFO, "Successfully deleted order {$order_id}." );
            return TRUE;
        }
    }

}
