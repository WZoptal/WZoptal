<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Users extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
        $this->load->model('user_model');
        $this->load->model('subscription_model');
        $this->load->model('users_model');
     }
    public function index(){
        $this->manage_business();
    }
    public function manage_artist(){
        $page = (isset($_GET["per_page"]) && $_GET["per_page"] != "") ? $_GET["per_page"] : ""; //$this->input->get("page");
        if($page == ''){
            $page = '0';
        }
        else{
            if (!is_numeric($page)){
                redirect(BASEURL . '404');
            }
            else{
                $page = $page;
            }
        }
        $config["per_page"]     = $this->config->item("perpageitem");
        $config['base_url']     = base_url() . "users/manage_artist/?" . $this->common->removeUrl("per_page", $_SERVER["QUERY_STRING"]);
        $countdata              = array();
        $countdata              = $_GET;
        $countdata["countdata"] = "yes";
        $config['total_rows']   = count($this->users_model->getuserData($countdata, 2));
        $config["uri_segment"]  = (isset($_GET["per_page"]) && $_GET["per_page"] != "") ? $_GET["per_page"] : "0";
        $this->pagination->initialize($config);
        /*--------------------------Paging code ends---------------------------------------------------*/
        $searcharray             = array();
        $searcharray             = $_GET;
        $searcharray["per_page"] = $config["per_page"];
        $searcharray["page"]     = $config["uri_segment"];
        $data["resultset"]       = $this->users_model->getuserData($searcharray, 2);
        $data["item"]            = "Artist";
        $data["master_title"]    = "Manage Artist"; // Please enter the title of page......
        $data["master_body"]     = "manage_artist"; //  Please use view name in this field please do not include '.php' for including view name
        $this->load->theme('mainlayout', $data);
    }
	
    public function view_artist(){
        $data["item"]         = "Artist";
        $data["do"]           = "View ";
        $data["page"]         = $page;
        $userid               = $this->uri->segment(3);
        $data["userdataa"]     = $this->users_model->getIndividualUser($userid);
        $data["master_title"] = "View artist"; // Please enter the title of page......
        $data["master_body"]  = "view_artist";
        $data["landing"]      = "manage_artist"; //  Please use view name in this field please do not include '.php' for including view name
        $this->load->theme('mainlayout', $data);
    }
	
    public function enable_disable_artist(){
        $id     = $this->uri->segment(3);
        $status = $this->uri->segment(4);
        $page   = $this->uri->segment(5);
        if($status == 0){
            $show_status = "Blocked";
        }
        else{
            $show_status = "Activated";
        }
        $this->users_model->enable_disable_user($id, $status);
        $this->session->set_flashdata("successmsg", "Artist " . $show_status . " successfully");
        $pagination =$page!='' ? "/?&per_page=" . $page : "";
        redirect(base_url() . "users/manage_artist". $pagination);
    }
	
    public function archive_artist(){
        $delid = $this->uri->segment(3);
        if($delid != ''){
            $this->users_model->archive_user($delid);
            $this->session->set_flashdata("successmsg", "Artist deleted successfully");
            redirect(base_url() . "users/manage_artist");
        }
     }
	
    public function manage_user(){
        $page = (isset($_GET["per_page"]) && $_GET["per_page"] != "") ? $_GET["per_page"] : ""; 
        if($page == ''){
            $page = '0';
        }
        else{
            if(!is_numeric($page)){
                redirect(BASEURL . '404');
            }
            else{
                $page = $page;
            }
        }
        $config["per_page"]     = $this->config->item("perpageitem");
        $config['base_url']     = base_url() . "users/manage_user/?" . $this->common->removeUrl("per_page", $_SERVER["QUERY_STRING"]);
        $countdata              = array();
        $countdata              = $_GET;
        $countdata["countdata"] = "yes";
        $config['total_rows']   = count($this->users_model->getuserData($countdata, 1));
        $config["uri_segment"]  = (isset($_GET["per_page"]) && $_GET["per_page"] != "") ? $_GET["per_page"] : "0";
        $this->pagination->initialize($config);
        /*--------------------------Paging code ends---------------------------------------------------*/
        $searcharray             = array();
        $searcharray             = $_GET;
        $searcharray["per_page"] = $config["per_page"];
        $searcharray["page"]     = $config["uri_segment"];
        $data["resultset"]       = $this->users_model->getuserData($searcharray, 1);
        $data["item"]            = "Users";
        $data["master_title"]    = "Manage Users"; // Please enter the title of page......
        $data["master_body"]     = "manage_user";  
        $this->load->theme('mainlayout', $data);
    }

    public function edit_user(){
        $id = $this->uri->segment(3);
        $data['user'] = $this->users_model->get_user_details($id);
        $data["country"]    = $this->user_model->get_country_data();
        $data["plan"]    = $this->subscription_model->GetSubscriptions();

        $data["item"]            = "User";
        $data["master_title"]    = "Edit User"; // Please enter the title of page......
        $data["master_body"]     = "edit_user";  
        $base_url = base_url();
        if(!empty($data['user']['profile_pic']) ){
           $data['user']['profile_pic'] = str_replace('/admin/', '', $base_url).'/pics/profile_pics/'.$data['user']['profile_pic'];
        }
        $this->load->theme('mainlayout', $data);
    }
	
    public function view_user(){
        $data["item"]         = "Users";
        $data["do"]           = "View ";
        $data["page"]         = $page;
        $userid               = $this->uri->segment(3);
        $data["userdata"]     = $this->users_model->getIndividualUser($userid);
        $data["master_title"] = "View Users"; // Please enter the title of page......
        $data["master_body"]  = "view_user";
        $this->load->theme('mainlayout', $data);
    }
	
    public function enable_disable_user(){
        $id     = $this->uri->segment(3);
        $status = $this->uri->segment(4);
        $page   = $this->uri->segment(5);
        if($status == 0){
            $show_status = "Blocked";
        }
        else{
            $show_status = "Activated";
        }
        $this->users_model->enable_disable_user($id, $status);
        $this->session->set_flashdata("successmsg", "User " . $show_status . " successfully");
        redirect(base_url() . "users/manage_user/?&per_page=" . $page);
    }
	
    public function archive_user(){
        $delid = $this->uri->segment(3);
        if($delid != ''){
            $this->users_model->did_delete_row($delid);
            $this->session->set_flashdata("successmsg", "User deleted successfully");
            redirect(base_url() . "users/manage_user");
        }
     }
	
    public function add_users_to_database(){
        $arr["id"]       = $this->input->post("id");
        //$arr["username"] = clean($this->input->post("username"));
        $arr["email"]    = clean($this->input->post("email"));
        $arr["password"] = clean($this->input->post("password"));
        if ($arr["id"] == "")
        {
            $arr["password"] = $this->common->salt_password($arr);
        }
        else if ($arr["id"] != "" && $arr["password"] != "")
        {
            $arr["password"] = $this->common->salt_password($arr);
        }
        else
        {
            unset($arr["password"]);
        }
        $arr["phone"]    = clean($this->input->post("phone"));
        $arr["username"] = clean($this->input->post("username"));
        $arr["status"]   = clean($this->input->post("status"));
        $arr["image"]    = $_FILES["image"]["name"];
        if ($arr["image"] != "")
        {
            $arr["image"] = time() . "." . $this->common->get_extensions($_FILES["image"]["name"]);
        }
        else
        {
            $arr["image"] = $this->input->post("prev_image");
        }
        ///debug($arr);die;
        $this->session->set_flashdata("tempdata", strip_slashes($arr));
        if ($this->validations->validate_userdata($arr))
        {

            if ($arr["image"] != $this->input->post("prev_image"))
            {
                $image_info   = getimagesize($_FILES['image']['tmp_name']);
                $image_width  = $image_info[0];
                $image_height = $image_info[1];
                $path         = "../pics/" . $arr["image"];
                chmod("$path", 0777); // set permission to the file.
                if (copy($_FILES['image']['tmp_name'], $path)) //  upload the file to the server
                {
                    $this->load->library('image_lib');
                    $config['image_library']  = 'gd2';
                    $config['source_image']   = $path;
                    $config['create_thumb']   = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']          = 150;
                    $config['height']         = 120;
                    $config['master_dim']     = 'width';
                    $config['new_image']      = $path;
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    unlink('../pics/' . $this->input->post("prev_image"));
                    $err = 0;
                }
                else
                {
                    //echo $this->upload->display_errors();die;
                    //	$this->session->set_flashdata("successmsg","There is some error uploading the files to server. Please contact server admin");		
                    if ($arr["id"] == "")
                    {
                        redirect(base_url() . $this->router->class . "/edit_users");
                    }
                    else
                    {
                        redirect(base_url() . $this->router->class . "/edit_user/" . $arr["id"]);
                    }
                }
                unset($arr["prev_image"]);
            }
            unset($arr["verifie"]);
        }
        else
        {
            if ($arr["id"] == "")
            {
                redirect(base_url() . $this->router->class . "/edit_users");
            }
            else
            {
                redirect(base_url() . $this->router->class . "/edit_users/" . $arr["id"]);
            }
        }
    }


    public function edit_users_to_database(){
       $arr["id"] = $this->input->post("id");
        $arr["name"]= ucfirst(trim(trim($this->input->post("name"))));
        $arr["username"]= ucfirst(trim(trim($this->input->post("username"))));
        $arr["email"]= ucfirst(trim(trim($this->input->post("email"))));
        $arr["phone"]= ucfirst(trim(trim($this->input->post("phone"))));
        $arr["country"]= ucfirst(trim(trim($this->input->post("country"))));
        $arr["user_type"]= ucfirst(trim(trim($this->input->post("user_type"))));
        $arr["gender"]= ucfirst(trim(trim($this->input->post("gender"))));
        $arr["plan_status"]= ucfirst(trim(trim($this->input->post("plan_status"))));
        $arr["address"]= ucfirst(trim(trim($this->input->post("address"))));
        $arr["planId"]= ucfirst(trim(trim($this->input->post("planId"))));
        $arr["pincode"]= trim(trim($this->input->post("pincode")));
        $_image     = $_FILES['image']['name'];
        $pic_path =  $this->config->item('pic_dir_path');
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
                  $path               = $pic_path."/pics/profile_pics/" . $image_name;
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
            redirect(base_url()."users/edit_user/".$arr['id']);
          }

        }
        else{
          $this->session->set_flashdata("errormsg","There is error adding category to data base . Please contact database admin");
          $err=1;
        }
    }
}
?>