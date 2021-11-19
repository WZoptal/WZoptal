<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class payment_policy extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		$data["item"]         = "Payment Policy";
 		$data["privacy"]   = $this->page_model->getPageData('payment_policy');
 		$data["master_title"] = "Payment Policy | ".$this->config->item('sitename');
 		$data["master_body"]  = "payment_policy";
 		$this->load->theme('home_layout', $data);
	}

}
