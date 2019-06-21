<?php

// Setup Twilio requirements
//require_once "vendor/autoload.php";
require __DIR__ . '/twilio-php-master/Twilio/autoload.php';
use Twilio\TwiML\VoiceResponse;
use Twilio\Security\RequestValidator;

//Setup the token and authorization
$token = "";
$signature = $_SERVER["HTTP_X_TWILIO_SIGNATURE"];
$validator = new RequestValidator($token);
$url = $_SERVER['REQUEST_URI'];
$domain = "";
$url = $domain.$url;
$postVars = $_POST;
// Initialize the validator 
if ($validator->validate($signature, $url, $postVars)) {
    apiRequest();
} else {
    echo "Request Invalid";
}

//setup and create the api request and Pay initialisation
function apiRequest(){
    //setup the request, you can also use CURLOPT_URL
    $ch = curl_init();
    $digits = $_REQUEST['Digits'];
    $httpcreate = 'https://app.invoiceninja.com/api/v1/invoices/' . $digits;

    curl_setopt($ch, CURLOPT_URL, $httpcreate);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTREDIR, 3);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    $headers = array();
    #insert headers with the specific Invoice Ninja API token
    $headers[] = "X-Ninja-Token: ";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    $getRequest = json_decode($result, true);
    $balance = $getRequest['data']['balance'];
    #echo $balance;

    $response = new VoiceResponse();
    $response->say('Your Account will be charged ' . $balance);
    $response->pay(['chargeAmount' => $balance]);

    echo $response;
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);
    }
?>