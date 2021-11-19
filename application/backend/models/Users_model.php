<?php
class Users_model extends CI_Model{
    function __construct(){ 
        parent::__construct();
    }
	
 	public function getuserData($searcharray = array(), $user_type){
        $recordperpage = "";
        $startlimit    = "";
        if (!isset($searcharray["page"]) || $searcharray["page"] == "")
        {
            $searcharray["page"] = 0;
        }
        if (!isset($searcharray["countdata"]))
        {
            if (isset($searcharray["per_page"]) && $searcharray["per_page"] != "")
            {
                $recordperpage = $searcharray["per_page"];
            }
            else
            {
                $recordperpage = 1;
            }
            if (isset($searcharray["page"]) && $searcharray["page"] != "")
            {
                $startlimit = $searcharray["page"];
            }
            else
            {
                $startlimit = 0;
            }
        }
        $sql = "SELECT * FROM users where user_type = '".$user_type."' AND status <> 4";
        if (isset($searcharray["search"]) && $searcharray["search"] != "")
        {
            $sql .= " AND email like '%" . $searcharray["search"] . "%' OR username like '%" . $searcharray["search"] . "%'";
        }
        if (isset($searcharray["page"]) && $searcharray["page"] != "")
        {
            if ($recordperpage != "" && ($startlimit != "" || $startlimit == 0))
            {
                $sql .= " order by id desc limit  $startlimit,$recordperpage";
            }
        }
		$sql .= " ";
         $query     = $this->db->query($sql);
		
        //echo $this->db->last_query();die;
        $resultset = $query->result_array();
        //print_r($resultset);die;
        return $resultset;
    }
    public function view_user($id){
        $this->db->select("*");
        $this->db->from('users');
        $where = array("id" => $id,"archive <> " => 1);
        $this->db->where($where);
        $query     = $this->db->get();
        //echo $this->db->last_query();
        $resultset = $query->row_array();
        return $resultset;
    }

    public function get_user_details($id){
        $this->db->select("*");
        $this->db->from('users');
        $where = array("id" => $id);
        $this->db->where($where);
        $query     = $this->db->get();
        //echo $this->db->last_query();
        $resultset = $query->row_array();
        return $resultset;
    }
    public function enable_disable_user($id, $status){
        $this->db->where("id", $id);
        $arr = array("status" => $status);
        return $this->db->update("users", $arr);
        //return $this->db->last_query();
    }
    public function archive_user($id){
        $this->db->where("id", $id);
        $arr = array("status" => 4, 'archive' => 1);
        return $this->db->update("users", $arr);
        //return $this->db->last_query();
    }
    public function delete_user($id){
        $this->db->where("id", $id);
        $arr = array("archive" => 1);
        return $this->db->update("users", $arr);
        //	echo $this->db->last_query();
    }

    public function did_delete_row($id){
        $this -> db -> where('id', $id);
        $this -> db -> delete('users');
    }


	//for set user password
	public function changePassword($arr){
		$id = $arr["id"];
		unset($arr["id"]);
		$this->db->where("id", $id);
		$res = $this->db->update('users', $arr);
		if($res){
			$response = true;
		}
		else{
			$response = false;
		}
		return $response;
	}

	
	//for update user profile data
	 public function add_user($arr){
		 if($arr["id"] <> ''){
		    $arr["time"] = time();
			$id          = $arr["id"];
			unset($arr["id"]);
			$this->db->where(array("id" => $id));
			$result = $this->db->update("users",$arr);
			//echo $this->db->last_query(); die;
		 }
		 else{
			  unset($arr['id']);
			  $arr['status']     = 1;
			  $arr["time"]       = time();
			  $arr["created_on"] = time();
			  $result = $this->db->insert("users",$arr);
			 // echo $this->db->last_query(); die;
 		 }
 		  return $result;
	 }
	
    //for user category	
    public function getIndividualUser($user_id){
        $this->db->select("*");
        $this->db->from('users');
        $where = array("id" => $user_id, "status <> " => "4");
        $this->db->where($where);
        $query     = $this->db->get();
        $resultset = $query->row_array();
        return $resultset;
    }
    //for paypal	
    public function getpaypal(){
        $id = $this->session->userdata("id");
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where(array('id' => $id));
        //$this->db->limit(1);
        //$this->db->order_by("services.id DESC");
        $query     = $this->db->get();
        //echo $this->db->last_query();
        $resultset = $query->row_array();
        return $resultset;
    }
    public function edit_paypal($arr){
        $id = $arr["id"];
        unset($arr["id"]);
        $this->db->where("id", $id);
        $result = $this->db->update("admin", $arr);
        //echo $this->db->last_query(); die;
        return $result;
    }
 	
 	
 	
 	
     //////////////////////////////////////////////////////////////////////////////	
}
?>