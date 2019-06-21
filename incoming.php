<?php
// Setup Twilio
//require_once "vendor/autoload.php";
require __DIR__ . '/twilio-php-master/Twilio/autoload.php';
use Twilio\TwiML\VoiceResponse;
use Twilio\Security\RequestValidator;

function getDigits(){
    $response = new VoiceResponse();
    #invoke the other script triggering the api call to Invoice Ninja
    $gather = $response->gather(['action' => '/process_gather.php','method' => 'GET']);
    $gather->say('Please enter your account number followed by the pound sign');
    $response->say('We didn\'t receive any input. Goodbye!');
    echo $response;
    }

$authenticate = false;
#Detect Http1.0 Authentication and present a username and password
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
{
 $name = $_SERVER['PHP_AUTH_USER'];
 $pass = $_SERVER['PHP_AUTH_PW'];
 if ($name == '' && $pass == '')
 {
  $authenticate = true;
 }
}
 
if ($authenticate==false)
{
 header('WWW-Authenticate: Basic realm="Restricted Page Enter Details To Continue"');
 header('HTTP/1.0 401 Unauthorized');
 echo "Authentication Failed, Try Again";
} 
else{

//Setup the token and authorization from Twilio
$token = "";
$signature = $_SERVER["HTTP_X_TWILIO_SIGNATURE"];
$validator = new RequestValidator($token);
$url = $_SERVER['REQUEST_URI'];

#domain where the twilio code is located
$domain = "";
$url = $domain.$url;
$postVars = $_POST;
// Initialize the validator 
if ($validator->validate($signature, $url, $postVars)) {
    getDigits();
} else {
    echo "Request Invalid";
}
}
?>