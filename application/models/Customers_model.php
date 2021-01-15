<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer_model
 *
 * @author chen
 */
class Customers_model extends CI_Model{
     
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function get_customers(){
    
     $this->db->db_debug = FALSE; 
     $error=null;
     $query=$this->db->get('Customer');
     if ($query){
      return $query->result();
      }
      $error= $this->db->error();
     return $error;      

    }
    
    public function save($data)
{
      $this->db->db_debug=FALSE;
      $error=null;
      if(!$this->db->insert('Customer', $data)){
          $error=$this->db->error();
         
      }
      
     return $error; 
}

  public function auth($data){
        $query = $this->db->get_where('Customer', $data);
        return $query->result();

     }
}
