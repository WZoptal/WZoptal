<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
   class Api extends CI_Controller {
 	public function __construct(){
  		parent::__construct();
  		$this->load->model('user_model');
    	$this->load->helper('url');	
    }

	public function index(){
		$this->view();
 	}

 	public function view(){
		$data["master_title"] = "Test Page | ".$this->config->item('sitename');
		$data["master_body"]  = "home";
		$this->load->theme('home_layout',$data);
  	}
	
    // androidNotification
    public function fcmNotification_post(){
         $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
		 $firebase_registration_id = 'fHFzeq_y9gQ:APA91bE-340dz_Z7s_9BCdWBRriiSCFvLj8VsB15vyABSApvzKz33d8-ctr5SY0rlc3_6-EJ9irkv2hZnnfbdjktYkTphlXpLrJN_oPGwqROUDUJ9vIUYrww_GYEW_AxVxYItfF1fbsBbtkD4X5asGpQ7TB8w8FfxA';
 
		$fields = array(
            'to' => $firebase_registration_id,
            'notification' => array('title' => "test notifications", 'body' => 'You receive a new message', 'type'  => 'test notifications',),
            'data' => array('message' => 'You receive a new message', 'type'  => 'test notifications', 'sender_id'   => 1, 'receiver_id' => 7, 'other_id' => 3)
        );
 
        $headers = array(
            'Authorization:key=AAAAHGFAymM:APA91bGCsh06oqbAFdHL-zqXCzn5NfeMhBEbPuRcLkfRiOzeMcLqsRhdt6XDJUVo2vp7vg7Z1WP0QeyWXjuVprSL9USTcVL3AkBP07GEqQDDrPG2u86d9-wlXqsGqNbJ7iqKOkKWQ5ai',
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
		 echo '<pre>'; print_r($result); die;
		curl_close($ch);// die;
     }
	
	// androidNotification
    public function fcmNotification($message, $notification_Arr, $title, $firebase_registration_id=false, $badgecount){   
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
		 
		
		$fields = array(
			'content_available' => true,
            'to' => $fcmDeviceId,
            'notification' => array('title' => $title, 'body' => $message, 'type' => $notification_Arr['notification'], "badge" => $badgecount,  "sound" => 'default',),
            'data' => array('message' => $message, 'type' => $notification_Arr['notification'], 'sender_id' => $notification_Arr['sender'], 'receiver_id' => $notification_Arr['receiver'], 'other_id' => $other_id, 'badgecount' => $badgecount)
        );
 
        $headers = array('Authorization:key=AAAAHGFAymM:APA91bGCsh06oqbAFdHL-zqXCzn5NfeMhBEbPuRcLkfRiOzeMcLqsRhdt6XDJUVo2vp7vg7Z1WP0QeyWXjuVprSL9USTcVL3AkBP07GEqQDDrPG2u86d9-wlXqsGqNbJ7iqKOkKWQ5ai',
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
		// echo '<pre>'; print_r($result);// die;
		curl_close($ch); // die;
     }
     public function strposa($haystack, $needle, $offset=0) { 
		    if(!is_array($needle)) $needle = array($needle);
		    foreach($needle as $query) {
		        if(stripos($haystack, $query, $offset) !== false) return true; // stop on first true result
		    }
		    return false;
		}
	
	   
	public function signup(){  
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
			if($name == "") array_push($errors, "Name"); 
	 		if($email == "") array_push($errors, "Email"); 
  	 		if($phone == "") array_push($errors, "Phone"); 
  	 		if($country == "") array_push($errors, "country"); 
  	 		//if($pincode == "") array_push($errors, "pincode"); 
	 		if($password == "") array_push($errors, "Password");
	 		if($user_type == "") array_push($errors, "User Type");
         		 
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			} 
 			else if($this->common->validate_email($email) === false){
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Please provide valid email address";
			} 
			else if($this->common->email_exist($email, '')){ 
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Email already exist";
			} 
			else if($this->common->phone_exist($phone, '')){  
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Phone number already exist";
			} 
			else if($this->common->username_exist($username, '')){ 
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Username already exist";
			} 
  			else{

  				$array  = array('.test');
				
				if($this->strposa($email, $array) === true){
					$dvar['result']  = false;
					$dvar['code']    = "201";
	 				$dvar['message'] = "Please don't create test account.Enter valid email address.";
				}else{

	  				$profile_pic = $_FILES['profile_pic']['name'];
					if($profile_pic != ""){
						$ext          		 = end(explode(".", $profile_pic));
						$profile_pic  	 	 = uniqid().'_'.time().".".$ext;
						$image_name   		 = $profile_pic;
						$arr["profile_pic"]  = $image_name;
						$path                = "./pics/profile_pics/" . $image_name;
						copy($_FILES['profile_pic']['tmp_name'], $path);
					}				
					$arr["username"]     = $username;
					$arr["name"]     	 = $name;
					$arr["email"]        = $email;
	 				$arr["password"]     = $password;
					$arr["admin_access"] = $password;
					$arr["phone"]        = $phone;
					$arr["user_type"]    = $user_type;
					$arr["country"]      = $country;
					$arr["password"]     = $this->common->salt_password($arr);
					$arr["access_token"] = md5(time());  
	 				if($this->user_model->add_user($arr)){
	 					$user_id  = $this->db->insert_id(); 
	 					$mailto  = $arr["email"];
						$subject = $this->config->item('sitename')." account verification";
						$from_mail = 'support@zoptal.in';
						$message1 = "<p> Dear ".$arr["name"]." </p>
						<p>Welcome to ".$this->config->item('sitename')."</p>
						<p>An account has just created for ".$mailto." </p>
						<p>To verify your account, click here: </p>
						<p><a href=".base_url()."verify_email/?token=".$user_id.">".base_url()."verify_email/?token=".urlencode($user_id)."</a></p> <br /> <br />
						<p> Thank you,</p> <br />
						<p>The ".$this->config->item('sitename')." Team</p>";

						// require_once('phpmailer-master/class.phpmailer.php');
						// $emailid = new PHPMailer();
						// $emailid->From      = $from_mail;
						// $emailid->FromName  = $this->config->item('sitename');
						// $emailid->IsHTML(true); 
						// $emailid->Subject   = $subject;
						// $emailid->Body      = $message1;
						// $emailid->AddAddress($mailto);
						// //$emailid->AddAttachment($file, $pdfFileName);
						// if($emailid->Send()){
						// 	//echo "sent"; die;
						// } 
						// else {     
						//  // echo $this->email->print_debugger();
						//  //  echo "not sent"; die;
						// }	
						$res = $this->send_email_sendgrid($mailto, $message1, $subject);	

						$profile_pic = "";
						if(!empty($arr['profile_pic'])){
							$profile_pic = base_url()."pics/profile_pics/".$arr['profile_pic'];
						}
						
						$data["user_id"] 	  = (string)$user_id;
						$data["access_token"] = $arr['access_token'];
						$data["email"] 	      = $arr['email'];
						$data["user_type"]    = (string)$arr["user_type"];
						$data["phone"]        = (string)$arr["phone"];
	 					$data["profile_pic"]  = $profile_pic;
	 					$data["register_date"]= (string)time();

						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "An verification email has been sent to your email. Please check you inbox.";
						$dvar['data']    = $data;
					} 
					else{
						$dvar['result']  = false;
						$dvar['code']    = "201";
						$dvar['message'] = "Something went wrong please try again!";
					}
				}
				
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	} 
	public function send_email_sendgrid($email_to, $message, $subject){
		require 'sendgrid/vendor/autoload.php'; 
		$email = new \SendGrid\Mail\Mail(); 
		$email->setFrom("bhpsapp.info@gmail.com", "BHPS"); 
 		$email->setSubject($subject);
 		$email->addTo($email_to, $subject);
 		$email->addContent("text/html", $message);
		$sendgrid = new \SendGrid(SENDGRID_KEY);
		try {
			$response = $sendgrid->send($email);		 
			return true;
		//	echo "<p style='color:#090'>Email sent successfully.</p>";
		 //	print $response->statusCode() . "\n";
		 //	print_r($response->headers());
		 //	print $response->body() . "\n";
		} catch (Exception $e) {
			return false;
			//echo "<p style='color:#900'>Something went erong please try after sometime.</p>";
			//echo 'Caught exception: '. $e->getMessage() ."\n";
		}
	}

	public function register_validations(){
 		if($_POST){
 			extract($_POST);
			$errors = array(); 		 	 		 
			if($email == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide your email.";
			}  
 			else if($this->common->validate_email($email) === false){
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Please provide valid email address";
			} 
			else if($this->common->email_exist($email, '')){
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Email already exist";
			} 
			else if($username == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide username.";
			} 
			else if($this->common->username_exist($username, '')){
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Username already exist";
			} 
			else if($phone == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide phone number.";
			} 
			else if($this->common->phone_exist($phone, '') && ($phone != '')){
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Phone number already exist";
			} 
  			else { 				 
 				$dvar['result']  = true;
				$dvar['code']    = "200";
 				$dvar['message'] = "Success";					
			}				 
			 
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	} 
	   
	public function login(){  
		if($_POST){
			extract($_POST);
			$errors = array();
	 		if($email == "") array_push($errors, "Email/Username");  
	 		if($password == "") array_push($errors, "Password");
			//if($location == "") array_push($errors, "Location");
			// if($latitude == "") array_push($errors, "Latitude");
			// if($longitude == "") array_push($errors, "Longitude");
			// if($longitude == "") array_push($errors, "Longitude");
 	 		if($app_version == "") array_push($errors, "App version");
	 		if($device_token == "") array_push($errors, "Device Token");

			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			} 
 			/*else if($this->common->validate_email($email) === false){
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Please provide valid email address";
			}*/ 
			else {
				$arr['email']  = $email;
				$arr['password']  = $password;				
 				$response = $this->user_model->ulogin($arr);
		 		if($response == "inactive"){
		 			$dvar['result']  = false;
					$dvar['code']    = "201";
 					$dvar['message'] = "First activate your account and then try again.";
		 		} elseif($response == "block") {
		 			$dvar['result']  = false;
					$dvar['code']    = "201";
 					$dvar['message'] = "Your account has been blocked, please contact with admin";
		 		} elseif($response == "wrong_pass") {
		 			$dvar['result']  = false;
					$dvar['code']    = "201";
 					$dvar['message'] = "The password you entered is incorrect. Please try again or use forgot password.";
		 		} elseif($response == "wrong_user") {
		 			$dvar['result']  = false;
					$dvar['code']    = "201";
 					$dvar['message'] = "Sorry, We can't find an account with this email address. Please try again or create a new account.."; 
		 		} 
				else {
		 			$user_id              = $response;
		 			$udat['id']           = $user_id;
		 			//$udat["location"]     = $location;
		 			$udat["latitude"]     = $latitude;
		 			$udat["longitude"]    = $longitude;
		 			$udat["device_type"]  = $device_type;
					$udat["device_token"] = $device_token;
					$udat["app_version"] = $app_version;
					$udat["last_login"]     = time();
		 			$userData             = $this->user_model->get_user_data($user_id);
					/*if(!empty($userData["access_token"])){
						$udat["device_token"] = $userData['device_token'].",".$udat["device_token"];
						$udat["device_type"] = $userData['device_type'].",".$udat["device_type"];
					} 
					else {*/
						$udat['access_token'] = md5($email.uniqid().time());
					//}
 		 			
 		 			$this->user_model->update_profile_data($udat);

		 			$userData    = $this->user_model->get_user_data($user_id);
 		 			$profile_pic = "";
					if(!empty($userData['profile_pic'])){
						$profile_pic = base_url()."pics/profile_pics/".$userData['profile_pic'];
					}
					
  		 			
					$data["user_id"]       = (string)$userData["id"];
 		 			$data["access_token"]  = $userData["access_token"];
					$data["email"] 	       = $userData['email'];
 					//$data["username"]      = $userData["username"];				
					$data["user_type"]     = (string)$userData["user_type"];
					$data["phone"]         = (string)$userData["phone"];
					$data["planId"]      = $userData["planId"];
					$data["plan_status"]      = $userData["plan_status"];
					$data["latitude"]      = $userData["latitude"];
					$data["longitude"]     = $userData["longitude"];
					$data["app_version"]     = $userData["app_version"];
					//$data["zip_code"]      = (string)$userData["zip_code"];
					//$data["description"]   = $userData["description"] ? $userData["description"] : "";
					//$data["tags"]          = $userData["tags"] ? $userData["tags"] : "";					
					$data["register_date"] = $userData["posted"];
					
					
      			//	$data['gender']          = !empty($userData['gender']) ? $userData['gender'] : "";
    			//	$data['fb_id']           = !empty($userData['fb_id']) ? $userData['fb_id'] : "";
				//	$data["verified"]        = (string)$userData["verified"];

 					$dvar['result']  = true;
					$dvar['code']    = "200";
 					$dvar['message'] = "You have logged in successfully";
					$dvar['data']    = $data;
		 		}
			}
	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	} 
	
	public function profile_data(){
		if($_POST){
				extract($_POST);
				if($access_token == ""){
					$dvar['result']  = false;
					$dvar['code']    = "201";
					$dvar['message'] = "Access token should not be empty.";
				} else {
					$userData = $this->user_model->getUserDataByAccessToken($access_token);
		 			if(!empty($userData)){
						
						$profile_pic = "";
						if(!empty($userData['profile_pic'])){
							$profile_pic = base_url()."pics/profile_pics/".$userData['profile_pic'];
						}
						
							
	   					$data["user_id"]       = (string)$userData["id"];
	 		 			$data["access_token"]  = $userData["access_token"];
	 					$data["email"] 	       = $userData['email'];
	 					$data["username"]      = $userData["username"];				
						$data["user_type"]     = (string)$userData["user_type"];
						$data["phone"]         = (string)$userData["phone"];
						$data["planId"]      = $userData["planId"];
						$data["plan_status"]      = $userData["plan_status"];
						$data["location"]      = $userData["location"];
						$data["latitude"]      = $userData["latitude"];
						$data["longitude"]     = $userData["longitude"];
						$data["app_version"]     = $userData["app_version"];
						$data["register_date"] = $userData["posted"];
						$data["profile_pic"]   = $profile_pic;

	  					$dvar['result']  = true;
	 					$dvar['code']    = "200";
						$dvar['message'] = "Profile data loaded successfully.";
						$dvar['data']    = $data;
	 	 			} 
					else {
		 				$dvar['result']  = false;
						$dvar['code']    = "202";
						$dvar['message'] = "Wrong access token"; 
		 			}				
				}	 		
			} else {
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Data empty!";
			}
		echo json_encode($dvar); die;
	}
	
	public function update_profile(){
 		if($_POST){
	 		$access_token       = $this->input->post("access_token");
 	 		$arr["phone"]       = $this->input->post("phone");
 	 		$arr["location"]    = $this->input->post("location");
 	 		$arr["latitude"]    = $this->input->post("latitude");
 	 		$arr["longitude"]   = $this->input->post("longitude");
 	 		$arr["description"] = $this->input->post("description");
 	 		$arr["device_type"] = $this->input->post("device_type");
 	 		$arr["device_token"]= $this->input->post("device_token");
 	 		$arr["tags"]        = $this->input->post("tags");
 	 		$arr["facebook_link"]= $this->input->post("facebook_link");
 	 		$arr["twitter_link"]= $this->input->post("twitter_link");
 	 		$arr["pinterest_link"]= $this->input->post("pinterest_link");
 	 		$arr["instagram_link"]= $this->input->post("instagram_link");
  			$userData           = $this->user_model->getUserDataByAccessToken($access_token);
	 		if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			}
			else if(empty($userData)){
				$dvar['result']  = false;
				$dvar['code']    = "202";
				$dvar['message'] = "Wrong access token"; 
			}  
			else if($arr["phone"] == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide phone number.";
			}   
			else if($arr["location"] == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide location.";
			} 
			else if($arr["latitude"] == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide latitude.";
			}   
			else if($arr["longitude"] == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide longitude.";
			}
			else if($arr["description"] == "" && $userData["user_type"] == 2){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide description.";
			}   
			else if($arr["tags"] == "" && $userData["user_type"] == 2){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide tags.";
			}   			 
 			else if($this->common->phone_exist($phone, $userData['id'])){
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Phone number already exist";
			} 
   			else{
				if(!empty($device_token)){
					$fcm_update=updateFcmToken($userData['id'],$device_type,$device_token);
				}
  				$user_id     = $userData['id'];
				$profile_pic = $_FILES['profile_pic']['name'];
 				if($profile_pic != ""){
					$ext          		 = end(explode(".", $profile_pic));
					$profile_pic  	 	 = $userData['id'].'_'.uniqid().'_'.time().".".$ext;
					$image_name   		 = $profile_pic;
					$arr["profile_pic"]  = $image_name;
					$path                = "./pics/profile_pics/" . $image_name;
					copy($_FILES['profile_pic']['tmp_name'], $path);
				}
				
 				$arr["id"]   = $user_id;
				$res = $this->user_model->update_profile_data($arr);
				if($res){
					$userData    = $this->user_model->get_user_data($user_id);
					$profile_pic = "";
					if(!empty($userData['profile_pic'])){
						$profile_pic = base_url()."pics/profile_pics/".$userData['profile_pic'];
					}
 					
					$data["user_id"]       = (string)$userData["id"];
 		 			$data["access_token"]  = $userData["access_token"];
 					$data["email"] 	       = $userData['email'];
 					$data["username"]      = $userData["username"];				
					$data["user_type"]     = (string)$userData["user_type"];
					$data["phone"]         = (string)$userData["phone"];
					$data["location"]      = $userData["location"];
					$data["latitude"]      = $userData["latitude"];
					$data["longitude"]     = $userData["longitude"];
					$data["zip_code"]      = (string)$userData["zip_code"];
					$data["description"]   = $userData["description"] ? $userData["description"] : "";
					$data["tags"]          = $userData["tags"] ? $userData["tags"] : "";					
 					$data["profile_pic"]   = $profile_pic;
 					$data["facebook_link"] = $userData["facebook_link"] ? $userData["facebook_link"] : "";
					$data["twitter_link"]  = $userData["twitter_link"] ? $userData["twitter_link"] : "";
					$data["pinterest_link"]= $userData["pinterest_link"] ? $userData["pinterest_link"] : "";
					$data["instagram_link"]= $userData["instagram_link"] ? $userData["instagram_link"] : "";
					$data["register_date"] = $userData["posted"];

					$dvar['result']      = true;
					$dvar['code']        = "200";
					$dvar['message']     = "Profile updated successfully.";
					$dvar['data']        = $data;
				}
				else{
					$dvar['result']  = false;
					$dvar['code']    = "201";
					$dvar['message'] = "No data found";
					$dvar['data']    = array();
				}
 	 		}
		} 
		else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}
	

	public function logout(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
	 			$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide access token.";
	 		} else {
	 			$userData = $this->user_model->getUserDataByAccessToken($access_token);
	 			if(!empty($userData)){
	 				$this->user_model->userLogout($userData['id']);
	 				$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "Logout successfully";
	 			} else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token";
	 			}
	 		}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}

	public function change_password(){
		if($_POST){
			extract($_POST);
	 		if($access_token == ""){
	 			$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide access token.";
	 		} else if($old_password == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide old password.";
			} else if($password == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please set your new password.";
			}  
			else {
				$userData = $this->user_model->getUserDataByAccessToken($access_token);
	 			if(!empty($userData)){
	 				$arr['user_id']      = $userData['id'];
	 				$arr['old_password'] = $old_password;
	 				$arr['password']     = $password;
	 				$arr['password']     = $this->common->salt_password($arr);
					if($this->user_model->changePassword($arr)){
						$udat['admin_access'] = $password;
						$udat['id']           = $userData['id'];
						$this->user_model->update_profile_data($udat);
						
			 			$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Password changed successfully.";
			 		} else {
			 			$dvar['result']  = false;
						$dvar['code']    = "201";

						$dvar['message'] = "Invalid old password.";						
			 		}
			 	} else {
			 		$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token";
			 	}
			}
 		} 
		else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	} 

	public function forgot_password(){
		if($_POST){
			extract($_POST);
	 		if($email == ""){
	 			$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Please provide email.";
	 		} else {
	 			$userData = $this->user_model->get_user_data_by_email($email);
				if(!empty($userData)){
	 				$arr['id'] = $userData['id'];
  	 				$subject   = "New Login Password --> ".$this->config->item('sitename');
					$message   = "<p>Dear ".$userData['name']."</p>";
					$message  .= "<p>As per your forgot password request, Your Login information as below: </p>";
					$message  .= "<p>Username: ".$userData['username']."</p>";
					$message  .= "<p>Password: ".$userData['admin_access']."</p>";
					$message  .= "<p>Thanks, </p>";
					$message  .= "<p>".$this->config->item('sitename')."</p>";
 					$headers   = "MIME-Version: 1.0" . "\r\n";
					$headers  .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
					$headers  .= 'From: '.$this->config->item('sitename').'<support@ideabuyerdev.com>'. "\r\n";
					$send      = mail($email,$subject,$message,$headers);
					if($send){
 			 			$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "New password has been sent to your email.";
			 		} 
					else{
			 			$dvar['result']  = false;
						$dvar['code']    = "201";
						$dvar['message'] = "Something wrong, please try again.";						
			 		}
			 	} else {
			 		$dvar['result']  = false;
					$dvar['code']    = "201";
					$dvar['message'] = "Invalid email.";
			 	}
			}
	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
	   
	public function save_profile_settings(){
		$access_token             = trim($this->input->post("access_token"));
		$arr["notification"]      = trim($this->input->post("notification"));
		$arr["show_check_in"]     = trim($this->input->post("show_check_in"));
		$arr["show_ratings"]      = trim($this->input->post("show_ratings"));
		$arr["show_saved_item"]   = trim($this->input->post("show_saved_item"));
		$arr["show_email"]        = trim($this->input->post("show_email"));
		$arr["show_social_links"] = trim($this->input->post("show_social_links"));
		$arr["profile_private"]      = trim($this->input->post("profile_private"));
 		$userData             = $this->user_model->getUserDataByAccessToken($access_token);
		if($access_token == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Access token should not be empty.";
		}
		else if(empty($userData)){
			$dvar['result']  = false;
			$dvar['code']    = "202";
			$dvar['message'] = "Wrong access token"; 
		}  
		else if($arr["notification"] == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide notifications.";
		}
		else if($arr["show_check_in"] == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide show check in.";
		}
		else if($arr["show_ratings"] == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide show ratings.";
		}
		else if($arr["show_saved_item"] == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide show saved item.";
		}
		else if($arr["show_email"] == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide show email.";
		}
		else if($arr["show_social_links"] == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide show social links.";
		}
		else if($arr["profile_private"] == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide profile private.";
		}
 		else{
			if(!empty($device_token)){
				$fcm_update=updateFcmToken($userData['id'],$device_type,$device_token);
			}
			$arr["id"] = $userData['id'];
			$res = $this->user_model->update_profile_data($arr);
			if($res){
				$dvar['result']  = true;
				$dvar['code']    = "200";
				$dvar['message'] = "Profile setting saved successfully.";
			//	$dvar['data']    = $arr;
				
			}
			else{
				$dvar['result']  = false;
				$dvar['code']    = "201";
  				$dvar['message'] = "Something went wrong please try again.";
			}
		}
 		echo json_encode($dvar); die;
 	}
	
	public function get_profile_settings(){
		$access_token = trim($this->input->post("access_token"));
  		$userData     = $this->user_model->getUserDataByAccessToken($access_token);
		if($access_token == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Access token should not be empty.";
		}
		else if(empty($userData)){
			$dvar['result']  = false;
			$dvar['code']    = "202";
			$dvar['message'] = "Wrong access token"; 
		}  
 		else{
			if(!empty($device_token)){
				$fcm_update=updateFcmToken($userData['id'],$device_type,$device_token);
			}
			$arr['setting']["notification"]      = (integer)$userData['notification'];
			$arr['setting']["show_check_in"]     = (integer)$userData['show_check_in'];
			$arr['setting']["show_ratings"]      = (integer)$userData['show_ratings'];
			$arr['setting']["show_saved_item"]   = (integer)$userData['show_saved_item'];
			$arr['setting']["show_email"]        = (integer)$userData['show_email'];
			$arr['setting']["show_social_links"] = (integer)$userData['show_social_links'];
			$arr['setting']["profile_private"]   = (integer)$userData['profile_private'];
			
			$dvar['result']  = true;
			$dvar['code']    = "200";
			$dvar['message'] = "Profile settings loaded successfully.";
			$dvar['data']    = $arr;
 		}
 		echo json_encode($dvar); die;
 	}
	
	public function update_fcm_token(){
		$access_token = $this->input->post("access_token");
		$device_type  = $this->input->post("device_type");
		$device_token = $this->input->post("device_token");
		$userData     = $this->user_model->getUserDataByAccessToken($access_token);
		if($access_token == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Access token should not be empty.";
		} 
		else if(empty($userData)){
			$dvar['result']  = false;
			$dvar['code']    = "202";
			$dvar['message'] = "Wrong access token"; 
		} 
		else if($device_type == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide device type.";
		} 
		else if($device_token == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide device token.";
		} 
		else{
			$arr["id"]            = $userData['id'];
			$arr["device_type"]   = $device_type;
			$arr["device_token"]  = $device_token;
			
			$res = $this->user_model->update_profile_data($arr);
			if($res){
				$dvar['result']      = true;
				$dvar['code']        = "200";
				$dvar['message']     = "FCM token updated successfully.";
			}
			else{
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Something went wrong, please try later";
			}
				 
		}
 		echo json_encode($dvar); die;
 	}   
	public function updateFcmToken($id,$device_type,$device_token){
			$arr["id"]            = $id;
			$arr["device_type"]   = $device_type;
			$arr["device_token"]  = $device_token;
			
			$res = $this->user_model->update_profile_data($arr);
			if($res){
				$dvar['result']	 = true;
				$dvar['code']	 = "200";
				$dvar['message'] = "FCM token updated successfully.";
			}
			else{
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Something went wrong, please try later";
			}	 
 		echo json_encode($dvar); die;
 	} 
	public function add_social_links(){
		$access_token          = trim($this->input->post('access_token'));
		$arr['facebook_link']  = trim($this->input->post('facebook_link'));  
		$arr['twitter_link']   = trim($this->input->post('twitter_link'));  
		$arr['pinterest_link'] = trim($this->input->post('pinterest_link'));  
		$arr['instagram_link'] = trim($this->input->post('instagram_link'));  
		$userData              = $this->user_model->getUserDataByAccessToken($access_token);
		if($access_token == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide token.";
		} 
 		else if(empty($userData)){
			$dvar['result']  = false;
			$dvar['code']    = "202";
			$dvar['message'] = "Wrong access token";
		}
		else{
			if(!empty($device_token)){
				$fcm_update=updateFcmToken($userData['id'],$device_type,$device_token);
			}
			if($arr['facebook_link'] == ""){
				unset($arr['facebook_link']);
			}
			if($arr['twitter_link'] == ""){
				unset($arr['twitter_link']);
			}
			if($arr['pinterest_link'] == ""){
				unset($arr['pinterest_link']);
			}
			if($arr['instagram_link'] == ""){
				unset($arr['instagram_link']);
			}
			$arr["id"]   = $userData['id'];
			$arr["time"] = time();
			$res         = $this->user_model->update_profile_data($arr);
			if($res){
  				$dvar['result']  = true;
				$dvar['code']    = "200";
				$dvar['message'] = "Social links updated successfully.";
			}
			else{
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Something went wrong please try again.";
			}
 		}
		echo json_encode($dvar); die;
	}
	
	public function delete_social_links(){
		$access_token   = trim($this->input->post('access_token'));
		$facebook_link  = trim($this->input->post('facebook_link'));  
		$twitter_link   = trim($this->input->post('twitter_link'));  
		$pinterest_link = trim($this->input->post('pinterest_link'));  
		$instagram_link = trim($this->input->post('instagram_link'));  
		$userData       = $this->user_model->getUserDataByAccessToken($access_token);
		if($access_token == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide token.";
		} 
 		else if(empty($userData)){
			$dvar['result']  = false;
			$dvar['code']    = "202";
			$dvar['message'] = "Wrong access token";
		}
		else{
			if(!empty($device_token)){
			 $fcm_update=updateFcmToken($userData['id'],$device_type,$device_token);
			}
			if($facebook_link == 1){
				$arr['facebook_link'] = "";
				$social = "Facebook";
			}
			 
			if($twitter_link == 1){
				$arr['twitter_link'] = "";
				$social = "Twitter";
			}
			if($pinterest_link == 1){
				$arr['pinterest_link'] = "";
				$social = "Pinterest";
			}
			if($instagram_link == 1){
				$arr['instagram_link'] = "";
				$social = "Instagram";
			}
			$arr["id"]   = $userData['id'];
			$arr["time"] = time();
			$res         = $this->user_model->update_profile_data($arr);
			if($res){
  				$dvar['result']  = true;
				$dvar['code']    = "200";
				$dvar['message'] = $social." link removed successfully.";
			}
			else{
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Something went wrong please try again.";
			}
 		}
		echo json_encode($dvar); die;
	}
    public function check_username(){  
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
 	 		if($username == "") array_push($errors, "Username"); 
 	 		if($email == "") array_push($errors, "Email"); 
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			}if($this->common->email_exist($email, '')){ 
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Email already exist";
			} 
			else  if($this->common->username_exist($username, '')){ 
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "Username already exist";
			} 
  			else{
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "email and username is available";
				}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}
 	public function post_stream(){  
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
	 		if($access_token == "") array_push($errors, "Access Token"); 
	 		if($address == "") array_push($errors, "Address"); 
			if($latitude == "") array_push($errors, "Latitude");
			if($longitude == "") array_push($errors, "Longitude");
			if($comment == "") array_push($errors, "Comment");
			if($item_name == "") array_push($errors, "item_name");
			if($restaurant_name == "")  array_push($errors, "Restaurant Name");
			if($tags == "")  array_push($errors, "Tags");
			if($rating == "") array_push($errors, "Rating"); 
	 		if($saved_to_profile == "") array_push($errors, "Saved profile");  
	 		if($business_id == "") array_push($errors, "Business Id");  
			$userData = $this->user_model->getUserDataByAccessToken($access_token);
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			}if(empty($userData)){
				$dvar['result']  = false;
				$dvar['code']    = "202";
				$dvar['message'] = "Wrong access token";
			}
			else{
				if(!empty($device_token)){
					$fcm_update=updateFcmToken($userData['id'],$device_type,$device_token);
				}
				$image_name = $_FILES['image_name']['name'];
				if($image_name != ""){
					$ext          		 = end(explode(".", $image_name));
					$image_name  	 	 = uniqid().'_'.time().".".$ext;
					$image_name   		 = $image_name;
					$arr["image_name"]  = $image_name;
					$path                = "./pics/stream_imgs/".$image_name;
					copy($_FILES['image_name']['tmp_name'], $path);
				}				

				$arr["user_id"]     	= $userData['id'];
				$arr["business_id"]     = $business_id;
 				$arr["restaurant_name"] = $restaurant_name;
 				$arr["tags"]            = $tags;
 				$arr["item_name"]       = $item_name;
 				$arr["address"]         = $address;
 				$arr["latitude"]     	= $latitude;
				$arr["longitude"]    	= $longitude;
 				$arr["comment"]         = $comment;
 				$arr["average_rating"]  = $rating;
				$arr["saved_to_profile"]= $saved_to_profile;
				$res=$this->user_model->add_post_stream($arr);
				//echo $this->db->last_query(); die;
 				if(!empty($res)){
					if(!empty($arr["image_name"])){
						$imageName = base_url()."pics/stream_imgs/" . $image_name;
					}else{
						$imageName = "";	
					}
					$data["user_id"]     	 = $arr["user_id"];     	
					$data["item_image"]      = $imageName;         
					$data["item_name"]       = $arr["item_name"];         
					$data["restaurant_name"] = $arr["restaurant_name"];         
					$data["tags"]            = $arr["tags"];         
					$data["address"]         = $arr["address"];         
					$data["latitude"]     	 = $arr["latitude"];     	
					$data["longitude"]    	 = $arr["longitude"];    	
					$data["comment"]         = $arr["comment"];         
					$data["average_rating"]  = $arr["average_rating"];  
					$data["saved_to_profile"]= $arr["saved_to_profile"];
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "Stream posted successfully";
					$dvar['data']    = $data;
				} 
				else{
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "No data found";
					$dvar['data']    = array();
				}
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}   
	public function complete_user_details(){  
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
  	 		if($access_token == "") array_push($errors, "Access Token"); 
	 		if($username == "") array_push($errors, "Username");
	 		if($user_type == "") array_push($errors, "User Type");
			if($location == "") array_push($errors, "Location");
			if($latitude == "") array_push($errors, "Latitude");
			if($longitude == "") array_push($errors, "Longitude");
			if($zip_code == "") array_push($errors, "Zip Code");
			if($user_type == 2 && $description == "") array_push($errors, "Description"); //User=>1, Business  => 2
			if($user_type == 2 && $tags == "") array_push($errors, "Tags");
			$userData           = $this->user_model->getUserDataByAccessToken($access_token);
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			} 
 			elseif(empty($userData)){  
				$dvar['result']  = false;
				$dvar['code']    = "202";
 				$dvar['message'] = "Wrong access token";
			} 
			else{
  				$profile_pic = $_FILES['profile_pic']['name'];
				if($profile_pic != ""){
					$ext          		 = end(explode(".", $profile_pic));
					$profile_pic  	 	 = uniqid().'_'.time().".".$ext;
					$image_name   		 = $profile_pic;
					$arr["profile_pic"]  = $image_name;
					$path                = "./pics/profile_pics/" . $image_name;
					copy($_FILES['profile_pic']['tmp_name'], $path);
				}				
				$arr["id"]           = $userData['id'];
				$arr["username"]     = $username;
				$arr["location"]     = $location;
				$arr["latitude"]     = $latitude;
				$arr["zip_code"]     = $zip_code;
				$arr["longitude"]    = $longitude;
 				$arr["description"]  = $description;
 				$arr["tags"]         = $tags;
				$arr["user_type"]    = $user_type;
 				if($this->user_model->update_profile_data($arr)){
					$user_Data    = $this->user_model->get_user_data($arr["id"]);
 					$user_id  =$user_Data['id']; 
 					$mailto  = $user_Data["email"];
					
					$profile_pic = "";
					if(!empty($user_Data['profile_pic'])){
						$profile_pic = base_url()."pics/profile_pics/".$user_Data['profile_pic'];
					}
					
					$data["user_id"] 	  = (string)$user_id;
					$data["access_token"] = $user_Data['access_token'];
					$data["email"] 	      = $user_Data['email'];
 					$data["username"]     = $user_Data["username"];				
					$data["user_type"]    = (string)$user_Data["user_type"];
					$data["phone"]        = (string)$user_Data["phone"];
					$data["location"]     = $user_Data["location"];
					$data["latitude"]     = $user_Data["latitude"];
					$data["longitude"]    = $user_Data["longitude"];
					$data["zip_code"]     = (string)$user_Data["zip_code"];
					$data["description"]  = $user_Data["description"] ? $user_Data["description"] : "";
					$data["tags"]         = $user_Data["tags"] ? $user_Data["tags"] : "";
 					$data["profile_pic"]  = $profile_pic;
 					$data["register_date"]= (string)time();
 					$data["facebook_link"] = "";
					$data["twitter_link"]  = "";
					$data["pinterest_link"]= "";
					$data["instagram_link"]= "";

 					//$data['fb_id']        = !empty($arr['fb_id']) ? $arr['fb_id'] : "";

					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "details completed successfully";
					$dvar['data']    = $data;
				} 
				else{
					$dvar['result']  = false;
					$dvar['code']    = "201";
					$dvar['message'] = "No data found";
					$dvar['data']    = array();
				}
				
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}
 	public function post_description(){  
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
	 		if($access_token == "") array_push($errors, "Access Token"); 
	 		if($post_id == "") array_push($errors, "Post Id"); 
			$userData = $this->user_model->getUserDataByAccessToken($access_token);
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			} 
 			elseif(empty($userData)){
				$dvar['result']  = false;
				$dvar['code']    = "202";
				$dvar['message'] = "Wrong access token";
			}
			else{
				if(!empty($device_token)){
					$fcm_update=updateFcmToken($userData['id'],$device_type,$device_token);
				}
				$res=$this->user_model->getPostData($post_id);
 				if(!empty($res)){
						$i=0;
						$comments=$this->user_model->posts_commnets($post_id);
						if(!empty($comments)){
							foreach($comments AS $key=>$val){  
								$userdta=$this->user_model->user_profile_data($val["user_id"]);
								$profilepic = "";
								if(!empty($userdta['profile_pic'])){
									$profilepic = base_url()."pics/profile_pics/".$userdta['profile_pic'];
								}
								$data1[$i]["user_id"]     = $userdta["id"];
								$data1[$i]["username"]     = $userdta["username"];
								$data1[$i]["profile_pic"]  = $profilepic;
								$data1[$i]["email"]        = $userdta["email"];
								$data1[$i]["comment"]      = $val["comment"];
								$data1[$i]["comment_id"]   = $val["id"];
								$data1[$i]["comment_ago"]  = $this->common->convert_time_days($val["time"]);
								$i++;
							}  
						}
					if(!empty($res["image_name"])){
						$imageName = base_url()."pics/stream_imgs/" .$res["image_name"];
					}else{
							
					}
					$data["user_id"]     	 = $res["user_id"];
					$user_data=$this->user_model->user_profile_data($res["user_id"]);
					if(!empty($user_data)){
						$profile_pic = "";
						if(!empty($user_data['profile_pic'])){
							$profile_pic = base_url()."pics/profile_pics/".$user_data['profile_pic'];
						}
						$data["username"]     = $user_data["username"];
						$data["profile_pic"]  = $profile_pic;
						$data["email"]        = $user_data["email"];
						
					}else{
						$data["username"]     = "";
						$data["profile_pic"]  = "";
						$data["email"]        = "";						
					}
					$grr['user_id'] = $userData['id'];
					$grr['post_id'] = $res["id"];
					$allreadyLike = $this->user_model->allready_liked($grr);					
					$nuLike = $this->user_model->num_like($res["id"]);
					$numcmment = $this->user_model->num_commnet($res["id"]);
					$arr['user_id']  = $userData['id'];
					$arr['post_id'] = $res["id"];
					$exist = $this->user_model->post_alredy_saved($arr);
					$data["item_image"]      = $imageName;  
					$data["item_name"]       = $res["item_name"];         
					$data["restaurant_name"] = $res["restaurant_name"];
					$data["profile_saved"]   = $exist;   
					$data["tags"]            = $res["tags"];  
					$data["address"]         = $res["address"];         
					$data["latitude"]     	 = $res["latitude"];     	
					$data["longitude"]    	 = $res["longitude"];    	
					$data["comment"]         = $res["comment"];         
					$data["average_rating"]  = $res["average_rating"];  
					$data["saved_to_profile"]= $res["saved_to_profile"];
					$data["total_like"]      = $nuLike;
					$data["total_commnnt"]   = $numcmment;
					$data["like_status"]     = $allreadyLike ;
					$data["commnnt_data"]    = $data1;
					$data["created_ago"]     = $this->common->convert_time_days($res["time"]);
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "Stream posted successfully";
					$dvar['data']    = $data;
				} 
				else{
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "No data found";
					$dvar['data']    = array();
				}
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}   
 	public function delete_post(){  
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
	 		if($access_token == "") array_push($errors, "Access Token"); 
	 		if($post_id == "") array_push($errors, "Post Id"); 
			$userData = $this->user_model->getUserDataByAccessToken($access_token);
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			}elseif(empty($userData)){
				$dvar['result']  = false;
				$dvar['code']    = "202";
				$dvar['message'] = "Wrong access token";
			}
			else{
				if(!empty($device_token)){
					$fcm_update=updateFcmToken($userData['id'],$device_type,$device_token);
				}
				$res=$this->user_model->deletePost($post_id);
 				if($res){
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "Post deleted successfully";
				} 
				else{
					$dvar['result']  = false;
					$dvar['code']    = "201";
					$dvar['message'] = "Post deleted failed!";
				}
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}    
	public function home_list(){  
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
	 		if($access_token == "") array_push($errors, "Access Token"); 
	 		if($userId == "") array_push($errors, "User Id");
			$userData = $this->user_model->getUserDataByAccessToken($access_token);
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			} 
 			elseif(empty($userData)){
				$dvar['result']  = false;
				$dvar['code']    = "202";
				$dvar['message'] = "Wrong access token";
			}
			else{
				if($no_of_post == 0 || $no_of_post == ""){
					$no_of_post = 10;
				}
				else{
					$no_of_post = $no_of_post;
				}
				if($page_no == 1 || $page_no == 0 || $page_no == ""){
					$limit = 0;
				}
				else{
					$limit = ($page_no - 1) * $no_of_post;
				}
				$followed_users=$this->user_model->followedUser($userData['id']);
				if(!empty($followed_users)){
					foreach($followed_users AS $key=>$val){
						$userId.=$val['other_id'].",";
					}
					$userId1=rtrim($userId,",");
				}else{
					$userId1= "0";
				}
				if(!empty($latitude) && !empty($longitude)){    
					$res=$this->user_model->home_post_list($userData['id'],$latitude,$longitude,$limit, $no_of_post,$userId1);
				}else{
					$res=$this->user_model->home_post_list($userData['id'],$userData['latitude'],$userData['longitude'],$limit, $no_of_post,$userId1);
				}
 				if(!empty($res)){
					$i=0;
					foreach($res AS $key=>$val){
							if(!empty($val["image_name"])){
								$imageName = base_url()."pics/stream_imgs/" .$val["image_name"];
							}else{
								$imageName = "";		
							}
							$data[$i]["id"]     	     = $val["id"];
							$data[$i]["user_id"]     	 = $val["user_id"];
							$user_data=$this->user_model->user_profile_data($val["user_id"]);
							if(!empty($user_data)){
								$profile_pic = "";
								if(!empty($user_data['profile_pic'])){
									$profile_pic = base_url()."pics/profile_pics/".$user_data['profile_pic'];
								}
								$data[$i]["username"]     = $user_data["username"];
								$data[$i]["profile_pic"]  = $profile_pic;
								$data[$i]["email"]        = $user_data["email"];
								
							}else{
								$data[$i]["username"]     = "";
								$data[$i]["profile_pic"]  = "";
								$data[$i]["email"]        = "";						
							}   	
							$nuLike = $this->user_model->num_like($val["id"]);
							$grr['user_id'] = $userData['id'];
							$grr['post_id'] = $val["id"];
							$allreadyLike = $this->user_model->allready_liked($grr);
							$numcmment = $this->user_model->num_commnet($val["id"]);
							$arr['user_id']  = $userData['id'];
							$arr['post_id'] = $val["id"];
							$exist = $this->user_model->post_alredy_saved($arr);
							$data[$i]["item_image"]      = $imageName;  
							$data[$i]["item_name"]       = $val["item_name"];         
							$data[$i]["profile_saved"]   = $exist;         
							$data[$i]["restaurant_name"] = $val["restaurant_name"];         
							$data[$i]["tags"]            = $val["tags"];  
							$data[$i]["address"]         = $val["address"];         
							$data[$i]["latitude"]     	 = $val["latitude"];     	
							$data[$i]["longitude"]    	 = $val["longitude"];    	
							$data[$i]["comment"]         = $val["comment"];         
							$data[$i]["like_status"]     = $allreadyLike;        
							$data[$i]["average_rating"]  = $val["average_rating"];  
							$data[$i]["saved_to_profile"]= $val["saved_to_profile"];
							$data[$i]["total_like"]      = $nuLike;
							$data[$i]["total_commnnt"]   = $numcmment;
							$data[$i]["created_ago"]     = $this->common->convert_time_days($val["time"]);
						$i++;
					}
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "Data loaded successfully";
					$dvar['data']    = $data;
				} 
				else{
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "No data found";
					$dvar['data']    = array();
				}
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}
 	public function home_episode(){  
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
	 	// 	if($access_token == "") array_push($errors, "Access Token"); 
	 	// 	if($userId == "") array_push($errors, "User Id");
			// $userData = $this->user_model->getUserDataByAccessToken($access_token);
			// if(count($errors)>0){
			// 	$errors = implode(", ", $errors);
			// 	$dvar['result']  = false;
			// 	$dvar['code']    = "201";
 		// 		$dvar['message'] = "$errors should not be empty";
			// } 
 		// 	elseif(empty($userData)){
			// 	$dvar['result']  = false;
			// 	$dvar['code']    = "202";
			// 	$dvar['message'] = "Wrong access token";
			// }
			// else{
				if($access_token){
					$userData = $this->user_model->getUserDataByAccessTokenOptional($access_token);
					if(empty($userData)){
						$dvar['result']  = false;
						$dvar['code']    = "202";
		 				$dvar['message'] = "Wrong access token";
		 				echo json_encode($dvar); die;
					}
				}else{
					$userData =array();
				}



				if($no_of_post == 0 || $no_of_post == ""){
					$no_of_post = 10;
				}
				else{
					$no_of_post = $no_of_post;
				}
				if($page_no == 1 || $page_no == 0 || $page_no == ""){
					$limit = 0;
				}
				else{
					$limit = ($page_no - 1) * $no_of_post;
				}
				
				$res=$this->user_model->getEpisodes($limit, $no_of_post);
				$resCount=$this->user_model->getEpisodesCount($limit, $no_of_post);
				
 				if(!empty($res)){

 					foreach ($res as $key => $value) {

 						$res[$key]['image'] = array_filter(explode(",",$value['image']));
 						$res[$key]['is_image'] = sizeOf($res[$key]['image']) > 0 ? "true" : "false";
 						$res[$key]['audio'] = array_filter(explode(",",$value['audio']));
 						$res[$key]['is_audio'] = sizeOf($res[$key]['audio']) > 0 ? "true" : "false";
 						$res[$key]['video'] = array_filter(explode(",",$value['video']));
						$res[$key]['is_video'] = sizeOf($res[$key]['video']) > 0 ? "true" : "false";
						$res[$key]['bhps_planId'] = array_filter(explode(",",$value['bhps_planId']));
 					}
					
					$data = $res;
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "Data loaded successfully";
					$dvar['total_count'] = $resCount;
					$dvar['data']    = $data;
				} 
				else{
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "No data found";
					$dvar['data']    = array();
				}
			//}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}
 	public function user_profile_data(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else {
				$userData = $this->user_model->getUserDataByAccessToken($access_token);
	 			if(!empty($userData)){
					if($userData['user_type'] == 1){
						$pstId="";
						$pst_places = $this->user_model->getPosts($userData["id"],$pstId);
						if(!empty($pst_places)){
							$z=0;
							foreach($pst_places AS $ket=>$vet){
								if(!empty($vet["image_name"])){
									$imageNm = base_url()."pics/stream_imgs/" .$vet["image_name"];
								}else{
									$imageNm = "";	
								}
								$pstdta[$z]["id"]     	       = $vet["id"];	
								$pstdta[$z]["user_id"]     	   = $vet["user_id"];	
								$pstdta[$z]["item_image"]      = $imageNm;  
								$pstdta[$z]["item_name"]       = $vet["item_name"];         
								$pstdta[$z]["restaurant_name"] = $vet["restaurant_name"];         
								$pstdta[$z]["address"]         = $vet["address"];         
								$pstdta[$z]["latitude"]        = $vet["latitude"];     	
								$pstdta[$z]["longitude"]       = $vet["longitude"];    		        
								$pstdta[$z]["average_rating"]  = $vet["average_rating"];  
								$pstdta[$z]["created_ago"]     = $this->common->convert_time_days($vet["time"]);
								 $z++;
							}
							
						}else{
							$pstdta=array();
						}
					}
					$profile_pic = "";
					if(!empty($userData['profile_pic'])){
						$profile_pic = base_url()."pics/profile_pics/".$userData['profile_pic'];
					}
					$postData = $this->user_model->getSavedPosts($userData["id"]);
					if(!empty($postData)){
						foreach($postData as $kt=>$vt){
							$pst_id.=$vt['post_id'].",";
						}
						$pstId=rtrim($pst_id,",");
					}else{
						$pstId="";
					}
					$pst_data = $this->user_model->getPosts($userData["id"],$pstId);
					//print_r($post_data); die;
					if(!empty($pst_data)){
						$m=0;
						foreach($pst_data AS $key=>$val){
							if(!empty($val['image_name'])){
								$img[$m]['id']        = $val['id'];
								$img[$m]['image_name']= base_url()."pics/stream_imgs/" .$val['image_name'];
								 $m++;
							}
						}
					}else{
						$img=array();
					}
					if(!empty($pst_data)){
						$p=0;
						foreach($pst_data AS $k=>$v){
							if(!empty($v["image_name"])){
								$imageName = base_url()."pics/stream_imgs/" .$v["image_name"];
							}else{
								$imageName = "";	
							}
							$pst_data[$p]["id"]     	     = $v["id"];	
							$pst_data[$p]["user_id"]     	 = $v["user_id"];	
							$pst_data[$p]["item_image"]      = $imageName;  
							$pst_data[$p]["item_name"]       = $v["item_name"];         
							$pst_data[$p]["restaurant_name"] = $v["restaurant_name"];         
							$pst_data[$p]["tags"]            = $v["tags"];  
							$pst_data[$p]["address"]         = $v["address"];         
							$pst_data[$p]["latitude"]     	 = $v["latitude"];     	
							$pst_data[$p]["longitude"]    	 = $v["longitude"];    		
							$pst_data[$p]["comment"]         = $v["comment"];         
							$pst_data[$p]["average_rating"]  = $v["average_rating"];  
							$pst_data[$p]["saved_to_profile"]= $v["saved_to_profile"];
							$pst_data[$p]["created_ago"]     = $this->common->convert_time_days($v["time"]);
							 $p++;
						}
					}else{
						$pst_data=array();
					}
					if($userData['user_type'] == 2){
						$ratingAvg= $this->user_model->resturantAverageRating($userData["id"]);
						if(!empty($ratingAvg)){
							$data["rating"]  = round($ratingAvg["rating"]);
						}else{
							$data["rating"]  = 0;
						}
						$count_comment= $this->user_model->countPostComment($userData["id"]);
						if(!empty($count_comment)){
							$data["count_comment"]  = round($count_comment["ttl_comment"]);
						}else{
							$data["count_comment"]  = 0;
						}
					}
   					$data["user_id"]       = (string)$userData["id"];
 		 			$data["access_token"]  = $userData["access_token"];
 					$data["email"] 	       = $userData['email'];
 					$data["username"]      = $userData["username"];				
					$data["user_type"]     = (string)$userData["user_type"];
					$data["phone"]         = (string)$userData["phone"];
					$data["location"]      = $userData["location"];
					$data["latitude"]      = $userData["latitude"];
					$data["longitude"]     = $userData["longitude"];
					$data["description"]   = $userData["description"] ? $userData["description"] : "";
					$data["tags"]          = $userData["tags"] ? $userData["tags"] : "";					
					$data["register_date"] = $userData["posted"];
					$data["zip_code"]      = $userData["zip_code"];
					$data["facebook_link"] = $userData["facebook_link"] ? $userData["facebook_link"] : "";
					$data["twitter_link"]  = $userData["twitter_link"] ? $userData["twitter_link"] : "";
					$data["pinterest_link"]= $userData["pinterest_link"] ? $userData["pinterest_link"] : "";
					$data["instagram_link"]= $userData["instagram_link"] ? $userData["instagram_link"] : "";
					$data["images"]        = $img;
					$data["saved_item"]    = $pst_data;
					if($userData['user_type'] == 1){
						$data["my_places"]     = $pstdta;
					}
					
  					$dvar['result']  = true;

 					$dvar['code']    = "200";
					$dvar['message'] = "Profile data loaded successfully.";
					$dvar['data']    = $data;
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}   
  	   
 	public function user_follow_api(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else if($other_id == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Other id should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
				if(!empty($userData)){
					$arr['user_id']  = $userData['id'];
					$arr['other_id'] = $other_id;
					$exist = $this->user_model->allready_followed($arr);
					if($exist > 0){
						$res1=$this->user_model->unfollow_api($arr);
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Un-followed successfully.";
					}else{
						$res=$this->user_model->follow_user($arr);
						if(!empty($res)){
							$dvar['result']  = true;
							$dvar['code']    = "200";
							$dvar['message'] = "Followed successfully.";
						}else{
							$dvar['result']  = true;
							$dvar['code']    = "201";
							$dvar['message'] = "Failed to follow.";						
						}
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
	// public function unfollow_api(){
		// if($_POST){
			// extract($_POST);
			// if($access_token == ""){
				// $dvar['result']  = false;
				// $dvar['code']    = "201";
				// $dvar['message'] = "Access token should not be empty.";
			// } else if($other_id == ""){
				// $dvar['result']  = false;
				// $dvar['code']    = "201";
				// $dvar['message'] = "Other id should not be empty.";
			// } else {
  				// $userData = $this->user_model->getUserDataByAccessToken($access_token);
				// if(!empty($userData)){
					// $arr['user_id']  = $userData['id'];
					// $arr['other_id'] = $other_id;
					// $res=$this->user_model->unfollow_api($arr);
					// if(!empty($res)){
						// $dvar['result']  = true;
						// $dvar['code']    = "200";
						// $dvar['message'] = "Un-followed successfully.";
					// }else{
						// $dvar['result']  = true;
						// $dvar['code']    = "201";
						// $dvar['message'] = "Failed to un-follow.";						
					// }
 	 			// } 
				// else {
	 				// $dvar['result']  = false;
					// $dvar['code']    = "202";
					// $dvar['message'] = "Wrong access token"; 
	 			// }				
			// }	 		
		// } else {
			// $dvar['result']  = false;
			// $dvar['code']    = "201";
			// $dvar['message'] = "Data empty!";
		// }
		// echo json_encode($dvar); die;
	// }
 	 public function update_stream_post(){  
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
	 		if($access_token == "") array_push($errors, "Access Token"); 
	 		if($post_id == "") array_push($errors, "Post Id"); 
	 		if($address == "") array_push($errors, "Address"); 
			if($latitude == "") array_push($errors, "Latitude");
			if($longitude == "") array_push($errors, "Longitude");
			if($comment == "") array_push($errors, "Comment");
			if($item_name == "") array_push($errors, "item_name");
			if($restaurant_name == "")  array_push($errors, "Restaurant Name");
			if($tags == "")  array_push($errors, "Tags");
			if($rating == "") array_push($errors, "Rating"); 
	 		if($saved_to_profile == "") array_push($errors, "Saved profile");  
			$userData = $this->user_model->getUserDataByAccessToken($access_token);
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			}if(empty($userData)){
				$dvar['result']  = false;
				$dvar['code']    = "202";
				$dvar['message'] = "Wrong access token";
			}
			else{

				$image_name = $_FILES['image_name']['name'];
				if($image_name != ""){
					$ext          		 = end(explode(".", $image_name));
					$image_name  	 	 = uniqid().'_'.time().".".$ext;
					$image_name   		 = $image_name;
					$arr["image_name"]  = $image_name;
					$path                = "./pics/stream_imgs/".$image_name;
					copy($_FILES['image_name']['tmp_name'], $path);
				}				

				$arr["id"]     	        = $post_id;
				$arr["user_id"]     	= $userData['id'];
 				$arr["restaurant_name"] = $restaurant_name;
 				$arr["item_name"]       = $item_name;
 				$arr["tags"]            = $tags;
 				$arr["address"]         = $address;
 				$arr["latitude"]     	= $latitude;
				$arr["longitude"]    	= $longitude;
 				$arr["comment"]         = $comment;
 				$arr["average_rating"]  = $rating;
				$arr["saved_to_profile"]= $saved_to_profile;
 				if($this->user_model->update_stream_post($arr)){
					if(!empty($arr["image_name"])){
						$imageName = base_url()."pics/stream_imgs/" . $image_name;
					}else{
							
					}
					$data["user_id"]     	 = $arr["user_id"];     	
					$data["item_image"]      = $imageName;         
					$data["item_name"]       = $arr["item_name"];         
					$data["restaurant_name"] = $arr["restaurant_name"];         
					$data["tags"]            = $arr["tags"];         
					$data["address"]         = $arr["address"];         
					$data["latitude"]     	 = $arr["latitude"];     	
					$data["longitude"]    	 = $arr["longitude"];    	
					$data["comment"]         = $arr["comment"];         
					$data["average_rating"]  = $arr["average_rating"];  
					$data["saved_to_profile"]= $arr["saved_to_profile"];
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "Stream posted updated successfully";
					$dvar['data']    = $data;
				} 
				else{
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "No data found";
					$dvar['data']    = array();
				}
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}  
 	public function post_like(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else if($post_id == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Post id should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
				if(!empty($userData)){
					$arr['user_id']  = $userData['id'];
					$arr['post_id'] = $post_id;
					$exist = $this->user_model->allready_liked($arr);
					if($exist > 0){
						$res1=$this->user_model->unlike_api($arr);
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Unlike successfully.";
					}else{
						$res=$this->user_model->post_like($arr);
						if(!empty($res)){
							$dvar['result']  = true;
							$dvar['code']    = "200";
							$dvar['message'] = "Liked successfully.";
						}else{
							$dvar['result']  = true;
							$dvar['code']    = "201";
							$dvar['message'] = "Failed to like.";						
						}
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}   
	// public function unlike_api(){
		// if($_POST){
			// extract($_POST);
			// if($access_token == ""){
				// $dvar['result']  = false;
				// $dvar['code']    = "201";
				// $dvar['message'] = "Access token should not be empty.";
			// } else if($post_id== ""){
				// $dvar['result']  = false;
				// $dvar['code']    = "201";
				// $dvar['message'] = "Post id should not be empty.";
			// } else {
  				// $userData = $this->user_model->getUserDataByAccessToken($access_token);
				// if(!empty($userData)){
					// $arr['user_id']  = $userData['id'];
					// $arr['post_id'] = $post_id;
					// $res=$this->user_model->unlike_api($arr);
					// if(!empty($res)){
						// $dvar['result']  = true;
						// $dvar['code']    = "200";
						// $dvar['message'] = "Unlike successfully.";
					// }else{
						// $dvar['result']  = true;
						// $dvar['code']    = "201";
						// $dvar['message'] = "Failed to unlike.";						
					// }
 	 			// } 
				// else {
	 				// $dvar['result']  = false;
					// $dvar['code']    = "202";
					// $dvar['message'] = "Wrong access token"; 
	 			// }				
			// }	 		
		// } else {
			// $dvar['result']  = false;
			// $dvar['code']    = "201";
			// $dvar['message'] = "Data empty!";
		// }
		// echo json_encode($dvar); die;
	// }
	public function post_comment(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else if($post_id == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Post id should not be empty.";
			} else if($comment == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Comment should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
				if(!empty($userData)){
					$arr['user_id']  = $userData['id'];
					$arr['post_id']  = $post_id;
					$arr['comment']  = $comment;
					$res=$this->user_model->post_comment($arr);
					if(!empty($res)){
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Commented successfully.";
					}else{
						$dvar['result']  = true;
						$dvar['code']    = "201";
						$dvar['message'] = "Failed to comment.";						
					}
				}else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
 	public function user_bussiness_follow(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else {
				if($no_of_post == 0 || $no_of_post == ""){
					$no_of_post = 10;
				}
				else{
					$no_of_post = $no_of_post;
				}
				if($page_no == 1 || $page_no == 0 || $page_no == ""){
					$limit = 0;
				}
				else{
					$limit = ($page_no - 1) * $no_of_post;
				}
				$userData = $this->user_model->getUserDataByAccessToken($access_token);
	 			if(!empty($userData)){
					$user_image = "";
					$user_Data = $this->user_model->user_bussiness_follow($userData['id']);
					$i=0;
					if(!empty($user_Data)){
						foreach($user_Data as $k => $v){
							$arr['user_id'] = $userData['id'];
							$arr['other_id'] = $v['id'];
							$exist = $this->user_model->allready_followed($arr);
							$data[$i]['id'] 		 = $v['id'];
							$data[$i]['email'] 		 = $v['email'];
							$data[$i]['user_type'] 	 = $v['user_type'];
							$data[$i]['username'] 	 = $v['username'];
							$data[$i]['follow'] 	 = $exist;
							$data[$i]['phone'] 		 = !empty($v['phone']) ? $v['phone'] : "";
							if(!empty($v['user_image'])){
								$data[$i]['user_image']  = base_url()."pics/profile_pics/".$v['user_image'];
							}else{
								$data[$i]['user_image']  ="";
							}
						 $i++;
						}
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Data loaded successfully.";
						$dvar['data']    = $data;
					}else{
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "No data found";
						$dvar['data']    = array();
					}
				} 
				else {
					$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
				}				
			}		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}   
 	public function add_menu(){ 
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
	 		if($access_token == "") array_push($errors, "Access Token"); 
	 		if($item_name == "") array_push($errors, "Item Name"); 
			if($item_price == "") array_push($errors, "Item Price");
			if($category_name == "") array_push($errors, "category Name");
			$userData = $this->user_model->getUserDataByAccessToken($access_token);
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			}if(empty($userData)){
				$dvar['result']  = false;
				$dvar['code']    = "202";
				$dvar['message'] = "Wrong access token";
			}
			else{
				
				$item_image = $_FILES['item_image']['name'];
				if($item_image != ""){
					$ext          		 = end(explode(".", $item_image));
					$item_image  	 	 = uniqid().'_'.time().".".$ext;
					$item_image   		 = $item_image;
					$arr["item_image"]  = $item_image;
					$path                = "./pics/items/".$item_image;
					copy($_FILES['item_image']['tmp_name'], $path);
				}
				if(!empty($category_id)){
					$categoryId=$category_id;
				}else{
					$prr["category_name"]    = $category_name;
					$cate_id = $this->user_model->add_category($prr);
					$categoryId=$cate_id;
				}
				$arr["user_id"]     	 = $userData['id'];
 				$arr["item_name"]        = $item_name;
 				$arr["item_price"]       = $item_price;
 				$arr["category_name"]    = $category_name;
 				$arr["category_id"]      = $categoryId;
				if(!empty($item_id)){
					$res=$this->user_model->update_items($arr,$item_id);
					$msg="updated";
				}else{
					$res=$this->user_model->add_items($arr);
					$msg="added";
				}
 				if($res){
					if(!empty($arr["item_image"])){
						$imageName = base_url()."pics/items/" . $item_image;
					}else{
						$imageName ="";
					}
					$data["user_id"]        = $arr["user_id"];     	
					$data["image_name"]     = $imageName;         
					$data["item_name"]      = $arr["item_name"];         
					$data["item_price"]     = $arr["item_price"];            	
					$data["category_name"]  = $arr["category_name"];     	
					$data["category_id"]    = $arr["category_id"];     	
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "Item ".$msg." successfully";
					$dvar['data']    = $data;
				} 
				else{
					$dvar['result']  = false;
					$dvar['code']    = "201";
					$dvar['message'] = "Item ".$msg." failed!";
				}
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}   
 	public function episodeDetail(){

 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
  	 		//if($access_token == "") array_push($errors, "Access Token"); 
  	 		if($episodeId == "") array_push($errors, "Episode Id"); 
			
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			} 
			else{
				
				if($access_token){
					$userData = $this->user_model->getUserDataByAccessTokenOptional($access_token);
					if(empty($userData)){
						$dvar['result']  = false;
						$dvar['code']    = "202";
		 				$dvar['message'] = "Wrong access token";
		 				echo json_encode($dvar); die;
					}
				}else{
					$userData =array();
				}

					$episode_data=$this->user_model->episodeDetail($episodeId);

					if($episode_data){
						$data["user_id"] 	  = (string)$episodeId;
						$data["title"] = $episode_data['title'];
						$data["subtitle"] 	      = $episode_data['subtitle'];
						$data["subtitle2"]     = $episode_data["subtitle2"];				
						$data["matthew"]    = $episode_data["matthew"];
						$data["subal_stearns"]        = $episode_data["subal_stearns"];

						$data["image"]     =  array_filter(explode(",",$episode_data["image"]));
						$data["is_image"]     = sizeOf($data["image"]) > 0 ? "true" : "false";
						$data["audio"]     = array_filter(explode(",",$episode_data["audio"]));
						$data["is_audio"]     = sizeOf($data["audio"]) > 0 ? "true" : "false";
						$data["video"]    =array_filter(explode(",",$episode_data["video"]));
						$data["is_video"]     = sizeOf($data["video"]) > 0 ? "true" : "false";
						$data["bhps_planId"]    =array_filter(explode(",",$episode_data["bhps_planId"]));

						$data["is_login"]    = empty($userData) ? false : true;
						$data["is_account"]    = empty($userData) ? false : true;
						$data["is_subscription"]    = empty($userData) ? false : ($userData['plan_status'] == 'active' ? true : false);
						$data["created_at"]     = $episode_data["created_at"];

					
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "details completed successfully";
						$dvar['data']    = $data;
					} 
					else{
						$dvar['result']  = false;
						$dvar['code']    = "201";
						$dvar['message'] = "Episode has been blocked by admin";
						//$dvar['data']    = array();
					}
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;


 	}
	public function completed_signup(){  
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
  	 		if($access_token == "") array_push($errors, "Access Token"); 
			$userData           = $this->user_model->getUserDataByAccessToken($access_token);
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			} 
 			elseif(empty($userData)){  
				$dvar['result']  = false;
				$dvar['code']    = "202";
 				$dvar['message'] = "Wrong access token";
			} 
			else{
				$arr["id"]           = $userData['id'];
				$arr["completed"]    = 1;
 				if($this->user_model->update_profile_data($arr)){
					$user_Data    = $this->user_model->get_user_data($arr["id"]);
 					$user_id  =$user_Data['id']; 
 					$mailto  = $user_Data["email"];
					
					$profile_pic = "";
					if(!empty($user_Data['profile_pic'])){
						$profile_pic = base_url()."pics/profile_pics/".$user_Data['profile_pic'];
					}
					
					$data["user_id"] 	  = (string)$user_id;
					$data["access_token"] = $user_Data['access_token'];
					$data["email"] 	      = $user_Data['email'];
 					$data["username"]     = $user_Data["username"];				
					$data["user_type"]    = (string)$user_Data["user_type"];
					$data["phone"]        = (string)$user_Data["phone"];
					$data["location"]     = $user_Data["location"];
					$data["latitude"]     = $user_Data["latitude"];
					$data["longitude"]    = $user_Data["longitude"];
					$data["zip_code"]     = (string)$user_Data["zip_code"];
					$data["description"]  = $user_Data["description"] ? $user_Data["description"] : "";
					$data["tags"]         = $user_Data["tags"] ? $user_Data["tags"] : "";
 					$data["profile_pic"]  = $profile_pic;
 					$data["register_date"]= (string)time();
 					$data["facebook_link"] = "";
					$data["twitter_link"]  = "";
					$data["pinterest_link"]= "";
					$data["instagram_link"]= "";

 					//$data['fb_id']        = !empty($arr['fb_id']) ? $arr['fb_id'] : "";

					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "details completed successfully";
					$dvar['data']    = $data;
				} 
				else{
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "No data found";
					$dvar['data']    = array();
				}
				
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}
 	public function follower_request_list(){ 	
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
  	 		if($access_token == "") array_push($errors, "Access Token"); 
			$userData           = $this->user_model->getUserDataByAccessToken($access_token);
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			} 
 			elseif(empty($userData)){  
				$dvar['result']  = false;
				$dvar['code']    = "202";
 				$dvar['message'] = "Wrong access token";
			} 
			else{
				$res=$this->user_model->follow_request_list($userData['id']);
 				if($res){
					$i=0;
					foreach($res AS $key=>$val){
						$user_Data    = $this->user_model->get_user_data($val["other_id"]);
						$profile_pic = "";
						if(!empty($user_Data['profile_pic'])){
							$profile_pic = base_url()."pics/profile_pics/".$user_Data['profile_pic'];
						}
						$data[$i]["user_id"] 	  = (string)$user_Data['id'];
						$data[$i]["email"] 	      = $user_Data['email'];
						$data[$i]["username"]     = $user_Data["username"];				
						$data[$i]["phone"]        = (string)$user_Data["phone"];
						$data[$i]["location"]     = $user_Data["location"];
						$data[$i]["latitude"]     = $user_Data["latitude"];
						$data[$i]["longitude"]    = $user_Data["longitude"];
						$data[$i]["profile_pic"]  = $profile_pic;
						$i++;
					}
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "Follow request list data loaded successfully";
					$dvar['data']    = $data;
				} 
				else{
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "No data found";
					$dvar['data']    = array();
				}
				
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}
 	public function accept_follower_request(){ 	
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
  	 		if($access_token == "") array_push($errors, "Access Token"); 
  	 		if($other_id == "") array_push($errors, "Other Id"); 
  	 		if($status == "") array_push($errors, "Status"); 
			$userData           = $this->user_model->getUserDataByAccessToken($access_token);
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			} 
 			elseif(empty($userData)){  
				$dvar['result']  = false;
				$dvar['code']    = "202";
 				$dvar['message'] = "Wrong access token";
			} 
			else{
				$res=$this->user_model->update_follower_request($userData['id'],$other_id,$status);
				if($status == 1){
					$msg="accepted";
				}else{
					$msg="rejected";
				}
 				if($res){
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "Request $msg successfully";
				} 
				else{
					$dvar['result']  = false;
					$dvar['code']    = "201";
					$dvar['message'] = "Request $msg failed!";
				}
				
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}
	public function notification_list(){
  		$page_no      = trim($this->input->post("page_no"));
		$no_of_post   = trim($this->input->post("no_of_post"));
		$access_token = trim($this->input->post('access_token'));
 		$userData     = $this->user_model->getUserDataByAccessToken($access_token);
  		if($access_token == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide token.";
		} 
 		else if(empty($userData)){
			$dvar['result']  = false;
			$dvar['code']    = "202";
			$dvar['message'] = "Wrong access token";
		} 
 		else{
 			if($no_of_post == 0 || $no_of_post == ""){
				$no_of_post = 10;
			}
			else{
				$no_of_post = $no_of_post;
			}
			if($page_no == 1 || $page_no == 0 || $page_no == ""){
				$limit = 0;
			}
			else{
				$limit = ($page_no - 1) * $no_of_post;
			}

 			$arr['user_id'] = $userData['id'];
  			$noti = $this->user_model->getNotificationList($arr, $limit, $no_of_post);
  			$counts = $this->user_model->getNotificationCount($arr);
  			
  		
  			$i=0;
			if(!empty($noti)){
 				foreach($noti as $k => $v){
					$senderData = $this->user_model->getUserDetails($v['sender']);
					if(!empty($senderData['profile_pic'])){
						$profile_pic= base_url()."pics/profile_pics/".$senderData['profile_pic'];;
					}else{
						$profile_pic="";
					}
  					$krr[$i]['id']           = $v['id'];
					$krr[$i]['notification'] = $v['body'];
					$krr[$i]['message'] 	 = $v['title'];
					$krr[$i]['req_id']       = $v['other_id'];
					$krr[$i]['type']       	 = $v['type'];
 					$krr[$i]['seen']         = $v['seen'];
					$krr[$i]['sender']       = $v['sender'] ;
					$krr[$i]['sender_name']  = $v['sender'] == 0 ? 'BHPS' : ucwords($senderData['username']);
					$krr[$i]['profile_pic']  = $profile_pic;
 					$krr[$i]['created']      = date('d/m/y - h:i A', $v['time']);
					$krr[$i]['created_ago']  = $this->common->convert_time_days($v['time']);
  					$i++;
				}
				$this->user_model->markNotificationAsRead($userData['id']);
				$barr['badgecount'] = 0;
				$barr['id']         = $userData['id'];
			    $this->user_model->update_profile_data($barr);

				$dvar['result']  = true;
				$dvar['code']    = "200";
				$dvar['message'] = "Notification data loaded successfully.";
				$dvar['total_count'] = $counts;
				$dvar['data']    = $krr;
				

			}
			else{
				$dvar['result']  = true;
				$dvar['code']    = "200";
				$dvar['message'] = "No data found";
				$dvar['data']    = array();
			}

		}
		echo json_encode($dvar); die;
	}
 	public function comment_item(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else if($item_id == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Item id should not be empty.";
			} else if($comment == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Comment should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
				if(!empty($userData)){
					$arr['user_id']  = $userData['id'];
					$arr['item_id']  = $item_id;
					$arr['comment']  = $comment;
					$res=$this->user_model->comment_item($arr);
					if(!empty($res)){
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Commented successfully.";
					}else{
						$dvar['result']  = true;
						$dvar['code']    = "201";
						$dvar['message'] = "Failed to comment.";						
					}
				}else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
public function item_like_unlike(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else if($item_id == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Post id should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
				if(!empty($userData)){
					$arr['user_id']  = $userData['id'];
					$arr['item_id'] = $item_id;
					$exist = $this->user_model->item_allready_liked($arr);
					if($exist > 0){
						$res1=$this->user_model->item_unlike_api($arr);
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Unlike successfully.";
					}else{
						$res=$this->user_model->item_like($arr);
						if(!empty($res)){
							$dvar['result']  = true;
							$dvar['code']    = "200";
							$dvar['message'] = "Liked successfully.";
						}else{
							$dvar['result']  = true;
							$dvar['code']    = "201";
							$dvar['message'] = "Failed to like.";						
						}
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}	
    public function item_description(){  
 		if($_POST){ 
 			extract($_POST);
			$errors = array(); 
	 		if($access_token == "") array_push($errors, "Access Token"); 
	 		if($item_id == "") array_push($errors, "Post Id"); 
			$userData = $this->user_model->getUserDataByAccessToken($access_token);
			if(count($errors)>0){
				$errors = implode(", ", $errors);
				$dvar['result']  = false;
				$dvar['code']    = "201";
 				$dvar['message'] = "$errors should not be empty";
			} 
 			elseif(empty($userData)){
				$dvar['result']  = false;
				$dvar['code']    = "202";
				$dvar['message'] = "Wrong access token";
			}
			else{
				$res=$this->user_model->getItemData($item_id);
 				if(!empty($res)){
					if(!empty($res["item_image"])){
						$imageName = base_url()."pics/items/" .$res["item_image"];
					}else{
						$imageName ="";	
					}
					$getItems = $this->user_model->getItems_Data($item_id);
					if(!empty($getItems)){
						$i=0;
						foreach($getItems AS $key=>$val){
							$userDta=$this->user_model->user_profile_data($val["user_id"]);
							if(!empty($userDta)){
								$profile_pic = "";
								if(!empty($userDta['profile_pic'])){
									$profile_pic = base_url()."pics/profile_pics/".$userDta['profile_pic'];
								}
								$data1[$i]["username"]   = $userDta["username"];
								$data1[$i]["profile_pic"]= $profile_pic;
								$data1[$i]["email"]      = $userDta["email"];
								
							}else{
								$data1[$i]["username"]   = "";
								$data1[$i]["profile_pic"]= "";
								$data1[$i]["email"]      = "";						
							}
							$data1[$i]["comment"]        = $val['comment'];
							$data1[$i]["comment_ago"]    = $this->common->convert_time_days($val["time"]);;
						 $i++;
						}
					}else{
						$data=array();
					}
					$getItemsLikes = $this->user_model->getItemsLike_Data($item_id);
					if(!empty($getItemsLikes)){
						$j=0;
						foreach($getItemsLikes AS $ky=>$vl){
							$user_dta=$this->user_model->user_profile_data($vl["user_id"]);
							if(!empty($user_dta)){
								$profile_pic = "";
								if(!empty($user_dta['profile_pic'])){
									$profile_pic = base_url()."pics/profile_pics/".$user_dta['profile_pic'];
								}
								$data2[$j]["username"]   = $user_dta["username"];
								$data2[$j]["profile_pic"]= $profile_pic;
								$data2[$j]["email"]      = $user_dta["email"];
								
							}else{
								$data2[$j]["username"]   = "";
								$data2[$j]["profile_pic"]= "";
								$data2[$j]["email"]      = "";						
							}
							$data2[$j]["liked_ago"]       = $this->common->convert_time_days($vl["time"]);;
						 $j++;
						}
					}else{
						$data2=array();
					}
					$data["user_id"]     	 = $res["user_id"];
					$user_data=$this->user_model->user_profile_data($res["user_id"]);
					if(!empty($user_data)){
						$profile_pic = "";
						if(!empty($user_data['profile_pic'])){
							$profile_pic = base_url()."pics/profile_pics/".$user_data['profile_pic'];
						}
						$data["username"]     = $user_data["username"];
						$data["profile_pic"]  = $profile_pic;
						$data["email"]        = $user_data["email"];
						
					}else{
						$data["username"]     = "";
						$data["profile_pic"]  = "";
						$data["email"]        = "";						
					}   	
					$data["item_image"]      = $imageName;  
					$data["item_name"]       = $res["item_name"];         
					$data["item_price"]      = $res["item_price"];     	
					$data["category_id"]     = $res["category_id"];     	
					$data["category_name"]   = $res["category_name"];     	
					$data["item_comments"]   = $data1;     	
					$data["item_likes"]      = $data2;     	
					$data["created_ago"]     = $this->common->convert_time_days($res["time"]);
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "Stream posted successfully";
					$dvar['data']    = $data;
				} 
				else{
					$dvar['result']  = true;
					$dvar['code']    = "200";
					$dvar['message'] = "No data found";
					$dvar['data']    = array();
				}
			}
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
 			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}
	public function business_location_list(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
	 			if(!empty($userData)){
					$i=0;
					$j=0;
					$user_Data = $this->user_model->getAllUser_Data($userData['id']);
					if(!empty($user_Data)){
						foreach($user_Data AS $key=>$val){
							$profile_pic = "";
							if(!empty($user_Data['profile_pic'])){
								$profile_pic = base_url()."pics/profile_pics/".$user_Data['profile_pic'];
							}
							$ItemsData = $this->user_model->getDataItems($val['id']);
							// echo $this->db->last_query(); die;
							if(!empty($ItemsData)){
								foreach($ItemsData AS $k=>$v){
									$imageName = "";
									if(!empty($v['item_image'])){
										$imageName = base_url()."pics/items/".$v['item_image'];
									}
									$data1[$j]["item_id"]         = $v["id"];  
									$data1[$j]["item_image"]      = $imageName;  
									$data1[$j]["item_name"]       = $v["item_name"];         
									$data1[$j]["item_price"]      = $v["item_price"];      	
									$data1[$j]["category_id"]     = $v["category_id"];     	
									$data1[$j]["category_name"]   = $v["category_name"]; 
									$j++;
								}
							}else{
								$data1=array();
							}
							$data[$i]["user_id"]       = (string)$val["id"];
							$data[$i]["access_token"]  = $val["access_token"];
							$data[$i]["email"] 	       = $val['email'];
							$data[$i]["username"]      = $val["username"];				
							$data[$i]["user_type"]     = (string)$val["user_type"];
							$data[$i]["phone"]         = (string)$val["phone"];
							$data[$i]["location"]      = $val["location"];
							$data[$i]["latitude"]      = $val["latitude"];
							$data[$i]["longitude"]     = $val["longitude"];
							$data[$i]["zip_code"]      = $val["zip_code"];
							$data[$i]["description"]   = $val["description"] ? $val["description"] : "";
							$data[$i]["tags"]          = $val["tags"] ? $val["tags"] : "";					
							$data[$i]["register_date"] = $val["posted"];
							$data[$i]["facebook_link"] = $val["facebook_link"] ? $val["facebook_link"] : "";
							$data[$i]["twitter_link"]  = $val["twitter_link"] ? $val["twitter_link"] : "";
							$data[$i]["pinterest_link"]= $val["pinterest_link"] ? $val["pinterest_link"] : "";
							$data[$i]["instagram_link"]= $val["instagram_link"] ? $val["instagram_link"] : "";
							$data[$i]["item_data"]     = $data1;
							$i++;
						}
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Data loaded successfully.";
						$dvar['data']    = $data;
					}else{
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "No data found";
						$dvar['data']    = array();
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
	public function add_category(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} elseif($category_name == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Category name should not be empty.";
			} else {
				$userData = $this->user_model->getUserDataByAccessToken($access_token);
				$arr['category_name']= $category_name;
				$arr['user_id']      = $userData['id'];
	 			if(!empty($userData)){
					$cate_id = $this->user_model->add_category($arr);
					if(!empty($cate_id)){
						$data['category_id'] = $cate_id;
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Category added successfully.";
						$dvar['data']    = $data;
					}else{
						$data['category_id'] = $cate_id;
						$dvar['result']  = false;
						$dvar['code']    = "201";
						$dvar['message'] = "Category added failed.";
						$dvar['data']    =  array();
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
	public function category_listing(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
	 			if(!empty($userData)){
					$i=0;
					$j=0;
					$categorys = $this->user_model->category_listing($search,$userData['id']);
					if(!empty($categorys)){
						foreach($categorys AS $key=>$val){
							$ItemsData = $this->user_model->getItemsData($userData['id'],$val['id']);
							//echo $this->db->last_query(); die;
							if(!empty($ItemsData)){
								foreach($ItemsData AS $k=>$v){
									$imageName = "";
									if(!empty($v['item_image'])){
										$imageName = base_url()."pics/items/".$v['item_image'];
									}
									$data1[$j]["item_image"]      = $imageName;  
									$data1[$j]["item_name"]       = $v["item_name"];         
									$data1[$j]["item_price"]      = $v["item_price"];      	
									$data1[$j]["category_id"]     = $v["category_id"];     	
									$data1[$j]["category_name"]   = $v["category_name"]; 
									$j++;
								}
							}else{
								$data1=array();
							}
							$data[$i]["category_id"]    = (string)$val["id"];
							$data[$i]["category_name"]  = $val["category_name"];
							$data[$i]["item_data"]      = $data1;
							
							$i++;
						}
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Data loaded successfully.";
						$dvar['data']    = $data;
					}else{
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "No data found";
						$dvar['data']    = array();
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
	public function get_search_api(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else if($search_type == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Search type should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
	 			if(!empty($userData)){
					$i=0;
					if($search_type == 2){
						$itemdata = $this->user_model->post_itemdata_listing($search);
						//echo $this->db->last_query(); die;
						if(!empty($itemdata)){
							foreach($itemdata AS $key=>$val){
								if(!empty($val["image_name"])){
										$imageName = base_url()."pics/stream_imgs/" .$val["image_name"];
								}else{
									$imageName = "";		
								}
									$data[$i]["id"]     	     = $val["id"];
									$data[$i]["user_id"]     	 = $val["user_id"];
									$user_data=$this->user_model->user_profile_data($val["user_id"]);
									if(!empty($user_data)){
										$profile_pic = "";
										if(!empty($user_data['profile_pic'])){
											$profile_pic = base_url()."pics/profile_pics/".$user_data['profile_pic'];
										}
										$data[$i]["username"]     = $user_data["username"];
										$data[$i]["profile_pic"]  = $profile_pic;
										$data[$i]["email"]        = $user_data["email"];
										
									}else{
										$data[$i]["username"]     = "";
										$data[$i]["profile_pic"]  = "";
										$data[$i]["email"]        = "";						
									}   	
									$nuLike = $this->user_model->num_like($val["id"]);
									$numcmment = $this->user_model->num_commnet($val["id"]);
									$arr['user_id']  = $userData['id'];
									$arr['post_id'] = $val["id"];
									$exist = $this->user_model->post_alredy_saved($arr);
									$data[$i]["item_image"]      = $imageName;  
									$data[$i]["item_name"]       = $val["item_name"];         
									$data[$i]["profile_saved"]   = $exist;         
									$data[$i]["restaurant_name"] = $val["restaurant_name"];         
									$data[$i]["tags"]            = $val["tags"];  
									$data[$i]["address"]         = $val["address"];         
									$data[$i]["latitude"]     	 = $val["latitude"];     	
									$data[$i]["longitude"]    	 = $val["longitude"];    	
									$data[$i]["comment"]         = $val["comment"];         
									$data[$i]["average_rating"]  = $val["average_rating"];  
									$data[$i]["saved_to_profile"]= $val["saved_to_profile"];
									$data[$i]["total_like"]      = $nuLike;
									$data[$i]["total_commnnt"]   = $numcmment;
									$data[$i]["created_ago"]     = $this->common->convert_time_days($val["time"]);
								$i++;
							}
							$dvar['result']  = true;
							$dvar['code']    = "200";
							$dvar['message'] = "Data loaded successfully.";
							$dvar['data']    = $data;
						}else{
							$dvar['result']  = true;
							$dvar['code']    = "200";
							$dvar['message'] = "No data found";
							$dvar['data']    = array();
						}
					}else{
						$itemdata = $this->user_model->business_data_listing($search);
						if(!empty($itemdata)){
							foreach($itemdata AS $key=>$val){
								$profile_pic = "";
								if(!empty($val['profile_pic'])){
									$profile_pic = base_url()."pics/profile_pics/".$val['profile_pic'];
								}
								$data[$i]["id"]        = (string)$val["id"];
								$data[$i]["username"]  = $val["username"];
								$data[$i]["profile_pic"]= $profile_pic;
								$data[$i]["phone"]        = $val["phone"];
								$data[$i]["user_type"]     = $val["user_type"];
								$data[$i]["location"]     = $val["location"];
								$data[$i]["latitude"]     = $val["latitude"];
								$data[$i]["longitude"]    = $val["longitude"];
								$data[$i]["zip_code"]     = $val["zip_code"];
								$data[$i]["description"]  = $val["description"];
								$data[$i]["tags"]         = $val["tags"];
								$data[$i]["facebook_link"] = $val["facebook_link"] ? $val["facebook_link"] : "";
								$data[$i]["twitter_link"]  = $val["twitter_link"] ? $val["twitter_link"] : "";
								$data[$i]["pinterest_link"]= $val["pinterest_link"] ? $val["pinterest_link"] : "";
								$data[$i]["instagram_link"]= $val["instagram_link"] ? $val["instagram_link"] : "";
								$i++;
							}
							$dvar['result']  = true;
							$dvar['code']    = "200";
							$dvar['message'] = "Data loaded successfully.";
							$dvar['data']    = $data;
						}else{
							$dvar['result']  = true;
							$dvar['code']    = "200";
							$dvar['message'] = "No data found.";
							$dvar['data']    = array();
						}
						
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
	public function business_places_list(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} elseif($latitude == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Latitude should not be empty.";
			} elseif($longitude == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Longitude should not be empty.";
			} elseif($unit_type == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Unit type should not be empty.";
			} elseif($number == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Number should not be empty.";
			} else {
					if($no_of_post == 0 || $no_of_post == ""){
						$no_of_post = 10;
					}
					else{
						$no_of_post = $no_of_post;
					}
					if($page_no == 1 || $page_no == 0 || $page_no == ""){
						$limit = 0;
					}
					else{
						$limit = ($page_no - 1) * $no_of_post;
					}
				if($unit_type == 1){
					$distance =$number; 
				}else{
					$distance =($number * 0.000189394);
				}
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
	 			if(!empty($userData)){
					$i=0;
					$j=0;
					$user_Data = $this->user_model->near_me_places($userData['id'],$search,$latitude,$longitude,$limit,$no_of_post,$distance);
					if(!empty($user_Data)){
						foreach($user_Data AS $key=>$val){
							$ItemsData = $this->user_model->getDataItems($val['id']);
							// echo $this->db->last_query(); die;
							if(!empty($ItemsData)){
								foreach($ItemsData AS $k=>$v){
									$imageName = "";
									if(!empty($v['item_image'])){
										$imageName = base_url()."pics/items/".$v['item_image'];
									}
									$data1[$j]["item_id"]         = $v["id"];  
									$data1[$j]["item_image"]      = $imageName;  
									$data1[$j]["item_name"]       = $v["item_name"];         
									$data1[$j]["item_price"]      = $v["item_price"];      	
									$data1[$j]["category_id"]     = $v["category_id"];     	
									$data1[$j]["category_name"]   = $v["category_name"]; 
									$j++;
								}
							}else{
								$data1=array();
							}
							$profile_pic = "";
							if(!empty($user_Data['profile_pic'])){
								$profile_pic = base_url()."pics/profile_pics/".$user_Data['profile_pic'];
							}
							if($val['user_type'] == 2){
								$ratingAvg= $this->user_model->resturantAverageRating($val["id"]);
								if(!empty($ratingAvg)){
									$data[$i]["rating"]  = round($ratingAvg["rating"]);
								}else{
									$data[$i]["rating"]  = 0;
								}
								$count_comment= $this->user_model->countPostComment($val["id"]);
								if(!empty($count_comment)){
									$data[$i]["count_comment"]  = round($count_comment["ttl_comment"]);
								}else{
									$data[$i]["count_comment"]  = 0;
								}
							}
							$data[$i]["user_id"]       = (string)$val["id"];
							$data[$i]["access_token"]  = $val["access_token"];
							$data[$i]["email"] 	       = $val['email'];
							$data[$i]["username"]      = $val["username"];				
							$data[$i]["user_type"]     = (string)$val["user_type"];
							$data[$i]["phone"]         = (string)$val["phone"];
							$data[$i]["location"]      = $val["location"];
							$data[$i]["latitude"]      = $val["latitude"];
							$data[$i]["longitude"]     = $val["longitude"];
							$data[$i]["zip_code"]      = $val["zip_code"];
							$data[$i]["description"]   = $val["description"] ? $val["description"] : "";
							$data[$i]["tags"]          = $val["tags"] ? $val["tags"] : "";					
							$data[$i]["register_date"] = $val["posted"];
							$data[$i]["facebook_link"] = $val["facebook_link"] ? $val["facebook_link"] : "";
							$data[$i]["twitter_link"]  = $val["twitter_link"] ? $val["twitter_link"] : "";
							$data[$i]["pinterest_link"]= $val["pinterest_link"] ? $val["pinterest_link"] : "";
							$data[$i]["instagram_link"]= $val["instagram_link"] ? $val["instagram_link"] : "";
							$data[$i]["item_data"]     = $data1;
							$i++;
						}
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Data loaded successfully.";
						$dvar['data']    = $data;
					}else{
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "No data found";
						$dvar['data']    = array();
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
	public function view_menu(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else if($user_id == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "User id should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
	 			if(!empty($userData)){
					$i=0;
					
					$categorys = $this->user_model->category_listing($search,$user_id);
					if(!empty($categorys)){
						foreach($categorys AS $key=>$val){
							$ItemsData ="";
							$ItemsData = $this->user_model->getItemsData($user_id,$val['id']);
							//echo $this->db->last_query(); die;
							if(!empty($ItemsData)){
								$j=0;
								foreach($ItemsData AS $k=>$v){
									$imageName = "";
									if(!empty($v['item_image'])){
										$imageName = base_url()."pics/items/".$v['item_image'];
									}
									$data1[$j]["item_image"]      = $imageName;  
									$data1[$j]["item_name"]       = $v["item_name"];         
									$data1[$j]["item_price"]      = $v["item_price"];      	
									$data1[$j]["category_id"]     = $v["category_id"];     	
									$data1[$j]["category_name"]   = $v["category_name"]; 
									$j++;
								}
							}else{
								$data1=array();
							}
							$data[$i]["category_id"]    = (string)$val["id"];
							$data[$i]["category_name"]  = $val["category_name"];
							$data[$i]["item_data"]      = $data1;
							
							$i++;
						}
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Data loaded successfully.";
						$dvar['data']    = $data;
					}else{
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "No data found.";
						$dvar['data']    = array();
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
	public function post_save_profile(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else if($post_id == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Post id should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
				if(!empty($userData)){
					$arr['user_id']  = $userData['id'];
					$arr['post_id'] = $post_id;
					$exist = $this->user_model->post_alredy_saved($arr);
					if($exist > 0){
						$res1=$this->user_model->post_unsave_profile($arr);
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Post remove from profile successfully.";
					}else{
						$res=$this->user_model->post_save_profile($arr);
						if(!empty($res)){
							$dvar['result']  = true;
							$dvar['code']    = "200";
							$dvar['message'] = "Post saved to profile successfully.";
						}else{
							$dvar['result']  = true;
							$dvar['code']    = "201";
							$dvar['message'] = "Failed to like.";						
						}
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
	public function suggestion_list(){
 		if($_POST){
				$page_no         = trim($this->input->post("page_no"));
				$no_of_post      = trim($this->input->post("no_of_post"));
				$access_token    = $this->input->post("access_token");
				$userData        = $this->user_model->getUserDataByAccessToken($access_token);
	 		if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			}
			else if(empty($userData)){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Wrong access token"; 
			}  
			else {
				$res=$this->user_model->refresh_suggestion_data();
				if($no_of_post == 0 || $no_of_post == ""){
					$no_of_post = 10;
				}
				else{
					$no_of_post = $no_of_post;
				}
				if($page_no == 1 || $page_no == 0 || $page_no == ""){
					$limit = 0;
				}
				else{
					$limit = ($page_no - 1) * $no_of_post;
				}
				$res=$this->user_model->get_suggestion_data($userData['id']);
				if(!empty($res)){
 						$data="";
						foreach($res as $key => $val){
							if($val['other_id'] <> $userData['id']){
								$data.=$val['other_id'].",";
							}
							else{
								$data.=$val['user_id'].",";
							}
 						}
						$str_data=rtrim($data,",");
					 
				}			
					$suggestion_listing=$this->user_model->suggestion_listing($str_data, $limit, $no_of_post,$userData['id']);
					if(!empty($suggestion_listing)){
						$j=0;
						foreach($suggestion_listing AS $a=>$b){
								$al_sent=$this->user_model->check_friend_request_already_sent($b['id'],$userData['id']);
								if(empty($al_sent)){
									$data1[$j]['id']           = $b['id'];
									$data1[$j]['username']     = $b['username'];
									$data1[$j]['email']        = $b['email'];
									$data1[$j]['user_type']    = $b['user_type'];
									$data1[$j]['phone']        = $b['phone'];
									if($b['profile_pic'] <> ''){
									$data1[$j]['user_image ']  =base_url()."pics/profile_pics/".$b['profile_pic'];
									}
									else{
										$data1[$j]['user_image ']  = '';
									}
									$data1[$j]['address']      = $b['location'];
									$j++;
								}
						}
						if(!empty($data1)){
							$dvar['result']       = true;
							$dvar['code']         = "200";
							$dvar['message']      = "Data Loaded successfully.";
							$dvar['data']         = $data1;
						}else{
							$dvar['result']       = false;
							$dvar['code']         = "201";
							$dvar['message']      = "No user found around you";
							$dvar['data']         = array();
						}
					}else{
					$dvar['result']       = false;
					$dvar['code']         = "201";
					$dvar['message']      = "No new friend around you.";
					$dvar['data']         = array();
				}
	 		}
		} 
		else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
 	}
	public function other_user_profile(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} elseif($other_id == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Other user id should not be empty.";
			} else {
				$userDta = $this->user_model->getUserDataByAccessToken($access_token);
	 			if(!empty($userDta)){
					$userData = $this->user_model->user_profile_data($other_id);
					if(!empty($userData)){
							if($userData['user_type'] == 1){
								$pstId="";
								$pst_places = $this->user_model->getPosts($userData["id"],$pstId);
								if(!empty($pst_places)){
									$z=0;
									foreach($pst_places AS $ket=>$vet){
										if(!empty($vet["image_name"])){
											$imageNm = base_url()."pics/stream_imgs/" .$vet["image_name"];
										}else{
											$imageNm = "";	
										}
										$pstdta[$z]["id"]     	       = $vet["id"];	
										$pstdta[$z]["user_id"]     	   = $vet["user_id"];	
										$pstdta[$z]["item_image"]      = $imageNm;  
										$pstdta[$z]["item_name"]       = $vet["item_name"];         
										$pstdta[$z]["restaurant_name"] = $vet["restaurant_name"];         
										$pstdta[$z]["address"]         = $vet["address"];         
										$pstdta[$z]["latitude"]        = $vet["latitude"];     	
										$pstdta[$z]["longitude"]       = $vet["longitude"];    		        
										$pstdta[$z]["average_rating"]  = $vet["average_rating"];  
										$pstdta[$z]["created_ago"]     = $this->common->convert_time_days($vet["time"]);
										 $z++;
									}
									
								}else{
									$pstdta=array();
								}
							}
							if($userData['user_type'] == 2){
								$cmts= $this->user_model->comment_data($userData['id']);
								//echo $this->db->last_query();
								if(!empty($cmts)){
									$q=0;
									foreach($cmts AS $vd=>$vs){
										$userdta = $this->user_model->user_profile_data($vs['user_id']);
										$cmt[$q]['id']       = $vs['id'];
										$cmt[$q]['comment']  = $vs['comment'];
										$cmt[$q]['item_id']  = $vs['item_id'];
										$cmt[$q]['item_name']= $vs['item_name'];
										$cmt[$q]['user_id']  = $vs['user_id'];
										$q++;
									}
								}else{
									$cmt=array();
								}
							}
							$profile_pic = "";
							if(!empty($userData['profile_pic'])){
								$profile_pic = base_url()."pics/profile_pics/".$userData['profile_pic'];
							}
							$postData = $this->user_model->getSavedPosts($userData["id"]);
							if(!empty($postData)){
								foreach($postData as $kt=>$vt){
									$pst_id.=$vt['post_id'].",";
								}
								$pstId=rtrim($pst_id,",");
							}else{
								$pstId="";
							}
							$pst_data = $this->user_model->getPosts($userData["id"],$pstId);
							//print_r($post_data); die;
							if(!empty($pst_data)){
								$m=0;
								foreach($pst_data AS $key=>$val){
									if(!empty($val['image_name'])){
										$img[$m]['id']        = $val['id'];
										$img[$m]['image_name']= base_url()."pics/stream_imgs/" .$val['image_name'];
										 $m++;
									}
								}
							}else{
								$img=array();
							}
							if(!empty($pst_data)){
								$p=0;
								foreach($pst_data AS $k=>$v){
									if(!empty($v["image_name"])){
										$imageName = base_url()."pics/stream_imgs/" .$v["image_name"];
									}else{
										$imageName = "";	
									}
									$pst_data[$p]["id"]     	     = $v["id"];	
									$pst_data[$p]["user_id"]     	 = $v["user_id"];	
									$pst_data[$p]["item_image"]      = $imageName;  
									$pst_data[$p]["item_name"]       = $v["item_name"];         
									$pst_data[$p]["restaurant_name"] = $v["restaurant_name"];         
									$pst_data[$p]["tags"]            = $v["tags"];  
									$pst_data[$p]["address"]         = $v["address"];         
									$pst_data[$p]["latitude"]     	 = $v["latitude"];     	
									$pst_data[$p]["longitude"]    	 = $v["longitude"];    		
									$pst_data[$p]["comment"]         = $v["comment"];         
									$pst_data[$p]["average_rating"]  = $v["average_rating"];  
									$pst_data[$p]["saved_to_profile"]= $v["saved_to_profile"];
									$pst_data[$p]["created_ago"]     = $this->common->convert_time_days($v["time"]);
									 $p++;
								}
							}else{
								$pst_data=array();
							}
							if($userData['user_type'] == 2){
								$ratingAvg= $this->user_model->resturantAverageRating($userData["id"]);
								if(!empty($ratingAvg)){
									$data["rating"]  = round($ratingAvg["rating"]);
								}else{
									$data["rating"]  = 0;
								}
								$count_comment= $this->user_model->countPostComment($userData["id"]);
								if(!empty($count_comment)){
									$data["count_comment"]  = round($count_comment["ttl_comment"]);
								}else{
									$data["count_comment"]  = 0;
								}
							}
							$data["user_id"]       = (string)$userData["id"];
							$data["access_token"]  = $userData["access_token"];
							$data["email"] 	       = $userData['email'];
							$data["username"]      = $userData["username"];				
							$data["user_type"]     = (string)$userData["user_type"];
							$data["phone"]         = (string)$userData["phone"];
							$data["location"]      = $userData["location"];
							$data["latitude"]      = $userData["latitude"];
							$data["longitude"]     = $userData["longitude"];
							$data["description"]   = $userData["description"] ? $userData["description"] : "";
							$data["tags"]          = $userData["tags"] ? $userData["tags"] : "";					
							$data["register_date"] = $userData["posted"];
							$data["zip_code"]      = $userData["zip_code"];
							$data["facebook_link"] = $userData["facebook_link"] ? $userData["facebook_link"] : "";
							$data["twitter_link"]  = $userData["twitter_link"] ? $userData["twitter_link"] : "";
							$data["pinterest_link"]= $userData["pinterest_link"] ? $userData["pinterest_link"] : "";
							$data["instagram_link"]= $userData["instagram_link"] ? $userData["instagram_link"] : "";
							$data["images"]        = $img;
							if($userData['user_type'] == 1){
								$data["my_places"]     = $pstdta;
								$data["saved_item"]    = $pst_data;
							}
							if($userData['user_type'] == 2){
								$data["menu_item"]    = $pst_data;
								$data["comment_data"] = $cmt;
							}
							
							$dvar['result']  = true;

							$dvar['code']    = "200";
							$dvar['message'] = "Profile data loaded successfully.";
							$dvar['data']    = $data;
					}else{
						$dvar['result']  = false;
						$dvar['code']    = "201";
						$dvar['message'] = "Wrong user profile"; 
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 
	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}
/////////// no code below ///////////// 

	public function search_location(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else if($userId == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "User id should not be empty.";
		
			} else if($access_difficulty == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access of difficulty should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
				if(!empty($userData)){
					$radius = $radius ? $radius: 50;
					$address = $address ? $address : "";
					$pincode = $pincode ? $pincode : "";
					$source = $source ? $source : "";
					$destination = $destination ? $destination : "";
					$getLocation = $this->user_model->location_list_by($source, $destination, $pincode, $radius, $address, $access_difficulty );
					
					if(!empty($getLocation)){
						$i=0;
						foreach ($getLocation as $key => $value) {
					
							$data[$i]['id']  		= (string)$value["id"];
							$data[$i]['title']  	= $value["title"];
							$data[$i]['address']  	= $value["address"];
							$data[$i]['direction']  = $value["direction"];
							$data[$i]['pincode']  	= $value["pincode"];
							$data[$i]['latitude']  	= $value["latitude"];
							$data[$i]['longitude']  = $value["longitude"];
							$data[$i]['access_difficulty']  = $access_difficulty;
							$data[$i]['icon']  = $value["icon"];
							
							$data[$i]['image'] = array_filter(explode(",",$value['image']));
	 						// $data[$i]['audio'] = array_filter(explode(",",$value['audio']));
	 						// $data[$i]['video'] = array_filter(explode(",",$value['video']));



						$i++;
						}


					
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Post saved to profile successfully.";
						$dvar['path']  = base_url()."pics/location/";
						$dvar['data']  =$data;
					}else{
						$dvar['result']       = false;
						$dvar['code']         = "201";
						$dvar['message']      = "No location found.";
						$dvar['data']         = array();					
					
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 

	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}


	public function location_detail(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else if($locationId == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Location id should not be empty.";

			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);
				if(!empty($userData)){
				
					$getLocation = $this->user_model->getLoationDetail($locationId);
					if(!empty($getLocation)){
				
						$data['id']  		= (string)$getLocation["id"];
						$data['title']  	= $getLocation["title"];
						$data['address']  	= $getLocation["address"];
						$data['direction']  = $getLocation["direction"];
						$data['pincode']  	= $getLocation["pincode"];
						$data['latitude']  	= $getLocation["latitude"];
						$data['longitude']  = $getLocation["longitude"];
						$data['icon']  		= $getLocation["icon"];

						$data["image"]     =  array_filter(explode(",",$getLocation["image"]));
						$data["audio"]     =  array_filter(explode(",",$getLocation["audio"]));
						$data["video"]     =  array_filter(explode(",",$getLocation["video"]));
						$data['access_difficulty']  = $getLocation["access_difficulty"];

					
						$dvar['result']  = true;
						$dvar['code']    = "200";
						$dvar['message'] = "Location fetch successfully.";
						$dvar['path']  = base_url()."pics/location/";
						$dvar['data']  =$data;
					}else{
						$dvar['result']       = false;
						$dvar['code']         = "201";
						$dvar['message']      = "No location found arround you.";
						$dvar['data']         = array();					
					
					}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 

	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}

	public function help_support(){
		if($_POST){
			extract($_POST);
			if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			} else if($subject == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Subject should not be empty.";
			} else if($message == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Message should not be empty.";
			} else {
  				$userData = $this->user_model->getUserDataByAccessToken($access_token);

				if(!empty($userData)){
					
						$arr['userid'] = $userData['id'];
						$arr['subject'] = $subject;
						$arr['message'] = $message;


						$res=$this->user_model->save_admin($arr);
						if(!empty($res)){
							$dvar['result']  = true;
							$dvar['code']    = "200";
							$dvar['message'] = "Message sent successfully.";
						}else{
							$dvar['result']  = true;
							$dvar['code']    = "201";
							$dvar['message'] = "Failed to send.";						
						}
 	 			} 
				else {
	 				$dvar['result']  = false;
					$dvar['code']    = "202";
					$dvar['message'] = "Wrong access token"; 

	 			}				
			}	 		
		} else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;
	}


	public function notification_setting(){

		if($_POST){
	 		$access_token       = $this->input->post("access_token");
	 		$status       		= $this->input->post("status");
 	 		
  			$userData           = $this->user_model->getUserDataByAccessToken($access_token);
	 		if($access_token == ""){
				$dvar['result']  = false;
				$dvar['code']    = "201";
				$dvar['message'] = "Access token should not be empty.";
			}
			else if(empty($userData)){
				$dvar['result']  = false;
				$dvar['code']    = "202";
				$dvar['message'] = "Wrong access token"; 
			}  
			else if(empty($status)){
				$dvar['result']  = false;
				$dvar['code']    = "202";
				$dvar['message'] = "status should not be empty."; 
			}
   			else{
			
   				$arr['push_notification'] = $status == "true" ? 1 : 0 ;
				$res = $this->user_model->update_setting($arr,$userData['id']);
				if($res){
					$what = $arr['push_notification'] == 1 ? "activated" : "de-activated";
					$dvar['result']      = true;
					$dvar['code']        = "200";
					$dvar['message']     = "Notification setting ".$what." successfully.";
					//$dvar['data']        = $data;
				}
				else{
					$dvar['result']  = false;
					$dvar['code']    = "201";
					$dvar['message'] = "No data found";
					//$dvar['data']    = array();
				}
 	 		}
		} 
		else {
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Data empty!";
		}
		echo json_encode($dvar); die;


	}


}



?>