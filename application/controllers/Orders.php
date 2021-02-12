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
		$this->load->model('Orders_model');
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
		if ($data['services'] == null){
			$this->no_service();
		}

		$this->load->view('templates/styleCss');
		$this->load->view('templates/orderCss');
		$this->load->view('templates/header');
		$this->load->view('orders/new_order', $data);
		$this->load->view('templates/footer');

	}

	public function no_service(){

		$this->load->view('templates/styleCss');

		$this->load->view('templates/header');
		$this->load->view('orders/no_service');
		$this->load->view('templates/footer');
	}

	public function place_order(){
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('select_service', 'Service', 'required');
		$this->form_validation->set_rules('select_dog', 'Dog', 'required');
		$this->form_validation->set_rules('select_employee', 'employee', 'required');


		$data_in = $this->input->post();

		if ($this->form_validation->run() == false){
			$errors = array(
				'error' => true,
				'service_error' => form_error('select_service'),
				'dog_error' => form_error('select_dog'),
				'employee_error' => form_error('select_employee')
				);



			echo json_encode($errors);
			return;
		}

		$date = $data_in['date'].' '.$data_in['time'].':00';

		$data = array (
			'employee_id' => $data_in['select_employee'],
			'service_id' => $data_in['select_service'],
			'customer_id' => $this->session->id,
			'order_date' => $date,
			'total_price' => $data_in['price'],
			'dog_id' => $data_in['select_dog']
		);
		$order_id = $this->Orders_model->save_order($data);

		if (array_key_exists('error',$order_id)){
			$errors = array(
				'error' => true,
				'db_error' => $order_id['error']
			);
			echo json_encode($errors);
			return;
		}
		$oid = $order_id['id'];
		foreach ($data_in as $key=>$item){
			if ($item == 'on'){
				$this->Orders_model->save_orders_add(array('additional_services_id'=>$key,'Orders_id'=>$oid));
			}
		}


		echo json_encode(array('success' => true));
	}

	public function complete(){
		echo 'order completed successfully!';
	}

	private function get_available_services(){
		//declare empty array
		$avialable_employees_by_service = array();

		//get geocode
		$location_data = $this->getLatitudeAndLongitude();
		if (array_key_exists('error',$location_data)) {
			return null;
		}

		//get all employees from DB
		$data['employees'] = $this->Employee_model->get_employees();
		// get all services from DB
		$data['services'] = $this->Services_model->get_services();

		$services_num = 0;
		//create return array structure by services
		foreach ($data['services']  as $service) {
			$service_id = $service->id;
			$service_name = $service->service_name;
			$service_price = $service->price;
			$avialable_employees_by_service[$service_id] = array( 'employees' => array(), 'price'=> $service_price, 'service_name' => $service_name);
			$services_num++;
		}

		// get available employees and their services
		foreach ($data['employees'] as $employee) {

			// calcDistance with each employee -> get a number which is the distance.
			$distance = $this->calc_distance($employee->latitude, $employee->longitude, $location_data['latitude'], $location_data['longitude']);

			// if the number is lower than employee raduis -> the employee is available
			if ( $distance <= $employee->radius ) {

				$employee_id = $employee->id;
				$employee_first_name = $employee->first_name;
				$employee_last_name = $employee->last_name;
				$employee_full_name = $employee_first_name." ".$employee_last_name;

				//get employee's services
				$data['temp_services'] = $this->Employee_model->get_employee_services_by_emp_id($employee_id);

				//push employee's services to the returned array
				foreach ($data['temp_services'] as $temp_service) {
					$service_id = $temp_service->service_id;
					array_push($avialable_employees_by_service[$service_id]['employees'],array('employee_id' => $employee_id, 'employee_name' => $employee_full_name));
				}
			}
		}
		//clean no service areas

		foreach ($avialable_employees_by_service as $key=>$service){
			if (empty($service['employees'])){
				unset($avialable_employees_by_service[$key]);
				$services_num--;
			}
		}
		if ($services_num == 0){
			return null;
		}
		return $avialable_employees_by_service;

	}

	private function getLatitudeAndLongitude() {
		// 1. get user address from db
		$id = $this->session->id;
		$data['address'] = $this->Address_model->get_address_by_cust_id($id);
		$street = $data['address']->street;
		$city = $data['address']->city;

		// implement API call
		$url = "http://api.positionstack.com/v1/forward?access_key=33576097aa621d30119b54a9621279d3&query=".urlencode($street).",".urlencode($city);
		$response = file_get_contents($url);
		$location_response = json_decode($response, true);

		if ($location_response['data']) {

			$location_data['latitude'] = $location_response['data'][0]['latitude'];
			$location_data['longitude'] = $location_response['data'][0]['longitude'];

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

	private function val_time($time){
		return $this->validateDate($time, 'H:i');
	}
	private function validateDate($date, $format = 'd.m.Y')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

}
