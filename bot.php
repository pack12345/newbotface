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
		error_log('event type '.$event['type']);
		
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent			
			error_log('message '.$event['message']);
			$text = $event['message']['text'];
			//$text = 'hello world';
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			// make GET
			$sessionID = session_id();
			error_log('session '.$sessionID);
			$postCXP = json_encode($para);
			$cxpUrl = 'http://58.82.133.74:8070/VoxeoCXP/DialogMapping?VSN=testService@System&message='.$text.'&vsDriver=164&channel=line&sessionID=1234567890';
			
			
			error_log($cxpUrl);
			$chcxp = curl_init($cxpUrl);
			
			curl_setopt($chcxp, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($chcxp, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($chcxp, CURLOPT_FOLLOWLOCATION, 1);
			$xcpResult = curl_exec($chcxp);
			curl_close($chcxp);
			error_log($xcpResult);	
			error_log(':'.substr($xcpResult,0,6).':');
			$messages = '';
			if(substr($xcpResult,0,6)=="  http"){
				error_log('pic');
			/*	$messages = [
					'type' => 'image',
					'originalContentUrl' => $xcpResult,
					'previewImageUrl' =>  $xcpResult
				];*/
				$messages=[
  					'type'=> 'template',
  					'altText' => 'this is a buttons template',
 					'template' => [
						'type'=> 'buttons',
						'thumbnailImageUrl'=> 'https://www.mx7.com/i/b7e/HdD0Yj.jpg',
						'title' => 'Today - 30 Jun 17',
						'text' => 'Everyday Special, Get Cash Back Up to 17 precentage  when spending at 1500 Baht or more sales slip 7 precentage',
						'actions' => [
							
							  [
							    'type' => 'uri',
							    'label' => 'More information',
							    'uri' => 'https://www.kasikornbank.com/EN/promotion/Pages/Supermarket.aspx'
							  ]
						      ]

				  		]
					];
				
			}else{	
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
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
?>
