<?php

class Customers_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
		$this->db->db_debug = FALSE;
    }

    public function get_customer_by_id($id){

    	$query = $this->db->get_where('Customer', array('id' => $id));
		if ($query->result()){
			return $query->result()[0];
		}
		return null;
	}

    public function get_customers() {


        $error = null;
        $query = $this->db->get('Customer');
        if ($query) {
            return $query->result();
        }
        $error = $this->db->error();
        return $error;
    }

    public function save($data) {

        $error = null;

        $encrypted = $this->encrypt($data['password'],  $data['id']);
        $data['password'] = $encrypted;

        if (!$this->db->insert('Customer', $data)) {
            $error = $this->db->error();
        }
        return $error;
    }

    public function update($id, $data){

		$error = null;

		if (!$this->db->update('Customer', $data, array('id' => $id))) {
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

    public function generateId (){
		$strong_result = true;
		$bytes = openssl_random_pseudo_bytes(16, $strong_result);
		return  bin2hex($bytes);
	}

}
