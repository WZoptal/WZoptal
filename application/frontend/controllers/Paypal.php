<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'PayPal-PHP-SDK/sample/bootstrap.php';


use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;

use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;

use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\ShippingAddress;


use PayPal\Api\Capture;
use PayPal\Api\Refund;
use PayPal\Api\RefundRequest;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use PayPal\Api\AgreementStateDescriptor;



class paypal extends CI_Controller { 
	 
	public $_api_context;

    function  __construct()
    {
        parent::__construct();
        
        // paypal credentials
        $this->load->model('paypal_model');
        $this->config->load('paypal');

        $this->_api_context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->config->item('client_id'), $this->config->item('secret')
            )
        );
     }


	  
	public function thankyou(){
		$this->data['segment1'] = $this->uri->segment(2); 
		$this->data['segment2'] = $this->uri->segment(3);
		
		// $this->data['session'] = $this->session->userdata(SUBDOMAIN);
		  
		 // echo "<pre>"; print_r($this->data); die;
		$this->load->view('thankyou_membership');
		
	  	//load_views("common/front_footer",$this->data);
		
	}   
	
	
	public function buy_Subscription(){


	        $this->_api_context->setConfig($this->config->item('settings'));
            
            $id = $this->uri->segment(3);
	        $uid =$this->uri->segment(4); 

	        if(sizeOf(array_filter(array( $id,  $uid)))  < 2){
	        	$this->session->set_flashdata("errormsg","Before buy subscription you need to login first.");
	        	redirect(base_url().'subscription'); die;

	        } 
            
            $DBPlan = $this->paypal_model->select_row('subscription','*',['status!='=>0,'id'=>$id]);

      //       $update_data['applied_plan'] = $id; 
		    // $result = $this->paypal_model->update('users',array('id'=>$uid),$update_data);

            $payer = new Payer();
            $payer->setPaymentMethod("paypal");
            
                
            $amount = new Amount();
            $amount->setCurrency($DBPlan->currency)
                ->setTotal($DBPlan->amount);
                //->setDetails($details);
                
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                //->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());

                    
            $baseUrl = getBaseUrl();
            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl("$baseUrl/paypal/ExecutePayment?success=true&id=".$id."&uid=".$uid)
                ->setCancelUrl("$baseUrl/paypal/ExecutePayment?success=false");
                
           
            $payment = new Payment();
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));
                
               // For Sample Purposes Only.
            $request = clone $payment;
            	
            
            
            
            try {
                
                $payment->create($this->_api_context); 
            } catch (Exception $ex) {
            
                        ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
                exit(1);
            }
            
            $approvalUrl = $payment->getApprovalLink();
            redirect($approvalUrl);
            ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

            return $payment;
	    
	}
	
	
   public function ExecuteAgreement(){
		  
		  //EC-5V038371HF897080H 
		  $this->_api_context->setConfig($this->config->item('settings'));
		 
			if (isset($_GET['success']) && $_GET['success'] == 'true') {
				$token = $_GET['token'];
				$agreement = new \PayPal\Api\Agreement();
				//try {
					$agreement->execute($token, $this->_api_context);
				//} catch (Exception $ex) { 
					
				//  ResultPrinter::printError("Executed an Agreement", "Agreement", $agreement->getId(), $_GET['token'], $ex);
				//	exit(1);
				//}	
				
				// ResultPrinter::printResult("Executed an Agreement", "Agreement", $agreement->getId(), $_GET['token'], $agreement);
				 
			
				 
				  try{
					  
						$agreement = \PayPal\Api\Agreement::get($agreement->getId(), $this->_api_context);
						$agreement = json_decode($agreement->toJSON(128));		
						//echo "<pre>";print_r($agreement);  
						$user_id = $_GET['userId'];
						$planId  = $_GET['planId'];
						$saleId  = $_GET['sale_id'];


						$table = "bhps_agreement";
			            $where=array('bhps_agreement.user_id'=>$user_id);
			 
			            $this->delete_Sub($table,$where);
                        					
						 $insert =  [
						              'agreement_id' => $agreement->id,
						              'state'=> $agreement->state,
						              'description'=> $agreement->description,
						              'start_date'=> date('Y-m-d H:i:s', strtotime($agreement->start_date)),
						              
						              'payment_method'=> $agreement->payer->payment_method,
						              'payment_status'=> $agreement->payer->status,
						              
						              'payer_id'=> $agreement->payer->payer_info->payer_id,
						              'payer_email'=> $agreement->payer->payer_info->email,
						              'payer_first_name'=> $agreement->payer->payer_info->first_name,
						              'payer_last_name'=> $agreement->payer->payer_info->last_name,
						              
						              'amount'=> $agreement->plan->payment_definitions[0]->amount->value,
						              'currency'=> $agreement->plan->payment_definitions[0]->amount->currency,
						              'user_id' => $user_id,
						              
						              'plan_id' => $planId,
						              
						              'next_billing_date'=>date('Y-m-d H:i:s',strtotime($agreement->agreement_details->next_billing_date)),
						              'final_payment_date'=> $agreement->agreement_details->next_billing_date,
						              'cycles_completed'=>$agreement->agreement_details->cycles_completed,
						              'last_payment_date'=>date('Y-m-d H:i:s',strtotime($agreement->agreement_details->next_billing_date)),//$agreement->last_payment_date,
						              'sale_id' => $saleId,
						            ];  
						           
  						            //~ $updateData['cycles_completed']  = $agreement->cycles_completed;
									//~ $updateData['next_billing_date'] = $agreement->agreement_details;
									//~ $updateData['last_payment_date'] = $agreement->last_payment_date;  
						             
						//echo "<pre>";print_r($insert);  die;
						     //$this->session->userdata(SUBDOMAIN)['agreement_id'] = $agreement->id;
						     
						     $Plan = $this->paypal_model->select_row('subscription','*',['id'=>$insert['plan_id']]);
						     
						    /* $_SESSION[SUBDOMAIN]['agreement_id'] = $agreement->id;
						     $_SESSION[SUBDOMAIN]['plan_id'] = $insert['plan_id'];
						     $_SESSION[SUBDOMAIN]['next_billing_date'] = $insert['next_billing_date'];
						     $_SESSION[SUBDOMAIN]['plan_name'] = $Plan->name;
						     $_SESSION[SUBDOMAIN]['min_emp'] = $Plan->min_emp;
						     $_SESSION[SUBDOMAIN]['max_emp'] = $Plan->max_emp;*/
						     
						    

						    $insert_id = $this->paypal_model->insert('bhps_agreement',$insert);
						   
						    ############ disable this query by krishan ############
						   //$this->admin->update('ed_users',array('id'=>$everlasting_user_id),array('plan_id' =>$everlasting_plan_id,'plan_status' =>'active'));
						    $this->paypal_model->update('users',array('id'=>$user_id),array('planId' =>$planId,'plan_status' =>'active','is_subscription'=>1));
						    
						    ####################### End changes ######################
						   
						   $user_detail=$this->paypal_model->select_row('users','email,username,device_token,badgecount',['id'=>$user_id]);


						   $message = $this->load->view('email/membership',array("name"=> $user_detail->username,"pay_id" =>$agreement->id,"plan_name"=>$Plan->name,"plan_amount" =>$insert['amount']), true);


								//$mail = $this->paypal_model->emailsend($user_detail->email,'BHPS - Membership',$message,'BHPS');
								
								$body_msg="your ".$Plan->name." purchased successfully";
								$MsgTitle="BHPS";
							// 	sendPushNotification($userid,array('body'=>$body_msg,'title'=> $MsgTitle,'sender_id'=>$uid ,'invite_id'=> $data, 'status' => 'pending'));
							    $token=array('device_token'=>$user_detail->device_token, 'sender'=>0, 'receiver'=>$user_id, "badge" => $user_detail->badgecount+1, 'other_id'=>0);  
                                $aps = array('alert'=>array('body'=>$body_msg,'title'=> $MsgTitle,'sender'=>0 ,'invite_id'=> 0, 'status' => 'purchase','sound'=>'default'));
                                $res = $this->sendPushNotificationLive($user_id, $token,array('body'=>$body_msg,'title'=> $MsgTitle,'type'=>'PURCHASED_SUBSCRIPTION', 'click_action'=>'open_notification_screen' ,'aps'=>$aps));

                                $response  = json_decode($res, true); 
                                if($response['success']== 1){
                                        $data = array(
                                            'receiver'=>$user_id,
                                            'sender'=>0,
                                            'other_id'=> 0,
                                            'type'=>'PURCHASED_SUBSCRIPTION',
                                            'title'=> $MsgTitle,
                                            'body'=>$body_msg,
                                            'time'=> time(),
                                        );
                                        //add_notification('ed_notifications',$data);
                                        $this->db->insert('notifications',$data);
                        
                                     $this->db->affected_rows() != 1 ? false : true;
        
                                }  
								
						//$this->CreatePaymentUsingPayPal($insert['plan_id'],  $agreement->payer->payer_info->payer_id, $agreement->payer->payer_info->payer_id, $insert['agreement_id']); 
						redirect(base_url('paypal/thankyou')); die;
						
				   }catch (Exception $ex) {
								
						ResultPrinter::printError("Get Agreement", "Agreement", null, null, $ex);
						exit(1);
								
				  }		
				 
				 ResultPrinter::printResult("Get Agreement", "Agreement", $agreement->getId(), null, $agreement);
				 
			} else {	
						redirect(base_url('subscription')); die;
						 ResultPrinter::printResult("User Cancelled the Approval", null);
			}

	 }
	 public function cancel_Agreement(){
	 	$this->_api_context->setConfig($this->config->item('settings'));

 	   $table = "bhps_agreement";
       $where=array('bhps_agreement.user_id'=>$this->uri->segment(3));
       
       $sub= $this->getWhereRowSelect_sub($table,$where);
   
        $agreementId = "I-TNNJTFTNVC7L";// $sub->agreement_id;
	        //$agreementId = "I-ABACAGAH";                  
        $agreement = new Agreement();            

        $agreement->setId($agreementId);
        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Cancel the agreement");

        try {
            $agreement->cancel($agreementStateDescriptor, $this->_apiContext);
            $cancelAgreementDetails = Agreement::get($agreement->getId(), $this->_apiContext);                
            
            //$agreement = Agreement::get($agreement_id, $this->_api_context);
		    //$agreement = json_decode($agreement->toJSON(128));	
		    // update aggrement table by this 
            
            
        } catch (Exception $ex) {  
			ResultPrinter::printError("Cancle Agreement", "Plan", null, null, $ex);
			exit(1);                
        }
        ResultPrinter::printResult("Cancle Agreement", "Agreement", $cancelAgreementDetails->getId(), null, $agreement);
	}
	
   public function cancelAgreement($agreementId){
	        //$agreementId = "I-ABACAGAH";                  
        $agreement = new Agreement();            

        $agreement->setId($agreementId);
        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Cancel the agreement");

        try {
            $agreement->cancel($agreementStateDescriptor, $this->_apiContext);
            $cancelAgreementDetails = Agreement::get($agreement->getId(), $this->_apiContext);                
            
            //$agreement = Agreement::get($agreement_id, $this->_api_context);
		    //$agreement = json_decode($agreement->toJSON(128));	
		    // update aggrement table by this 
            
            
        } catch (Exception $ex) {  
			ResultPrinter::printError("Cancle Agreement", "Plan", null, null, $ex);
			exit(1);                
        }
        ResultPrinter::printResult("Cancle Agreement", "Agreement", $cancelAgreementDetails->getId(), null, $agreement);
	}
/***********************************************************************************************************************************************************/	
   public function create_plan(){
		
		  // setup PayPal api context
          $this->_api_context->setConfig($this->config->item('settings'));
		  
			$plan_name = 'Unlimity Plan';
			$plan_description = 'Unlimity plan having Unlimited employees.';
			$plan_type = 'INFINITE';
			
			$plan = new Plan();
			
			$plan->setName($plan_name)
				 ->setDescription($plan_description)
				 ->setType($plan_type);

			$paymentDefinition = new PaymentDefinition();

			$paymentDefinition->setName('Regular Payments')
				->setType('REGULAR')
				->setFrequency('Month')
				->setFrequencyInterval("1")
				//->setCycles("1")
				->setAmount(new Currency(array('value' => 200, 'currency' => 'AUD')));

				// Charge Models
				$chargeModel = new ChargeModel();
				$chargeModel->setType('SHIPPING')
					->setAmount(new Currency(array('value' => 0, 'currency' => 'AUD')));

				$paymentDefinition->setChargeModels(array($chargeModel));

				$merchantPreferences = new MerchantPreferences();
				
				$merchantPreferences->setReturnUrl(base_url()."paypal/ExecuteAgreement?success=true")
					->setCancelUrl(base_url()."paypal/ExecuteAgreement?success=false")
					->setAutoBillAmount("yes")
					->setInitialFailAmountAction("CONTINUE")
					->setMaxFailAttempts("0")
					->setSetupFee(new Currency(array('value' => 0, 'currency' => 'AUD')));


				$plan->setPaymentDefinitions(array($paymentDefinition));
				$plan->setMerchantPreferences($merchantPreferences);

				// For Sample Purposes Only.
				$request = clone $plan;

				// ### Create Plan
				try {
					$output = $plan->create($this->_api_context);
				} catch (Exception $ex) {
					// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
					ResultPrinter::printError("Created Plan", "Plan", null, $request, $ex);
					exit(1);
				}

				// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
				 ResultPrinter::printResult("Created Plan", "Plan", $output->getId(), $request, $output);

				return $output;
				//PD-2RB80550HR417283RILB2VVA			
	}
	    
	    
	    
	public function get_plan($pid=''){
		
		  // setup PayPal api context
          $this->_api_context->setConfig($this->config->item('settings'));
		  if($pid=='')
		   $planId = 'P-7TV20287J5229164FMCLK2SI';
		  else
		  	$planId = $pid;

		    try {
				$plan = Plan::get($planId, $this->_api_context);
			} catch (Exception $ex) {    
				 ResultPrinter::printError("Retrieved a Plan", "Plan", $planId, null, $ex);
				exit(1);
			}
			
			ResultPrinter::printResult("Retrieved a Plan", "Plan", $plan->getId(), null, $plan);

			return $plan;
    }
    
    public function list_plans(){
		  
		  try{
			     $params = array('page_size' => '10','state'=>'ACTIVE');
				$planList = Plan::all($params, $this->_api_context);
			} catch (Exception $ex) {
				
				 ResultPrinter::printError("List of Plans", "Plan", null, $params, $ex);
				exit(1);
			}
		  ResultPrinter::printResult("List of Plans", "Plan", null, $params, $planList);

		  return $planList;	
		
	}
	
	
	public function update_plan(){
		  
		  // setup PayPal api context
          $this->_api_context->setConfig($this->config->item('settings'));
		  $planId = 'P-7C415678KX270853GIMJFFMY';
		  $createdPlan = Plan::get($planId, $this->_api_context);
		    
		  try {
				$patch = new Patch();

				$value = new PayPalModel('{
					   "state":"ACTIVE"
					 }');

				$patch->setOp('replace')
					->setPath('/')
					->setValue($value);
				$patchRequest = new PatchRequest();
				$patchRequest->addPatch($patch);

				$createdPlan->update($patchRequest, $this->_api_context);

				$plan = Plan::get($planId, $this->_api_context);
			} catch (Exception $ex) {
						ResultPrinter::printError("Updated the Plan to Active State", "Plan", null, $patchRequest, $ex);
				exit(1);
			}
			
			ResultPrinter::printResult("Updated the Plan to Active State", "Plan", $plan->getId(), $patchRequest, $plan);

			return $plan;

	}
	
	/***********************************************************************************************************************/
	
	public function CreateBillingAgreementWithPayPal(){
		  
		  
		  //echo date("Y-m-d\TH:i:s\Z" ,time()+300); echo "<br>"; die;
		  
		 
	        
	        $this->_api_context->setConfig($this->config->item('settings'));
	        
	        $planId = 'P-8HP88623381910458IJ4ULCI';
	        
	        $agreement = new Agreement();
	        
	        $agreement->setName('Base Agreement')
	                  //->setPlanId($planId)   
					  ->setDescription('Basic Agreement')
					  ->setStartDate(date("Y-m-d\TH:i:s\Z"));
					  
			$plan = new Plan();
				$plan->setId($planId);
				$agreement->setPlan($plan);		  
				
			$payer = new Payer();
				$payer->setPaymentMethod('paypal');
				$agreement->setPayer($payer);	
				
			//~ $shippingAddress = new ShippingAddress();
			//~ $shippingAddress->setLine1('111 First Street')
				//~ ->setCity('Saratoga')
				//~ ->setState('CA')
				//~ ->setPostalCode('95070')
				//~ ->setCountryCode('US');
			//~ $agreement->setShippingAddress($shippingAddress);	
			
			$request = clone $agreement;
			try {
				 $agreement = $agreement->create($this->_api_context);
				 		$approvalUrl = $agreement->getApprovalLink();
				 	
				//echo "<pre>";
				// print_r(json_decode($agreement->toJSON(128)));		
				// die;		
				 		
			} catch (Exception $ex) {	 
						ResultPrinter::printError("Created Billing Agreement.", "Agreement", null, $request, $ex);
				exit(1);
			}
			
			 ResultPrinter::printResult("Created Billing Agreement. Please visit the URL to Approve.", "Agreement", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $agreement);

			return $agreement;	

	}
	 
	 public function subscribeplan($planId){
		  //print_r($_COOKIE);
		 // $session = $this->session->userdata(SUBDOMAIN); 	   
		     //$_SESSION['everlasting_plan_id'] = $planId;
		     $_SESSION['everlasting_user_id'] = $session['user_id'];
		     //$hairservice_salon_sub_domain = $session['sub_domain'];
		     
		        //~ $cookie_name = "hair_service_domain_for_payment";
				//~ $cookie_value = $session['sub_domain'];
				//~ setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	        
	       //echo "<pre>"; print_r($_SESSION); die;
	       //$this->session->set_userdata($array);
	   
	   
	        $this->_api_context->setConfig($this->config->item('settings'));
	        
	        // $planId = 'P-8HP88623381910458IJ4ULCI';
	        
	        $agreement = new Agreement();
	        
	        $agreement->setName('Subscription Agreement')
					  //->setPlanId($planId)   
					  ->setDescription('Agreement of everlasting date')
					  ->setStartDate(date("Y-m-d\TH:i:s\Z"));
					  
			$plan = new Plan();
			//$plan = Plan::get($planId, $this->_api_context);
			
				$plan->setId($planId);
				$agreement->setPlan($plan);		  
				
			$payer = new Payer();
				$payer->setPaymentMethod('paypal');
				$agreement->setPayer($payer);	
				
			//~ $shippingAddress = new ShippingAddress();
			//~ $shippingAddress->setLine1('111 First Street')
				//~ ->setCity('Saratoga')
				//~ ->setState('CA')
				//~ ->setPostalCode('95070')
				//~ ->setCountryCode('US');
			//~ $agreement->setShippingAddress($shippingAddress);	
			
			$request = clone $agreement;
			try {
				  $agreement = $agreement->create($this->_api_context);
				    $approvalUrl = $agreement->getApprovalLink();
			} catch (Exception $ex) {	 
						ResultPrinter::printError("Created Billing Agreement.", "Agreement", null, $request, $ex);
				exit(1);
			}
		  
		  ResultPrinter::printResult("Get Agreement", "Agreement", $agreement->getId(), null, $agreement);
		 redirect($approvalUrl); die;
	
	 }
	 

    public function upgrade_downgrade(){

           $id = $this->uri->segment(3);
	       $uid = $this->uri->segment(4); 
	       

	       $table = "ed_agreement";
	       $where=array('ed_agreement.user_id'=>$uid);
	       
	       $sub= $this->getWhereRowSelect_sub($table,$where);

            if(!empty($sub)){
                    
                $DBPlan = $this->admin->select_row('ed_plan','*',['status!='=>'deleted','id'=>$sub->plan_id]); 
   
                if($sub->plan_id == 2){
                        
                    if($id ==1 ){
                        $agreement_id =$sub->agreement_id;
                        $this->change_subscription_status($sub->agreement_id, $DBPlan->name);
    	                $refund = $this->subscriptionbillingRefund($agreement_id, $DBPlan->billing_cycle, $sub->sale_id);

                        $this->delete_Sub($table,$where);
                        $response =  $this->getMembershipNew($id,$uid );
                    }
                }
                   
                $this->change_subscription_status($sub->agreement_id, $DBPlan->name);
                $this->delete_Sub($table,$where);
                $response =  $this->getMembershipNew($id,$uid ); 

                
            }

    }
    
    public function getMembershipNew(){
	         
	        $this->_api_context->setConfig($this->config->item('settings'));
            
            $id = $this->uri->segment(3);
	        $uid =$this->uri->segment(4); 
            
            $DBPlan = $this->admin->select_row('ed_plan','*',['status!='=>'deleted','id'=>$id]);

            $payer = new Payer();
            $payer->setPaymentMethod("paypal");
            
                
            $amount = new Amount();
            $amount->setCurrency($DBPlan->currency)
                ->setTotal($DBPlan->amount);
                //->setDetails($details);
                
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                //->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());

                    
            $baseUrl = getBaseUrl();
            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl("$baseUrl/paypal/ExecutePayment?success=true&id=".$id."&uid=".$uid)
                ->setCancelUrl("$baseUrl/paypal/ExecutePayment?success=false");
                
           
            $payment = new Payment();
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));
                
               // For Sample Purposes Only.
            $request = clone $payment;

            try {
                
                $payment->create($this->_api_context); print_r($payment); 
            } catch (Exception $ex) {
            
                        ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
                exit(1);
            }
            
            $approvalUrl = $payment->getApprovalLink();
            redirect($approvalUrl);
            ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

            return $payment;
	    
	}

    
    function delete_Sub($table,$where)
    {
        $table=$table;
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }
    
    function getWhereRowSelect_sub($table,$where){ 
        $this->db->select('*');
        $this->db->where($where);
        $getdata = $this->db->get($table);      
        $result = $getdata->row();
        return $result;
    }
    
    
    function change_subscription_status($subscriptionId, $planname) {
        
        
            ////////////////////////////// GET TEMP ACCESS TOKEN/////////////////////////////////
            $ch = curl_init();
            $clientId = $this->config->item('client_id');
            $secret = $this->config->item('secret');
            $myIDKEY = "";
            
            curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/oauth2/token");
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
            
            $result = curl_exec($ch);
            
            if(empty($result))die("Error: No response.");
            else
            {
                $json = json_decode($result);
                //print_r($json->access_token);
                $myIDKEY = $json->access_token;
            }
            
            curl_close($ch);
            /////////////////////////////// SEND CANCEL POST ////////////////////////////////
            $ch = curl_init();
            $headers  = [
                        'Authorization: Bearer '.$myIDKEY, 
                        'Content-Type: application/json'
                    ];
            $postData = [
                'reason' => 'User changed subscription plan, old '.$planname.' cancelled.'
            ];
            curl_setopt($ch, CURLOPT_URL,"https://api.paypal.com/v1/billing/subscriptions/".$subscriptionId."/cancel");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));           
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result     = curl_exec ($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            return  $myIDKEY; 
             
             
             
            	
    }
    
    ################## subscription refund id plan downgrade ################
    
    
    function subscriptionbillingRefund($agreement_id, $cycle, $sale_id){

        if(!empty($sale_id)){
           $table = "ed_agreement";
	       $where=array('ed_agreement.agreement_id'=>$agreement_id);
	       $agreement= $this->getWhereRowSelect_sub($table,$where);

            $planAmount = $agreement->amount; 
            $days       =  $cycle * 30; 
            $perdaycost = $planAmount / $days ; 
         
            $days_between = ceil(abs(strtotime($agreement->next_billing_date) - strtotime(date("Y-m-d"))) / 86400) ;   
           
            $refund_amount = $agreement->amount - number_format((float)$perdaycost * $days_between, 2, '.', '') ;  
           
            
                if ($refund_amount < 0)
                {
                   $refund_amount = $planAmount ;
                }else{
                  $refund_amount = $refund_amount; 
                    
                }
              

            $amount = new \PayPal\Api\Amount();
            $amount->setCurrency("AUD")
                         ->setTotal($refund_amount);
            
            $refundRequest = new RefundRequest();
            $refundRequest->setAmount($amount);
            
            // Replace $captureId with any static Id you might already have. 
             $captureId = $sale_id; //$json['resource']['id']; 


            $this->_api_context->setConfig($this->config->item('settings'));

            // ### Retrieve Capture details
            $capture = Capture::get($captureId, $this->_api_context);  
        
            // ### Refund the Capture 
            $captureRefund = $capture->refundCapturedPayment($refundRequest, $this->_api_context);
          return true;
        }
           
        //     $table = "ed_webhook";
	       // $where='ed_webhook.agreement_id like "%'.$agreement_id.'%"';
	       // $result= $this->getWhereRowSelectLike($table,$where); 
	       // if(!empty($result)){
        //             $webhook_id = $result->webhook_id;   
        //             $webhook= $this->getTractionId('er_paycheck','er_paycheck.output like "%'.$webhook_id.'%"'); 

        //             $planAmount = $result->amount;
                    
        //             $json = json_decode($webhook->output, true);
        //             $days =  $cycle * 30; 
        //             $amountdeduct = $planAmount / $days ; 
                        
        //             $days_between = ceil(abs(strtotime($result->next_billing_date) - strtotime(date("Y-m-d h:i:s"))) / 86400) ; 
        
        //             $refund_amount =number_format((float)$amountdeduct * $days_between, 2, '.', '') ; 
        
        //             $amount = new \PayPal\Api\Amount();
        //             $amount->setCurrency("AUD")
        //                          ->setTotal($refund_amount);
                    
        //             $refundRequest = new RefundRequest();
        //             $refundRequest->setAmount($amount);
                    
        //             // Replace $captureId with any static Id you might already have. 
        //              $captureId = $json['resource']['id']; 
        
        
        //             $this->_api_context->setConfig($this->config->item('settings'));
        
        //             // ### Retrieve Capture details
        //             $capture = Capture::get($captureId, $this->_api_context);  
                
        //             // ### Refund the Capture 
        //             $captureRefund = $capture->refundCapturedPayment($refundRequest, $this->_api_context);
	       // }
        
        
    }
    
    public function getWhereRowSelectLike($table, $where){ 
        $this->db->select('*');
        $this->db->where($where);
        $getdata = $this->db->get($table);      
        $result = $getdata->row();
        
        return $result;
    }
    public function getTractionId($table, $where){ 
        $this->db->select('*');
        $this->db->where($where);
        $this->db->order_by("id", "ASC");
        $this->db->limit(1);
        $getdata = $this->db->get($table);      
        $result = $getdata->row();
        //echo $this->db->last_query(); die;
        return $result;
    }
    
    
    ######################## new function added by krishan to get instent payment ############

    public function CreatePaymentUsingPayPal($arr, $sale_id){
        		

             //User login Check
	       // $this->is_not_logged_in_as_user_redirect('salon');
	       
	       // Get Plan ID from url segment
		$id = $arr['id']; //$this->uri->segment(3);
		$uid = $arr['uid']; //$this->uri->segment(4); 
	       
	    
		 
		 if($id!=''){
			   
			   //Getting Plan from database by Id
			   $DBPlan = $this->paypal_model->select_row('subscription','*',['status!='=>'deleted','id'=>$id]);

			   //Current user data from session
			  // $session = $this->session->userdata(SUBDOMAIN);
			   
			   
		     // echo "<pre>"; print_r($DBPlan); print_r($session); echo "</pre>"; die;
		        
		      /********** Create Plan on Paypal ***********/
		        
		        // setup PayPal api context
				$this->_api_context->setConfig($this->config->item('settings'));
				
				$plan = new Plan();
				//$DBPlan->description
				$plan->setName($DBPlan->name)
					 ->setDescription($DBPlan->title)
					 ->setType('INFINITE');
					 
				$paymentDefinition = new PaymentDefinition();	
				
					$paymentDefinition->setName('Regular Payments')
						->setType('REGULAR')
						//->setFrequency('Month')
						->setFrequency('Day')
						->setFrequencyInterval($DBPlan->billing_cycle)
						//->setCycles($DBPlan->billing_cycle)
						->setAmount(new Currency(array('value' => $DBPlan->amount, 'currency' => $DBPlan->currency))); 
				
				// Charge Models
				$chargeModel = new ChargeModel();
					$chargeModel->setType('SHIPPING')
						->setAmount(new Currency(array('value' => 0, 'currency' => $DBPlan->currency)));
					$paymentDefinition->setChargeModels(array($chargeModel));	
				
				$merchantPreferences = new MerchantPreferences();
				$merchantPreferences->setReturnUrl(base_url().'paypal/ExecuteAgreement?success=true&sale_id='.$sale_id.'&planId='.$id.'&userId='.$uid)
					->setCancelUrl(base_url().'paypal/ExecuteAgreement?success=false')
					->setAutoBillAmount('yes')
					->setInitialFailAmountAction('CONTINUE')
					->setMaxFailAttempts('0')
					->setSetupFee(new Currency(array('value' => 0, 'currency' => $DBPlan->currency)));


				$plan->setPaymentDefinitions(array($paymentDefinition));
				$plan->setMerchantPreferences($merchantPreferences);

				// For Sample Purposes Only.
				$request = clone $plan;		
				
				// ### Create Plan
				try {
					$output = $plan->create($this->_api_context);
				} catch (Exception $ex) {
					// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
					ResultPrinter::printError("Created Plan", "Plan", null, $request, $ex);
					exit(1);
				}

				// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
				// ResultPrinter::printResult("Created Plan", "Plan", $output->getId(), $request, $output);
				
				//$output = json_decode($output->toJSON(128));	
				//echo "<pre>"; print_r(json_decode($output->toJSON(128)));	
				/*****Update Plan*****/	
				
				if($output->getId()!=''){
					 
					 $getPlan = Plan::get($output->getId(), $this->_api_context); 
						try {
							$patch = new Patch();

							$value = new PayPalModel('{
								   "state":"ACTIVE"
								 }');

							$patch->setOp('replace')
								  ->setPath('/')
								  ->setValue($value);
							$patchRequest = new PatchRequest();
							$patchRequest->addPatch($patch);

							$getPlan->update($patchRequest, $this->_api_context);
							
							$UpdatedPlan = Plan::get($output->getId(), $this->_api_context);
							
						} catch (Exception $ex) {
									ResultPrinter::printError("Updated the Plan to Active State", "Plan", null, $patchRequest, $ex);
							exit(1);
						}
					    
					    //echo $UpdatedPlan->getId(); echo "<pre>";
					    //echo $UpdatedPlan->getState();
					    //echo "<pre>"; print_r(json_decode($UpdatedPlan->toJSON(128)));	
					    
					    if($UpdatedPlan->getState()=='ACTIVE'){
							 
							 /*****Create Agreement************/
							 $agreement = new Agreement();
	        
							 $agreement->setName($DBPlan->name)
										  //->setPlanId($planId)   
										  ->setDescription($DBPlan->title)
										  ->setStartDate(date("Y-m-d\TH:i:s\Z", strtotime("+".$DBPlan->billing_cycle." day", strtotime(date("Y-m-d\TH:i:s\Z" ,time()+300)))));
										  
							   $GPlan = new Plan();
								  $GPlan->setId($output->getId());
								  //$GPlan->setName($output->getName());
								  $agreement->setPlan($GPlan);		  
									
								$payer = new Payer();
									$payer->setPaymentMethod('paypal');
									$agreement->setPayer($payer);	
									
								
								$request = clone $agreement;
								try {
									 $agreement = $agreement->create($this->_api_context);
									 $approvalUrl = $agreement->getApprovalLink();
									 
									 $_SESSION['everlasting_plan_id'] = $id;
									 $_SESSION['everlasting_paypal_plan_id'] = $output->getId();
									 $_SESSION['everlasting_user_id'] = $uid;
									 

									redirect($approvalUrl); die;
									//echo "<pre>"; print_r(json_decode($agreement->toJSON(128))); die;		
											
								} catch (Exception $ex) {	 
											ResultPrinter::printError("Created Billing Agreement.", "Agreement", null, $request, $ex);
									exit(1);
								}
								
						}
				}
		 /*****************************************************************************************/
		 }
	    
	    die;
            
            
        
    }
    
    public function ExecutePayment(){

	    	
		    	$query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
				parse_str($query, $params);
	    	
        	
        		if($params['success'] == "true"){
		            $this->_api_context->setConfig($this->config->item('settings'));

		            $DBPlan = $this->paypal_model->select_row('subscription','*',['status!='=>'deleted','id'=>$params['id']]);
		         
		            $token = $_GET['token'];

		            $paymentId = $_GET['paymentId'];
		            $payerId = $_GET['PayerID'];
		            $payment = Payment::get($paymentId, $this->_api_context);
		            
		            $execution = new PaymentExecution();
		            $execution->setPayerId($payerId);
		            
		            
		            $transaction = new Transaction();
		            $amount = new Amount();
		            //$details = new Details();
		        
		            //$details->setShipping(2.2)
		               // ->setTax(1.3)
		             //   ->setSubtotal(17.50);
		        
		            $amount->setCurrency($DBPlan->currency);
		            $amount->setTotal($DBPlan->amount);
		           // $amount->setDetails($details);
		            $transaction->setAmount($amount);
		            
		            $execution->addTransaction($transaction);
		            try {
		            
		                $result = $payment->execute($execution, $this->_api_context);
		                $payment = Payment::get($paymentId, $this->_api_context); 
		                $sale_id = $payment->transactions[0]->related_resources[0]->sale->id; 

		                $this->CreatePaymentUsingPayPal($params, $sale_id); 	
		            
		                ResultPrinter::printResult("Executed Payment", "Payment", $payment->getId(), $execution, $result);
		                
		       
		            } catch (Exception $ex) {
		                
		                
		                 ResultPrinter::printError("Executed Payment", "Payment", null, null, $ex);
		                exit(1);
		            }
		            
		            ResultPrinter::printResult("Get Payment", "Payment", $payment->getId(), null, $payment);
		        
		            return $payment;
		        }else{
		        	
	        		redirect('../subscription'); 

		        }
       
        }
    
    ######################### end ########################

    function sendPushNotificationLive($uid, $token, $data=array()){   


	        $fields = json_encode(array(

	                'to' => $token['device_token'],
	                'notification' => array('message' => $data['body'],'title' => $data['title'], 'body' => $data['body'], "badge" => $token['badge'], 'type'  => $data['type'], 'click_action'  => $data['click_action'], 'sender'=> $token['sender'], 'receiver' => $token['receiver'], 'other_id'=> $token['other_id'],),
	                'data' => array('title' => $data['title'], 'body' => $data['body'],'message' => $data['body'], 'type' =>$data['type'], 'sender'=> $token['sender'], 'receiver' => $token['receiver'], 'other_id'=> $token['other_id'], 'badgecount' => $token['badge'] ,'click_action'  => $data['click_action'],)
	          ));
	         //print_r($fields); die;
	       //~ preprint($fields);

	       // Set POST variables
	       $url = 'https://fcm.googleapis.com/fcm/send';
	       $headers = array(
	           'Authorization: key=' . FIREBASE_API_KEY,
	           'Content-Type: application/json'
	       );
	       // Open connection
	       $ch = curl_init();
	       // Set the url, number of POST vars, POST data
	       curl_setopt($ch, CURLOPT_URL, $url);
	       curl_setopt($ch, CURLOPT_POST, true);
	       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	       // Disabling SSL Certificate support temporarly
	       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	       curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
	       // Execute post
	       $result = curl_exec($ch);
	       if ($result === FALSE) {
	           die('Curl failed: ' . curl_error($ch));
	       }
	       // Close connection
	       curl_close($ch);
	   return $result;

	}

	function cancel_subscription_Agreement() {

		 	$table = "bhps_agreement";
			$where=array('bhps_agreement.user_id'=>$this->session->userdata('id'));

			$Agreement= $this->getWhereRowSelect_sub($table,$where); 
			$subscriptionId = $Agreement->agreement_id;
        

			$table = "subscription";
			$where=array('subscription.id'=>$Agreement->plan_id);

			$planinfo= $this->getWhereRowSelect_sub($table,$where); 

		 	$ch = curl_init();
            $clientId = $this->config->item('client_id');
            $secret = $this->config->item('secret');
            $myIDKEY = "";
            
            curl_setopt($ch, CURLOPT_URL, $this->config->item('paypal_url')."v1/oauth2/token");
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_USERPWD, $this->config->item('client_id').":".$this->config->item('secret'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
            
            $result = curl_exec($ch);
            
            if(empty($result))die("Error: No response.");
            else
            {
                $json = json_decode($result);
                //print_r($json->access_token);
                $myIDKEY = $json->access_token;
            }
            
            curl_close($ch);
            /////////////////////////////// SEND CANCEL POST ////////////////////////////////
            $ch = curl_init();
            $headers  = [
                        'Authorization: Bearer '.$myIDKEY, 
                        'Content-Type: application/json'
                    ];
            $postData = [
                'reason' => 'User changed subscription plan, old '.$planinfo->name.' cancelled.'
            ];
            curl_setopt($ch, CURLOPT_URL, $this->config->item('paypal_url')."v1/billing/subscriptions/".$subscriptionId."/cancel");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));           
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result     = curl_exec ($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);// die;


            $this->paypal_model->update('users',array('id'=>$Agreement->user_id),array('plan_status' =>'inactive', 'is_subscription'=> 0));
            $this->paypal_model->update('bhps_agreement',array('user_id'=>$Agreement->user_id),array('state' =>'Canceled'));


  		    $this->session->set_flashdata("successmsg","Your subscription cancelled successfully.");    
            redirect(base_url()."subscription");

            return  $myIDKEY; 
            

	}

	public function revise_subscription(){

			$table = "bhps_agreement";
			$where=array('bhps_agreement.user_id'=>$this->session->userdata('id'));
			$Agreement= $this->getWhereRowSelect_sub($table,$where);

			$table = "subscription";
			$where=array('subscription.id'=>$Agreement->plan_id);
			$planinfo= $this->getWhereRowSelect_sub($table,$where); 

			//echo gettype($this->uri->segment(3));

			if($this->uri->segment(3) > $Agreement->plan_id ){

				echo "grater";
			}else{
				echo "less";

				echo $planAmount = $Agreement->amount;  echo "<br>";
				echo $days       =  $planinfo->billing_cycle * 1; echo "<br>";
				echo $perdaycost = $planAmount / $days ;echo "<br>";

				echo $days_between = ceil(abs(strtotime($Agreement->next_billing_date) - strtotime(date("Y-m-d"))) / 86400) ;  echo "<br>";

			
			}



			// print_r($planinfo->billing_cycle);

			//  echo $Agreement->plan_id;
			//  echo $Agreement->amount;
			//  print_r( $Agreement); die;
			//echo $this->uri->segment(3);  
		    //echo  $this->uri->segment(4); die;

			// $table = "bhps_agreement";
			// $where=array('bhps_agreement.user_id'=>$this->session->userdata('id'));

			// $Agreement= $this->getWhereRowSelect_sub($table,$where); 
			// $subscriptionId = $Agreement->agreement_id;
        

			// $table = "subscription";
			// $where=array('subscription.id'=>$Agreement->plan_id);

			// $planinfo= $this->getWhereRowSelect_sub($table,$where); 

		 // 	$ch = curl_init();
   //          $clientId = $this->config->item('client_id');
   //          $secret = $this->config->item('secret');
   //          $myIDKEY = "";
            
   //          curl_setopt($ch, CURLOPT_URL, $this->config->item('paypal_url')."v1/oauth2/token");
   //          curl_setopt($ch, CURLOPT_HEADER, false);
   //          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   //          curl_setopt($ch, CURLOPT_POST, true);
   //          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
   //          curl_setopt($ch, CURLOPT_USERPWD, $this->config->item('client_id').":".$this->config->item('secret'));
   //          curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
            
   //          $result = curl_exec($ch);
            
   //          if(empty($result))die("Error: No response.");
   //          else
   //          {
   //              $json = json_decode($result);
   //              //print_r($json->access_token);
   //              $myIDKEY = $json->access_token;
   //          }
            
   //          curl_close($ch);
   //          /////////////////////////////// SEND CANCEL POST ////////////////////////////////
   //          $ch = curl_init();
   //          $headers  = [
   //                      'Authorization: Bearer '.$myIDKEY, 
   //                      'Content-Type: application/json'
   //                  ];
   //          $postData = [
   //              'plan_id' => $this->uri->segment(3)
   //          ];

   //          curl_setopt($ch, CURLOPT_URL, $this->config->item('paypal_url')."v1/billing/subscriptions/".$subscriptionId."/revise");
   //          curl_setopt($ch, CURLOPT_POST, 1);
   //          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   //          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));           
   //          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   //          $result     = curl_exec ($ch);
   //          $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
   //          curl_close($ch);// die;
   //          print_r( $result ); die;



	}

}





//http://webeasystep.com/blog/view_article/paypal_payment_gateway_integration_in_codeigniter

//https://developer.paypal.com/docs/api/quickstart/create-billing-plan/#create-and-activate-billing-plan






