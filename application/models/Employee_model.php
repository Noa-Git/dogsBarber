<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer_model
 *
 * @author itamar
 */
class Employee_model extends CI_Model{
    //put your code here

    public function __construct() {

        parent::__construct();
        $this->load->database();
		$this->db->db_debug = FALSE;
    }

    public function get_employees() {

        $error = null;
        $query = $this->db->get('Employee');
        if ($query) {
            return $query->result();
        }
        $error = $this->db->error();
        return $error;
    }

    public function get_employee_services_by_emp_id($emp_id) {
        $error = null;
        $data = array('employee_id' => $emp_id);
        $query = $this->db->get_where('Employee_services', $data);

        if ($query) {
            return $query->result();
        }
        $error = $this->db->error();
        return $error;

    }
}
