<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commonfunctions extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){

	}

	public function updateprofile(){
		$data["resultset"]=$this->session->flashdata("tempdata");
		$data["master_title"]=$this->config->item('sitename')." | Update profile";  
		$data["master_body"]="updateprofile";  
		$this->load->theme('mainlayout',$data);  
	}

	public function updatemoderatorprofile(){
		$data["resultset"]=$this->session->flashdata("tempdata");
		$data["master_title"]=$this->config->item('sitename')." | Update profile";   
		$data["master_body"]="updatemoderatorprofile";  
		$this->load->theme('mainlayout',$data); 
	}

	public function update_admin_profile(){		
		$arr["username"]=$this->input->post("username");
		$arr["oldpassword"]=$this->input->post("oldpassword");	
		$arr["newpassword"]=$this->input->post("newpassword");
		$this->session->set_flashdata("tempdata",$arr);
		$arr["confirmnewpassword"]=$this->input->post("confirmnewpassword");
		if($this->validations->validatepasswords($arr))
		{
			if($this->common->update_profile($arr))
			{
				$err=0;
				$this->session->set_flashdata("successmsg","Profile updated successfully");	
			}	
			else
			{
				$err=1;
				$this->session->set_flashdata("errormsg","There is error updating profile of admin. Please contact database admin");
			}
		}
		redirect(base_url()."commonfunctions/updateprofile");
	}

	public function update_moderator_profile(){
		$arr["username"]=$this->input->post("username");
		$arr["oldpassword"]=$this->input->post("oldpassword");	
		$arr["newpassword"]=$this->input->post("newpassword");
		$this->session->set_flashdata("tempdata",$arr);
		$arr["confirmnewpassword"]=$this->input->post("confirmnewpassword");
		if($this->validations->validatemoderatorpasswords($arr))
		{
			if($this->common->update_moderator_profile($arr))
			{
				$err=0;
				$this->session->set_flashdata("successmsg","Profile updated successfully");	
			}	
			else
			{
				$err=1;
				$this->session->set_flashdata("errormsg","There is error updating profile of admin. Please contact database admin");
			}
		}
		redirect(base_url()."commonfunctions/updatemoderatorprofile");	
	}
	
}