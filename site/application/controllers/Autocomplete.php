<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autocomplete extends CI_Controller {

    public function index() {
        $this->load->view('autocomplete');
    }

	public function email() {	  	      
	    $queryString = $this->input->post_get('emailQuery');

	    if(!Permissions::is_authorized(Permissions::USER_ADMIN)){
	        echo "{}";
	        return;
	    }
	    
	    if(empty($queryString)){
	        echo "{}";
	        return;
	    }
	    
	    $results = array();
	    
        $this->db->select('email');
        $this->db->like('email', $queryString);
        $query = $this->db->get('users', 5)->result();
        
        foreach($query as $row){
            $result['value'] = $row->email;
            $result['label'] = $row->email;
            $results[] = $result;
        }
        
        $to_send = json_encode($results);
        
        log_message('debug', $to_send);
        
        echo $to_send;
	}
}
