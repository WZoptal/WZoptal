
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
		$id = $arr["user_id"];
		unset($arr["user_id"]);
		$this->db->where("id", $id);
		return $this->db->update('users', $arr);
		
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
	 public function add_notifications($arr){
 		$arr['seen'] = 0;
 		$arr["date"] = time();
		$arr["time"] = time();
		$result = $this->db->insert("notifications", $arr);
		//echo $this->db->last_query();
		return $this->db->insert_id();
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
	// public function getPosts($user_id){
		// $this->db->select('*');
		// $this->db->from('stream');
		// $this->db->where(array("user_id" => $user_id,"status" => 1));
		// $query = $this->db->get();
		// return $query->result_array();
	// }
	public function getPosts($user_id,$ids){
		if(!empty($ids)){
			$where="user_id =".$user_id." AND status = 1 OR id IN($ids)";
		}else{
			$where="user_id =".$user_id." AND status = 1";
		}
		$this->db->select('*');
		$this->db->from('stream');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function home_post_list($user_id,$lat,$long,$limit, $no_of_post,$userId){
		$sql  = "select * FROM (SELECT *, (3959 * acos (cos(radians('".$lat."'))* cos(radians( latitude))* cos(radians(longitude) - radians('".$long."') )+ sin(radians('".$lat."'))* sin(radians(latitude)))) AS distances FROM (stream)) AS s  WHERE  status =1 AND distances < 30  OR user_id IN (".$userId.") order by id ASC";
		$this->db->limit($no_of_post,$limit);
		$result = $this->db->query($sql);
		return $result->result_array();
    }
	public function deletePost($post_id){
	  $this->db-> where('id',$post_id);
	 return $this-> db-> delete('stream');
	}
	public function follow_user($arr) {
		$arr["time"]       = time();
		$res = $this->db->insert("follower", $arr);
		return $res;	
	}
	function allready_followed($arr){
		$this->db->select('*');
		$this->db->from('follower');
		$this->db->where(array("user_id" => $arr['user_id'],"other_id" => $arr['other_id'],"status" => 1));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function unfollow_api($arr){
	$where="( user_id =".$arr['user_id']." AND other_id =".$arr['other_id'].") OR ( user_id =".$arr['other_id']." AND other_id =".$arr['user_id'].") AND status =1";
	  $this->db-> where($where);
	 return $this-> db-> delete('follower');
	}
	 public function update_stream_post($arr){
		$id = $arr["id"];
		unset($arr["id"]);
		$this->db->where("id", $post_id);
		return $this->db->update('stream', $arr);
	}
	public function post_like($arr) {
		$arr["time"]       = time();
		$res = $this->db->insert("post_like", $arr);
		return $res;	
	}
	function allready_liked($arr){
		$this->db->select('*');
		$this->db->from('post_like');
		$this->db->where(array("user_id" => $arr['user_id'],"post_id" => $arr['post_id'],"status" => 1));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function unlike_api($arr){
	$where=" user_id =".$arr['user_id']." AND post_id =".$arr['post_id']." AND status =1";
	  $this->db-> where($where);
	 return $this-> db-> delete('post_like');
	}
	public function post_comment($arr) {
		$arr["time"]       = time();
		$res = $this->db->insert("post_comment", $arr);
		return $res;	
	}
	public function user_bussiness_follow($id){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('id !=' => $id,"status" => 1));
		$query = $this->db->get();
		return $query->result_array();
	}
	function num_like($post_id){
		$this->db->select('*');
		$this->db->from('post_like');
		$this->db->where(array("post_id" => $post_id,"status" => 1));
		$query = $this->db->get();
		return $query->num_rows();
	}
	function num_commnet($post_id){
		$this->db->select('*');
		$this->db->from('post_comment');
		$this->db->where(array("post_id" => $post_id,"status" => 1));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function add_items($arr) {
		$arr["time"]       = time();
		$arr["status"]     = 1;
		$res = $this->db->insert("items", $arr);
		 //echo $this->db->last_query(); die;
		return $res;
		
	}
	public function update_items($arr,$item_id){
		$arr['time'] = time();
 		$this->db->where(array("id" => $item_id, "status" => 1));
		return $this->db->update('items', $arr);
  	}
	public function follow_request_list($user_id){
		$this->db->select('*');
		$this->db->from('follower');
		$this->db->where(array("user_id"=>$user_id,"accept_status"=>0));
		$query= $this->db->get();
		// echo $this->db->last_query(); die;
		return $query->result_array();
	
	}
	public function my_follow_listing($user_id){
		$this->db->select('*');
		$this->db->from('follower');
		$this->db->where(array("other_id"=>$user_id,"accept_status"=>1));
		$query= $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result_array();
	}
	public function update_follower_request($user_id,$other_id,$status){ 
		if($status == 1){
			$arr['accept_status'] = 1;
			$this->db->where(array("user_id"=>$other_id,"other_id"=>$user_id,"status"=>1));
			return $this->db->update('follower', $arr);
			
		}elseif($status == 2){
			$this->db-> where(array("user_id"=>$other_id,"other_id"=>$user_id,"status"=>1));
			$this-> db-> delete('follower');
			return $this->db->last_query(); die;
		}
  	}
	public function comment_item($arr) {
		$arr["time"]       = time();
		$res = $this->db->insert("item_comment", $arr);
		return $res;	
	}
	public function item_like($arr) {
		$arr["time"]       = time();
		$res = $this->db->insert("item_like", $arr);
		return $res;	
	}
	function item_allready_liked($arr){
		$this->db->select('*');
		$this->db->from('item_like');
		$this->db->where(array("user_id" => $arr['user_id'],"item_id" => $arr['item_id'],"status" => 1));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function item_unlike_api($arr){
	$where=" user_id =".$arr['user_id']." AND item_id =".$arr['item_id']." AND status =1";
	  $this->db-> where($where);
	 return $this-> db-> delete('item_like');
	}
	function getItemData($item_id){
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where(array('id' => $item_id, "status" => 1));
		$query = $this->db->get();
		return $query->row_array();
	}
	function getItems_Data($item_id){
		$this->db->select('*');
		$this->db->from('item_comment');
		$this->db->where(array('item_id' => $item_id, "status" => 1));
		$query = $this->db->get();
		return $query->result_array();
	}
	function getItemsLike_Data($item_id){
		$this->db->select('*');
		$this->db->from('item_like');
		$this->db->where(array('item_id' => $item_id, "status" => 1));
		$query = $this->db->get();
		return $query->result_array();
	}
	function getAllUser_Data($user_id){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('user_type' => 2,"status <>" => 4,'archive' => 0));
		$query = $this->db->get();
		return $query->result_array();
	}
	public function add_category($arr) {
		$arr["time"]     = time();
		$arr["status"]   = 1;
        $res=$this->db->insert("category", $arr);
		return $this->db->insert_id();	
	}
	function getItemsData($user_id,$category_id){
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where(array('user_id' => $user_id,'category_id' => $category_id, "status" => 1));
		$query = $this->db->get();
		return $query->result_array();
	}
	function category_listing($search,$user_id){
		$this->db->select('*');
		$this->db->from('category');
		if(!empty($search)){
			$where ="status=1 AND user_id = ".$user_id." AND category_name LIKE '%".$search."%' ";
		}else{
			$where ="status=1 AND user_id = ".$user_id;
		}
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}
	function post_itemdata_listing($search){
		$this->db->select('*');
		$this->db->from('stream');
		if(!empty($search)){
			$where ="status=1 AND restaurant_name LIKE '%".$search."%' OR tags LIKE '%".$search."%' ";
		}else{
			$where ="status=1";
		}
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}
	function business_data_listing($search){
		$this->db->select('*');
		$this->db->from('users');
		if(!empty($search)){
			$where ="status=1 AND username LIKE '%".$search."%' OR tags LIKE '%".$search."%' ";
		}else{
			$where ="status=1 ";
		}
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}
	function getDataItems($user_id){
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where(array('user_id' => $user_id,"status" => 1));
		$query = $this->db->get();
		return $query->result_array();
	}
	function getAllPlaces_Data($user_id,$search){
	 if(!empty($search)){
		$where="id !=".$user_id." AND user_type =2 AND status <> 4 AND archive = 0 AND username LIKE '%".$search."%'  OR tags LIKE '%".$search."%'";
	 }else{
		$where="id !=".$user_id." AND user_type = 2 AND status <> 4 AND archive= 0";
	 }
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function near_me_places($user_id,$search,$lat,$long,$limit, $no_of_post,$distance){
		if(!empty($search)){
			$where=" AND id !=".$user_id." AND user_type =2 AND status <> 4 AND archive = 0 AND username LIKE '%".$search."%'  OR tags LIKE '%".$search."%'  order by id ASC";
		}else{
			$where=" AND id !=".$user_id." AND user_type = 2 AND status <> 4 AND archive= 0  order by id ASC";
		}
		$sql  = "select * FROM (SELECT *, (3959 * acos (cos(radians('".$lat."'))* cos(radians( latitude))* cos(radians(longitude) - radians('".$long."') )+ sin(radians('".$lat."'))* sin(radians(latitude)))) AS distances FROM (users)) AS i  WHERE id <> '".$user_id."' AND distances < ".$distance." ".$where;
		$this->db->limit($no_of_post,$limit);
		$result = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		return $result->result_array();
    }
	public function post_unsave_profile($arr){
		$where=" user_id =".$arr['user_id']." AND post_id =".$arr['post_id']." AND status =1";
	  $this->db-> where($where);
	 return $this-> db-> delete('post_save_profile');
	}
	function post_alredy_saved($arr){
		$this->db->select('*');
		$this->db->from('post_save_profile');
		$this->db->where(array("user_id" => $arr['user_id'],"post_id" => $arr['post_id'],"status" => 1));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function post_save_profile($arr) {
		$arr["time"]     = time();
		$arr["status"]   = 1;
        $res=$this->db->insert("post_save_profile", $arr);
		return $this->db->insert_id();	
	}
	function posts_commnets($post_id){
		$this->db->select('*');
		$this->db->from('post_comment');
		$this->db->where(array("post_id" => $post_id,"status" => 1));
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function add_device($arr) {
		$arr["time"]       = time();
		$arr["status"]     = 1;
		$res = $this->db->insert("devices", $arr);
		 //echo $this->db->last_query(); die;
		return $res;
		
	}
	
	
	public function getSavedPosts($user_id){
		$this->db->select('*');
		$this->db->from('post_save_profile');
		$this->db->where(array("status" => 1,"user_id" =>$user_id));
		$query = $this->db->get();
		return $query->result_array();
	}
	function followedUser($user_id){
		$this->db->select('*');
		$this->db->from('follower');
		$this->db->where(array("user_id" => $user_id,"status" => 1));
		$query = $this->db->get();
		return $query->result_array();
	}
	public function refresh_suggestion_data($user_id){
	$this->db->where(array("status" => 0));
	return $this->db->delete("follower");
}
	public function get_suggestion_data($user_id){
		$this->db->select('*');
		$this->db->from('follower');
		$this->db->where("(user_id ='".$user_id."' OR other_id='".$user_id."') AND (accept_status = 1  OR accept_status = 3) AND status !=0");
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result_array();
	}
	public function suggestion_listing($str_data, $limit, $no_of_post,$user_id){
		//print_r($str_data); exit;
		$this->db->select('*');
		$this->db->from('users');
		if($str_data <> ''){
			$where="id NOT IN($str_data) AND id !='".$user_id."' AND status=1";
		}else{
			$where="id !='".$user_id."' AND status=1";
		}
		$this->db->where($where);
		$this->db->order_by('id asc');
		$this->db->limit($no_of_post, $limit);
 		$query  = $this->db->get();
		 //echo $this->db->last_query();
		return $query->result_array();
	}
	public function check_friend_request_already_sent($friend_id,$userId){
		$this->db->select('*');
		$this->db->from('follower');
		$this->db->where(("user_id ='".$userId."' AND other_id='".$friend_id."'  AND status !=0 AND accept_status IN(0,1)" ));
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->row_array();
	}
	public function comment_data($user_id){
		$sql="SELECT * FROM `stream` WHERE business_id =".$user_id;
		$result = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		return $result->result_array();
    }
	public function resturantAverageRating($user_id){
		$sql="SELECT AVG(average_rating) AS rating FROM `stream` WHERE business_id=".$user_id;
		$result = $this->db->query($sql);
		return $result->row_array();
    }
	public function countPostComment($business_id){
		$sql="SELECT count(id) AS ttl_comment FROM `stream` WHERE business_id=".$business_id;
		$result = $this->db->query($sql);
		return $result->row_array();
    }
	public function follow_listing($user_id,$type){
		$this->db->select('*');
		$this->db->from('follower');
		if($type == 1){
			$this->db->where(array("user_id"=>$user_id,"accept_status"=>1));
		}else{
			$this->db->where(array("other_id"=>$user_id,"accept_status"=>1));
		}
		$query= $this->db->get();
		return $query->result_array();
	}
	function getDataItemsByID($item_id){
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where(array('id' => $item_id,"status" => 1));
		$query = $this->db->get();
		return $query->result_array();
	}
	function getDataItemsByID_one($item_id){
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where(array('id' => $item_id,"status" => 1));
		$query = $this->db->get();
		return $query->row_array();
	}

	############ hubub only #######
	public function add_music($arr) {
		$arr["time"]       = time();
		$arr["status"]     = 1;
		$res = $this->db->insert("musics", $arr);
		 //echo $this->db->last_query(); die;
		return $res;
		
	}

	function getTagsTracks($user_id){
		$this->db->select('*');
		$this->db->from('musics');
		$this->db->where(array('user_id' => $user_id,"status" => 1));
		$query = $this->db->get();
		return $query->result_array();
	}
	function addprofileSetting($user_id){
		$arr["user_id"]       = $user_id;
		$arr["time"]       = time();
		$arr["status"]     = 1;
		$res = $this->db->insert("user_profile_settings", $arr);
		 //echo $this->db->last_query(); die;
		return $res;
	}
	public function getProfileSetting($user_id){
		$this->db->select('*');
		$this->db->from('user_profile_settings');
		$this->db->where(array('user_id' => $user_id,"status" => 1));
		//echo $this->db->last_query(); die;
		$query = $this->db->get();
		return $query->row_array();
	}
	public function update_profile_setting($arr){
		$id = $arr["user_id"];
		unset($arr["user_id"]);
		$this->db->where("user_id", $id);
		 //echo $this->db->last_query(); die;
		return $this->db->update('user_profile_settings', $arr);
	}
	function fav_alredy_saved($arr){
		$this->db->select('*');
		$this->db->from('fav_save_profile');
		$this->db->where(array("user_id" => $arr['user_id'],"fav_id" => $arr['fav_id'],"status" => 1));
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function fav_unsave_profile($arr){
		$where=" user_id =".$arr['user_id']." AND fav_id =".$arr['fav_id']." AND status =1";
	  $this->db-> where($where);
	 return $this-> db-> delete('fav_save_profile');
	}
	public function fav_save_profile($arr) {
		$arr["time"]     = time();
		$arr["status"]   = 1;
        $res=$this->db->insert("fav_save_profile", $arr);
		return $this->db->insert_id();	
	}
	public function fav_get_profile($user_id) {
		$this->db->select('*');
		$this->db->from('fav_save_profile');
		$this->db->where(array("user_id" => $user_id,"status" => 1));
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result_array();
	}
	public function get_user_by($track_id){
		$this->db->select('*');
		$this->db->from('musics');
		$this->db->where(array('id' => $track_id,"status" => 1));
		$query = $this->db->get();
		return $query->row_array();
	}
	function addTrackasFavPlayList($arr){
		$arr["time"]       = time();
		$arr["status"]     = 1;
		$res = $this->db->insert("my_fav_list", $arr);
		return $res;
	}
	public function getUserDetails($user_id){
 		$this->db->select('*');
 		$this->db->from('users');
 		$this->db->where(array('id' => $user_id));
 		$query  = $this->db->get();
 		return $query->row_array(); 		
 	}
	public function getUserFavTrack($user_id,$type){
		$this->db->select('*');
 		$this->db->from('my_fav_list');
 		$this->db->where(array('user_id' => $user_id, 'add_to_playlist'=>$type));
 		$query  = $this->db->get();
		//echo $this->db->last_query(); die;
 		return $query->result_array(); 
	}
	public function getAllArtist($no_of_post,$limit){
		$this->db->select('*');
 		$this->db->from('users');
 		$this->db->where(array('user_type'=>2));
		$this->db->limit($no_of_post,$limit);
 		$query  = $this->db->get();
		
		//echo $this->db->last_query(); die;
 		return $query->result_array(); 
	}
	public function getArtistTrackCount($user_id){
		
		$this->db->select('*');
 		$this->db->from('musics');
 		$this->db->where(array('user_id'=>$user_id , 'status'=>1));
 		$query  = $this->db->get();
 		return $query->num_rows();
		
	}
	
	########### Chat ############
	
	public function getConversationThred($userData,$other_user_id){
 	    $this->db->select("conversation_id");
		$this->db->from("chat_tbl");
		$where ="((other_user_id = '".$other_user_id."' AND user_id = '".$userData."') OR (other_user_id = '".$userData."' AND user_id = '".$other_user_id."'))";
		$this->db->where($where);
	    $query = $this->db->get();
		//echo $this->db->last_query(); die;
 	 	$data = $query->row_array();
		return $data;
	}
	public function chat_api($arr){
 		$arr['status'] = 1;
		$arr["time"] = time();
		$result = $this->db->insert("chat_tbl", $arr);
		return $this->db->insert_id();
	}
	public function getconversation($conversation_id, $limit, $no_of_post){
		$this->db->select("*");
		$this->db->from("chat_tbl");
		$where = "conversation_id = '".$conversation_id."' AND status = 1";
		$this->db->where($where);
 		$this->db->order_by('id asc');
		$this->db->limit($no_of_post, $limit);
		$query  = $this->db->get();
		//echo $this->db->last_query();die;
		$result = $query->result_array();
		return $result;
	}
	public function getInboxMesg($user_id, $limit, $no_of_post){
		$this->db->select("*");
		$this->db->from("chat_tbl");
		$where = "(user_id = '".$user_id."' OR other_user_id = '".$user_id."') AND status <> 4";
		$this->db->where($where);
		$this->db->group_by('conversation_id');
		$this->db->order_by('id desc');
		$this->db->limit($no_of_post, $limit);
		$query  = $this->db->get();
		//echo $this->db->last_query();die;
		$result = $query->result_array();
		return $result;
	}
	public function getLatestMessage($conversation_id){
		$this->db->select("*");
		$this->db->from("chat_tbl");
		$where = "conversation_id = '".$conversation_id."' AND status <> 4";
		$this->db->where($where);
 		$this->db->order_by('id desc');
		$this->db->limit(1);
		$query  = $this->db->get();
		//echo $this->db->last_query();die;
		$result = $query->row_array();

		return $result;

	}
	public function getSearchData($search,$no_of_post,$limit){
		$this->db->select("*");
		$this->db->from("users");
		$where = " ( name like '%".$search."%' OR username like '%".$search."%' OR location like '%".$search."%')  AND status = 1";
		$this->db->where($where);
 		$this->db->order_by('id desc');
		$this->db->limit($no_of_post,$limit);
		$query  = $this->db->get();
		//echo $this->db->last_query();die;
		$result = $query->result_array();

		return $result;

	}
	public function send_invitation($arr) {
		$arr["time"]     = time();
		$arr["status"]   = 1;
        $res=$this->db->insert("invite", $arr);
		return $this->db->insert_id();	
	}
	
//////////////////////////////////////////////////////////	 
}
?>