<?php


class Services_model extends CI_Model
{
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->db->db_debug = FALSE;
	}

	public function get_services() {
		$error = null;
		$query = $this->db->get('Service');
		if ($query) {
			return $query->result();
		}
		$error = $this->db->error();
		return $error;
	}

	public function get_add_services(){
		$error = null;
		$query = $this->db->get('Additional_services');
		if ($query) {
			return $query->result();
		}
		$error = $this->db->error();
		return $error;
	}

}
