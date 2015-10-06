<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Lectures extends CI_Controller {

    public static function getLectureCachePath(){
        return APPPATH . 'cache/lectures/';
    }

    public function __construct() {
        parent::__construct ();
        $this->load->helper ( 'file' );
        $this->load->helper('url');
    }

	public function index() {
        $data = array();
        $lecture_array = array();

        $lectures = scandir(Lectures::getLectureCachePath());

        foreach($lectures as $lecture){
            if(strpos($lecture, "Lecture") === 0){
                $parts = explode(" - ", $lecture);
                $new_lecture = new stdClass ();
                $new_lecture->id = str_replace("Lecture ", "", $parts[0]);
                $new_lecture->name = str_replace(".md", "", $parts[1]);
                array_push($lecture_array, $new_lecture);
            }
        }

        $data['lectures'] = $lecture_array;

        $this->load->view('lectures/index', $data);
	}

    private function _isValidLectureID($lecture_id){
        $lectures = scandir(Lectures::getLectureCachePath());
        foreach($lectures as $lecture){
            if(strpos($lecture, $lecture_id)){
                return $lecture;
            }
        }

        return NULL;
    }

    public function get($lecture_id = NULL){

        if($lecture_id == NULL || !is_numeric($lecture_id)){
            return;
        }

        $filename = $this->_isValidLectureID($lecture_id);
        if($filename == NULL){
            return;
        }

        $contents = read_file(Lectures::getLectureCachePath() . $filename);
        $contents = str_replace("---", "!", $contents);
        echo $contents;
    }

    public function display($lecture_id = NULL, $data = array()){
        if($lecture_id == NULL || !is_numeric($lecture_id)){
            return;
        }

        $filename = $this->_isValidLectureID($lecture_id);
        if($filename == NULL){
            return;
        }

        $data['presentation'] = '/lectures/get/' . $lecture_id;
        $this->load->view('lectures/presenter', $data);
    }

    public function update(){
        $client_id = $this->config->item ( 'github_client_id' );
        $client_secret = $this->config->item ( 'github_client_secret' );

        $url = "https://api.github.com/repos/UoLCompSoc/Lectures/contents/2015-2016?client_id=" . $client_id . "&client_secret=" . $client_secret;

        $decoded = json_decode ( $this->_getContent ( $url ) );

        $lectures = array();

        foreach($decoded as $file){
            if($file->download_url != null && strpos($file->name, 'Lecture') == 0){
                array_push($lectures, $file);

                $filename = $file->name;
                $filepath = Lectures::getLectureCachePath() . $filename;
                $this->_putContent($filepath, $this->_getContent($file->download_url), 'w');
            }
        }
    }

    function _putContent($filepath, $content, $type){
        if (! write_file ( $filepath, $content, $type)) {
            log_message ( 'error', 'Cannot write to lecture cache file at ' . $filepath );
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