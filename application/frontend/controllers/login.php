
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class login extends CI_Controller {

   	public function __construct(){
    		parent::__construct();
    		$this->load->model('login_model');
            $this->load->model('user_model');
            $this->load->helper('url');	
   	}

  	public function index(){

       if(empty($this->session->userdata('logged_in'))){     
          $data["item"]         = "Sign In";
          //$data["resultset"]    = $this->page_model->getPageData('privacy_policy');
          $data["master_title"] = "Sign In | ".$this->config->item('sitename');
          $data["master_body"]  = "login";
          $this->load->theme('micro_layout', $data);
        }else{

          redirect(base_url());
        }
   	}

   
    public function verifyUser()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        $res = $this->login_model->login_user($email, $pass);

        if(!empty($res)){
          if($this->common->validateHash($pass, $res["password"])) {
            
            $newdata = array( 
               'id'  => $res['id'],
               'username'  => $res['username'], 
               'email'     => $res['email'], 
               'profile_pic'=>$res['profile_pic'],
               'plan_status'=>$res['plan_status'],
               'planId'     =>$res['planId'],
               'logged_in' => TRUE
            );  

            $this->session->set_userdata( $newdata);
             $udat['id']           = $res['id'];
            $udat["last_login"]     = time();
            $this->user_model->update_profile_data($udat);
            
            
             $this->session->set_flashdata("successmsg","You have logged in successfully");     
              redirect(base_url()."home");

          } else {
            
            $this->session->set_flashdata("errormsg","You have entered wrong pssword.");     
              redirect(base_url()."login");

          }
        } else {
           
           $this->session->set_flashdata("errormsg","You have enterd wrong email/password.");     
              redirect(base_url()."login");
        }
      
    }

    public function logout(){


    
      $newdata = array( 
               'id'  => $this->session->userdata('id'),
               'username'  => $this->session->userdata('username'), 
               'email'     => $this->session->userdata('email'), 
               'profile_pic'=>$this->session->userdata('profile_pic'),
               'logged_in' => TRUE
            );  

      $this->session->unset_userdata( $newdata);
      $this->session->set_flashdata("successmsg","You have logout successfully.");     
      redirect(base_url()."login");


    }




}
