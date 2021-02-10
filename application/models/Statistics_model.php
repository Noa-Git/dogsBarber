<?php


class Statistics_model extends CI_Model
{
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->db->db_debug = FALSE;
	}

	public function get_services(){
		$error = null;
		$query = $this->db->query('SELECT service_name, count(service_name) as number1 FROM service inner join orders on service.id=orders.service_id GROUP BY service_name');
		$results = $query->result();
		if ($results) {
			return $results;
		}
		$error = $this->db->error();
		return $error;
	}

	public function get_orders_per_city(){
		$error = null;
		$query = $this->db->query('SELECT city, count(orders.id) as number2 from employee inner join orders on employee.id=orders.employee_id GROUP BY city');
		$results = $query->result();
		if ($results) {
			return $results;
		}
		$error = $this->db->error();
		return $error;
	}

	public function get_orders_this_year_by_month(){
		$error = null;
		$query = $this->db->query('SELECT MONTHNAME(order_date) as months_name, count(orders.id) as number3 from orders where YEAR(order_date)=YEAR(CURRENT_DATE()) GROUP BY months_name DESC');
		$results = $query->result();
		if ($results) {
			return $results;
		}
		$error = $this->db->error();
		return $error;
	}
}
