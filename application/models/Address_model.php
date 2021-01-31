<?php


class Address_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db->db_debug = FALSE;
	}

	public function save($data){
		$error = null;

		if (!$this->db->insert('address', $data)) {
			$error = $this->db->error();
		}
		return $error;
	}

	public function get_address_by_cust_id ($cust_id){
		$data = array('customer_id' => $cust_id);
		$query = $this->db->get_where('address', $data);
		if ($query->result()){
			return $query->result()[0];
		}
		return null;

	}

	public function update($cust_id, $data){
		$error = null;
		if (!$this->db->update('address', $data, array('customer_id' => $cust_id))) {
			$error = $this->db->error();
		}
		return $error;
	}
}
