<?php
$access_token = 'Mb1MfpF5t/adwXJenkK5jMkKvZOcGCOaiLIZzFI2ZcV059EKV4eC0FV4Euf8FPg4XqQcDwoB+7bTMVxxtoeJgAlqAxJfbXcnpzxLX8eiHTIaA6snZz8ZU6i8q9drPExofgFrjUrDH/TuDT/OYenjDgdB04t89/1O/w1cDnyilFU=';


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
			$text = $event['message']['text'];
			//$text = 'hello world';
			// Get replyToken
			$replyToken = $event['replyToken'];
			error_log('replyToken'.$replyToken);
			// Build message to reply back
			// make GET
			$sessionID = session_id();
			error_log('session '.$sessionID);
			$postCXP = json_encode($para);
			$cxpUrl = 'http://58.82.133.74:8070/VoxeoCXP/DialogMapping?VSN=testService@System&message='.$text.'&vsDriver=164&channel=line&sessionID='.$userID;
			
			
			error_log($cxpUrl);
			$chcxp = curl_init($cxpUrl);
			
			curl_setopt($chcxp, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($chcxp, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($chcxp, CURLOPT_FOLLOWLOCATION, 1);
			$xcpResult = curl_exec($chcxp);
			curl_close($chcxp);
			error_log($xcpResult);	
			//error_log(':'.substr($xcpResult,0,6).':');
			//error_log('XXXX:'.substr($xcpResult,0,27).'');
			
			// inint value
			$messages = '';
			$imageURL = '';
			$title = '';
			$subTitle = '';
			$titleButton = '';
			$webURL = '';
	
			// convert value 
			
			$resultMes = explode("\n",$xcpResult);
			
			for($i = 0; $i < count($resultMes) ; $i++){

				if(substr($resultMes[$i],0,1) == "!"){
					$imageURL  = trim($resultMes[$i],"!");

				}elseif (substr($resultMes[$i],0,1) == "["){
					$title  = trim($resultMes[$i],"[");

				}elseif (substr($resultMes[$i],0,1) == "\"){
					$subTitle   = trim($resultMes[$i],"\");

				}elseif (substr($resultMes[$i],0,1) == "*"){
					$titleButton   = trim($resultMes[$i],"*");

				}elseif (substr($resultMes[$i],0,1) == "#"){
					$webURL    = trim($resultMes[$i],"#");

				}else{
					echo "Not have condition fix.";
				}
			}
			
			// set message to type
			
			$symResult = "";
			$symImageURL = "!";
			// 40 charpter
			$symTitle = "[";
			// 40 charpter
			$symSubtitle = "\";
			$symTitleBN = "*";
			$symWebURL = "#";
// 			$symMessOnly = "(";

			foreach ($resultMes as $value) {
			    $symResult .= substr($value, 0, 1)
			}
			
			$checkImageURL = strpos($symResult, $symImageURL);
			$checkTitle = strpos($symResult, $symTitle);
			$checkSubtitle = strpos($symResult, $symSubtitle);
			$checkTitleBN = strpos($symResult, $symTitleBN);
			$checkWebURL = strpos($symResult, $symWebURL);
			$checkMessOnly = strpos($symResult, $symMessOnly);

			
			if (($checkImageURL !== false) && ($checkTitle !== false) && ($checkSubtitle !== false) && ($checkTitleBN !== false) && ($checkWebURL !== false)) {
				
			    	$messages=['type'=> 'template',
					'altText' => 'this is a buttons template',
					'template' => [
						'type'=> 'buttons',
						'thumbnailImageUrl'=> $imageURL,
						'title' => $title,
						'text' => $subTitle,
						'actions' => [
								 ['type' => 'uri',
									'label' => $titleButton,
									'uri' => $webURL
								  ]
							     ]
							]
					];
		
			}elseif (($checkTitle !== false) && ($checkSubtitle !== false) && ($checkTitleBN !== false) && ($checkWebURL !== false)) {

			    echo "Template not have image";

			}elseif (($checkImageURL !== false) && ($checkTitle !== false) && ($checkSubtitle !== false)) {
			    echo "Template not have button";

			}elseif (($checkImageURL !== false) && ($checkSubtitle !== false)) {
			    echo "Template not have title";

			}elseif (($checkImageURL !== false) && ($checkTitle !== false)) {
			    echo "Template not have subtitle and button";

			}elseif (($checkImageURL !== false)) {
			    echo "Send image only";

			}elseif (($checkMessOnly !== false)) {
			    echo "Send message only";

			}else{
				$messages = [
				'type' => 'text',
				'text' => $xcpResult];
			
				//ho "Not have condition fix.";
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
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
?>

