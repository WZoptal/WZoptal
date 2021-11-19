<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class support extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		$data["item"]         = "Support";
 		$data["support"]   = $this->page_model->getPageData('support');
 		$data["master_title"] = "Support | ".$this->config->item('sitename');
 		$data["master_body"]  = "support";
 		$this->load->theme('home_layout', $data);
   	}

}
