<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
     
 class Product extends CI_Controller {
     
    
    public function index()
	{
	$this->load->view('front/index');		
	}
	
	
	public function save_order()
    {
        $this->load->model('Product_Model');
        $this->Product_Model->save_order($_POST);
    }
	

	

	
	
	
 }

 