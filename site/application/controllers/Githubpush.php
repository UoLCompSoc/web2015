<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Githubpush extends CI_Controller {
	public function index() {
		$res = $this->input->post(NULL, TRUE);
		$message = "Test";
		
		if($res != FALSE) {
			$message .= "Hello<br>";
			$message .= $this->input->get_request_header('X-Hub-Signature');
		}
		
		$this->load->view('ghfeed.php', array('notification_message'=>$message));
	}
}