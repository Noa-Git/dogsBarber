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
        
        public function get_add_services_by_order_id($order_id){
		$error = null;
		$sql = 'SELECT * 
				FROM Additional_services INNER JOIN Order_add 
				    ON Additional_services.id = Order_add.additional_services_id
				WHERE Order_add.Orders_id = ? ';
                //$this->db->join('Order_add', 'Additional_services.id = Order_add.additional_services_id');
		$query = $this->db->query($sql,array($order_id));
                
		if ($query) {
			return $query->result();
		}
		$error = $this->db->error();
		return $error;
	}

}
