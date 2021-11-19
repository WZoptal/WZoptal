<?php 
ob_start();
class Login_model extends CI_Model { 
    function __construct(){
        parent::__construct();
    }
	
/************************************************* Admin login functions starts ***********************************************/	

	//for validate admin username
	public function check_admin_login($arr){
		$this->db->select("*");
		$this->db->from("admin");
		$this->db->where(array("username" => $arr["username"]));
		$result=$this->db->get();
		$countrows=$result->num_rows();
		$result=$result->row_array();
		return $result;
 	}
	
	//for get admin data
	public function get_adminData($id){
		$this->db->select("*");
		$this->db->from("admin");
		$this->db->where(array("id" => $id));
		$result=$this->db->get();
	   //echo $this->db->last_query();die;
		$countrows=$result->num_rows();
		$result=$result->row_array();
		return $result;
 	}
	
 	//for update admin password
	public function update_admin_data($arr, $table){
		$arr["password"] = $this->common->salt_password($arr);
		$id = $arr["id"];
		unset($arr["id"]);
		$this->db->where("id",$id);
		$rws = $this->db->update($table,$arr);
		return $rws;
	}
	
	//for update email status
	public function user_email_verify($lgId){		
		$arr = array("verified" => 1, "status" => 1);
		$this->db->where(array('id' => $lgId));
        if($this->db->update("users", $arr)){
			return true;
		}
		else{
			return false;	
		}
	}
	
	//for get admin data by username
	public function getAdminData($username){
		$this->db->select("*");
		$this->db->from("admin");
		$where = "username = '".$username."' OR email = '".$username."'";
		$this->db->where($where);
		$result=$this->db->get();
		$result = $result->row_array();
		return $result;
	}
	
	//for update admin password
	public function updateAdminPassword($arr){
		$id = $arr['id'];
		unset($arr['id']);
		$this->db->where(array('id' => $id));
		return $this->db->update("admin", $arr);
	}
	
/************************************************* Admin login functions ends *************************************************/
	########### micro website function ##############


	public function login_user($email, $pass){ 
       
		$this->db->select("*");
		$this->db->from("users");
		$where = "email = '".$email."'";
		$this->db->where($where);
		$result=$this->db->get();
		///echo $this->db->last_query();die;
		$result = $result->row_array();
		return $result;
       
    }

    public function count_user(){ 
       
		$this->db->select("*");
		$this->db->from("users");
		$user=$this->db->get();
		///echo $this->db->last_query();die;
		$user = $user->num_rows();
		
		$this->db->select("*");
		$this->db->from("episodes");
		$episodes=$this->db->get();
		///echo $this->db->last_query();die;
		$episodes = $episodes->num_rows();

		$this->db->select("*");
		$this->db->from("locations");
		$locations=$this->db->get();
		///echo $this->db->last_query();die;
		$locations = $locations->num_rows();

		$this->db->select("*");
		$this->db->from("subscription");
		$subscription=$this->db->get();
		///echo $this->db->last_query();die;
		$subscription = $subscription->num_rows();


		return array('user'=>$user, 'episodes'=> $episodes, 'locations'=>$locations,'subscription'=>$subscription );
       
    }





}