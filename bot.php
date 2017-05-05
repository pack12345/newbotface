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
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			//$text = 'hello world';
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			
			$cxpUrl = 'http://58.82.133.74:8099/VoxeoCXP/DialogMapping?VSN=MessageProxy&phone=0847685368&message=Test&User-Agent=MessageMedia';
			$chcxp = curl_init($cxpUrl);
			$xcpResult = curl_exec($chcxp);
			curl_close($chcxp);
			$messages = [
				'type' => 'text',
				'text' => $xcpResult
			];
			
			// Make a POST Request to Messaging API to reply to sender
			 $url = 'https://api.line.me/v2/bot/message/reply';
			//
			//echo $url;
			//$cxpMsg = $_GET($url);
			//echo $cxpMsg;
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
