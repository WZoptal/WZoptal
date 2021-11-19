
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Forgot extends CI_Controller {

   	public function __construct(){
    		parent::__construct();
    		$this->load->model('login_model');
       		 $this->load->model('user_model');
     		$this->load->helper('url');	
   	}

  	public function index(){
         
          $data["item"]         = "Forgot password";
          //$data["resultset"]    = $this->page_model->getPageData('privacy_policy');
          $data["master_title"] = "Forgot Password | ".$this->config->item('sitename');
          $data["master_body"]  = "forgot";
          $this->load->theme('micro_layout', $data);
       
   	}

    public function forgot_password(){

            $email = $this->input->post("email");

            if($email == ""){
                      
                $this->session->set_flashdata("errormsg","Please enter valid email.");     
                redirect(base_url()."forgot");
            } else {
                $userData = $this->user_model->get_user_data_by_email($email);

                if(empty($userData)){

                    $this->session->set_flashdata("errormsg","Email not registered with us.");     
                    redirect(base_url()."forgot");
                }else{                  
                    $arr["password"]     = rand(99, 99999);
                    $udat['id']           = $userData['id'];
                    $udat["password"]     = $this->common->salt_password($arr) ;
                    $udat["admin_access"]    = $arr['password'];
                    $this->user_model->update_profile_data($udat);

                    $subject     = "New Login Password --> ".$this->config->item('sitename');
                    $body        = "<p>Dear ".$userData['name']."</p>";
                    $body       .= "<p>As per your forgot password request, Your Login information as below: </p>";
                    $body       .= "<p>Username: ".$userData['email']."</p>";
                    $body       .= "<p>Password: ".$arr['password']."</p>";
                    $body       .= "<p>Thanks, </p>";
                    $body       .= "<p>".$this->config->item('sitename')."</p>";
                    $mail_to     = $this->input->post("email");

                    try {
                       $res = $this->send_email_sendgrid($mail_to, $body, $subject);
                        //$emailreturn = 200;
                        $this->session->set_flashdata("successmsg","New password has been sent to your email.");     
                        redirect(base_url()."login");

                    }  catch (Exception $e) {
                        //$emailreturn = $e->errorMessage();             
                        $this->session->set_flashdata("errormsg","Something wrong, please try again.");     
                        redirect(base_url()."forgot");
                    }
                //echo $emailreturn;
            }

        }
    }
    
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function send_email_sendgrid($email_to, $message, $subject){
        require 'sendgrid/vendor/autoload.php'; 
        $email = new \SendGrid\Mail\Mail(); 
        $from = 'bhpsapp.info@gmail.com';
        $email->setFrom($from, "BHPS Team"); 
        $email->setSubject($subject);
        $email->addTo($email_to, $subject);
        $email->addContent("text/html", $message);
        $sendgrid = new \SendGrid(SENDGRID_KEY);
        try {
            $response = $sendgrid->send($email);         
            return true;
        //  echo "<p style='color:#090'>Email sent successfully.</p>";
         // print $response->statusCode() . "\n";
         // print_r($response->headers());
         // print $response->body() . "\n";
        } catch (Exception $e) {
            return false;
            //echo "<p style='color:#900'>Something went erong please try after sometime.</p>";
            //echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
   

}
