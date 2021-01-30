<?php


class Dogs_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db->db_debug = FALSE;
	}

	public function save($data) {

		$error = null;

		if (!$this->db->insert('Dog', $data)) {
			$error = $this->db->error();
		}
		return $error;
	}

	public function get_dog_by_cust_id ($cust_id){

		$data = array('customer_id' => $cust_id);
		$query = $this->db->get_where('dog', $data);
		return $query->result();

	}

}
