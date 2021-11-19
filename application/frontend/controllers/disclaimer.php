<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class disclaimer extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		$data["item"]         = "Disclaimer";
 		$data["disclaimer"]   = $this->page_model->getPageData('disclaimer');
 		$data["master_title"] = "Disclaimer | ".$this->config->item('sitename');
 		$data["master_body"]  = "disclaimer";
 		$this->load->theme('home_layout', $data);
   	}

}
