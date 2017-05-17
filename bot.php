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
			error_log('XXXX:'.substr($xcpResult,0,27).':');
			$messages = '';
			
		if(substr($xcpResult,0,27)=="  https://www.mx7.com/i/b7e"){
			error_log('pic');
		/*	$messages = [
					'type' => 'image',
					'originalContentUrl' => $xcpResult,
					'previewImageUrl' =>  $xcpResult
				];*/
			$messages=['type'=> 'template',
					'altText' => 'this is a buttons template',
					'template' => [
						'type'=> 'buttons',
						'thumbnailImageUrl'=> 'https://www.mx7.com/i/b7e/HdD0Yj.jpg',
						'title' => 'Today - 30 Jun 17',
						'text' => 'Everyday Special, Get Cash Back Up to 17 precentage',
						'actions' => [

								 ['type' => 'uri',
									'label' => 'More information',
									'uri' => 'https://www.kasikornbank.com/EN/promotion/Pages/Supermarket.aspx'
								  ]
							     ]

							]
				];
			}	
			 else if(substr($xcpResult,0,27)=="  https://www.mx7.com/i/b7b"){
				error_log('pic');
		
				$messages=[
  					'type'=> 'template',
  					'altText' => 'this is a buttons template',
 					'template' => [
						'type'=> 'buttons',
						'thumbnailImageUrl'=> 'https://www.mx7.com/i/b7b/CQ6y5K.png',
						'title' => 'Shori Sushi House',
						'text' => 'Tel: 02-169-1532
								Opening Hours: 11:00 – 23:00',
						'actions' => [
							
							  [
							    'type' => 'uri',
							    'label' => 'Location',
							    'uri' => 'https://goo.gl/maps/jxgfN1aXYzR2'
							  ]
						      ]

				  		]
					];
			}	
			else if(substr($xcpResult,0,27)=="  https://www.mx7.com/i/bde"){
				error_log('pic');
		
				$messages=[
  					'type'=> 'template',
  					'altText' => 'this is a buttons template',
 					'template' => [
						'type'=> 'buttons',
						'thumbnailImageUrl'=> 'https://www.mx7.com/i/bde/2oPh6u.png',
						'title' => 'Hakone Bangkok',
						'text' => 'Tel: 02-108-2790
								Opening Hours: 10:00 – 22:00',
						'actions' => [
							
							  [
							    'type' => 'uri',
							    'label' => 'Location',
							    'uri' => 'https://goo.gl/maps/EJQUDLLtugE2'
							  ]
						      ]

				  		]
					];	
			}	
			else if(substr($xcpResult,0,27)=="  https://www.mx7.com/i/1f1"){
				error_log('pic');
		
				$messages=[
  					'type'=> 'template',
  					'altText' => 'this is a buttons template',
 					'template' => [
						'type'=> 'buttons',
						'thumbnailImageUrl'=> 'https://www.mx7.com/i/1f1/79drKy.png',
						'title' => 'Yoshino Yama',
						'text' => 'Tel: 02-259-2582
								Opening Hours: 17:00 – 01:00',
						'actions' => [
							
							  [
							    'type' => 'uri',
							    'label' => 'Location',
							    'uri' => 'https://goo.gl/maps/FgVPc8yddDo'
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
