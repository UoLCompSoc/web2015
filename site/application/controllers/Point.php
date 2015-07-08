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

    public function view($userid = -1){
        if($userid == -1){
            $this->load->view('admin');
            return;
        }

        $this->db->select("a.fullname AS Assigner, t.amount, t.transaction_comment AS comment, p.title AS type, t.timecreated AS date");
        $this->db->from('transactions AS t');
        $this->db->order_by('t.timecreated');
        $this->db->where('t.userid', $userid);
        $this->db->join('point_types as p', 't.pointtype = p.id');
        $this->db->join('users as a', 't.assignerid = a.userid');

        $query = $this->db->get();

        $user = $this->db->get_where('users', array ('userid' => $userid));

        $this->db->select_sum('amount');
        $total = $this->db->get_where('transactions', array ('userid' => $userid));

        $data = array();
        $data['points'] = $query->result();
        $data['user'] = $user->row();
        $data['total'] = $total->row()->amount;

        $this->load->view('point/view', $data);
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
        $data['pointtype'] = $this->input->post('pointtype') != FALSE ? $this->input->post('pointtype') : '1';
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
                    $data['pointtype'] = '1';
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