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
		$id = $this->session->id;
		$data['name']= $this->session->first_name;
		$data['services'] =$this->Statistics_model->get_all_services();
		$data['cust_services']= $this->Statistics_model->get_cust_services($id);
		$data['add_services'] =$this->Statistics_model->get_all_add_services();
		$data['cust_add_services']= $this->Statistics_model->get_cust_add_services($id);
		$data['orders'] = $this->Statistics_model->get_orders($id);
		$this->load->view('templates/styleCss');
		$this->load->view('templates/show_stat');
		$this->load->view('templates/header');
		$this->load->view('Statistics/display', $data);
		$this->load->view('templates/footer');
	}
}
