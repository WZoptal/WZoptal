<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Privacy_policy extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){ 
		$data["item"]         = "Privacy Policy";
 		$data["resultset"]    = $this->page_model->getPageData('privacy_policy');
 		$data["master_title"] = "Privacy Policy | ".$this->config->item('sitename');
 		$data["master_body"]  = "privacy_policy"; 
 		$this->load->theme('micro_layout', $data);
   	}

}
