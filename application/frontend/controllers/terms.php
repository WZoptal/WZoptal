<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class terms extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		$data["item"]         = "Terms and Conditions";
 		$data["terms"]   = $this->page_model->getPageData('terms');
 		$data["master_title"] = "Terms & Conditions | ".$this->config->item('sitename');
 		$data["master_body"]  = "terms";
 		$this->load->theme('home_layout', $data);
   	}

}
