<?php


class Orders_model extends CI_Model
{
	public function __construct() {
		parent::__construct();
		$this->load->database();
                $this->db->db_debug = FALSE;
	}
        
        public function get_orders() {
            
            $error = null;
            $query = $this->db->get('Orders');
            if ($query) {
                return $query->result();
            }
            $error = $this->db->error();
            return $error;
        }
        
        public function get_orders_by_cust_id($cust_id) {
            $error = null;
            $data = array('customer_id' => $cust_id);
	    $query = $this->db->get_where('Orders', $data);
	     if ($query) {
                return $query->result();
            }
            $error = $this->db->error();
            return $error;
            
        }
        
        
         public function save_order($data) {

        $ret = array();

        if (!$this->db->insert('Orders', $data)) {
            $ret['error'] = $this->db->error();
        }
        else{
        	$ret['id'] = $this->db->insert_id();
		}
        return $ret;
    }
    
       public function save_orders_add($data) {

        $error = null;

        if (!$this->db->insert('Order_add', $data)) {
            $error = $this->db->error();
        }
        return $error;
    }

         public function get_last_order($cust_id) {
            
            $error = null;
            $this->db->order_by('order_date', 'DESC');
            $query = $this->db->get_where('Orders',array('customer_id'=>$cust_id));
            if ($query) {
                return ($query->result())[0];
            }
            $error = $this->db->error();
            return $error;
        }  
        
        
         public function get_pupolar_order() {
            
            $sql='SELECT service_name,counted 
                FROM(
                   SELECT COUNT(*)AS counted,service_id
                    FROM Orders 
                    GROUP BY service_id order by counted desc) as ms
                    INNER JOIN Service on Service.id=ms.service_id'; 
             
            $error = null;
            
            $query = $this->db->query($sql);
            if ($query) {
                return ($query->result())[0];
            }
            $error = $this->db->error();
            return $error;
        }




}
