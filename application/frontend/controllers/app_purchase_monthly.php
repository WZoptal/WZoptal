<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class app_purchase_monthly extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		$data["item"]         = "In App Purchase Monthly";
 		$data["terms"]   = $this->page_model->getPageData('app_purchase_monthly');
 		$data["master_title"] = "In App Purchase Monthly | ".$this->config->item('sitename');
 		$data["master_body"]  = "app_purchase_monthly";
 		$this->load->theme('home_layout', $data);
   	}

}
