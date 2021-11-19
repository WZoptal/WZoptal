
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Contact extends CI_Controller {

 	public function __construct(){
  		parent::__construct();
  		$this->load->model('page_model');
  		$this->load->model('user_model');
   		$this->load->helper('url');	
 	}

 	public function index(){
		$data["item"]         = "Contact Us";
 		//$data["resultset"]    = $this->page_model->getPageData('privacy_policy');
 		$data["master_title"] = "Contact Us | ".$this->config->item('sitename');
 		$data["master_body"]  = "contact";

 		$this->load->theme('micro_layout', $data);
   	}


   	public function addquery(){
			
		extract($_POST);
		$errors = array(); 
		if($name == "") array_push($errors, "Name"); 
 		if($email == "") array_push($errors, "Email"); 
 		if($inquiry == "") array_push($errors, "Subject"); 
 		if($message == "") array_push($errors, "Message"); 
     		 
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
		else if($inquiry == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide subject.";
		} 
		else if($message == ""){
			$dvar['result']  = false;
			$dvar['code']    = "201";
			$dvar['message'] = "Please provide message.";
		} else{

				$udat["name"]     = $name;
				$udat["user_id"]     = $user_id ;
				$udat["email"]    = $email;
				$udat["subject"]  = $inquiry;
				$udat["description"] = $message;
				$userData  = $this->user_model->add_contact($udat); 
				if($userData == 1 ){

				$imgulr    = base_url('assets/dashboard/Logo_Final-Couloured@2x.png'); 
				$AppName   = "BHPS";
				$body      = '<html>
								<body style="background-color:#F4F4F4;">
									<table style="max-width:500px;min-width:500px;margin:0 auto;background-color:#fff;text-align:center;">
										<tr>
										<td style="color:#696969;font-family:open sans;font-size:14px;padding:7px 0;text-align:left;
											padding-left:20px;padding-right:20px;padding-top:1;background-color: #ffffff;">
												<img src="'.$imgulr.'" style="height: 60px;padding-left: 195px;"/>
											</td>
											</tr><tr>
										<td style="color:#696969;font-family:open sans;font-size:14px;padding:18px 0;text-align:left;
											padding-left:20px;padding-right:20px;padding-top:40px;">
												Hi Admin,
											</td>
										</tr>
										<tr>
											<td style="color:#696969;font-family:open sans;font-size:14px;padding:1px 0;
											text-align:left;padding-left:20px;padding-right:20px;line-height:12px;">
												You have new request form user, details as below
											</td>
										</tr>
										<tr>
											<td style="color:#696969;font-family:open sans;font-size:14px;padding:3px 0;
											text-align:left;padding-left:20px;padding-right:20px;">
												Email: ' . strtolower($email) . '
											</td>
										</tr>
										<tr>
											<td style="color:#696969;font-family:open sans;font-size:14px;padding:1px 0;
											text-align:left;padding-left:20px;padding-right:20px;">
												Subject: ' . $inquiry . '
											</td>
										</tr>
										<tr>
											<td style="color:#696969;font-family:open sans;font-size:14px;padding:1px 0;
											text-align:left;padding-left:20px;padding-right:20px;">
												Message: ' . $message. '
											</td>
										</tr>
										
										<tr>
											<td style="color:#696969;font-family:open sans;font-size:14px;padding:0;
											text-align:left;padding-left:20px;padding-right:20px;margin-top:20px; display: block;">
												Regards
											</td>
										</tr>
										<tr>
											<td style="color:#23A8E0;font-family:open sans;font-size:14px;padding:0;
											text-align:left;padding-left:20px;padding-right:20px;padding-bottom:40px;">
											 '.ucfirst($name).'
											</td>
										</tr>
									</table>
								</body>
							</html>';


				// // >>>>>>>>>>>>>>Sending Mail<<<<<<<<<<<<
				// 	$headers   = "MIME-Version: 1.0" . "\r\n";
				// 	$headers  .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
				// 	/*$headers  .= 'From: '.$this->config->item('sitename').'<support@pikfi.gr>'. "\r\n";*/
				// 	$headers  .= 'From: BHPS<krishankumar@zoptal.in>'. "\r\n";
				 
				// 	$send      = mail('krishanzoptal2019@gmail.com',"Contact us query",$body,$headers);

				// 	$this->session->set_flashdata("successmsg","Your query has been submitted successfully. Our team will contact you soon.");	
				// redirect(base_url()."contact");
				

                //$emailData['name'] = $user['firstname'];
                //$message =$this->load->view('emails/sign_up_professional.php', $emailData, TRUE);
                $this->send_email_sendgrid(CONTACT_US, $body, 'You have new query from user.');
           		$this->session->set_flashdata("successmsg","Your query has been submitted successfully. Our team will contact you soon.");	
				redirect(base_url()."contact");

				}else{

					$this->session->set_flashdata("errormsg","Something went wrong. Please try again later.");
 					redirect(base_url()."contact"); exit;
				}
				

		}
   	}

   	public function send_email_sendgrid($email_to, $message, $subject){
		require 'sendgrid/vendor/autoload.php'; 
		 //$email_to = "gurpreet.zoptal@gmail.com"; //$message = '<p> test message </p>'; $subject = "test message";
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


}
