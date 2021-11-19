<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



class help extends CI_Controller {



 	public function __construct(){

  		parent::__construct();

  		$this->load->model('page_model');

   		$this->load->helper('url');	

 	}



 	public function index(){
 		
		$data["item"]         = "Help";

 		$data["disclaimer"]   = $this->page_model->getPageData('help');

 		$data["master_title"] = "Help | ".$this->config->item('sitename');

 		$data["master_body"]  = "help";

 		$this->load->theme('home_layout', $data);

   	}
   	
   	



}

