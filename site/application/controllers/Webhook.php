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

    public function lecture(){
        //Load github specific tokens
        $webhook_secret = $this->config->item ( 'github_webhook_secret' );
        $client_id = $this->config->item ( 'github_client_id' );
        $client_secret = $this->config->item ( 'github_client_secret' );

        if (!isset($_SERVER['HTTP_X_HUB_SIGNATURE'])) {
            throw new \Exception("HTTP header 'X-Hub-Signature' is missing.");
        } elseif (!extension_loaded('hash')) {
            throw new \Exception("Missing 'hash' extension to check the secret code validity.");
        }

        list($algo, $hash) = explode('=', $_SERVER['HTTP_X_HUB_SIGNATURE'], 2) + array('', '');
        if (!in_array($algo, hash_algos(), TRUE)) {
            throw new \Exception("Hash algorithm '$algo' is not supported.");
        }
        $rawPost = file_get_contents('php://input');
        if ($hash !== hash_hmac($algo, $rawPost, $webhook_secret)) {
            throw new \Exception('Hook secret does not match.');
        }

        $url = "https://api.github.com/repos/UoLCompSoc/Lectures/contents/2015-2016?client_id=" . $client_id . "&client_secret=" . $client_secret;

        $decoded = json_decode ( $this->_getContent ( $url ) );

        $lectures = array();

        foreach($decoded as $file){
            if($file->download_url != null && strpos($file->name, 'Lecture') == 0){
                array_push($lectures, $file);

                $filename = $file->name;
                $filepath = APPPATH . 'cache/lectures/' . $filename;
                $this->_putContent($filepath, $this->_getContent($file->download_url), 'w');
            }
        }
    }

    private function _putContent($filepath, $content, $type){
        if (! write_file ( $filepath, $content, $type)) {
            log_message ( 'error', 'Cannot write to lecture cache file at ' . $filepath );
        }
    }

	public function update() {
        //Load github specific tokens
        $webhook_secret = $this->config->item ( 'github_webhook_secret' );
        $client_id = $this->config->item ( 'github_client_id' );
        $client_secret = $this->config->item ( 'github_client_secret' );

        if (!isset($_SERVER['HTTP_X_HUB_SIGNATURE'])) {
		    throw new \Exception("HTTP header 'X-Hub-Signature' is missing.");
	    } elseif (!extension_loaded('hash')) {
		    throw new \Exception("Missing 'hash' extension to check the secret code validity.");
	    }

        list($algo, $hash) = explode('=', $_SERVER['HTTP_X_HUB_SIGNATURE'], 2) + array('', '');
        if (!in_array($algo, hash_algos(), TRUE)) {
            throw new \Exception("Hash algorithm '$algo' is not supported.");
        }
        $rawPost = file_get_contents('php://input');
        if ($hash !== hash_hmac($algo, $rawPost, $webhook_secret)) {
            throw new \Exception('Hook secret does not match.');
        }

		$url = "https://api.github.com/users/UoLCompSoc/repos?per_page=10&client_id=" . $client_id . "&client_secret=" . $client_secret;

		$decoded = json_decode ( $this->_getContent ( $url ) );

        $github_data = array();

        foreach ( $decoded as $repo ) {
			if($repo->fork === TRUE){
                continue;
            }

            $collaborators = json_decode ( $this->_getContent ( $repo->contributors_url ) );
			$repo->collaborator_count = sizeof ( $collaborators );

            array_push($github_data, $repo);
		}


		$filepath = APPPATH . 'cache/repocache.json';

		if (! write_file ( $filepath, json_encode ( $github_data ), 'w' )) {
			log_message ( 'error', 'Cannot write to github cache file at ' . $filepath );
		}
		
		//$this->load->view ( 'admin' );
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
