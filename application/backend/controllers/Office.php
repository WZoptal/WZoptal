<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Office extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->model('office_model');
		$this->load->helper('url');
	}
	public function index(){
		$this->manage_office();	
	}	
	
	/////////////////////////////////  office ////////////////////////
	
		public function manage_office(){   
		$page=(isset($_GET["per_page"]) && $_GET["per_page"]!="")?$_GET["per_page"]:""; //$this->input->get("page");
		
		if($page == ''){
            $page = '0';
        }
		else{
            if(!is_numeric($page)){
            	redirect(BASEURL.'404');
            }
			else{
            	$page = $page;
            }
        }
		$config["per_page"]     = $this->config->item("perpageitem"); 
		$config['base_url']     = base_url()."office/manage_office/?".$this->common->removeUrl("per_page",$_SERVER["QUERY_STRING"]);
		$countdata              = array();
		$countdata              = $_GET;
		$countdata["countdata"] = "yes";	
		
		$config['total_rows']   = count($this->office_model->getOfficeData($countdata));   
		$config["uri_segment"]  = (isset($_GET["per_page"]) && $_GET["per_page"]!="")?$_GET["per_page"]:"0";
		$this->pagination->initialize($config);
		/*--------------------------Paging code ends---------------------------------------------------*/
		$searcharray             = array();
		$searcharray             = $_GET;
		$searcharray["per_page"] = $config["per_page"];
		$searcharray["page"]     = $config["uri_segment"];
		$data["resultset"]       = $this->office_model->getOfficeData($searcharray);
		$data["item"]            = "Office";
		$data["master_title"]    = "Manage office | ".$this->config->item('sitename');  
		$data["master_body"]     = "manage_offices";  
		$this->load->theme('mainlayout',$data);	
	}
	public function add_office(){	
		$data["item"]         = "Office";
		$data["do"]           = "add";
		$data["resultset"]    = $this->session->flashdata("tempdata");
		$data["master_title"] = "Add Office | ".$this->config->item('sitename');  
		$data["master_body"]  = "add_office"; 
		$this->load->theme('mainlayout',$data);
		if($this->uri->segment(3) != '' && $this->uri->segment(3)== '0'){
			header("Refresh:4;url=".base_url()."office/manage_office");
		}
	}
	public function edit_office(){
		$data["item"]         = "Office";
		$data["do"]           = "edit";
		$officeid             = $this->uri->segment(3); 
		$data["resultset"]    = $this->office_model->getIndividualoffice($officeid); 
		$data["master_title"] = "Edit Office | ".$this->config->item('sitename');  
		$data["master_body"]  = "add_office";  
		$this->load->theme('mainlayout',$data);	
		if($this->uri->segment(4) !='' && $this->uri->segment(4) == '0'){
			header("Refresh:4; url=".base_url()."office/manage_office");
		}
	}
	public function add_office_to_database(){
		$arr["id"]       = $this->input->post("id");
		$arr["title"]    = ucfirst(trim(trim($this->input->post("title"))));
		$arr["email"]    = trim(trim($this->input->post("email")));
		$arr["password"] = trim(trim($this->input->post("password")));
		$arr["admin_access"] = $arr["password"];
 		
		$this->session->set_flashdata("tempdata",strip_slashes($arr));
		if($this->common->email_exist($email, '')){
			$this->session->set_flashdata("errormsg","Email already exist");
			$err=1;
 		} 
		else{
			$arr["password"] = $this->common->salt_password($arr);
			if($this->office_model->add_edit_office($arr)){ 
			  $last_id = $this->db->insert_id();  
			  $err=0;
			  if($arr["id"] == ""){
				  $this->session->set_flashdata("successmsg","Office created successfully");		 
				  redirect(base_url().$this->router->class."/add_office/".$err);
			  }
			  else{ 
				  $this->session->set_flashdata("successmsg","Office updated successfully");
				  redirect(base_url().$this->router->class."/edit_office/".$arr["id"]."/".$err);
			  }
		  }
		  else{
			  $this->session->set_flashdata("errormsg","There is error adding office to data base . Please contact database admin");
			  $err=1;
		  }
		}
}
	public function enable_disable_office(){
		$id     = $this->uri->segment(3);
		$status = $this->uri->segment(4);
		if($status == 0){
			$show_status = "deactivated";	
		}	
		else{
			$show_status = "activated";	
		}
		
		$this->office_model->enable_disable_office($id,$status);
		$this->session->set_flashdata("successmsg","Office ".$show_status." successfully");	
		redirect(base_url()."office/manage_office");
	}
	
	public function archive_office(){
		$id = $this->uri->segment(3);
		if($id != ''){	
			$this->office_model->archive_office($id);
			$this->session->set_flashdata("successmsg","Office archived successfully");	
			redirect(base_url()."office/manage_office");
		}
		else{
			redirect(base_url()."invalidpage");
		}	
	}
	
	public function view_office(){		
		$id = $this->uri->segment(3);
		if($id == ""){
			redirect(base_url()."invalidpage");				
		}
		else{
			$data["resultset"] = $this->office_model->getIndividualOffice($id);	
		}
		$data["item"]          = "Office";
		$data["master_title"]  = "View Office";   // Please enter the title of page......
		$data["master_body"]   = "view_office";   
		$this->load->theme('mainlayout',$data);  // Loading theme
	}
	
	
	
}
?>