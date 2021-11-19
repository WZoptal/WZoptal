<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class survey_eligibility_criteria extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		$data["item"]         = "Survey Eligibility Criteria";
 		$data["support"]   = $this->page_model->getPageData('survey_eligibility_criteria');
 		$data["master_title"] = "Survey Eligibility Criteria | ".$this->config->item('sitename');
 		$data["master_body"]  = "survey_eligibility_criteria";
 		$this->load->theme('home_layout', $data);
   	}

}
