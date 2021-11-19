<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->model('location_model');
		$this->load->model('user_model');
		$this->load->helper('url');
	}
	public function index(){
		$this->manage_location();	
	}	
	
	/////////////////////////////////  category ////////////////////////
	
		public function manage_location(){   
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
		$config['base_url']=base_url()."location/manage_location/?".$this->common->removeUrl("per_page",$_SERVER["QUERY_STRING"]);
		$countdata=array();
		$countdata=$_GET;
		$countdata["countdata"]="yes";	
		
		$config['total_rows']=count($this->location_model->getcategoryData($countdata));   
		$config["uri_segment"]=(isset($_GET["per_page"]) && $_GET["per_page"]!="")?$_GET["per_page"]:"0";
		$this->pagination->initialize($config);
		/*--------------------------Paging code ends---------------------------------------------------*/
		$searcharray=array();
		$searcharray=$_GET;
		$searcharray["per_page"]=$config["per_page"];
		$searcharray["page"]=$config["uri_segment"];
		$data["resultset"]=$this->location_model->getcategoryData($searcharray);
		$data["item"]="location";
		$data["master_title"]= "Manage Location | ".$this->config->item('sitename');  
		$data["master_body"]="manage_location";  
		$this->load->theme('mainlayout',$data);	
	}
	public function add_location(){	
		$data["item"]         = "location";
		$data["do"]           = "add";
		$data["categorydata"] = $this->session->flashdata("tempdata");
		$data["master_title"] = "Add Location | ".$this->config->item('sitename');  
		$data["master_body"]  = "add_location";  
		$this->load->theme('mainlayout',$data);
		if($this->uri->segment(3) != '' && $this->uri->segment(3)== '0'){
			header("Refresh:4;url=".base_url()."location/manage_location");
		}
	}
	public function edit_location(){
		$data["item"] = "location";
		$data["do"]   = "edit";
		$episodeid   = $this->uri->segment(3); 
		$data["categorydata"]=$this->location_model->getIndividualepisode($episodeid); 
		$data["master_title"]="Edit Location | ".$this->config->item('sitename');  
		$data["master_body"]="add_location";   
		$this->load->theme('mainlayout',$data);	
		if($this->uri->segment(4)!=''&& $this->uri->segment(4)== '0'){
			header("Refresh:4; url=".base_url()."location/manage_location");
		}
	}
	public function add_location_to_database(){

		$arr["id"] = $this->input->post("id");
		$arr["title"]= ucfirst(trim(trim($this->input->post("title"))));
		$arr["address"]= ucfirst(trim(trim($this->input->post("address"))));
		$arr["direction"]= ucfirst(trim(trim($this->input->post("direction"))));
		$arr["pincode"]= ucfirst(trim(trim($this->input->post("pincode"))));
		$arr["latitude"]= ucfirst(trim(trim($this->input->post("latitude"))));
		$arr["longitude"]= ucfirst(trim(trim($this->input->post("longitude"))));
		$arr["access_difficulty"]= ucfirst(trim(trim($this->input->post("access_difficulty"))));
		$_icon    = $_FILES['icon']['name'];
 		$_image    = $_FILES['image']['name'][0];
 		$audio     = $_FILES['audio']['name'][0];
 		$video     = $_FILES['video']['name'][0];
			

 			if ($_icon != "") {
				
					$allowed_icon_extension = array("png","PNG","JPG", "jpg","gif");
				
					
						$file_name=$_FILES["icon"]["name"];
						$file_tmp=$_FILES["icon"]["tmp_name"];
		    			$file_extension=pathinfo($file_name, PATHINFO_EXTENSION);


		    			if (! in_array($file_extension, $allowed_icon_extension)){
							if(!empty($arr["id"])){
								 $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");		 
								redirect(base_url().$this->router->class."/edit_location/".$arr["id"]."/".$err);
							}else{
								 $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");		 
								redirect(base_url().$this->router->class."/add_location/".$err);
							}
						}else{

							 $ext          = end(explode(".", $file_name)); 
							$_icon  	  = 'bhps_'.uniqid().'_'.time().".".$ext;
							$icon_name   = $_icon;
							$arr["icon"] = $icon_name;
							$path 		  = "../pics/location/" . $icon_name;
							copy($_FILES['icon']['tmp_name'], $path);

						}

			}

 			if ($_image != "") {
				
					$allowed_image_extension = array("png","PNG","JPG", "jpg","gif");
					$imgArr =[];
					foreach($_FILES["image"]["tmp_name"] as $key=>$tmp_name) {

						$file_name=$_FILES["image"]["name"][$key];
						$file_tmp=$_FILES["image"]["tmp_name"][$key];
		    			$file_extension=pathinfo($file_name, PATHINFO_EXTENSION);


		    			if (! in_array($file_extension, $allowed_image_extension)){
							if(!empty($arr["id"])){
								 $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");		 
								redirect(base_url().$this->router->class."/edit_location/".$arr["id"]."/".$err);
							}else{
								 $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");		 
								redirect(base_url().$this->router->class."/add_location/".$err);
							}
						}else{

							$ext          = end(explode(".", $file_name));
							$_image  	  = 'bhps_'.uniqid().'_'.time().".".$ext;
							$image_name   = $_image;
							$arr["image"] = $image_name;
							$path 		  = "../pics/location/" . $image_name;
							copy($_FILES['image']['tmp_name'][$key], $path);

						}

		    			array_push($imgArr, $image_name);
					}
					$arr["image"] = implode(",",$imgArr);

			}
			if ($audio != "") {

					$allowed_audio_extension = array("mp3","MP3","m4a","M4A");
					$audioArr =[];
					foreach($_FILES["audio"]["tmp_name"] as $key=>$tmp_name) {

						$file_name=$_FILES["audio"]["name"][$key];
						$file_tmp=$_FILES["audio"]["tmp_name"][$key];
		    			$file_extension=pathinfo($file_name, PATHINFO_EXTENSION);


		    			if (! in_array($file_extension, $allowed_audio_extension)){
							if(!empty($arr["id"])){
								 $this->session->set_flashdata("errormsg","Upload valid extension. Only Mp3,M4a are allowed.");		 
								redirect(base_url().$this->router->class."/edit_location/".$arr["id"]."/".$err);
							}else{
								 $this->session->set_flashdata("errormsg","Upload valid extension. Only Mp3, M4a are allowed.");		 
								redirect(base_url().$this->router->class."/add_location/".$err);
							}
						}else{

							$ext          = end(explode(".", $file_name));
							$audio  	  = 'bhps_'.uniqid().'_'.time().".".$ext;
							$audio_name   = $audio;
							//$arr["audio"] = $audio_name;
							$path 		  = "../pics/location/" . $audio_name;
							copy($_FILES['audio']['tmp_name'][$key], $path);

						}

		    			array_push($audioArr, $audio_name);
					}
					$arr["audio"] = implode(",",$audioArr);
			}

			if ($video != "") {

					$allowed_video_extension = array("mp4","MP4");
					$videoArr =[];
					foreach($_FILES["video"]["tmp_name"] as $key=>$tmp_name) {

						$file_name=$_FILES["video"]["name"][$key];
						$file_tmp=$_FILES["video"]["tmp_name"][$key];
		    			$file_extension=pathinfo($file_name, PATHINFO_EXTENSION);


		    			if (! in_array($file_extension, $allowed_video_extension)){
							if(!empty($arr["id"])){
								 $this->session->set_flashdata("errormsg","Upload valid extension. Only MP4 are allowed.");		 
								redirect(base_url().$this->router->class."/edit_location/".$arr["id"]."/".$err);
							}else{
								 $this->session->set_flashdata("errormsg","Upload valid extension. Only MP4 are allowed.");		 
								redirect(base_url().$this->router->class."/add_location/".$err);
							}
						}else{

							$ext          = end(explode(".", $file_name));
							$video  	  = 'bhps_'.uniqid().'_'.time().".".$ext;
							$video_name   = $video;
							//$arr["video"] = $video_name;
							$path 		  = "../pics/location/" . $video_name;
							copy($_FILES['video']['tmp_name'][$key], $path);

						}

		    			array_push($videoArr, $video_name);
					}
					$arr["video"] = implode(",",$videoArr);
			}


		$this->session->set_flashdata("tempdata",strip_slashes($arr));
		 
 		if($this->location_model->add_edit_episode($arr)){ 
			$last_id = $this->db->insert_id(); 
			$push = $this->pushNotification($last_id, $arr["title"]);
			$err=0;
		  if($arr["id"] == ""){
			  $this->session->set_flashdata("successmsg","Location created successfully");		 
			  redirect(base_url().$this->router->class."/add_location/".$err);
		  }
		  else{ 
			  $this->session->set_flashdata("successmsg","Location updated successfully");
			  redirect(base_url().$this->router->class."/edit_location/".$arr["id"]."/".$err);
		  }

 	  }
	  else{
		  $this->session->set_flashdata("errormsg","There is error adding location to data base . Please contact database admin");
		  $err=1;
	  }
}
	public function enable_disable_location(){
		$id=$this->uri->segment(3);
		$status=$this->uri->segment(4);
		if($status==0){
			$show_status="deactivated";	
		}	
		else{
			$show_status="activated";	
		}
		
		$this->location_model->enable_disable_episode($id,$status);
		$this->session->set_flashdata("successmsg","Location ".$show_status." successfully");	
		redirect(base_url()."location/manage_location");
	}
	
	public function archive_location(){
		$id = $this->uri->segment(3);
		if($id!=''){	
			$this->location_model->deletelocaltion($id);
			$this->session->set_flashdata("successmsg","Location  archived successfully");	
			redirect(base_url()."location/manage_location");
		}
		else{
			redirect(base_url()."invalidpage");
		}	
	}
	
	public function view_location(){		
		$id = $this->uri->segment(3);
		if($id==""){
			redirect(base_url()."invalidpage");				
		}
		else{
			$data["resultset"]=$this->location_model->getIndividualEpisode($id);	
		}
		$data["item"]         = "location";
		$data["master_title"] = "View Location";   // Please enter the title of page......
		$data["master_body"]  = "view_location";   
		$this->load->theme('mainlayout',$data);  // Loading theme
	}
	public function pushNotification($last_id,$title){ 

			$user = $this->user_model->getAllUser();  

			foreach ($user as $key => $value) {

				$badge_count       = ($value["badgecount"]+1);
				$krru['badgecount'] = $badge_count;
				$krru['id']         = $value['id']; 
				$this->user_model->update_profile_data($krru);

				$noti_message         =  ucwords($title).' new location added ';  
				$krr1['sender']       = 0;
				$krr1['receiver']     = $value['id'];
				$krr1['other_id']     = $last_id;
				$krr1['type'] 		  = "new_location" ;
				$krr1['body']         = $noti_message;
				$notifi_id            = $this->user_model->add_notifications($krr1);   	
				

				$notification_Arr = array(
					'sender'       => 0,
					'receiver'     => $value['id'],
					'other_id'     => $last_id,
					'id'           => $last_id,
					'seen'         => 0,
					'notification' => "New location added",
					'type'		   =>$krr1['type'] ,
					'time'         => time() ,
					'message'      => $noti_message
				);
				if($value['push_notification'] == 1){  
					if($value["device_token"] <> '' || $value["device_token"] <> '1234'){
						 $device_token = $value["device_token"]; 
						$this->fcmNotification($noti_message, $notification_Arr, $device_token, $badge_count);
					}
				}
				# code...
			}

	}

	public function fcmNotification($message, $notification_Arr, $firebase_registration_id=false, $badgecount){   

		
       $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
	   if($notification_Arr['other_id'] == ""){
		   $other_id = "";
	   }
	   else{
		   $other_id = $notification_Arr['other_id'];
	   }
		$fcm_device_id = explode(',', $firebase_registration_id);
		
		foreach($fcm_device_id as $k => $v){
			$fcmDeviceId[] = $v;
		}
		$title = '';
		
		$fields = array(
			'content_available' => true,
            'to' => $firebase_registration_id,
            //'notification' => array('title' => $title, 'body' => $message, 'type' => $notification_Arr['type'], "badge" => $badgecount,  "sound" => 'default','click_action'=> "new_episode"),
            'notification' => (object)array('title' => $title, 'body' => $message),
            'data' => array('message' => $message, 'type' => $notification_Arr['type'], 'sender_id' => $notification_Arr['sender'], 'receiver_id' => $notification_Arr['receiver'], 'other_id' => $other_id, 'badgecount' => $badgecount, 'click_action'=> "new_episode")
        );
 
 		
        $headers = array('Authorization:key=AAAAnckkg0M:APA91bHd3KbQGCxygaJyLd_OYaQhMPk8Y2O8JO7jCu1ie9dclHg1_RwDsH0xvKM9NccoDXckDMR20Vl7eXMbIAIc2AP_74yXWgU_1DyzkzXgGO9r38j6LJOuhf6DwYOdncH-n23meMZt',
            'Content-Type:application/json'
        );		
		$ch = curl_init();
 
        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    
        $result = curl_exec($ch); 
		//echo '<pre>'; print_r($result);// die;
		curl_close($ch); // die;
     }
	
}
?>