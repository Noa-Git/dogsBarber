<?php

class Main extends CI_Controller{
   
        public function __construct() {
        parent::__construct();
          $this->load->model('Orders_model');
        $this->load->helper('url');
        $this->load->library('session');
    }
    
    public function index() {
        $this->load->view('templates/styleCss');
	$this->load->view('templates/orderCss');
	$this->load->view('templates/header');
	$this->load->view('main/home');
	$this->load->view('templates/footer');
        
    }
    
    
     public function services() {
         
        $data['service']=$this->Orders_model->get_pupolar_order();
        $this->load->view('templates/styleCss');
	$this->load->view('templates/servicesCss');
	$this->load->view('templates/header');
	$this->load->view('main/services',$data);
	$this->load->view('templates/footer');
        
    }
    
     public function gallery() {
        $this->load->view('templates/styleCss');
	$this->load->view('templates/orderCss');
	$this->load->view('templates/header');
	$this->load->view('main/gallery');
	$this->load->view('templates/footer');
        
    }
    
     public function blog() {
        $this->load->view('templates/styleCss');
	$this->load->view('templates/orderCss');
	$this->load->view('templates/header');
	$this->load->view('main/blog');
	$this->load->view('templates/footer');
        
    }
    
}
