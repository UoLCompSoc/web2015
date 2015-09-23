<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function index() {
		$this->load->view("profile");
	}
	
	public function settings($showSuccess = FALSE) {
		$userdata = $this->user_model->get_logged_in();
		$userdata->passwordhash = null;
		
		$arr = (array)$userdata;
		if($showSuccess){
			$arr["notification_message"] = "Update successful!";
		}
		
		$this->load->view("settings", $arr);
	}
	
	public function update_profile() {
		$userdata = (array)$this->user_model->get_logged_in();
		
		$steamID = $this->input->post("steamID");
		$linkedInID = $this->input->post("linkedInID");
		$githubID = $this->input->post("githubID");
		$twitterID = $this->input->post("twitterID");
		
		$userdata["steamID"] = $steamID;
		$userdata["linkedinURL"] = $linkedInID;
		$userdata["githubID"] = $githubID;
		$userdata["twitterID"] = $twitterID;
		
		$this->settings($this->user_model->update($userdata));
	}
}