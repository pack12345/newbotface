<?php
session_start();
$access_token = 'IHf9TGAiHOH3XZdKNdrz+NBHzcPr2y+f2rpdiDj7b2okT11aW2a7eknIfMCVkkIekN82nmiUonCyubOwPxCD0WN6ObtI8miTVkemgWQN8M27m8kCdxcbE6Q/rGRExajPhaWfpzyrO8xTyGyIrE/TGgdB04t89/1O/w1cDnyilFU=';
$depSession = "";

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		$userID = $event['source']['userId'];
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent			
			error_log('message '.$event['message']);
			error_log('--$_SESSION1 : '.$_SESSION['departure']);
			$depSession = $_SESSION['departure'];
			error_log('--$depSession : '.$depSession);
			if($depSession == "1"){
				error_log("----- send departure ----");
				$text ='จาก'. $event['message']['text'];
			}else{
				$text = $event['message']['text'];
			}
			
			//$text = 'hello world';
			// Get replyToken
			$replyToken = $event['replyToken'];
			error_log('replyToken'.$replyToken);
			// Build message to reply back
			// make GET
			$sessionID = session_id();
			error_log('session '.$sessionID);
			$postCXP = json_encode($para);
			//$cxpUrl = 'http://58.82.133.74:8070/VoxeoCXP/DialogMapping?VSN=testService@System&message='.$text.'&vsDriver=164&channel=line&sessionID='.$userID;
			
			
// 			error_log($cxpUrl);
// 			$chcxp = curl_init($cxpUrl);
			
// 			curl_setopt($chcxp, CURLOPT_CUSTOMREQUEST, "GET");
// 			curl_setopt($chcxp, CURLOPT_RETURNTRANSFER, true);
// 			curl_setopt($chcxp, CURLOPT_FOLLOWLOCATION, 1);
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL,"http://58.82.133.74:8070/VoxeoCXP/DialogMapping");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,
				    'VSN=testService@System&message='.$text.'&vsDriver=164&channel=line&sessionID='.$userID);
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			error_log('url_post : '.$ch);
			$xcpResult = curl_exec($ch);
			
			//$xcpResult = curl_exec($chcxp);
			curl_close($ch);
			error_log($xcpResult);	
			error_log('XXXX:'.substr($xcpResult,0,27).'');
		
			if(substr($xcpResult,0,5) == "    1"){
			    error_log("----- ark departure ----");
				$_SESSION['departure'] = "1";
				session_write_close();
				$aaa = explode(":",$xcpResult);
				error_log('--$_SESSION2 : '.$_SESSION['departure']);
				$messages = [
						'type' => 'text',
						'text' => $aaa[1]
					];
			}
			else if(substr($xcpResult,0,27) == "  https://www.picz.in.th/im"){
			    error_log("Send image only");
				$messages=[
						  "type"=> "template",
						  "altText"=> "this is a image carousel template",
						  "template"=> [
						      "type"=> "image_carousel",
						      "columns"=> [
							  [
							    "imageUrl"=> "https://www.picz.in.th/images/2017/10/30/20170906-104358.png",
								"action"=> [
							      "type"=> "postback",
							      "label"=> "Buy",
							      "data"=> "action=buy&itemid=111"
							    ]
							   
							  ],
							  [
							    "imageUrl"=> "https://www.picz.in.th/images/2017/10/30/airasia20150629.jpg",
							    "action"=> [
							      "type"=> "message",
							      "label"=> "Yes",
							      "text"=> "yes"
							    ]
							  ],
							  [
							    "imageUrl"=> "https://www.picz.in.th/images/2017/10/30/qantas.jpg",
							    "action"=> [
							      "type"=> "uri",
							      "label"=> "View detail",
							      "uri"=> "https://www.picz.in.th/images/2017/10/30/qantas.jpg"
							    ]
							  ],
							    [
							    "imageUrl"=> "https://www.picz.in.th/images/2017/10/24/20150828-230116.jpg",
							    "action"=> [
							      "type"=> "uri",
							      "label"=> "View detail",
							      "uri"=> "https://www.picz.in.th/images/2017/10/24/20150828-230116.jpg"
							    ]
							  ]    
						      ]
						  ]
						
					];
				
			}else{
				$_SESSION['departure'] = "0";
				session_write_close();
				error_log('--$_SESSION2 : '.$_SESSION['departure']);
				$messages = [
						'type' => 'text',
						'text' => $xcpResult
					];
			}
			
			error_log('message : '.$messages);	
			// Make a POST Request to Messaging API to reply to sender
			 $url = 'https://api.line.me/v2/bot/message/reply';
			
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$resultMes = curl_exec($ch);
			curl_close($ch);
			echo $resultMes . "\r\n";
		}
	}
}
echo "OK";
?>
