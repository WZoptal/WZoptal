<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal_model extends  CI_Model{ 
	
	public function __construct()
	{
			// Call the CI_Model constructor
			parent::__construct();
	}
	function select_row($table='',$field='',$where=''){
		
		$result = false;
		if($table != '' && $field !=''){
			$this->db->select($field);
			if(is_array($where) && count($where) > 0){
				$this->db->where($where);
			}
			$query = $this->db->get($table);
			$result=$query->row();
		}
		return $result;
	}

	 function update($table,$where,$data){
        $this->db->where($where);
        $update = $this->db->update($table,$data);    
        $this->db->last_query() ;  
        if($update) 
            return TRUE;
        else 
            return FALSE;
    }

    function insert($table, $data){
		$this->db->insert($table,$data);
		$num = $this->db->insert_id();
		if($num)
			return $num;
		else
			return FALSE;
	}


    function delete($table,$where)
    {
        $table=$table;
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }

    function getWhereRowSelect($table,$where,$select='*'){ 
        $this->db->select($select);
        $this->db->where($where);
        $getdata = $this->db->get($table);      
        $result = $getdata->row();
        return $result;
    }

    function emailsend($email,$subject,$body,$from){
    $headers = 'From: BHPS<'.ADMIN_EMAIL_SEND.'>' . "\r\n" .
            'Reply-To:<'.ADMIN_EMAIL_SEND.'>' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
           //return $body;
         $mail_send = mail($email,$subject,$body,$headers);
         if ($mail_send) {
		    return true;
    	} else {
    		return false;
    	}
}



}

?>