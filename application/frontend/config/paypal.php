<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

/** set your paypal credential **/

/******       SENDBOX               *****/

$config['client_id'] = 'Acm9Fzt1iQH3Wq6E9qU0XpTvs0zEJbwdS-d_T9LxyTQ2V5iEpEsU41ZoKKb4b7dEAud_8-UZOyZmvOKa';
$config['secret'] = 'EApgJnlNdhF2ckLH8ECC3Ke1mfbDtn97ObO1BSKpuvXPbNFyy0NVKDjNWUMtGtYqRazsvDRzciSqQV4N';
$config['paypal_url'] = 'https://sandbox.paypal.com/';


/**********   LIVE      *****************/

//$config['client_id'] = 'AWKy5BPSR_BDrhx4U1Yg4NEvfVDZ912T3Ln4C24xng1u0i8_IlSShzyCUNzks5dTX8id2ftgt1UPzft5';
//$config['secret'] = 'ELeffTOs0GuC3v4WwXrK_bAkiBcjGSrWM7V4WfC78eL1KwJFXr7Eh2uC-BWiWoJ3UcM_HjzqoDs_04Wd';
//$config['paypal_url'] = 'https://api.paypal.com/';


/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);
