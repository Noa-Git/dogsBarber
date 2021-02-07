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
		// To do: check services not null -> send to no_services_available
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
		//declare empty array
		$avialable_employees_by_service = array();

		//get geocode
		$location_data = getLatitudeAndLongitude();
		if ($location_data['error']) {
			return null;
		}

		//get all employees from DB
		$data['employees'] = $this->Employee_model->get_employees();
		// get all services from DB
		$data['services'] = $this->Services_model->get_services();

		//create return array structure by services
		foreach ($services as $service) {
			$servie_id = $service->id;
			$service_name = $service->name;
			$service_price = $service->price;
			$avialable_employees_by_service[$servie_id] = array( 'employees' => array(), 'price'=> $service_price, 'service_name' => $service_name);
		}

		// get available employees and their services
		foreach ($emplyees as $employee) {

			// calcDistance with each employee -> get a number which is the distance.
			$distance = calc_distance($employee->latitude, $employee->longitude, $location_data->latitude, $location_data->longitude);

			// if the number is lower than employee raduis -> the employee is available
			if ( $distance <= $employee->radius ) {

				$employee_id = $emplyee->id;
				$employee_fiest_name = $employee->first_name;
				$employee_last_name = $employee->last_name;
				$employee_full_name = $employee_fiest_name." ".$employee_last_name;

				//get employee's services
				$data['tepm_services'] = $this->Employee_model->get_employee_services_by_emp_id($employee_id);

				//push employee's services to the returned array
				foreach ($temp_services as $temp_service) {
					$service_id = $temp_service->service_id;
					$avialable_employees_by_service[$service_id]['employees'] = array('employee_id' => $employee_id, 'employee_name' => $employee_full_name);
				}
			}
		}

		return $avialable_employees_by_service;

	}

	private function getLatitudeAndLongitude() {
		// 1. get user address from db
		$id = $this->session->id;
		$data['address'] = $this->Address_model->get_address_by_cust_id($id);
		$street = $address->street;
		$city = $address->city;

		// implement API call
		$url = "https://api.positionstack.com/v1/forward?access_key=33576097aa621d30119b54a9621279d3&query=".urlecode($street).",".urlencode($city);
		$response = file_get_contents($url);

		if ($response) {

			$location_response = json_decode($response, true);
			$location_data['latitude'] = $location_response['data']['results'][0]['latitude'];
			$location_data['longitude'] = $location_response['data']['results'][0]['longitude'];

			return $location_data;
		} else {

			$data['error']= 1;
			$data['message'] = 'Could not find Geocode for this address';

			return $data;
		}
	}

	private function calc_distance($employeeLatitude, $employeeLongitude, $customerLatitude, $ecustomerLongitude) {

		// getting employee and customer latitude and longitude
		$radEmpLat = deg2rad($employeeLatitude);
		$radEmpLon = deg2rad($employeeLongitude);
		$radCusLat = deg2rad($customerLatitude);
		$radCusLon = deg2rad($ecustomerLongitude);

		//set up data
		$finalLong = $radEmpLon - $radCusLon;
		$finalLati = $radEmpLat - $radCusLat;

		// calculate distance
		$val = pow(sin($finalLati/2),2) + cos($radCusLat) * cos($radEmpLat) * pow(sin($finalLong/2),2);
		$res = 2 * asin(sqrt($val));
		$radius = 3958.756;

		// return a number
		return ($res * $radius);
	}

}
