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
        //Generating a random safe for encryption ID. will also be used as salt for password
        $id = $this->generateId();
        $encrypted = $this->encrypt($data['password'], $id);
        $data['password'] = $encrypted;
        $data['id'] = $id;
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
			$encrypted = $this->encrypt($data['password'], $res[0]->id);
			if ($password == $encrypted) {
				return $query->result();
			}
		}
		return null;
    }
    
    private function encrypt($password, $salt){
    	//salt is the randomly generated id
        $encrypted = md5($password.$salt);
        return $encrypted;
    }

    private function generateId (){
		$strong_result = true;
		$bytes = openssl_random_pseudo_bytes(16, $strong_result);
		return  bin2hex($bytes);
	}

}
