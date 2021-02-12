<?php


class Statistics_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db->db_debug = FALSE;
	}

	public function get_all_services()
	{
		$error = null;
		$query = $this->db->query('SELECT service_name, count(service_name) as number1 FROM Service inner join Orders on Service.id=Orders.service_id GROUP BY service_name');
		if ($query) {
			return $query->result();
		}
		$error = $this->db->error();
		return $error;
	}

	public function get_cust_services($id)
	{
		$error = null;
		$sql = 'SELECT service_name, count(service_name) as number4 FROM Service inner join Orders on Service.id=Orders.service_id WHERE orders.customer_id=?GROUP BY service_name';
		$query = $this->db->query($sql, array($id));
		if ($query) {
			return $query->result();
		}
		$error = $this->db->error();
		return $error;
	}

	public function get_all_add_services()
	{
		$error = null;
		$query = $this->db->query('SELECT additional_services.service_name as add_service_name, count(order_add.additional_services_id) as number2 FROM Order_add inner join Additional_services on Order_add.additional_services_id=Additional_services.id GROUP BY service_name');
		if ($query) {
			return $query->result();
		}
		$error = $this->db->error();
		return $error;
	}

	public function get_cust_add_services($id){
		$error = null;
		$sql = 'SELECT additional_services.service_name as add_service_name, count(order_add.additional_services_id) as count_add_services FROM Order_add inner join Additional_services on Order_add.additional_services_id=Additional_services.id WHERE Orders_id in(select id from Orders where customer_id=?) GROUP BY service_name';
		$query = $this->db->query($sql, array(array($id)));
		if ($query) {
			return $query->result();
		}
		$error = $this->db->error();
		return $error;
	}

	public function get_orders($id)
	{
		$error = null;
		$query1 = $this->db->query('SELECT MONTHNAME(order_date) as months_name, count(id) as number5 from Orders where order_date IS NOT NULL and YEAR(order_date)=YEAR(CURRENT_DATE()) GROUP BY months_name DESC');
		$sql = 'SELECT MONTHNAME(order_date) as months_name, count(id) AS cust_ord FROM Orders WHERE order_date IS NOT NULL AND customer_id = ?';
		$query2 = $this->db->query($sql, array($id));
		if ($query1 and $query2) {
			$res_all = $query1->result();
			$res_cust = $query2->result();
			$results = array('genreal' => $res_all, 'cust' => $res_cust);
			return $results;
		}
		$error = $this->db->error();
		return $error;
	}

}
