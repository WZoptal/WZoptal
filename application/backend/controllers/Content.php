<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

	public function __construct(){ 
		parent::__construct();
		$this->load->model('page_model');
	}

	/******************************************** Page functions starts  ************************************************/

	public function index(){
		//$this->help();	
	}	

	//for contact us
	public function contact(){ 
		$pagename             = $this->uri->segment(2); 
		$data["do"]           = "edit";
		$data["page_name"]    = $pagename;
		$data["resultset"]    = $this->page_model->getPageData($pagename);
		$data["item"]         = "Contact Us";
		$data["master_title"] = "Contact Us | ".$this->config->item('sitename'); 
		$data["master_body"]  = "contact";  
		$this->load->theme('mainlayout',$data);	
	}	

	//for about us
	public function about_us(){  
		$pagename             = $this->uri->segment(2); 
		$data["do"]           = "edit";
		$data["page_name"]    = $pagename;
		$data["resultset"]    = $this->page_model->getPageData($pagename);
		$data["item"]         = "About Us"; //print_r($data); die;
		$data["master_title"] = "About Us | ".$this->config->item('sitename'); 
		$data["master_body"]  = "about_us";  
		$this->load->theme('mainlayout',$data);	
	}	

	public function ftp_detail(){   
		$pagename             = $this->uri->segment(2); 
		$data["do"]           = "edit";
		$data["page_name"]    = $pagename;
		$data["resultset"]    = $this->page_model->get_ftp_detail($pagename);
		$data["item"]         = "FTP Detail"; 
		$data["master_title"] = "FTP Detail | ".$this->config->item('sitename'); 
		$data["master_body"]  = "ftp_detail";  
		$this->load->theme('mainlayout',$data);	
	}	


	public function faq(){
		$pagename             = $this->uri->segment(2); 
		$data["do"]           = "edit";
		$data["page_name"]    = $pagename;
		$data["resultset"]    = $this->page_model->getPageData($pagename);
		$data["item"]         = "FAQ";
		$data["master_title"] = "FAQ | ".$this->config->item('sitename'); 
		$data["master_body"]  = "faq";  
		$this->load->theme('mainlayout',$data);	
	}	

	public function secure_payment(){
		$pagename             = $this->uri->segment(2); 
		$data["do"]           = "edit";
		$data["page_name"]    = $pagename;
		$data["resultset"]    = $this->page_model->getPageData($pagename);
		$data["item"]         = "Secure Payments";
		$data["master_title"] = "Secure Payments | ".$this->config->item('sitename'); 
		$data["master_body"]  = "secure_payment";  
		$this->load->theme('mainlayout',$data);	
	}	
	
	public function testimonials(){
		$pagename             = $this->uri->segment(2); 
		$data["do"]           = "edit";
		$data["page_name"]    = $pagename;
		$data["resultset"]    = $this->page_model->getPageData($pagename);
		$data["item"]         = "Testimonials";
		$data["master_title"] = "Testimonials | ".$this->config->item('sitename'); 
		$data["master_body"]  = "testimonials";  
		$this->load->theme('mainlayout',$data);	
	}	

	public function why_equalitix(){
		$pagename             = $this->uri->segment(2); 
		$data["do"]           = "edit";
		$data["page_name"]    = $pagename;
		$data["resultset"]    = $this->page_model->getPageData($pagename);
		$data["item"]         = "Why Equalitix"; //print_r($data); die;
		$data["master_title"] = "Why Equalitix | ".$this->config->item('sitename'); 
		$data["master_body"]  = "why_equalitix";  
		$this->load->theme('mainlayout',$data);	
	}	

	//get get motivation
	public function privacy_policy(){ 
		$pagename             = $this->uri->segment(2); 
		$data["do"]           = "edit";
		$data["page_name"]    = $pagename;
		$data["resultset"]    = $this->page_model->getPageData($pagename);
		$data["item"]         = "Privacy Policy"; //print_r($data); die;
		$data["master_title"] = "Privacy Policy | ".$this->config->item('sitename');
		$data["master_body"]  = "privacy_policy";  
		$this->load->theme('mainlayout',$data);	
	}	

	//get get motivation
	public function terms(){ 
		$pagename             = $this->uri->segment(2); 
		$data["do"]           = "edit";
		$data["page_name"]    = $pagename;
		$data["resultset"]    = $this->page_model->getPageData($pagename);
		$data["item"]         = "Terms and Condition"; //print_r($data); die;
		$data["master_title"] = "Terms and Condition | ".$this->config->item('sitename');  
		$data["master_body"]  = "terms";  
		$this->load->theme('mainlayout',$data);	
	}

	//get help
	public function help(){ 
		$pagename             = $this->uri->segment(2); 
		$data["do"]           = "edit";
		$data["page_name"]    = $pagename;
		$data["resultset"]    = $this->page_model->getPageData($pagename);
		$data["item"]         = "Help and support"; //print_r($data); die;
		$data["master_title"] = "Help and support | ".$this->config->item('sitename');  
		$data["master_body"]  = "help";  
		$this->load->theme('mainlayout',$data);	
	}
	
	public function footer_content(){ 
 	  $pagename             = $this->uri->segment(2); 
 	  $data["do"]           = "edit";
 	  $data["page_name"]    = $pagename;
 	  $data["resultset"]    = $this->page_model->getPageData($pagename);
 	  $data["item"]         = "Footer Content";
 	  $data["master_title"] = "Footer Content | ".$this->config->item('sitename');  
 	  $data["master_body"]  = "footer_content";  
 	  $this->load->theme('mainlayout',$data);	
 	}
	
	public function home_content(){ 
 	  $pagename             = $this->uri->segment(2); 
 	  $data["do"]           = "edit";
 	  $data["page_name"]    = $pagename;
 	  $data["resultset"]    = $this->page_model->getPageData($pagename);
 	  $data["item"]         = "Home Content";
 	  $data["master_title"] = "Home Content | ".$this->config->item('sitename');  
 	  $data["master_body"]  = "home_content";  
 	  $this->load->theme('mainlayout',$data);	
 	}
	
	public function social_links(){
 	  $pagename             = $this->uri->segment(2); 
 	  $data["do"]           = "edit";
 	  $data["page_name"]    = $pagename;
 	  $data["resultset"]    = $this->page_model->getPageData($pagename);
 	  $data["item"]         = "Social Links";
 	  $data["master_title"] = "Social Links | ".$this->config->item('sitename');  
 	  $data["master_body"]  = "social_links";  
 	  $this->load->theme('mainlayout',$data);	
	}

	public function update_social_links_information(){
 		$arr["id"]           = $this->input->post("id");
 		$arr["page_name"]    = $this->input->post("page_name");
 		$arr["fb_url"]       = $this->input->post("fb_url");
 		$arr["tw_url"]       = $this->input->post("tw_url");
 		$arr["gp_url"]       = $this->input->post("gp_url");
 		$arr["in_url"]       = $this->input->post("in_url");
 		$arr["insta_url"]    = $this->input->post("insta_url");
 		$arr["page_content"] = $this->input->post("page_content");
  		   
		if($this->page_model->updatepagedata($arr)){
			$this->session->set_flashdata("successmsg","Content updated successfully");
		}	
		else{
			$this->session->set_flashdata("errormsg","There is error updating content to database. Please contact database admin");	
		}
 		
 		redirect(base_url()."content/".$arr["page_name"]);
	}

	//update content page
	public function update_page_to_database(){ 
		$arr["id"]           = $this->input->post("id");
		$arr["page_title"]   = $this->input->post("page_title");
		$arr["page_content"] = $this->input->post("page_content");
		$arr["summary"]      = $this->input->post("summary");
		$arr["page_name"]    = $this->input->post("page_name");
		if($arr["page_content"] == '' || $arr["page_content"] == " "){
			$this->session->set_flashdata("errormsg","Please enter Page Content");
		}else{
			if($this->page_model->updatepagedata($arr)){
				$this->session->set_flashdata("successmsg","Content updated successfully");
			} else {
				$this->session->set_flashdata("errormsg","There is error updating content to database. Please contact database admin");	
			}
		}
		redirect(base_url()."content/".$arr["page_name"]);
	}	

	

	public function update_ftp_detail_database(){ 
		$arr["id"]           = $this->input->post("id");
		$arr["hostname"]   = $this->input->post("hostname");
		$arr["ipaddress"]    = $this->input->post("ipaddress"); 
		$arr["username"] = $this->input->post("username");
		$arr["password"]      = $this->input->post("password");
		$arr["page_name"]    = $this->input->post("page_name"); 
		
		if($this->page_model->updateFtpdata($arr)){
			$this->session->set_flashdata("successmsg","Content updated successfully");
		} else {
			$this->session->set_flashdata("errormsg","There is error updating content to database. Please contact database admin");	
		}
		
		redirect(base_url()."content/".$arr["page_name"]);
	}	


	public function update_homecontent_information(){ 
		$arr["id"]           = $this->input->post("id");
		$arr["page_title"]   = $this->input->post("page_title");
		$arr["page_content"] = $this->input->post("page_content");
		$arr["address"]      = $this->input->post("address");
		$arr["summary"]      = $this->input->post("summary");
		$arr["rightbar_heading"] = $this->input->post("rightbar_heading");
		$arr["event_content"]    = $this->input->post("event_content");
		$arr["test_content"]     = $this->input->post("test_content");
		$arr["page_name"]        = $this->input->post("page_name");
		if($arr["page_content"] == '' || $arr["page_content"] == " "){
			$this->session->set_flashdata("errormsg","Please enter Page Content");
		} else {
			if($this->page_model->updatepagedata($arr)){
				$this->session->set_flashdata("successmsg","Content updated successfully");
			} else {
				$this->session->set_flashdata("errormsg","There is error updating content to database. Please contact database admin");	
			}
		}
		redirect(base_url()."content/".$arr["page_name"]);
	}	

	//update content page
	public function update_policy_information(){ 
		$arr["id"]           = $this->input->post("id");
		$arr["page_title"] = $this->input->post("page_title");
		$arr["page_content"] = $this->input->post("page_content");
		$arr["page_name"]    = $this->input->post("page_name");
		if($arr["page_content"] == '' || $arr["page_content"] == " "){
			$this->session->set_flashdata("errormsg","Please enter Page Content");
		} else {
			if($this->page_model->updatepagedata($arr)){
				$this->session->set_flashdata("successmsg","Content updated successfully");
			} else {
				$this->session->set_flashdata("errormsg","There is error updating content to database. Please contact database admin");	
			}
		}
		redirect(base_url()."content/".$arr["page_name"]);
	}

	// for update about us page
	public function update_aboutus_page_to_database(){
		$arr["id"]               		= $this->input->post("id");
		//$arr["page_title"]    	    = $this->input->post("page_title");
		$arr["page_name"]        		= $this->input->post("page_name");
		$arr["heading"]     	 		= $this->input->post("heading");
		$arr["title_1"]   		 		= $this->input->post("title_1");
		$arr["description_1"]    		= $this->input->post("description_1");
		$arr["title_2"]          		= $this->input->post("title_2");
		$arr["description_2"]    		= $this->input->post("description_2");
		$arr["title_3"]      	 		= $this->input->post("title_3");
		$arr["description_3"]    		= $this->input->post("description_3");
		$arr["our_vission"]        		= $this->input->post("our_vission");
		$arr["vission_description"]     = $this->input->post("vission_description");
		$arr["question_1"]     			= $this->input->post("question_1");
		$arr["answer_1"]     			= $this->input->post("answer_1");
		$arr["question_2"]     			= $this->input->post("question_2");
		$arr["answer_2"]     			= $this->input->post("answer_2");
		$arr["question_3"]     			= $this->input->post("question_3");
		$arr["answer_3"]     			= $this->input->post("answer_3");
		$arr["question_4"]     			= $this->input->post("question_4");
		$arr["answer_4"]     			= $this->input->post("answer_4");	

		$this->session->set_flashdata("tempdata",strip_slashes($arr));
		if($arr["heading"] == '' || $arr["heading"] == " "){
			$this->session->set_flashdata("errormsg","Please enter Page heading");
		} else {
			if($this->page_model->updatepageAboutdata($arr)){
				$this->session->set_flashdata("successmsg","Content updated successfully");
			} else {
				$this->session->set_flashdata("errormsg","There is error updating content to database. Please contact database admin");	
			}
		}
		redirect(base_url()."content/".$arr["page_name"]);
	}

	//for update contact
	public function update_contact_information(){
		$arr["id"]             = $this->input->post("id");
		$arr["page_name"]      = $this->input->post("page_name");
		$arr["contact_number"] = $this->input->post("contact_number");
		$arr["contact_email"]  = $this->input->post("contact_email");
		//$arr["city"]           = $this->input->post("city");
		//$arr["state"]          = $this->input->post("state");
		$arr["page_content"] = $this->input->post("page_content");	
		$arr["summary"]          = $this->input->post("summary");	

		if($this->page_model->update_contact_information_db($arr)){
			$this->session->set_flashdata("successmsg","Contact Information updated successffuly");
			$err=0;
		} else {
			$err = 1;
		}
		redirect(base_url()."content/contact");
	}

	public function get_image_Extension($imagename){
		$imagename=explode(".",$imagename);
		return $imagename[1];
	}

	public function upload_images(){
		$config['upload_path']   = '../ckeditorimages/';
		$config['allowed_types'] = '*';
		$config['file_name']     = $_FILES['upload']['name'];
		$this->upload->initialize($config);
		$validimages=array("jpg","gif","png","jpeg","bmp");
		if(in_array($this->get_image_Extension($_FILES['upload']['name']),$validimages)){
			if($this->upload->do_upload('upload')){
				$arr=$this->upload->data();
				$url = $this->config->item("ckeditorimages").$arr['file_name'];
			} else {
				$message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
			}
		} else {
			$message = "Only images file with ".implode(",",$validimages)." extensions are allowed";
		}
		$funcNum = $_GET['CKEditorFuncNum'] ;
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
	}
	

/*************************************** Page functions starts  ************************************************/
}