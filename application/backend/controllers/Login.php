<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('login_model'); //for login model
	}
 	/***********************************************Login function starts **************************************************************/
	
	//for login page   
	public function index(){
 		$data["master_title"] = $this->config->item('sitename')." | Login"; // for page title
		$data['userdata']     = $this->session->userdata('tempdata');
		$this->load->theme('login', $data); 	 
	}
	
	//for validate login details  
	public function check_login(){   
		$arr["username"] = trim($this->input->post("username"));
		$arr["password"] = trim($this->input->post("password"));
		$arr["user_type"] = 1; 
		//for validate admin details in database
  		 $result = $this->login_model->check_admin_login($arr);
		 if($this->common->validateHash($arr["password"],$result["password"])){
			if($result["username"] != ""){
				//for set session
				$err = 0;
				$this->session->set_userdata("username",$result["username"]);
				$this->session->set_userdata("type",'admin');
				$this->session->set_userdata("id",$result["id"]);
				$this->session->set_userdata("last_logged",$result["last_login"]);
 				redirect(base_url()."dashboard");
			}
		}
		else{
				$err=1;	
				$this->session->set_flashdata("errormsg","Wrong username and password");
				redirect(base_url()."login"); 
		}
 	}
	
	//for forgot password
	public function forgot_password(){
		$data["master_title"] = $this->config->item('sitename')." | Forgot Password";  // for page title
		$data['userdata']     = $this->session->userdata('tempdata'); 
		$this->load->theme('forgot_password',$data); 	 
	}
	
	//for validate/update admin data 
	public function forgot_password_db(){
		$arr["username"] = trim($this->input->post("username"));
		$this->session->set_flashdata("tempdata", $arr);
 		$userData = $this->login_model->getAdminData($arr["username"]); 
		if(!empty($userData)){
			//for generate new password
			$arr1['id'] = $userData['id'];
			$password = $this->common->random_generator(5);
			$str = $this->common->random_generator(2);
			$new_password = md5($str.$password);
			$new_password = $new_password.":".$str;
			$arr1['password'] = $new_password;
			$userData['password'] = $password;
			//for send new password to admin email 
            $email   = $userData['email'];
			$subject = "Admin Login Details -->".$this->config->item('sitename');
			$message = $this->common->forgotAdminEmailTemplate($userData);
			$headers = "From: wow@iwscgroup.com\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=iso-8859-1\n";

			$send = mail($email,$subject,$message,$headers);
			if($send){
				//for update new password to database
				$this->login_model->updateAdminPassword($arr1);
				//for success message
	 			$this->session->set_flashdata("successmsg","New password has been sent to your email address.");
 				redirect(base_url()."login/forgot_password"); exit;
	 		} 
			else {
				//for error message
	 			$this->session->set_flashdata("errormsg","Something wrong, Please try again.");
 				redirect(base_url()."login/forgot_password"); exit;					
	 		}
	 	} else {
			//for error message
	 		$this->session->set_flashdata("errormsg","Wrong Email/Username.");
 			redirect(base_url()."login/forgot_password"); exit;
	 	}
	}
	
	//logout the Admin
	public function logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata("successmsg","Log out successfully");	
		redirect(base_url()."login");
	}
	/***********************************************Login function ends **************************************************************/
}
?>