<?php
class Projects extends CI_Controller {

    public function __construct() {
        parent::__construct ();
        $this->load->helper ( 'file' );
    }

	public function index() {
        $filepath = APPPATH . 'logs/repocache.json';
        $cachefile = read_file($filepath);
        $decoded = json_decode($cachefile);

        $data = array();
        $data['githubFeed'] = $decoded;

		$this->load->view ( "projects" , $data );
	}
}