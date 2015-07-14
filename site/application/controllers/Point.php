<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends CI_Controller
{

    const LOG_FILE = 'points_log.txt';
    const SELF_LOG_FILE = 'self_points_log.txt';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction_model');
        $this->load->helper('file');
    }

    public function index()
    {
        $this->load->view('point/dashboard');
    }

    public function view($userid = -1)
    {
        //Check if the view has been given a id to lookup
        if ($userid == -1) {
            $this->load->view('admin');
            return;
        }

        //TODO Make this less horrific
        //Gets a list of all of the points given to a user and associates the Full name of the assigner, as well as the type of the points given
        $this->db->select("a.fullname AS Assigner, t.amount, t.transaction_comment AS comment, p.title AS type, t.timecreated AS date");
        $this->db->from('transactions AS t');
        $this->db->order_by('t.timecreated');
        $this->db->where('t.userid', $userid);
        $this->db->join('point_types as p', 't.pointtype = p.id');
        $this->db->join('users as a', 't.assignerid = a.userid');
        $query = $this->db->get();

        //Gets the user
        $user = $this->db->get_where('users', array('userid' => $userid));

        //Get the sum of all of their points
        $this->db->select_sum('amount');
        $total = $this->db->get_where('transactions', array('userid' => $userid));

        $data = array();
        $data['points'] = $query->result();
        $data['user'] = $user->row();
        $data['total'] = $total->row()->amount;

        $this->load->view('point/view', $data);
    }

    /**
     * Method that controls the entire points adding process
     */
    public function add()
    {
        $rules = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required'
            ),

            array(
                'field' => 'amount',
                'label' => 'Amount',
                'rules' => 'required'
            ),

            array(
                'field' => 'pointtype',
                'label' => 'Point Type',
                'rules' => 'required'
            ),

            array(
                'field' => 'comment',
                'label' => 'Comment',
                'rules' => 'trim'
            )
        );

        $this->form_validation->set_rules($rules);

        /*
         * If there is POST data (form has been submitted) then use that data instead blank data
         */
        $data = array();
        $data['email'] = $this->input->post('email') != FALSE ? $this->input->post('email') : '';
        $data['amount'] = $this->input->post('amount') != FALSE ? $this->input->post('amount') : '';
        $data['pointtype'] = $this->input->post('pointtype') != FALSE ? $this->input->post('pointtype') : '1';
        $data['comment'] = $this->input->post('comment') != FALSE ? $this->input->post('comment') : '';
        $data['pointtypes'] = $this->db->get('point_types')->result();

        /*
         * Check if the page is being visited for the first time
         */
        if ($this->form_validation->run() === FALSE) {
            //Load empty page
            $this->load->view('point/add', $data);
        } else {
            //Get the userid associated with the user getting the points
            $query = $this->db->get_where('users', array('email' => $this->input->post('email')));
            $user = $query->row();
            $this->db->flush_cache();

            //Gets the userid of the user giving the points
            $query = $this->db->get_where('users', array('email' => get_instance()->session->userdata('email')));
            $assigner = $query->row();

            //Add the data to the array
            $data['userid'] = $user->userid;
            $data['assignerid'] = $assigner->userid;
            $data['timecreated'] = date('Y-m-d H:i:s');

            //Check that the user is not giving themselves points
            if ($user->userid != $assigner->userid) {
                //Attempt to insert the record into the database
                if ($this->transaction_model->insert($data) == TRUE) {
                    // Log the points being added in the database
                    $this->_logAdd($data);

                    // Clear the form data
                    $data['message'] = 'Assigned ' . $data['amount'] . ' points to ' . $user->fullname;
                    $data['email'] = '';
                    $data['amount'] = '';
                    $data['pointtype'] = '1';
                    $data['comment'] = '';
                    $data['clear'] = true;
                } else {
                    //Adding the record failed
                    $data['errormessage'] = 'Failure to assign points' . $this->db->_error_message();
                }
            } else {
                $this->_logSelfAdd($data);
                $data['errormessage'] = 'You cannot assign points to yourself ' . $assigner->fullname;
            }

            $this->load->view('point/add', $data);
        }
    }

    /**
     * Stores a copy of the points transaction a separate log file
     * @param $data
     */
    private function _logAdd($data)
    {
        $filepath = APPPATH . 'logs/' . Point::LOG_FILE;

        //Separate the data with commas
        $data_to_append = $data['userid'] . ',' . $data['assignerid'] . ',' . $data['amount'] . ',' . date('Y-m-d H:i:s') . "\n";

        if (!write_file($filepath, $data_to_append, 'a')) {
            log_message('error', 'Cannot write to points log file at ' . $filepath);
        }
    }

    /**
     * Stores a copy of the points transaction a separate log file
     * @param $data
     */
    private function _logSelfAdd($data)
    {
        $filepath = APPPATH . 'logs/' . Point::SELF_LOG_FILE;

        //Separate the data with commas
        $data_to_append = $data['assignerid'] . ',' . $data['amount'] . ',' . date('Y-m-d H:i:s') . "\n";

        if (!write_file($filepath, $data_to_append, 'a')) {
            log_message('error', 'Cannot write to self giving points log file at ' . $filepath);
        }
    }
}