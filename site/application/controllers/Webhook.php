<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Webhook extends CI_Controller {

	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'file' );
	}

	public function index() {
		$this->load->view ( 'index' );
	}

	public function update() {
		$client_id = $this->config->item ( 'github_client_id' );
		$client_secret = $this->config->item ( 'github_client_secret' );

		$url = "https://api.github.com/users/UoLCompSoc/repos?per_page=10&client_id=" . $client_id . "&client_secret=" . $client_secret;

		$decoded = json_decode ( $this->_getContent ( $url ) );
		
		usort($decoded, function($a, $b)
        {
            return ($a->pushed_at < $b->pushed_at);
        });

        $github_data = array();

        foreach ( $decoded as $repo ) {
			if($repo->fork === TRUE){
                continue;
            }

            $collaborators = json_decode ( $this->_getContent ( $repo->contributors_url ) );
			$repo->collaborator_count = sizeof ( $collaborators );

            array_push($github_data, $repo);
		}


		$filepath = APPPATH . 'logs/repocache.json';

		if (! write_file ( $filepath, json_encode ( $github_data ), 'w' )) {
			log_message ( 'error', 'Cannot write to github cache file at ' . $filepath );
		}
	}

	function _getContent($url) {
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_USERAGENT, 'Compsoc Website' );
		$html_content = curl_exec ( $ch );
		curl_close ( $ch );

		return $html_content;
	}
}
