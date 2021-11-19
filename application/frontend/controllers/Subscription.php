<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class subscription extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('subscription_model');
  		$this->load->model('user_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		
			$this->manage_subscription();
     		
    
	}

 	public function manage_subscription(){     
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
	    $config['base_url']=base_url()."home?".$this->common->removeUrl("per_page",$_SERVER["QUERY_STRING"]);
	    $countdata=array();
	    $countdata=$_GET;
	    $countdata["countdata"]="yes";  
	    
	    $config['total_rows']=count($this->subscription_model->getSubscriptionData($countdata));   
	    $config["uri_segment"]=(isset($_GET["per_page"]) && $_GET["per_page"]!="")?$_GET["per_page"]:"0";

	    $this->pagination->initialize($config);
	    /*--------------------------Paging code ends---------------------------------------------------*/

	    if(!empty($this->session->userdata('logged_in'))){   

	 		$data["userData"] = $this->user_model->get_user_data($this->session->userdata('id'));
	 	}else{

 			$data['userData'] =array();
	 	}


	    $searcharray=array();
	    $searcharray=$_GET;
	    $searcharray["per_page"]=$config["per_page"];
	    $searcharray["page"]=$config["uri_segment"];
	    $data["resultset"]=$this->subscription_model->getSubscriptionData($searcharray);
	    $data["item"]="subscription";
	    $data["master_title"]= "Manage Subscription | ".$this->config->item('sitename');  
	    $data["master_body"]="subscription";	
	    $this->load->theme('micro_layout',$data); 
	}


}
