<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer
 *
 * @author chen
 */
class Customers extends CI_Controller{
    //put your code here
    public function __construct(){
        parent::__construct();
        $this->load->model('Customers_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('form_validation');
    }
    
     public function index(){
         $this->login();
           // $data['Customer']=$this->Customers_model->get_customers();
          //  print_r($data);
           
     }
     
     public function success() {
         
         echo '<h1> login successfull</h1>';
         
     }


     public function login($error=null){
      //  $this->load->view('templates/header');
        //$this->load->view('templates/headerC');
        $data['error']=$error;
        $this->load->view('customers/login',$data);
    
    }
     
     public function register($info=null) {
           $data['info']=$info;
        $this->load->view('customers/register',$data);
         
     }
     
       public function save_customer(){
        $this->form_validation->set_rules('id', 'id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $error = ['message' => 'Id is required'];
            $this->register($error);
            return;
        }
        $this->form_validation->set_rules('name', 'name', 'required|max_length[20]');
        if ($this->form_validation->run() == FALSE) {
            $error = ['message' => 'Name can not be more than 20 charachters'];
            $this->register($error);
            return;
        }
        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
        if ($this->form_validation->run() == FALSE) {
            $error = ['message' => 'Password have to contain at least 6 charachters'];
            $this->register($error);
            return;
        }
        $data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'password' => $this->input->post('password')
        );

        $error = $this->Customers_model->save($data);
        if ($error)
            $this->register($error);
        else {
            $this->login();
        }
       
    }
    
          public function auth(){

           $data = array(
               'email' => $this->input->post('email'),
               'password' => $this->input->post('password')
                
             );
           
            $check=$this->Customers_model->auth($data);
          
            if ($check==null){
               $data['error']='User not found';
               $this->login($data);
            }
            else{
              $data['name']=$check[0]->name;
              $data['loggedin']='1';
              $this->session->set_userdata($data); 
              redirect("Customers/success");
            }
   
    }
    
   
    
    public function save_register(){
        $data = array(
               'email' => $this->input->post('email'), 
               'first_name' => $this->input->post('fname'),
               'last_name' => $this->input->post('lname'),
               'phone_number' => $this->input->post('phone'),
               'password' => $this->input->post('password')
                
         );
        
        $error=$this->Customers_model->save($data);
        if ($error){
            $this->register($error);
        }
        else{
            $data['loggedin']='1';
            $data['message']='User Registered successfuly';
            $data['code']=1;
            $this->session->set_userdata($data); 
            $this->login();
           
        }
    }
    
     public function logout()
       {
              $data = array(
               'user',
                'loggedin'  
             );
             $this->session->unset_userdata($data);
             $this->login();
    
                         
       }
       
   
     
}    

