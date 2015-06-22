<?php

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('user_model');
	}
	
	public function index() {
		$this->load->view('login.php');
	}
	
	public function login_process() {
		echo 'Not implemented yet';
	}
	
	public function register_process() {
		echo 'Not implemented yet';
	}
}