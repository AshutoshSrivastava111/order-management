<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Model extends CI_Model
{
	function __construct(){
		parent::__construct();
	}
	public function index()
	{

	}
   

    public function save_order(){
		
		//echo "<pre>"; print_r($_POST);die;

        $name=trim($this->input->post('cust_name'));
        $email=trim($this->input->post('email'));
       
        $phone=trim($this->input->post('phone'));
        $total_amount=$this->input->post('total_amount');
       
        $name_arr=$this->input->post('name');
        $quantity_arr=$this->input->post('quantity');
        $rate_arr=$this->input->post('rate');
        $amount_arr=$this->input->post('amount');
        

        $created_at=date("Y-m-d H:i:s");
        

        $data=array(
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone,
            'total_amount'=>$total_amount,
            'status'=>1,
            'create_date'=>$created_at
           
        );
       
                $this->db->insert('product_order',$data);
                if($this->db->insert_id()>0){
                    $order_id=$this->db->insert_id();
					for($i=0;$i<count($name_arr);$i++){
						
						 $data1=array(
                           'product_name'=>$name_arr[$i],
                           'quantity'=>$quantity_arr[$i],
                           'rate'=>$rate_arr[$i],
                           'amount'=>$amount_arr[$i],
                           'order_id'=>$order_id,
                           'status'=>1,
                           'create_date'=>$created_at

                        );
                          $this->db->insert('product_order_detail',$data1);
						
					}

                   
					
                    if($this->db->insert_id()>0){

                   

                      echo '<script>alert("Order Added Successfully");</script>';

                 echo "<script>window.location='".base_url()."Product/index';</script>";
                    }                 
                }else{
                    echo '<script>alert("Order Failed");</script>';
                     echo "<script>window.location='".base_url()."Product/index';</script>";
                }
         


    }




	
}