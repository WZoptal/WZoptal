<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Verify_email extends CI_Controller {
 	public function __construct(){
  		parent::__construct();
  		$this->load->model('user_model');
   		$this->load->helper('url');	
 	}

 	public function index(){ 

			$user_id = urldecode($this->input->get("token")); 
			$uData   = $this->user_model->user_profile_data($user_id); 
			if($uData['id'] <> ''){
				if($uData['verified'] == 1){
					$err_status = 1;
					$verifymessage = "Error : Your verification link has expired.";
				}
				else{
					$verify  = $this->user_model->verify_email($user_id); 
					if($verify){
						 $err_status = 0;
						 $verifymessage = "Success : Your email address has been verified successfully. Thank you!!";
					}
					else{
						$err_status = 1;
						$verifymessage = "Error : Your verification link has miss match.";
					}
				}
			}
			else{
				$err_status = 1;
				$verifymessage = "Error : Your verification link has miss match.";
			}
		
			$data["item"]          = "Account Verification";
			$data["master_title"]  = "Account Verification | ".$this->config->item('sitename');
			$data["verifymessage"] = $verifymessage;
		    $data["err_status"]    = $err_status;
			$data["master_body"]   = "verify_email";
 			$this->load->theme('micro_layout',$data);		 

 	}
	
}
