<?php

class Customers extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Customers_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->login();

    }

    public function success() {

        echo '<h1> login successfull</h1>';
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

    public function save_customer() {
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('fname', 'first name', 'required|alpha|min_length[1]');
		$this->form_validation->set_rules('lname', 'last name', 'required|alpha|min_length[1]');
		$this->form_validation->set_rules('phone', 'phone number', 'required|numeric|min_length[1]');
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
         $data = array(
            'email' => $this->input->post('email'),
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'phone_number' => $this->input->post('phone'),
            'password' => $this->input->post('password')
        );

        $error = $this->Customers_model->save($data);
        if ($error) {
            $errors = array('error' => true,'db_error' => $error);
			echo json_encode($errors);

        } else {
            $data['loggedin'] = '1';
            $data['message'] = 'User Registered successfuly';
            $data['code'] = 1;
            $this->session->set_userdata($data);

            echo json_encode(array('success' => true));
        }
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
            $data['email'] = $check[0]->name;
            $data['loggedin'] = '1';
            $this->session->set_userdata($data);
            redirect("Customers/success");
        }
    }

    public function logout() {
        $data = array(
            'user',
            'loggedin'
        );
        $this->session->unset_userdata($data);
        $this->login();
    }

}
