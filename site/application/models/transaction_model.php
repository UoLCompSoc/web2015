<?php
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
}