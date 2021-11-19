<?php 
class Location_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	
 	/*************************************Category function starts*****************************/
	
	public function getCategoryData($searchdata=array()){
		$searcharray=array("status"=>"status");		
		if(!isset($searchdata["page"]) || $searchdata["page"]==""){
			$searchdata["page"]=0;	
		}
	    if(!isset($searchdata["countdata"])){	
			if(isset($searchdata["per_page"]) && $searchdata["per_page"]!=""){
				$recordperpage=$searchdata["per_page"];	
			}
			else{
				$recordperpage=1;
			}
			if(isset($searchdata["page"]) && $searchdata["page"]!=""){
				$startlimit=$searchdata["page"];	
			}
			else{
				$startlimit=0;
			}
		}
		
		$this->db->select("*");
		$this->db->from("locations");
		//$this->db->join("blogs_categories","blogs_categories.id=blogs.categories");
		if(isset($searchdata["search"]) && $searchdata["search"]!="" && $searchdata["search"]!="search"){
			$this->db->like("locations.title",$searchdata["search"]);	
		}	
		foreach($searchdata as $key=>$val){
			if(isset($searcharray[$key]) && $searchdata[$key]!=""){
				if(array_key_exists($key,$searcharray)){
					$where=array($searcharray[$key]=>$val);
					$this->db->where($where);
				}
			}
		}		
		/*if($searchdata["type"]=="activated")
		{
			$where=array("blogs.status"=>"1");	
			$this->db->where($where);	
		}*/
		$where=array("locations.status <>"=>"4");
		$this->db->where($where);		
		if(isset($searchdata["per_page"]) && $searchdata["per_page"]!=""){
			if(isset($recordperpage) && $recordperpage!="" && ($startlimit!="" || $startlimit==0)){
				$this->db->limit($recordperpage,$startlimit);
			}
		}
		$this->db->order_by("title ASC");
		$query = $this->db->get();
		$resultset=$query->result_array();
		return $resultset; 
	}
	
	
	public function add_edit_episode($arr){//print_r($arr); die;
		if($arr["id"] == ""){
			$arr["created_at"] = time();
			$arr["updated_at"] = time();
			$arr["time"]   = time();
			$arr["status"] = 1;
			$res = $this->db->insert("locations",$arr);	//echo $this->db->last_query(); die;
			return $res;
		}	
		else{
 			$arr["time"] = time();
 			$arr["updated_at"] = time();
			$this->db->where("id", $arr["id"]);
			$res = $this->db->update("locations",$arr);  //echo $this->db->last_query(); die;
			if($res){
				$arr["updated_at"] = time();
				$arr1["time"] = time();
				$arr1["title"] = $arr["title"];
				$this->db->where("id", $arr["id"]);
				$this->db->update("locations",$arr1);  //echo $this->db->last_query(); die;
			}
			return $res;
		}	
	}
	
	public function getIndividualEpisode($id){
		$this->db->select("*");	
		$this->db->from('locations');
		$where=array("id"=>$id, "status <> " => "4");
		$this->db->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$resultset=$query->row_array();
		return $resultset;		
	}
	
 	
	public function enable_disable_episode($id,$status){
		$this->db->where("id",$id);
		$array=array("status"=>$status);
		$this->db->update("locations",$array);		
	}
	
	public function archive_episode($id){
		$where=array("id"=>$id);
		$array=array("status"=>4);
		$this->db->where($where);
		$this->db->update("locations",$array);
	}	
	
	public function deletelocaltion($id){
	  $this->db-> where('id',$id);
	 return $this-> db-> delete('locations');
	}
	
	
	/*************************************Category function starts*****************************/
	
	
}
?>