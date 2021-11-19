<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->model('subscription_model');
		$this->load->helper('url');
		//echo $this->config->item('sitename'); 


		//echo ADMIN_EMAIL_SEND; die;
	}
	public function index(){
		$this->manage_subscription();	
	}	
	
	/////////////////////////////////  category ////////////////////////
	
		public function manage_subscription(){   
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
		$config["per_page"] = $this->config->item("perpageitem"); 
		$config['base_url']=base_url()."subscription/manage_subscription/?".$this->common->removeUrl("per_page",$_SERVER["QUERY_STRING"]);
		$countdata=array();
		$countdata=$_GET;
		$countdata["countdata"]="yes";	
		
		$config['total_rows']=count($this->subscription_model->getcategoryData($countdata));   
		$config["uri_segment"]=(isset($_GET["per_page"]) && $_GET["per_page"]!="")?$_GET["per_page"]:"0";
		$this->pagination->initialize($config);
		/*--------------------------Paging code ends---------------------------------------------------*/
		$searcharray=array();
		$searcharray=$_GET;
		$searcharray["per_page"]=$config["per_page"];
		$searcharray["page"]=$config["uri_segment"];
		$data["resultset"]=$this->subscription_model->getcategoryData($searcharray);
		$data["country_arr"] = $this->config->item('country_arr'); 
		$data["item"]="plan";
		$data["master_title"]= "Manage subscription | ".$this->config->item('sitename');  
		$data["master_body"]="manage_subscription";  
		$this->load->theme('mainlayout',$data);	
	}
	public function add_plan(){	
		$data["item"]         = "plan";
		$data["do"]           = "add";
		$data["categorydata"] = $this->session->flashdata("tempdata");
		$data["master_title"] = "Add plan | ".$this->config->item('sitename');  
		$data["master_body"]  = "add_plan";  
		$this->load->theme('mainlayout',$data);
		if($this->uri->segment(3) != '' && $this->uri->segment(3)== '0'){
			header("Refresh:4;url=".base_url()."subscription/manage_subscription");
		}
	}
	public function edit_plan(){
		$data["item"] = "plan";
		$data["do"]   = "edit";
		$episodeid   = $this->uri->segment(3); 
		$data["categorydata"]=$this->subscription_model->getIndividualplan($episodeid); 
		$data["master_title"]="Edit Plan | ".$this->config->item('sitename');  
		$data["master_body"]="add_plan";   
		$this->load->theme('mainlayout',$data);	
		if($this->uri->segment(4)!=''&& $this->uri->segment(4)== '0'){
			header("Refresh:4; url=".base_url()."subscription/manage_subscription");
		}
	}

	public function strposa($haystack, $needle, $offset=0) { 
		    if(!is_array($needle)) $needle = array($needle);
		    foreach($needle as $query) {
		        if(stripos($haystack, $query, $offset) !== false) return true; // stop on first true result
		    }
		    return false;
		}
	

	public function add_plan_to_database(){

		$arr["id"] = $this->input->post("id");
		$arr["name"]= ucfirst(trim(trim($this->input->post("name"))));
		$arr["title"]= ucfirst(trim(trim($this->input->post("title"))));
		$arr["description"]= ucfirst(trim(trim($this->input->post("description"))));
		$arr["amount"]= trim(trim($this->input->post("amount")));
		$arr["currency"]= ucfirst(trim(trim($this->input->post("currency"))));
		$arr["billing_cycle"]= trim(trim($this->input->post("billing_cycle")));
		
		$array  = array('Free');
		$arr['is_free'] =  true;
		if($this->strposa($arr["name"], $array) === false){
			$arr['is_free'] =  false;
		}


 		$_image     = $_FILES['image']['name'];
 		
			if ($_image != "") {
				$file_extension=pathinfo($_image, PATHINFO_EXTENSION);
				$allowed_image_extension = array("png","PNG","JPG", "jpg");
				if (! in_array($file_extension, $allowed_image_extension)){
					 if(!empty($arr["id"])){
						 $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");		 
						redirect(base_url().$this->router->class."/edit_plan/".$arr["id"]."/".$err);
					}else{
						 $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");		 
						redirect(base_url().$this->router->class."/add_plan/".$err);
					}
				}else{
				
						$ext          		 = end(explode(".", $_image));
						$_image  	 	 = $userData['id'].'_'.uniqid().'_'.time().".".$ext;
						$image_name   		 = $_image;
						$arr["image"]   = $image_name;
						$path = "../pics/plans/" . $image_name;
						copy($_FILES['image']['tmp_name'], $path);
					
				}
			}

		$this->session->set_flashdata("tempdata",strip_slashes($arr));
		
 		if($this->subscription_model->add_edit_plan($arr)){ 
			$last_id = $this->db->insert_id(); 
			$err=0;
		  if($arr["id"] == ""){
			  $this->session->set_flashdata("successmsg","Plan created successfully");		 
			  redirect(base_url().$this->router->class."/add_plan/".$err);
		  }
		  else{ 
			  $this->session->set_flashdata("successmsg","Plan updated successfully");
			  redirect(base_url().$this->router->class."/edit_plan/".$arr["id"]."/".$err);
		  }

 	  }
	  else{
		  $this->session->set_flashdata("errormsg","There is error adding plan to data base . Please contact database admin");
		  $err=1;
	  }
}
	public function enable_disable_plan(){
		$id=$this->uri->segment(3);
		$status=$this->uri->segment(4);
		if($status==0){
			$show_status="deactivated";	
		}	
		else{
			$show_status="activated";	
		}
		
		$this->subscription_model->enable_disable_plan($id,$status);
		$this->session->set_flashdata("successmsg","Episode ".$show_status." successfully");	
		redirect(base_url()."subscription/manage_subscription");
	}
	
	public function archive_plan(){
		$id = $this->uri->segment(3);
		if($id!=''){	
			$this->subscription_model->did_delete_row($id);
			$this->session->set_flashdata("successmsg","Plan  archived successfully");	
			redirect(base_url()."subscription/manage_subscription");
		}
		else{
			redirect(base_url()."invalidpage");
		}	
	}
	
	public function view_plan(){		
		$id = $this->uri->segment(3);
		if($id==""){
			redirect(base_url()."invalidpage");				
		}
		else{
			$data["resultset"]=$this->subscription_model->getIndividualplan($id);	
		}
		$data["item"]         = "plan";
		$data["master_title"] = "View Plan";   // Please enter the title of page......
		$data["master_body"]  = "view_plan";   
		$this->load->theme('mainlayout',$data);  // Loading theme
	}
	
	
	
}
?>