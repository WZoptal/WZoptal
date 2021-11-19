<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class content extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		$data["item"]         = "HappEgo";
 		$data["support"]   = $this->page_model->getPageData('happego');
 		$data["master_title"] = "HappEgo | ".$this->config->item('sitename');
 		$data["master_body"]  = "content";
 		$this->load->theme('home_layout', $data);
   	}

}
