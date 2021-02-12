<?php

class Statistics extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Statistics_model');
		$this->load->library('session');
	}

	public function show_stat() {
		if ($this->session->loggedin == null){
			$this->session->set_userdata('referrer',uri_string());
			redirect("Customers/login");
		}
		$data['name']= $this->session->first_name;
		$data['services'] =$this->Statistics_model->get_services();
		$data['orders_per_city'] = $this->Statistics_model->get_orders_per_city();
		$data['orders_per_date'] = $this->Statistics_model->get_orders_this_year_by_month();
		$city = $this->session->city;
		$id = $this->session->id;
		$data['cust_orders'] = $this->Statistics_model->get_cust_orders($id);
//		$data['cust_city']=$this->Statistics_model->get_common_services_at_your_city($city);
		$this->load->view('templates/styleCss');
		$this->load->view('templates/header');
		$this->load->view('Statistics/display', $data);
		$this->load->view('templates/footer');
	}
}
