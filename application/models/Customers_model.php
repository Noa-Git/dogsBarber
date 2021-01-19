<?php

class Customers_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_customers() {

        $this->db->db_debug = FALSE;
        $error = null;
        $query = $this->db->get('Customer');
        if ($query) {
            return $query->result();
        }
        $error = $this->db->error();
        return $error;
    }

    public function save($data) {
        $this->db->db_debug = FALSE;
        $error = null;
        $encrypted = $this->encrypt($data['password']);
        $data['password'] = $encrypted;
        if (!$this->db->insert('Customer', $data)) {
            $error = $this->db->error();
        }
        return $error;
    }

    public function auth($data) {
        $new_data = array('email'=>$data['email']);
        $query = $this->db->get_where('Customer', $new_data);
		if ($query->result()!=null) {
			$res = $query->result();
			$password = $res[0]->password;
			$encrypted = $this->encrypt($data['password']);
			if ($password == $encrypted) {
				return $query->result();
			}
		}
		return null;
    }
    
    private function encrypt($password){
    	//salt created by hashing the reversed password
        $salt = md5(strrev($password));
        $encrypted = md5($password.$salt);
        return $encrypted;
    }

}
