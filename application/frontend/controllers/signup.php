
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Signup extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('user_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
 		if(empty($this->session->userdata('logged_in'))){     
			$data["item"]         = "Sign Up";
	 		//$data["resultset"]    = $this->page_model->getPageData('privacy_policy');
	 		$data["master_title"] = "Sign Up | ".$this->config->item('sitename');
	 		$data["master_body"]  = "sign_up";

	 		$this->load->theme('micro_layout', $data);
	 	}else{

          redirect(base_url());
        }
   	}

}
