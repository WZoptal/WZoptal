<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Terms_and_conditions extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		$data["item"]         = "Terms and Conditions";
 		$data["resultset"]    = $this->page_model->getPageData('terms');
 		$data["master_title"] = "Terms & Conditions | ".$this->config->item('sitename');
 		$data["master_body"]  = "terms"; //print_r($data); die;
 		$this->load->theme('micro_layout', $data);
   	}

}
