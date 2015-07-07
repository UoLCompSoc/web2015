<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends CI_Controller {

    public function __construct() {
        parent::__construct ();
        $this->load->model ( 'transaction_model' );
    }

	public function index() {
		$this->load->view('admin');
	}

    public function add(){
        $rules = array (
            array (
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required'
            ),

            array (
                'field' => 'amount',
                'label' => 'Amount',
                'rules' => 'required'
            ),

            array (
                'field' => 'pointtype',
                'label' => 'Point Type',
                'rules' => 'required'
            ),

            array (
                'field' => 'comment',
                'label' => 'Comment',
                'rules' => 'trim'
            )
        );

        $this->form_validation->set_rules($rules);

        $data = array();
        $data['email'] = $this->input->post('email') != FALSE ? $this->input->post('email') : '';
        $data['amount'] = $this->input->post('amount') != FALSE ? $this->input->post('amount') : '';
        $data['pointtype'] = $this->input->post('pointtype') != FALSE ? $this->input->post('pointtype') : '0';
        $data['comment'] = $this->input->post('comment') != FALSE ? $this->input->post('comment') : '';
        $data['pointtypes'] = $this->db->get('point_types')->result();

        if ($this->form_validation->run () === FALSE) {
            $this->load->view('point/add', $data);
        } else {
            $query = $this->db->get_where('users', array('email' => $this->input->post('email')));
            $user = $query->row();
            $this->db->flush_cache();

            $query = $this->db->get_where('users', array('email' => get_instance()->session->userdata('email')));
            $assigner = $query->row();

            $data['userid'] = $user->userid;
            $data['assignerid'] = $assigner->userid;
            $data['timecreated'] = date('Y-m-d H:i:s');

            if($user->userid != $assigner->userid){
                if($this->transaction_model->insert($data) == TRUE){
                    $data['message'] = 'Assigned ' . $data['amount'] . ' points to ' . $user->fullname;
                    $data['email'] = '';
                    $data['amount'] = '';
                    $data['pointtype'] = '0';
                    $data['comment'] = '';

                    //TODO add log points are added to a user
                } else {
                    $data['errormessage'] = 'Failure to assign points' . $this->db->_error_message();
                }
            } else {
                $data['errormessage'] = 'You cannot assign points to yourself ' . $assigner->fullname;
                //TODO add log when users add points to self
            }
            $this->load->view('point/add', $data);
        }


    }
}