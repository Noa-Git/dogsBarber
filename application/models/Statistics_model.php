<?php


class Statistics_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db->db_debug = FALSE;
	}

	public function get_services()
	{
		$error = null;
		$query = $this->db->query('SELECT service_name, count(service_name) as number1 FROM service inner join orders on service.id=orders.service_id GROUP BY service_name');
		$results = $query->result();
		if ($results) {
			return $results;
		}
		$error = $this->db->error();
		return $error;
	}

	public function get_orders_per_city()
	{
		$error = null;
		$query = $this->db->query('SELECT city, count(orders.id) as number2 from employee inner join orders on employee.id=orders.employee_id GROUP BY city');
		$results = $query->result();
		if ($results) {
			return $results;
		}
		$error = $this->db->error();
		return $error;
	}

	public function get_orders_this_year_by_month()
	{
		$error = null;
		$query = $this->db->query('SELECT MONTHNAME(order_date) as months_name, count(orders.id) as number3 from orders where YEAR(order_date)=YEAR(CURRENT_DATE()) GROUP BY months_name DESC');
		$results = $query->result();
		if ($results) {
			return $results;
		}
		$error = $this->db->error();
		return $error;
	}

//	public function get_common_services_at_your_city($city){
//		$error = null;
//		$sql = "SELECT service_name, count(service_name) as number4 FROM orders inner join service on orders.service_id=service.id inner join address on orders.customer_id=address.customer_id WHERE city=?";
//		$query = $this->db->query($sql, array($city));
//		$results = $query->result();
//		print_r($results);
//		if ($results) {
//			return $results;
//		}
//		$error = $this->db->error();
//		return $error;
//	}

	public function get_cust_orders($id)
	{
		$error = null;
		$query1 = $this->db->query('SELECT MONTHNAME(order_date) as months_name, count(id) as number5 from orders where order_date IS NOT NULL and YEAR(order_date)=YEAR(CURRENT_DATE()) GROUP BY months_name DESC');
		$res_all = $query1->result();
		$sql = 'SELECT MONTHNAME(order_date) as months_name, count(id) AS cust_ord FROM orders WHERE order_date IS NOT NULL AND customer_id = ?';
		$query2 = $this->db->query($sql, array($id));
		$res_cust = $query2->result();
		if ($res_cust and $res_all) {
			$results = array('genreal'=>$res_all, 'cust'=>$res_cust);
			return $results;
		}
		$error = $this->db->error();
		return $error;
	}
}
