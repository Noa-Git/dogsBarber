<?php


class Dogs extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('Dogs_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
	}

	public function add() {
		if ($this->session->loggedin == null){
			$this->session->set_userdata('referrer',current_url());
			redirect("Customers/login");
		}
		$id = $this->session->id;
		$this->load->view('templates/styleCss');
		$this->load->view('templates/addDogCss');
		$this->load->view('templates/header');
		$this->load->view('dogs/add');
		$this->load->view('templates/footer');
	}

	public function save_dog(){

		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('dog_name', 'Dog Name', 'required|alpha_numeric_spaces|min_length[2]');
		$this->form_validation->set_rules('age', 'Age', 'required|numeric|min_length[1]');
		$this->form_validation->set_rules('weight', 'Weight', 'required|numeric|min_length[1]');

		if ($this->form_validation->run() == false){
			$errors = array(
				'error' => true,
				'dog_name_error' => form_error('dog_name'),
				'age_error' => form_error('age'),
				'weight_error' => form_error('weight'),
			);
			echo json_encode($errors);
			return;
		}
		//preparing data for db
		$id = $this->session->id;
		$data = array(
			'dog_name' => $this->input->post('dog_name'),
			'gender' => $this->input->post('gender'),
			'age' => $this->input->post('age'),
			'size' => $this->input->post('size'),
			'weight' => $this->input->post('weight'),
			'customer_id' => $id
		);

		$error = $this->Dogs_model->save($data);
		if ($error) {
			$errors = array('error' => true,'db_error' => $error);
			echo json_encode($errors);

		} else {

			echo json_encode(array('success' => true));
		}
	}
}
