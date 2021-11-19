<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Events extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');         //for load url helper
 		$this->load->model('event_model');  //for load event model 	
	}
	public function index(){
		//default function on page load
		$this->manage_events();	
	}	
	
	//for Manage User page
	public function manage_events(){ 
		/*--------------------------Paging code start---------------------------------------------------*/
		$page=(isset($_GET["per_page"]) && $_GET["per_page"]!="")?$_GET["per_page"]:""; 
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
		$config["per_page"]      = $this->config->item("perpageitem"); 
		$config['base_url']      = base_url()."events/manage_events/?".$this->common->removeUrl("per_page",$_SERVER["QUERY_STRING"]);
		$countdata               = array();
		$countdata               = $_GET;
		$countdata["countdata"]  = "yes";	
 		$config['total_rows']    = count($this->event_model->getEventData($countdata));   
		$config["uri_segment"]   = (isset($_GET["per_page"]) && $_GET["per_page"]!="")?$_GET["per_page"]:"0";
		$this->pagination->initialize($config);
		/*--------------------------Paging code ends---------------------------------------------------*/
		$searcharray             = array();
		$searcharray             = $_GET;
		$searcharray["per_page"] = $config["per_page"];
		$searcharray["page"]     = $config["uri_segment"];
		$data["resultset"]       = $this->event_model->getEventData($searcharray); //for get list of all events
 		$data["item"]            = "Event";
		$data["master_title"]    = "Manage Events | ".$this->config->item('sitename');  // Please enter the title of page......
		$data["master_body"]     = "manage_events";  //Please use view name in this field please do not include '.php' for including view name
		$this->load->theme('mainlayout',$data);	
	}
	
	//For Add Event
	public function add_event(){	
		$data["item"]         = "Event";
		$data["do"]           = "add";
		$event_id       = $_GET['previous_events'];
 		$data["resultset"]    = $this->session->flashdata("tempdata");
 		$data["master_title"] = "Add Event | ".$this->config->item('sitename');    //Please enter the title of page......
		$data["master_body"]  = "add_event"; //  Please use view name in this field please do not include '.php' for including view name
		$this->load->theme('mainlayout',$data);
		//for refresh page after saving data
		if($this->uri->segment(3) != '' && $this->uri->segment(3)== '0'){
			header("Refresh:4;url=".base_url()."events/manage_events");
		}
	}
	
	//For Update/Edit Event
	public function edit_event(){
		$data["item"]         = "Event";
		$data["do"]           = "edit";
		$id                   = $this->uri->segment(3); 
 		$data["resultset"]    = $this->event_model->getIndividualEvent($id); //for get event data
 		$data["master_title"] = "Edit Event | ".$this->config->item('sitename');  //Please enter the title of page...... 
		$data["master_body"]  = "add_event";  //  Please use view name in this field please do not include '.php' for including view name
		$this->load->theme('mainlayout',$data);
		//for refresh page after saving data	
		if($this->uri->segment(4) != '' && $this->uri->segment(4) == '0'){
			header("Refresh:4; url=".base_url()."events/manage_events");
		}
	}
	
	//For Add/Edit Event data into database
	public function add_events_to_database(){
 		$arr["id"]         = trim($this->input->post("id"));
		$arr["name"]       = ucwords(trim($this->input->post("name")));
		$arr["start_date"] = trim($this->input->post("start_date"));  // mm/dd/yyyy
		$start_hh          = trim($this->input->post("start_hh"));  
		$start_mm          = trim($this->input->post("start_mm"));  
		$time_status       = trim($this->input->post("time_status"));  
		$arr["start_time"] = $start_hh.':'.$start_mm.' '.$time_status;
		$arr["location"]   = trim($this->input->post("location"));
		$prev_image        = trim($this->input->post("prev_image"));
		$start_date        = explode('/', $arr["start_date"]);
		$arr["start_timestamp"] = strtotime($start_date[2].'/'.$start_date[0].'/'.$start_date[1].' '.$arr["start_time"]);
		
		$imagename = $_FILES['image']['name'];  
		$size      = $_FILES['image']['size'];  
		$path      = "../pics/events/";
		if(strlen($imagename)){ 
			$ext = strtolower($this->common->get_extension($imagename));
			//if($size < (90*90)){ 
			
				$actual_image_name = time().uniqid().".".$ext;
				$uploadedfile      = $_FILES['image']['tmp_name'];
				$widthArray        = array(360); //You can change dimension here.
				foreach($widthArray as $newwidth){
					$filename = $this->common->compressImage($ext, $uploadedfile, $path, $actual_image_name, $newwidth);
					 //echo "<img src='".$filename."' class='img'/>"; die;
				}
			//}
 		}
 		//Original Image
		if(move_uploaded_file($uploadedfile, $path.$actual_image_name)){
			$arr["image"] = $actual_image_name;
			if($pre_image <> ''){
				unlink('pics/events/'.$prev_image);
				unlink('pics/events/360_'.$prev_image);
 			}
   		}
 		 
 		$this->session->set_flashdata("tempdata",strip_slashes($arr));
   		if($this->event_model->add_edit_event($arr)){
			//for get user id 
			$last_id = $this->db->insert_id(); 
			if($arr["id"] == ""){
 				$err = 0;
				//for success message "Add Page"
				$this->session->set_flashdata("successmsg","Event created successfully");		 
				redirect(base_url().$this->router->class."/add_event/".$err);
			}
			else{ 
			    $err = 0;
				//for success message "Edit Page"
				$this->session->set_flashdata("successmsg","Event updated successfully");
				redirect(base_url().$this->router->class."/edit_event/".$arr["id"]."/".$err);
			}
  	  }
	  else{
		  if($arr["id"] == ""){
			  //for error message "Add Page"
			  $this->session->set_flashdata("errormsg","There is error adding event to data base . Please contact database admin");
			  $err=1;
			  redirect(base_url().$this->router->class."/add_event/".$err);
		  }
		  else{ 
		      //for error message "Edit Page"
			  $this->session->set_flashdata("errormsg","There is error adding event to data base . Please contact database admin");
			  $err=1;
			  redirect(base_url().$this->router->class."/edit_event/".$arr["id"]."/".$err);
		  }
	  }
	}
	
	//For Enable/Disable Event
	public function enable_disable_event(){
		$id = $this->uri->segment(3);
		$status  = $this->uri->segment(4);
		if($status == 0){
			$event_status = "deactivated";	
		}	
		else{
			$event_status = "activated";	
		}
		//for update event status into database
		$this->event_model->enable_disable_event($id,$status);
		//for success message
		$this->session->set_flashdata("successmsg","Event ".$event_status." successfully");	
		redirect(base_url()."events/manage_events");
	}
	
 	
	//for delete event from database
	public function archive_event(){
		$delid = $this->uri->segment(3);
		if($delid != ''){
			//for check you register for event or not
			//$num = $this->event_model->checkAnyUserRegisterForEvent($delid);	
			//if($num == 0){
				// if no event deleted from database
			$this->event_model->archive_event($delid);
			//for success message
			$this->session->set_flashdata("successmsg","Event deleted successfully");	
			redirect(base_url()."events/manage_events");
			/*}
			else{
				//if yes
				//for error message
				$this->session->set_flashdata("errormsg","You cannot delete this event due to already User register for this event");	
				redirect(base_url()."events/manage_events");
			}*/
		}
		else{
			//for error message
 			$this->session->set_flashdata("successmsg","Selected events archived successfully");	
			redirect(base_url()."events/manage_events");
		}	
	}
	
	//for view event details page
	public function view_event(){
		$data["item"] = "Event";
 		$id      = $this->uri->segment(3);
		if($id == ""){
			redirect(base_url()."invalidpage");				
		}
		else{
			$data["resultset"]  = $this->event_model->getIndividualEvent($id);
 		}
 		$data["master_title"] = "View event";   // Please enter the title of page......
		$data["master_body"]  = "view_event";  //  Please use view name in this field please do not include '.php' for including view name
		$this->load->theme('mainlayout',$data);  // Loading theme
	}
	
	
///////////////////***************** page code end here ****************//////////////////	
}
?>