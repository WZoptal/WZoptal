<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->model('category_model');
		$this->load->helper('url');
	}
	public function index(){
		$this->manage_categories();	
	}	
	
	/////////////////////////////////  category ////////////////////////
	
		public function manage_categories(){   
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
		$config['base_url']=base_url()."category/manage_categories/?".$this->common->removeUrl("per_page",$_SERVER["QUERY_STRING"]);
		$countdata=array();
		$countdata=$_GET;
		$countdata["countdata"]="yes";	
		
		$config['total_rows']=count($this->category_model->getcategoryData($countdata));   
		$config["uri_segment"]=(isset($_GET["per_page"]) && $_GET["per_page"]!="")?$_GET["per_page"]:"0";
		$this->pagination->initialize($config);
		/*--------------------------Paging code ends---------------------------------------------------*/
		$searcharray=array();
		$searcharray=$_GET;
		$searcharray["per_page"]=$config["per_page"];
		$searcharray["page"]=$config["uri_segment"];
		$data["resultset"]=$this->category_model->getcategoryData($searcharray);
		$data["item"]="category";
		$data["master_title"]= "Manage Categories | ".$this->config->item('sitename');  
		$data["master_body"]="manage_categories";  
		$this->load->theme('mainlayout',$data);	
	}
	public function add_category(){	
		$data["item"]         = "category";
		$data["do"]           = "add";
		$data["categorydata"] = $this->session->flashdata("tempdata");
		$data["master_title"] = "Add Category | ".$this->config->item('sitename');  
		$data["master_body"]  = "add_category"; 
		$this->load->theme('mainlayout',$data);
		if($this->uri->segment(3) != '' && $this->uri->segment(3)== '0'){
			header("Refresh:4;url=".base_url()."category/manage_categories");
		}
	}
	public function edit_category(){
		$data["item"] = "category";
		$data["do"]   = "edit";
		$categoryid   = $this->uri->segment(3); 
		$data["categorydata"]=$this->category_model->getIndividualcategory($categoryid); 
		$data["master_title"]="Edit category | ".$this->config->item('sitename');  
		$data["master_body"]="add_category";  
		$this->load->theme('mainlayout',$data);	
		if($this->uri->segment(4)!=''&& $this->uri->segment(4)== '0'){
			header("Refresh:4; url=".base_url()."category/manage_categories");
		}
	}
	public function add_category_to_database(){
		$arr["id"] = $this->input->post("id");
		$arr["title"]= ucfirst(trim(trim($this->input->post("title"))));
 		$category_image     = $_FILES['category_image']['name'];
			if ($category_image != "") {
				$file_extension=pathinfo($category_image, PATHINFO_EXTENSION);
				$allowed_image_extension = array("png","PNG");
				if (! in_array($file_extension, $allowed_image_extension)){
					 if(!empty($arr["id"])){
						 $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");		 
						redirect(base_url().$this->router->class."/edit_category/".$arr["id"]."/".$err);
					}else{
						 $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");		 
						redirect(base_url().$this->router->class."/add_category/".$err);
					}
				}else{
					list($width, $height, $type, $attr) = getimagesize($_FILES['category_image']['tmp_name']);
					if(($width > 70 || $width < 98) && ($height  > 70 || $height < 98) ){			
						$ext          		 = end(explode(".", $category_image));
						$category_image  	 	 = $userData['id'].'_'.uniqid().'_'.time().".".$ext;
						$image_name   		 = $category_image;
						$arr["category_image"]   = $image_name;
						$path = "../pics/episode/" . $image_name;
						copy($_FILES['category_image']['tmp_name'], $path);
					}else{
						if(!empty($arr["id"])){
							 $this->session->set_flashdata("errormsg","Please upload image size 70*98");		 
							redirect(base_url().$this->router->class."/edit_category/".$arr["id"]."/".$err);
						}else{
							 $this->session->set_flashdata("errormsg","Please upload image size 70*98");		 
							redirect(base_url().$this->router->class."/add_category/".$err);
						}
					}
				}
			}
		$this->session->set_flashdata("tempdata",strip_slashes($arr));
		 
 		if($this->category_model->add_edit_category($arr)){ 
			$last_id = $this->db->insert_id(); 
			$err=0;
		  if($arr["id"] == ""){
			  $this->session->set_flashdata("successmsg","Category created successfully");		 
			  redirect(base_url().$this->router->class."/add_category/".$err);
		  }
		  else{ 
			  $this->session->set_flashdata("successmsg","Category updated successfully");
			  redirect(base_url().$this->router->class."/edit_category/".$arr["id"]."/".$err);
		  }

 	  }
	  else{
		  $this->session->set_flashdata("errormsg","There is error adding category to data base . Please contact database admin");
		  $err=1;
	  }
}
	public function enable_disable_category(){
		$id=$this->uri->segment(3);
		$status=$this->uri->segment(4);
		if($status==0){
			$show_status="deactivated";	
		}	
		else{
			$show_status="activated";	
		}
		
		$this->category_model->enable_disable_category($id,$status);
		$this->session->set_flashdata("successmsg","Category ".$show_status." successfully");	
		redirect(base_url()."category/manage_categories");
	}
	
	public function archive_category(){
		$id = $this->uri->segment(3);
		if($id!=''){	
			$this->category_model->archive_category($id);
			$this->session->set_flashdata("successmsg","Category  archived successfully");	
			redirect(base_url()."category/manage_categories");
		}
		else{
			redirect(base_url()."invalidpage");
		}	
	}
	
	public function view_category(){		
		$id = $this->uri->segment(3);
		if($id==""){
			redirect(base_url()."invalidpage");				
		}
		else{
			$data["resultset"]=$this->category_model->getIndividualCategory($id);	
		}
		$data["item"]         = "category";
		$data["master_title"] = "View category";   // Please enter the title of page......
		$data["master_body"]  = "view_category";   
		$this->load->theme('mainlayout',$data);  // Loading theme
	}
	
	
	
}
?>