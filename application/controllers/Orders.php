<?php


class Orders extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('Customers_model');
		$this->load->model('Dogs_model');
		$this->load->model('Employee_model');
		$this->load->model('Address_model');
		$this->load->model('Services_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
	}

	public function add(){
		if ($this->session->loggedin == null){
			$this->session->set_userdata('referrer',uri_string());
			redirect("Customers/login");
		}
		$id = $this->session->id;
		$data['address'] = $this->Address_model->get_address_by_cust_id($id);
		if ($data['address']->city == null){
			$this->session->set_userdata('referrer',uri_string());
			redirect("Customers/address");
		}
		$data['customer'] =$this->Customers_model->get_customer_by_id($id);
		$data['dogs'] = $this->Dogs_model->get_dog_by_cust_id($id);
		$data['add_services'] = $this->Services_model->get_add_services();
		$data['services'] = $this->get_available_services();


		$this->load->view('templates/styleCss');
		$this->load->view('templates/orderCss');
		$this->load->view('templates/header');
		$this->load->view('orders/new_order', $data);
		$this->load->view('templates/footer');

	}

	public function place_order(){
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('time', 'Time', 'required');

		if ($this->form_validation->run() == false){
			$errors = array(
				'error' => true,
				'date_error' => form_error('date'),
				'time_error' => form_error('time')
			);
			echo json_encode($errors);
			return;
		}
		$data_in = $this->input->post();
		echo json_encode(array('success' => true));
	}

	public function complete(){
		echo 'order completed successfully!';
	}

	private function get_available_services(){
		//dummy data until Elad's implementation
		return array(
			"1"=>array(
				'employees'=>array(
					array('employee_id'=>'1','employee_name'=>'Itamar'),
					array('employee_id'=>'2','employee_name'=>'Elad')
				),
				'service_name'=>'Shower',
				'price'=>'100'
			),
			"2"=>array(
				'employees'=>array(
					array('employee_id'=>'1','employee_name'=>'Itamar'),
					array('employee_id'=>'3','employee_name'=>'moshe')
				),
				'service_name'=>'Haircut',
				'price'=>'150'
			)
		);
	}




}
