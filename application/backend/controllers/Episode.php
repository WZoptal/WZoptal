<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Episode extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->model('episode_model');
		$this->load->model('user_model');
		$this->load->helper('url');
	}
	public function index(){
		$this->manage_episode();	
	}	
	
	/////////////////////////////////  category ////////////////////////
	
		public function manage_episode(){   
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
		$config['base_url']=base_url()."episode/manage_episode/?".$this->common->removeUrl("per_page",$_SERVER["QUERY_STRING"]);
		$countdata=array();
		$countdata=$_GET;
		$countdata["countdata"]="yes";	
		
		$config['total_rows']=count($this->episode_model->getcategoryData($countdata));   
		$config["uri_segment"]=(isset($_GET["per_page"]) && $_GET["per_page"]!="")?$_GET["per_page"]:"0";
		$this->pagination->initialize($config);
		/*--------------------------Paging code ends---------------------------------------------------*/
		$searcharray=array();
		$searcharray=$_GET;
		$searcharray["per_page"]=$config["per_page"];
		$searcharray["page"]=$config["uri_segment"];
		$data["resultset"]=$this->episode_model->getcategoryData($searcharray);
		$data["item"]="episode";
		$data["master_title"]= "Manage Episode | ".$this->config->item('sitename');  
		$data["master_body"]="manage_episode"; 
		$this->load->theme('mainlayout',$data);	
	}
	public function add_episode(){	
		$data["item"]         = "episode";
		$data["do"]           = "add";
		$data["categorydata"] = $this->session->flashdata("tempdata");
		$data["bhpsplans"] = $this->episode_model->getPlans();
		$data["master_title"] = "Add Episode | ".$this->config->item('sitename');  
		$data["master_body"]  = "add_episode";   
		$this->load->theme('mainlayout',$data);
		if($this->uri->segment(3) != '' && $this->uri->segment(3)== '0'){
			header("Refresh:4;url=".base_url()."episode/manage_episode");
		}
	}
	public function edit_episode(){
		$data["item"] = "episode";
		$data["do"]   = "edit";
		$episodeid   = $this->uri->segment(3); 
		$data["categorydata"]=$this->episode_model->getIndividualepisode($episodeid); 
		$data["bhpsplans"] = $this->episode_model->getPlans();

		$data["master_title"]="Edit Episode | ".$this->config->item('sitename');  
		$data["master_body"]="add_episode";   
		$this->load->theme('mainlayout',$data);	 
		if($this->uri->segment(4)!=''&& $this->uri->segment(4)== '0'){
			header("Refresh:4; url=".base_url()."episode/manage_episode");
		}
	}
	public function add_episode_to_database(){ 

		// $last_id=1;
		// $title= "TEst ";
		//  $push = $this->pushNotification($last_id, $title);
		

		//print_R( implode(",", $this->input->post('bhps_planId'))); 

		$arr["id"] = $this->input->post("id");
		$arr["title"]= ucfirst(trim(trim($this->input->post("title"))));
		$arr["subtitle"]= ucfirst(trim(trim($this->input->post("subtitle"))));
		$arr["subtitle2"]= ucfirst(trim(trim($this->input->post("subtitle2"))));
		$arr["matthew"]= ucfirst(trim(trim($this->input->post("matthew"))));
		$arr["subal_stearns"]= ucfirst(trim(trim($this->input->post("subal_stearns"))));
		$arr["bhps_planId"]= implode(",", $this->input->post('bhps_planId'));

	
		if(trim($this->input->post("subal_stearns"))){
			$arr["amount"]= ucfirst(trim(trim($this->input->post("amount"))));
		}
		
 		$_image    = $_FILES['image']['name'][0];
 		$audio     = $_FILES['audio']['name'][0];
 		$video     = $_FILES['video']['name'][0];
		
			if ($_image != "") {
				
					$allowed_image_extension = array("png","PNG","JPG","jpeg", "jpg","gif");
					$imgArr =[];
					foreach($_FILES["image"]["tmp_name"] as $key=>$tmp_name) {

						$file_name=$_FILES["image"]["name"][$key];
						$file_tmp=$_FILES["image"]["tmp_name"][$key];
		    			$file_extension=pathinfo($file_name, PATHINFO_EXTENSION);


		    			if (! in_array($file_extension, $allowed_image_extension)){
							if(!empty($arr["id"])){
								 $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");		 
								redirect(base_url().$this->router->class."/edit_episode/".$arr["id"]."/".$err);
							}else{
								 $this->session->set_flashdata("errormsg","Upload valid images. Only PNG are allowed.");		 
								redirect(base_url().$this->router->class."/add_episode/".$err);
							}
						}else{

							$ext          = end(explode(".", $file_name));
							$_image  	  = 'bhps_'.uniqid().'_'.time().".".$ext;
							$image_name   = $_image;
							$arr["image"] = $image_name;
							 $path 		  = "../pics/episode/" . $image_name;
							mkdir(dirname($path), 0777, true);
							copy($_FILES['image']['tmp_name'][$key], $path);

						}

		    			array_push($imgArr, $image_name);
					}
					$arr["image"] = implode(",",$imgArr);

			}
			if ($audio != "") {

					$allowed_audio_extension = array("mp3","MP3","mp4","MP4","m4a","M4A");
					$audioArr =[];
					foreach($_FILES["audio"]["tmp_name"] as $key=>$tmp_name) {

						$file_name=$_FILES["audio"]["name"][$key];
						$file_tmp=$_FILES["audio"]["tmp_name"][$key];
		    			$file_extension=pathinfo($file_name, PATHINFO_EXTENSION);


		    			if (! in_array($file_extension, $allowed_audio_extension)){
							if(!empty($arr["id"])){
								 $this->session->set_flashdata("errormsg","Upload valid extension. Only Mp3,M4a are allowed.");		 
								redirect(base_url().$this->router->class."/edit_episode/".$arr["id"]."/".$err);
							}else{
								 $this->session->set_flashdata("errormsg","Upload valid extension. Only Mp3, M4a are allowed.");		 
								redirect(base_url().$this->router->class."/add_episode/".$err);
							}
						}else{

							$ext          = end(explode(".", $file_name));
							$audio  	  = 'bhps_'.uniqid().'_'.time().".".$ext;
							$audio_name   = $audio;
							//$arr["audio"] = $audio_name;
							$path 		  = "../pics/episode/" . $audio_name;
							copy($_FILES['audio']['tmp_name'][$key], $path);

						}

		    			array_push($audioArr, $audio_name);
					}
					$arr["audio"] = implode(",",$audioArr);
			}

			if ($video != "") {

					$allowed_video_extension = array("mp4","MP4","M4A","m4a");
					$videoArr =[];
					foreach($_FILES["video"]["tmp_name"] as $key=>$tmp_name) {

						$file_name=$_FILES["video"]["name"][$key];
						$file_tmp=$_FILES["video"]["tmp_name"][$key];
		    			$file_extension=pathinfo($file_name, PATHINFO_EXTENSION);


		    			if (! in_array($file_extension, $allowed_video_extension)){
							if(!empty($arr["id"])){
								 $this->session->set_flashdata("errormsg","Upload valid extension. Only MP4 are allowed.");		 
								redirect(base_url().$this->router->class."/edit_episode/".$arr["id"]."/".$err);
							}else{
								 $this->session->set_flashdata("errormsg","Upload valid extension. Only MP4 are allowed.");		 
								redirect(base_url().$this->router->class."/add_episode/".$err);
							}
						}else{

							$ext          = end(explode(".", $file_name));
							$video  	  = 'bhps_'.uniqid().'_'.time().".".$ext;
							$video_name   = $video;
							//$arr["video"] = $video_name;
							$path 		  = "../pics/episode/" . $video_name;
							copy($_FILES['video']['tmp_name'][$key], $path);

						}

		    			array_push($videoArr, $video_name);
					}
					$arr["video"] = implode(",",$videoArr);
			}

			//print_r($arr); die;
		$this->session->set_flashdata("tempdata",strip_slashes($arr));
		 
 		if($this->episode_model->add_edit_episode($arr)){ 
				$last_id = $this->db->insert_id(); 
				$err=0;
			  if($arr["id"] == ""){
			  	 $this->pushNotification($last_id, $arr["title"]);
				  $this->session->set_flashdata("successmsg","Episode created successfully");		 
				  redirect(base_url().$this->router->class."/add_episode/".$err);
			  }
			  else{ 
				  $this->session->set_flashdata("successmsg","Episode updated successfully");
				  redirect(base_url().$this->router->class."/edit_episode/".$arr["id"]."/".$err);
			  }

	 	  }
		  else{
			  $this->session->set_flashdata("errormsg","There is error adding category to data base . Please contact database admin");
			  $err=1;
		  }
	}

	public function pushNotification($last_id,$title){ 

			$user = $this->user_model->getAllUser();  

			foreach ($user as $key => $value) { 

				$badge_count       = ($value["badgecount"]+1);
				$krru['badgecount'] = $badge_count;
				$krru['id']         = $value['id']; 
				$this->user_model->update_profile_data($krru);

				$noti_message         =  ucwords($title).' new episode added ';  
				$krr1['sender']       = 0;
				$krr1['receiver']     = $value['id'];
				$krr1['other_id']     = $last_id;
				$krr1['type'] 		  = "new_episode" ;
				$krr1['body']         = $noti_message;
				$notifi_id            = $this->user_model->add_notifications($krr1);   	
				

				$notification_Arr = array(
					'sender'       => 0,
					'receiver'     => $value['id'],
					'other_id'     => $last_id,
					'id'           => $last_id,
					'seen'         => 0,
					'notification' => "New episode added",
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


	public function enable_disable_episode(){
		$id=$this->uri->segment(3);
		$status=$this->uri->segment(4);
		if($status==0){
			$show_status="deactivated";	
		}	
		else{
			$show_status="activated";	
		}
		
		$this->episode_model->enable_disable_episode($id,$status);
		$this->session->set_flashdata("successmsg","Episode ".$show_status." successfully");	
		redirect(base_url()."episode/manage_episode");
	}
	
	public function archive_episode(){
		$id = $this->uri->segment(3);
		if($id!=''){	
			$this->episode_model->deleteEpisode($id);
			$this->session->set_flashdata("successmsg","Category  archived successfully");	
			redirect(base_url()."episode/manage_episode");
		}
		else{
			redirect(base_url()."invalidpage");
		}	
	}
	
	public function view_episode(){		
		$id = $this->uri->segment(3);
		if($id==""){
			redirect(base_url()."invalidpage");				
		}
		else{
			$data["resultset"]=$this->episode_model->getIndividualEpisode($id);	
		}
		$data["item"]         = "episode";
		$data["master_title"] = "View episode";   // Please enter the title of page......
		$data["master_body"]  = "view_episode";    
		$this->load->theme('mainlayout',$data);  // Loading theme
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
            'notification' => (object)array('title' => $title, 'body' => $message),
            //'notification' => array('title' => $title, 'body' => $message, 'type' => $notification_Arr['type'], "badge" => $badgecount,  "sound" => 'default','click_action'=> "new_episode"),
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