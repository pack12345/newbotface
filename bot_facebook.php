<?php

error_log('facebook hook' );

  $access_token = 'EAASvNkXVo7wBAAZCAZBU4dJBXMCWnoCFCx9sgpLMVZAnUMb3JbqlYehI2bu2rblrSPVurMZCYgqb4mIdHCfVZAz6jcE3aAhQPUjU8CqFiwSJbRZC6SlkZB5WPprBhbwrc5Q2bAE7Az9P1ukzAAYnvBZCWlZCENEd1N7ZAXhC43aZCtiKAZDZD';
  $verify_token = 'cxp_poc';
  $hub_verify_token = null;

  if(isset($_REQUEST['hub_challenge'])) {
    	$challenge = $_REQUEST['hub_challenge'];
   	$hub_verify_token = $_REQUEST['hub_verify_token'];
  }

 error_log('hub_verify_token  '. $hub_verify_token );
  if ($hub_verify_token === $verify_token) {
    	error_log('challenge '.$challenge);
  }
  $input = json_decode(file_get_contents('php://input'), true);
 error_log('input  '. $input );
  $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
 error_log('sender  '. $sender );
  $message = $input['entry'][0]['messaging'][0]['message']['text'];
 
$cxpUrl = 'http://58.82.133.74:8070/VoxeoCXP/DialogMapping?VSN=testService@System&message='.$message.'&vsDriver=164&channel=facebook&sessionID=EAASvNkXVo7wBAAZCAZBU4dJBXMCWnoCF';
					
	error_log($cxpUrl);
	$chcxp = curl_init($cxpUrl);

	curl_setopt($chcxp, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($chcxp, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($chcxp, CURLOPT_FOLLOWLOCATION, 1);
	$xcpResult = curl_exec($chcxp);
	curl_close($chcxp);
	error_log('cxp '.$chcxp);

	//API Url
	$url = 'https://graph.facebook.com/v2.6/me/messages';
	$message_to_reply = $xcpResult;
	error_log('url reply'.$url);
	//Initiate cURL.
	$ch = curl_init($url);
// 	$messages = '';
// 	if(substr($xcpResult,0,27)=='  https://www.mx7.com/i/b7e'){
// 			error_log('pic');
// 			$messages=[
// 				'attachment' =>['type' => 'template',
// 						      'elements' => [
// 								 [
// 									'title' => 'Today - 30 Jun 17',
// 									'image_url'=> 'https://www.mx7.com/i/b7e/HdD0Yj.jpg',
// 									'subtitle' => 'Everyday Special, Get Cash Back Up to 17 precentage',
// 									'buttons' => [
// 										['type' => 'web_url',
// 										'title' => 'More information',
// 										'url' => 'https://www.kasikornbank.com/EN/promotion/Pages/Supermarket.aspx'
// 										]
// 									]
// 								]
// 							]
						    
// 						]
// 				];
						
// 	}else{	
// 		$messages = [
// 			'type' => 'text',
// 			'text' => $message_to_reply
// 		];
// 	}

	//The JSON data.
	$jsonData = [
	    'access_token'=>$access_token,
	    'recipient'=>[
		'id'=> $sender
	      ],
	    'message'=>[$message_to_reply]		
	];

	//Encode the array into JSON.
	$jsonDataEncoded = json_encode($jsonData);
	//Tell cURL that we want to send a POST request.
	curl_setopt($ch, CURLOPT_POST, 1);
	//Attach our encoded JSON string to the POST fields.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
	//Set the content type to application/json
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

	//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
	//Execute the request
	if(!empty($input['entry'][0]['messaging'][0]['message'])){
	    $result = curl_exec($ch);
	}
?>
