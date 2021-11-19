<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class about_us extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		//$pages = "'who_we_are','privacy_policy','terms','infringement'";
		$pages = "'privacy_policy','terms'";
		$data["item"]         = "About Us";
 		$data["pages"]		  = $this->page_model->AboutUsPages($pages);
 		$data["contactus"]    = $this->page_model->getPageData('contact');
 		$data["master_title"] = "About Us | ".$this->config->item('sitename');
 		$data["master_body"]  = "about_us";
 		$this->load->theme('home_layout', $data);
   	}

}
