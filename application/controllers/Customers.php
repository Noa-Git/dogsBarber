<?php

class Customers extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Customers_model');
          $this->load->model('Orders_model');
		$this->load->model('Dogs_model');
		$this->load->model('Address_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->login();

    }

    public function success() {

//        echo '<h1> login successfull</h1>';
//        print_r ($this->session->userdata());
		  redirect("Customers/details");
    }

    public function login($error = null) {
		$this->load->view('templates/styleCss');
		$this->load->view('templates/loginCss');
		$this->load->view('templates/header');
        $data['error'] = $error;
        $this->load->view('customers/login', $data);
		$this->load->view('templates/footer');
    }

    public function register($info = null) {
		$this->load->view('templates/styleCss');
		$this->load->view('templates/registerCss');
		$this->load->view('templates/header');
    	$data['info'] = $info;
        $this->load->view('customers/register', $data);
		$this->load->view('templates/footer');
    }

    public function details() {
    	if ($this->session->loggedin == null){
			$this->session->set_userdata('referrer',uri_string());
    		redirect("Customers/login");
		}
    	$id = $this->session->id;
		$data['customer'] =$this->Customers_model->get_customer_by_id($id);
    	$data['dogs'] = $this->Dogs_model->get_dog_by_cust_id($id);
		$data['address'] = $this->Address_model->get_address_by_cust_id($id);


		$this->load->view('templates/styleCss');
		$this->load->view('templates/customerDetailsCss');
		$this->load->view('templates/header');
		$this->load->view('customers/details', $data);
		$this->load->view('templates/footer');

	}

	public function address(){
		if ($this->session->loggedin == null){
			$this->session->set_userdata('referrer',uri_string());
			redirect("Customers/login");
		}
		$data['name']= $this->session->first_name;
		$this->load->view('templates/styleCss');
		$this->load->view('templates/customerDetailsCss');
		$this->load->view('templates/header');
		$this->load->view('customers/address', $data);
		$this->load->view('templates/footer');
	}

    public function save_customer() {
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('fname', 'first name', 'required|callback_validate_alpha_input');
		$this->form_validation->set_rules('lname', 'last name', 'required|callback_validate_alpha_input');
		$this->form_validation->set_rules('phone', 'phone number', 'required|numeric|min_length[10]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[4]');
		$this->form_validation->set_rules('confirmPassword', 'confirm password', 'required|matches[password]');


		if ($this->form_validation->run() == false){
			$errors = array(
				'error' => true,
				'email_error' => form_error('email'),
				'fname_error' => form_error('fname'),
				'lname_error' => form_error('lname'),
				'phone_error' => form_error('phone'),
				'password_error' => form_error('password'),
				'confirmPassword_error' => form_error('confirmPassword')
			);
			echo json_encode($errors);
			return;
		}

		//preparing data for db
		$id = $this->Customers_model->generateId();
         $data = array(
            'email' => $this->input->post('email'),
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'phone_number' => $this->input->post('phone'),
            'password' => $this->input->post('password'),
			 //Generating a random safe for encryption ID. will also be used as salt for password
			 'id'=> $id
        );

        $error = $this->Customers_model->save($data);
        if ($error) {
            $errors = array('error' => true,'db_error' => $error);
			echo json_encode($errors);

        } else {
        	$this->Address_model->save(array('customer_id'=>$id));
            $data['loggedin'] = '1';
            $this->session->set_userdata($data);
            $this->session->unset_userdata('password');
			$this->session->set_userdata('referrer','customers/login');
            echo json_encode(array('success' => true));
        }
    }

    public function update_customer(){
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('fname', 'first name', 'required|callback_validate_alpha_input');
		$this->form_validation->set_rules('lname', 'last name', 'required|callback_validate_alpha_input');
		$this->form_validation->set_rules('phone', 'phone number', 'required|numeric|min_length[1]');
		$this->form_validation->set_rules('street', 'Street', 'required|callback_validate_alpha_input');
		$this->form_validation->set_rules('city', 'City', 'required|callback_validate_alpha_input');
		$this->form_validation->set_rules('house', 'House Number', 'required|numeric|min_length[1]');
		$this->form_validation->set_rules('zip', 'Zip Code', 'required|numeric|min_length[5]');


		if ($this->form_validation->run() == false){
			$errors = array(
				'error' => true,
				'fname_error' => form_error('fname'),
				'lname_error' => form_error('lname'),
				'phone_error' => form_error('phone'),
				'street_error' => form_error('street'),
				'house_error' => form_error('house'),
				'city_error' => form_error('city'),
				'zip_error' => form_error('zip')
			);
			echo json_encode($errors);
			return;
		}
		//preparing data for db
		$id = $this->session->id;
		$user_data = array(
			'first_name' => $this->input->post('fname'),
			'last_name' => $this->input->post('lname'),
			'phone_number' => $this->input->post('phone'),
		);

		$address_data = array (
			'street' => $this->input->post('street'),
			'house_number' => $this->input->post('house'),
			'city' => $this->input->post('city'),
			'zip_code' => $this->input->post('zip'),
		);

		$error = $this->Customers_model->update($id, $user_data);
		if ($error) {
			$errors = array('error' => true,'db_error' => $error);
			echo json_encode($errors);
			return;
		}

		$error = $this->Address_model->update($id, $address_data);
		if ($error) {
			$errors = array('error' => true,'db_error' => $error);
			echo json_encode($errors);
			return;
		}


		echo json_encode(array('success' => true));

	}


	public function update_address(){
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('street', 'Street', 'required|callback_validate_alpha_input');
		$this->form_validation->set_rules('city', 'City', 'required|callback_validate_alpha_input');
		$this->form_validation->set_rules('house', 'House Number', 'required|numeric');
		$this->form_validation->set_rules('zip', 'Zip Code', 'required|numeric|min_length[5]');


		if ($this->form_validation->run() == false){
			$errors = array(
				'error' => true,
				'street_error' => form_error('street'),
				'house_error' => form_error('house'),
				'city_error' => form_error('city'),
				'zip_error' => form_error('zip')
			);
			echo json_encode($errors);
			return;
		}
		//preparing data for db
		$id = $this->session->id;

		$address_data = array (
			'street' => $this->input->post('street'),
			'house_number' => $this->input->post('house'),
			'city' => $this->input->post('city'),
			'zip_code' => $this->input->post('zip'),
		);

		$error = $this->Address_model->update($id, $address_data);
		if ($error) {
			$errors = array('error' => true,'db_error' => $error);
			echo json_encode($errors);
			return;
		}

		echo json_encode(array('success' => true));

	}

	//callback function for save_customer() and update_address() and update_customer()
	public function validate_alpha_input($names)
	{
		return $names === '' || (bool) preg_match('/[a-zA-Zא-ת][a-zA-Z א-ת]*/', $names);
	}


	public function auth() {
        $data = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        $check = $this->Customers_model->auth($data);
        if ($check == null) {
            $data['error'] = 'Wrong user name or password';
            $this->login($data);
        } else {

            $check[0]->loggedin = '1';
            $this->session->set_userdata((array)$check[0]);
            $this->session->unset_userdata('password');
            if ($this->session->has_userdata('referrer')){
				redirect($this->session->referrer);
			}
            else {
				redirect("Customers/success");
			}

        }
    }

    public function logout() {
        $data = array(
			'email',
			'first_name',
			'last_name',
			'phone_number',
			'id',
            'loggedin',
			'referrer'
        );
        $this->session->unset_userdata($data);
        $this->login();
    }



}
