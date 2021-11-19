<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
   class About extends CI_Controller {
 	public function __construct(){
  		parent::__construct();
  		$this->load->model('user_model');
    	$this->load->helper('url');	
    }

	public function index(){
		$this->view();
 	}

 	public function view(){
		$data["master_title"] = "About Us | ".$this->config->item('sitename');
		$data["master_body"]  = "about";
		$this->load->theme('micro_layout',$data);
  	}

}



?>