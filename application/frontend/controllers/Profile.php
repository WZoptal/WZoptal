
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Profile extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('user_model');
   		$this->load->helper('url');	
 	}

   public function index(){
      if(!empty($this->session->userdata('logged_in'))){   

     		$id =  $this->session->userdata('id');

     		$data["resultset"] = $this->user_model->get_user_data($id);
        $data["country"]    = $this->user_model->get_country_data();
     		$data["item"]         = "profile";
     		$data["master_title"] = "Manage Profile | ".$this->config->item('sitename');
     		$data["master_body"]  = "profile";
     		$this->load->theme('micro_layout', $data);
      }else{
         redirect(base_url()."login");
      }
   	}

    public function add_profile_to_database(){

        $arr["id"] = $this->input->post("id");
        $arr["name"]= ucfirst(trim(trim($this->input->post("name"))));
        $arr["username"]= ucfirst(trim(trim($this->input->post("username"))));
        $arr["email"]= ucfirst(trim(trim($this->input->post("email"))));
        $arr["phone"]= ucfirst(trim(trim($this->input->post("phone"))));
        $arr["country"]= ucfirst(trim(trim($this->input->post("country"))));
        $arr["gender"]= ucfirst(trim(trim($this->input->post("gender"))));
        $arr["pincode"]= trim(trim($this->input->post("pincode")));
        $_image     = $_FILES['image']['name'];
          if ($_image != "") {
              $file_extension=pathinfo($_image, PATHINFO_EXTENSION);
              $allowed_image_extension = array("png","PNG","JPG", "jpg");
              if (! in_array($file_extension, $allowed_image_extension)){
                 if(!empty($arr["id"])){
                   $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");     
                  redirect(base_url()."profile");
                }else{
                   $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");     
                  redirect(base_url()."profile");
                }
              }else{
                  $ext                = end(explode(".", $_image));
                  $_image             = $this->session->userdata('id').'_'.uniqid().'_'.time().".".$ext;
                  $image_name         = $_image;
                  $arr["profile_pic"] = $image_name;
                  $path               = "./pics/profile_pics/" . $image_name;
                  copy($_FILES['image']['tmp_name'], $path);

              }
          }
            
       
        $this->session->set_flashdata("tempdata",strip_slashes($arr));
         
        if($this->user_model->add_edit_profile($arr)){ 
          $last_id = $this->db->insert_id(); 
       
          if($arr["id"] == ""){
            $this->session->set_flashdata("successmsg","Profile created successfully");    
            redirect(base_url()."profile");
          }
          else{ 
            $this->session->set_flashdata("successmsg","Profile updated successfully");
            redirect(base_url()."profile");
          }

        }
        else{
          $this->session->set_flashdata("errormsg","There is error adding category to data base . Please contact database admin");
          $err=1;
        }
    }



}
