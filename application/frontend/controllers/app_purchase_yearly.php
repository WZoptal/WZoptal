<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class app_purchase_yearly extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){ 
		$data["item"]         = "In App Purchase Yearly";
 		$data["terms"]   = $this->page_model->getPageData('app_purchase_yearly');
 		$data["master_title"] = "In App Purchase Yyearly | ".$this->config->item('sitename');
 		$data["master_body"]  = "app_purchase_yearly";
 		$this->load->theme('home_layout', $data);
   	}

}
