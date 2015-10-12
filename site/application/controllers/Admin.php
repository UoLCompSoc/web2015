<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Admin extends CI_Controller {

	public function index() {
		Permissions::require_admin ();
		
		$this->load->view ( 'admin' );
	}
}