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
            if(strpos($lecture, $this->security->xss_clean($lecture_id))){
                return $lecture;
            }
        }

        return NULL;
    }

    public function get($lecture_id = NULL){

        $lecture_id = $this->security->xss_clean($lecture_id);

        if($lecture_id == NULL || !is_numeric($lecture_id)){
            $this->index();
            return;
        }

        $filename = $this->_isValidLectureID($lecture_id);
        if($filename == NULL){
            $this->index();
            return;
        }

        $contents = read_file(Lectures::getLectureCachePath() . $filename);
        $contents = str_replace("---", "!", $contents);
        echo $contents;
    }

    public function display($lecture_id = NULL, $data = array()){
        if($lecture_id == NULL || !is_numeric($lecture_id)){
            $this->index();
            return;
        }

        $filename = $this->_isValidLectureID($lecture_id);
        if($filename == NULL){
            $this->index();
            return;
        }

        $data['presentation'] = '/lectures/get/' . $lecture_id;
        $this->load->view('lectures/presenter', $data);
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