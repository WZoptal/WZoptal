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

use \PayPal\Api\VerifyWebhookSignature;
use \PayPal\Api\WebhookEvent;


class paypalWebHook extends CI_Controller { 
	 
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


	public function receiveWebhook(){
		  
		//file_put_contents(dirname(__FILE__).'/receiveWebhook.log',print_r(file_get_contents('php://input')."\r\n",true),FILE_APPEND); 

		  $webhookId = '0411272343356093T';
		  
		  //$bodyReceived = file_get_contents('php://input');
		  //$insert_id = $this->user->insert('output',['output'=>$bodyReceived]);
		 // $insertRess = $this->paypal_model->insert('er_paycheck',['output'=>$bodyReceived]);
		  $bodyReceived = '{"id":"WH-58193264SH8856404-6J562650PJ338074W","event_version":"1.0","create_time":"2020-09-05T10:08:52.873Z","resource_type":"sale","event_type":"BILLING.SUBSCRIPTION.CREATED","summary":"Payment completed for AUD 36.5 AUD","resource":{"id":"6C855652NG888981N","state":"completed","amount":{"total":"36.50","currency":"AUD","details":{"subtotal":"36.50"}},"payment_mode":"INSTANT_TRANSFER","protection_eligibility":"ELIGIBLE","protection_eligibility_type":"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE","transaction_fee":{"value":"1.25","currency":"AUD"},"invoice_number":"","billing_agreement_id":"I-GKUASHCENLHX","create_time":"2020-09-05T10:08:37Z","update_time":"2020-09-05T10:08:37Z","links":[{"href":"https://api.paypal.com/v1/payments/sale/6C855652NG888981N","rel":"self","method":"GET"},{"href":"https://api.paypal.com/v1/payments/sale/6C855652NG888981N/refund","rel":"refund","method":"POST"}],"soft_descriptor":"PAYPAL *EVERLASTING"},"links":[{"href":"https://api.paypal.com/v1/notifications/webhooks-events/WH-58193264SH8856404-6J562650PJ338074W","rel":"self","method":"GET"},{"href":"https://api.paypal.com/v1/notifications/webhooks-events/WH-58193264SH8856404-6J562650PJ338074W/resend","rel":"resend","method":"POST"}]}';
		      
		      $bodyReceived = json_decode($bodyReceived);
		    
		      $event_type = $bodyReceived->event_type; 
		    
		    
		      switch ($event_type) {
				  //https://developer.paypal.com/docs/integration/direct/webhooks/event-names/#batch-payouts
					case "BILLING.SUBSCRIPTION.CREATED":
						 $this->billing_subscription_created($bodyReceived);
						break;
					case "BILLING.SUBSCRIPTION.UPDATED":
						 $this->billing_subscription_updated($bodyReceived);
						break;
					case "BILLING.SUBSCRIPTION.CANCELLED":
						 $this->billing_subscription_cancelled($bodyReceived);
						break;		
					case "BILLING.SUBSCRIPTION.RE-ACTIVATED":
						 $this->billing_subscription_re_activated($bodyReceived);
						break;	
					case "PAYMENT.SALE.DENIED":
						 $this->payment_sale_denied($bodyReceived);
						break;
					case "BILLING.SUBSCRIPTION.PAYMENT.FAILED":
						 $this->billing_subscription_payment_failed($bodyReceived);
						break;
					case "PAYMENT.SALE.COMPLETED":
						 $this->payment_sale_completed($bodyReceived);
						break;
							
						
					default:
						echo "not find anything 404";
				}
		    
		    
		    //echo "<pre>"; print_r($bodyReceived);die;  
		  
	}  
	
	
	
	public function billing_subscription_created($data){
		  		print_R($data); die;
		  $agreement_id = $data->resource->id;
		  $updateData['next_billing_date'] = date('Y-m-d H:i:s',strtotime($data->resource->agreement_details->next_billing_date));
		  $updateData['final_payment_date'] = date('Y-m-d H:i:s',strtotime($data->resource->agreement_details->final_payment_due_date));
		  $updateData['payment_status'] = $data->resource->payer->status;
		  $updateData['payer_id'] = $data->resource->payer->payer_info->payer_id;
		  $updateData['start_date'] = date('Y-m-d H:i:s',strtotime($data->resource->start_date));
		  $updateRes = $this->admin->update('ed_agreement',$updateData,['agreement_id'=>$agreement_id]);
		  //$updateRes = $this->service->update('ed_agreement',$updateData,['agreement_id'=>$agreement_id]);
		  
		  $updateData['webhook_id'] = $data->id;  
		  $updateData['event_type'] = $data->event_type;  
		  $updateData['amount'] = $data->resource->plan->payment_definitions[0]->amount->value;
		  $updateData['payer_email'] = $data->resource->payer->payer_info->email;
		  $updateData['agreement_id'] = $agreement_id;
		  $insertRes = $this->admin->insert('ed_webhook',$updateData);    
		  
		      
	}
	
	public function billing_subscription_updated($data){

		print_R($data); die;
		  
		  $agreement_id = $data->resource->id;
		  $updateData['next_billing_date'] = date('Y-m-d H:i:s',strtotime($data->resource->agreement_details->next_billing_date));
		  $updateData['final_payment_date'] = date('Y-m-d H:i:s',strtotime($data->resource->agreement_details->final_payment_due_date));
		  $updateData['payment_status'] = $data->resource->payer->status;
		  $updateData['payer_id'] = $data->resource->payer->payer_info->payer_id;
		  $updateData['start_date'] = date('Y-m-d H:i:s',strtotime($data->resource->start_date));
  	      $updateData['sale_id'] = $agreement->resource->id;

		  $updateRes = $this->admin->update('ed_agreement',$updateData,['agreement_id'=>$agreement_id]);
		  //$updateRes = $this->service->update('ed_agreement',$updateData,['agreement_id'=>$agreement_id]);
		  
		  $updateData['webhook_id'] = $data->id;  
		  $updateData['event_type'] = $data->event_type;  
		  $updateData['amount'] = $data->resource->plan->payment_definitions[0]->amount->value;
		  $updateData['payer_email'] = $data->resource->payer->payer_info->email;
		  $insertRes = $this->admin->insert('ed_webhook',$updateData); 
		      
	}
	
	public function billing_subscription_cancelled($data){
		
	}
	
	public function billing_subscription_re_activated($data){
		
	}
	 
	public function payment_sale_denied($data){
			
		 // $updateData['next_billing_date'] = date('Y-m-d H:i:s',strtotime($data->resource->agreement_details->next_billing_date));
		  //$updateData['final_payment_date'] = date('Y-m-d H:i:s',strtotime($data->resource->agreement_details->final_payment_due_date));
		  $updateData['payment_status'] = $data->resource->payer->status;
		  $updateData2['payment_status'] = $data->resource->payer->status;
		  
		  $updateData['other_status'] = isset($data->status)?$data->status:'';
		  $updateData['payer_id'] = $data->resource->payer->payer_info->payer_id;
		  $updateData['start_date'] = date('Y-m-d H:i:s',strtotime($data->resource->start_date));
		 
		 // $updateRes = $this->admin->update('ed_agreement',$updateData,['agreement_id'=>$agreement_id]);

		  //$updateRes = $this->service->update('ed_agreement',$updateData,['agreement_id'=>$agreement_id]);
		  
		  $updateData['webhook_id'] = $data->id;  
		  $updateData['event_type'] = $data->event_type;  
		  $updateData['amount'] = $data->resource->plan->payment_definitions[0]->amount->value;
		  $updateData['payer_email'] = $data->resource->payer->payer_info->email;
		     
		   $insertRes = $this->admin->insert('ed_webhook',$updateData);
		   $agreement_id = $data->resource->id;
		   $updateRes = $this->admin->update('ed_agreement',$updateData2,['agreement_id'=>$agreement_id]);
	}
	
	public function payment_sale_completed($data){
		
		$agreement_id = $data->resource->billing_agreement_id;
		
		 //get agreement from paypal
		  $agreement = Agreement::get($agreement_id, $this->_api_context);
		  $agreement = json_decode($agreement->toJSON(128));	
		   
		     $updateData['cycles_completed']  = $agreement->agreement_details->cycles_completed;
		     $updateData['next_billing_date'] = date('Y-m-d H:i:s',strtotime($agreement->agreement_details->next_billing_date));
		     $updateData['last_payment_date'] = date('Y-m-d H:i:s',strtotime($agreement->agreement_details->last_payment_date));
		     $updateData['sale_id'] = $agreement->resource->id;
		      
		  
		     $updateData['payment_status'] =isset($data->status)?$data->status:'';
		     
		  $updateRes = $this->admin->update('ed_agreement',$updateData,['agreement_id'=>$agreement_id]);
		  //$updateRes = $this->service->update('ed_agreement',$updateData,['agreement_id'=>$agreement_id]);
		   
		     $updateData['payer_id'] = $agreement->payer->payer_info->payer_id;
		     $updateData['start_date'] = date('Y-m-d H:i:s',strtotime($agreement->start_date));  
		     
		    $updateData['webhook_id'] = $data->id;  
			$updateData['event_type'] = $data->event_type;  
			$updateData['agreement_id'] = $agreement_id;  
			$updateData['summary'] = $data->summary;
			$updateData['amount'] = $data->resource->amount->total;
			$updateData['payer_email'] = $agreement->payer->payer_info->email;
			$updateData['other_status'] = $data->resource->state;
		
		$insertRes = $this->admin->insert('ed_webhook',$updateData); 
	}
	
	public function billing_subscription_payment_failed($data){
		  //$updateData['next_billing_date'] = date('Y-m-d H:i:s',strtotime($data->resource->agreement_details->next_billing_date));
		  //$updateData['final_payment_date'] = date('Y-m-d H:i:s',strtotime($data->resource->agreement_details->final_payment_due_date));
		  $updateData['payment_status'] = isset($data->status)?$data->status:'';
		  $updateData2['payment_status'] = isset($data->status)?$data->status:'';
		  $updateData['other_status'] = $data->resource->payer->status;
		  $updateData['payer_id'] = $data->resource->payer->payer_info->payer_id;
		  $updateData['start_date'] = date('Y-m-d H:i:s',strtotime($data->resource->start_date));
		 
		 //$updateRes = $this->admin->update('ed_agreement',$updateData,['agreement_id'=>$agreement_id]);

		  //$updateRes = $this->service->update('ed_agreement',$updateData,['agreement_id'=>$agreement_id]);
		  
		  $updateData['webhook_id'] = $data->id;  
		  $updateData['event_type'] = $data->event_type;  
		  $updateData['amount'] = $data->resource->plan->payment_definitions[0]->amount->value;
		  $updateData['payer_email'] = $data->resource->payer->payer_info->email;
		     
		  $insertRes = $this->admin->insert('ed_webhook',$updateData);
		  $agreement_id = $data->resource->id;
		  $updateRes = $this->admin->update('ed_agreement',$updateData2,['agreement_id'=>$agreement_id]);
		  
		  
		  if($data->resource->billing_agreement_id){ 
        
        
            $sql_q  = "SELECT user_id from ed_agreement WHERE agreement_id='".$data->resource->billing_agreement_id."'";
            $results = $this->db->query($sql_q); //echo $this->db->last_query(); die;
            $result2=  $results->row();
    	     
    	    
    	     
            $sql_1  = "SELECT id,email,username as sender_nm, device_token from ed_users WHERE id=".$result2->user_id;
            $res1 = $this->db->query($sql_1); //echo $this->db->last_query(); die;
            $result1=  $res1->row();
    	     
        	    if(!empty($result1->device_token)){ 
                    $body_msg="Subscription payment failed.";
        			$MsgTitle="Everlastingdate";
                	$token=array('device_token'=>$result1->device_token, 'sender'=>0, 'receiver'=>$result1->id, 'other_id'=>0);  
                    $aps = array('alert'=>array('body'=>$body_msg,'title'=> $MsgTitle,'sender'=>0 ,'invite_id'=>0, 'status' => 'accepted','sound'=>'default'));
                    $res = sendPushNotificationLive($result1->id,$token,array('body'=>$body_msg,'title'=> $MsgTitle,'type'=>'PAYMENT_FAILED', 'click_action'=>'open_notification_screen' ,'aps'=>$aps));
           
                    $response  = json_decode($res, true); 
                    if($response['success']== 1){
                            $data = array(
                                'receiver'=>$result1->id,
                                'sender'=>0,
                                'other_id'=> 0,
                                'type'=>'PAYMENT_FAILED',
                                'title'=> $MsgTitle,
                                'body'=>$body_msg,
                                'time'=> time(),
                            );
                            //add_notification('ed_notifications',$data);
                            $this->db->insert('ed_notifications',$data);
            
                         $this->db->affected_rows() != 1 ? false : true;
        
                    }  
                }
            }
		  
		  
		  
	}
	 
}
