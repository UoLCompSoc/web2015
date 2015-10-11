<?php
class Projects extends CI_Controller {

    public function __construct() {
        parent::__construct ();
        $this->load->helper ( 'file' );
    }

	public function index() {
        $filepath = APPPATH . 'cache/repocache.json';
        $cachefile = read_file($filepath);
        $decoded = json_decode($cachefile);

        usort($decoded, function($a, $b)
        {
            return ($a->pushed_at < $b->pushed_at);
        });

        $data = array();
        $data['githubFeed'] = $decoded;

		$this->load->view ( "projects" , $data );
	}
}