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
        // $data['Customer']=$this->Customers_model->get_customers();
        //  print_r($data);
    }

    public function success() {

        echo '<h1> login successfull</h1>';
    }

    public function login($error = null) {
        //  $this->load->view('templates/header');
        //$this->load->view('templates/headerC');
        $data['error'] = $error;
        $this->load->view('customers/login', $data);
    }

    public function register($info = null) {
        $data['info'] = $info;
        $this->load->view('customers/register', $data);
    }

    public function save_customer() {
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$error = ['message' => 'Please insert your email address'];
			$this->register($error);
			return;
		}
        $this->form_validation->set_rules('fname', 'first name', 'required|alpha|min_length[1]');
        if ($this->form_validation->run() == FALSE) {
            $error = ['message' => 'Please insert your first name'];
            $this->register($error);
            return;
        }
		$this->form_validation->set_rules('lname', 'last name', 'required|alpha|min_length[1]');
		if ($this->form_validation->run() == FALSE) {
			$error = ['message' => 'Please insert your first name'];
			$this->register($error);
			return;
		}
		$this->form_validation->set_rules('phone', 'phone number', 'required|numeric|min_length[1]');
		if ($this->form_validation->run() == FALSE) {
			$error = ['message' => 'Please insert your phone number'];
			$this->register($error);
			return;
		}
        $this->form_validation->set_rules('password', 'password', 'required|min_length[4]');
        if ($this->form_validation->run() == FALSE) {
            $error = ['message' => 'Password have to contain at least 4 charachters'];
            $this->register($error);
            return;
        }
        $this->form_validation->set_rules('confirmPassword', 'confirm password', 'required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $error = ['message' => 'Password does not match!'];
            $this->register($error);
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
            $this->register($error);
        } else {
            $data['loggedin'] = '1';
            $data['message'] = 'User Registered successfuly';
            $data['code'] = 1;
            $this->session->set_userdata($data);
            $this->login();
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
