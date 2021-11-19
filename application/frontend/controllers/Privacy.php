<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Privacy extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		$data["item"]         = "Privacy Policy";
 		$data["privacy"]   = $this->page_model->getPageData('privacy_policy');
 		$data["master_title"] = "Privacy | ".$this->config->item('sitename');
 		$data["master_body"]  = "privacy";
 		$this->load->theme('home_layout', $data);
	}

}
