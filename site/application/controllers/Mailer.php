<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Mailer extends CI_Controller {
	public function index() {
		$this->load->view('mailer/panel.php');
	}
	
	public function create() {
		$this->load->view('mailer/create.php');
	}
	
	public function view() {
		$this->load->view('mailer/view.php');
	}
}
