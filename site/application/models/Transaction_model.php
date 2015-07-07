<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Transaction_model extends CI_Model {
    var $id = -1;

    var $user = null;
    var $assigner = null;

    var $timecreated = '';

    var $amount = 0;
    var $pointtype = null;

    var $transaction_comment = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data){
        $insertdata = array(
            'userid' => $data['userid'],
            'assignerid' => $data['assignerid'],
            'timecreated' => date('Y-m-d H:i:s'),
            'amount' => $data['amount'],
            'pointtype' => $data['pointtype'],
            'transaction_comment' => $data['comment']
        );

        if(!$this->db->insert('transactions', $insertdata)) {
            log_message('error', "Insert failed on database when adding points to {$data['userid']}: " . $this->db->error()['message']);
            return FALSE;
        } else {
            syslog(LOG_INFO, "Successfully added {$data['amount']} points to {$data['userid']} by {$data['assignerid']}.");
            return TRUE;
        }
    }
}