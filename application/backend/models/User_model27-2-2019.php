<?php
class User_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function ulogin($arr){
		$sql = "select * from users where (username = '".$arr['email']."' OR email = '".$arr['email']."') AND archive = 0"; 
		$query = $this->db->query($sql);
		$result = $query->row_array();
		if(!empty($result)){
			if($this->common->validateHash($arr["password"], $result["password"])) {
				if ($result['status'] == 1) {
					$response = $result["id"];
				} else if ($result['status'] == 0) {
					$response = "inactive";
				} else if ($result['status'] == 2) {
					$response = "block";
				}
			} else {
				$response = "wrong_pass";
			}
		} else {
			$response = "wrong_user";
		}
		return $response;
	}
	
 	public function getLoginSessionData($user_id){
		$this->db->select("id as user_id, email, title, user_type");
		$this->db->from('users');
		$this->db->where("id", $user_id);
		$this->db->where("status", 1);
		$this->db->where("archive", 0);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function changePassword($arr){
		$this->db->select("*");
		$this->db->from('users');
		$this->db->where(array("id" => $arr['user_id'], "status" => 1, "archive <> " => 1));
		$query = $this->db->get();
		$result = $query->row_array();
		$response = false;
		if($this->common->validateHash($arr["old_password"], $result["password"])) {
			$id = $arr["user_id"];
			unset($arr["user_id"]);
			unset($arr["old_password"]);
			$this->db->where("id", $id);
			$this->db->update('users', $arr);
			$response = true;
		}
		return $response;
	}

	public function get_user_list($id, $blocked_users){
		$this->db->select("id, username, name, profile_pic");
		$this->db->from('users');
		$where = array("status" => 1, "user_type" => 2, "id <>" => $id);
		$this->db->where($where);
		if(!empty($blocked_users)){
			$this->db->where_not_in('id', $blocked_users);
		}
		$this->db->order_by("username asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function user_profile_data($user_id){ 
		$this->db->select("*");
		$this->db->from('users');
		$where = array("id" => $user_id, 'archive <> ' => 1, 'status =' => 1);
		$this->db->where($where);
		$query = $this->db->get();
	//echo $this->db->last_query(); die;
		return $query->row_array();
	}
  
	public function add_edit_user($arr){
		if ($arr["oldimage"] == 1) {
			$this->db->select("*");
			$this->db->from("users");
			$this->db->where("id", $arr["user_id"]);
			$query = $this->db->get();
			$Images = $query->row_array();
			$Images['image'];
			unlink('pics/' . $Images['image']);
		}

		$id = $arr["id"];
		unset($arr["id"]);
		unset($arr["oldimage"]);
		$this->db->where("id", $id);
		$result = $this->db->update("users", $arr);
		return $result;
	}
	
  	public function add_user($arr) {
		$arr["posted"]     = time();
		$arr["last_login"] = time();
		$arr["time"]       = time();
		$arr["status"]     = 1;
		$res = $this->db->insert("users", $arr);
		 //echo $this->db->last_query(); die;
		return $res;
		
	}
	
	// for signup/login with facebook
	public function add_user_fb($arr){
   		$this->db->select("*");	
		$this->db->from('users');
		$where = "email = '".$arr["email"]."' OR fb_id='".$arr["fb_id"]."'";
   		$this->db->where($where);
  		$query = $this->db->get();
 		$num_row = $query->num_rows();
		if($num_row == 0){
			$arr['status']      = 1;
			$arr["time"]        = time();
			$arr["last_login"]  = time();
			$arr["created_on"] = time();
			$this->db->insert("users", $arr);
			$result = $this->db->insert_id();
			return $result;
		}
		else{
			$resultr = $query->row_array();
			$fb_id = $arr["fb_id"];
			unset($arr["fb_id"]);
			$where = "email = '".$arr["email"]."' OR fb_id='".$fb_id."'";
			$this->db->where($where);
			// print_r($arr); die;
			$result = $this->db->update("users", $arr);
			//echo $this->db->last_query(); die;
			return $resultr['id'];
		}
	}
	
	public function validateFacebookId($fb_id){
   		$this->db->select("*");	
		$this->db->from('users');
   		$this->db->where(array('fb_id' => $fb_id));
  		$query = $this->db->get();
 		$res = $query->row_array();
		return $res;
	}
	
	function get_user_data($user_id){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('id' => $user_id,"status <>" => 4, 'archive' => 0));
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_user_data_by_email($email){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('email' => $email, "status" => 1, 'archive' => 0));
		$query = $this->db->get();
		return $query->row_array();
	}

 	public function getUserDataByAccessToken($access_token){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('access_token' => $access_token, "status" => 1));
		$query = $this->db->get();
		return $query->row_array();
	}

 	public function userLogout($id){
		$data['access_token'] = "";
		$data['device_token'] = "";
		$data['device_type']  = "";
		$this->db->where(array('id' => $id));
		return $this->db->update("users", $data);
	}
	public function update_profile_data($arr){
		$id = $arr["id"];
		unset($arr["id"]);
		$this->db->where("id", $id);
		return $this->db->update('users', $arr);
	}
      
	public function getUserDetails($user_id){
 		$this->db->select('*');
 		$this->db->from('users');
 		$this->db->where(array('id' => $user_id));
 		$query  = $this->db->get();
 		return $query->row_array(); 		
 	}
	
 	public function getAllUserDataByAccessToken($user_id){
 		$this->db->select('*');
 		$this->db->from('users');
 		$this->db->where(array('id <> ' => $user_id, "status" => 1));
 		$query  = $this->db->get();
 		return $query->result_array(); 		
 	}
	
	public function verify_email($id){
		$arr = array("verified" => 1);
		$this->db->where(array('id' => $id));
		$result = $this->db->update("users", $arr);
		//echo $this->db->last_query(); die;
		if ($result) {			
			$data = 1;
		} else {
			$data = 0;
		}
		return $data;
	}
	 
 	public function getNotificationList($user_id, $limit, $no_of_post){
 		$this->db->select("*");
		$this->db->from("notifications");
		$where = "receiver = '".$user_id."'"; // AND (time >= '".$arr['from']."' AND time <= '".$arr['to']."'
  		$this->db->where($where);
		$this->db->order_by('id desc');
		$this->db->limit($no_of_post, $limit);
 		$query = $this->db->get();
		 //   echo $this->db->last_query();die;
 		$resultset = $query->result_array();	
 		return $resultset;	
	}
	
	public function markNotificationAsRead($user_id){
		$arr['seen'] = 1;
		$arr['time'] = time();
 		$this->db->where(array("receiver" => $user_id, "notification" => "message"));
		return $this->db->update('notifications', $arr);
  	}
	public function add_post_stream($arr) {
		$arr["time"]       = time();
		$arr["status"]     = 1;
		$res = $this->db->insert("stream", $arr);
		 //echo $this->db->last_query(); die;
		return $res;
		
	}
	function getPostData($post_id){
		$this->db->select('*');
		$this->db->from('stream');
		$this->db->where(array('id' => $post_id, "status" => 1));
		$query = $this->db->get();
		return $query->row_array();
	}
	function getPosts(){
		$this->db->select('*');
		$this->db->from('stream');
		$this->db->where(array("status" => 1));
		$query = $this->db->get();
		return $query->result_array();
	}
	public function home_post_list($user_id,$lat,$long,$limit, $no_of_post){
		$sql  = "select * FROM (SELECT *, (3959 * acos (cos(radians('".$lat."'))* cos(radians( latitude))* cos(radians(longitude) - radians('".$long."') )+ sin(radians('".$lat."'))* sin(radians(latitude)))) AS distances FROM (stream)) AS s  WHERE user_id <> '".$user_id."' AND status =1 AND distances < 30  order by id ASC";
		$this->db->limit($no_of_post,$limit);
		$result = $this->db->query($sql);
		return $result->result_array();
    }
	public function deletePost($post_id){
	  $this->db-> where('id',$post_id);
	 return $this-> db-> delete('stream');
	}
//////////////////////////////////////////////////////////	 
}
?>