<?php
error_log('facebook hook ');
 
   $access_token = 'EAAcCIIH2scoBAIraN46Dv06N41dlZC5E5gkKcwZBuU0mXS6wK71pnThMs97An0ZAnNCauHv0qv8TZBVaHyur9JjWUvrem5EkXpE867SlQbuSKdic9lfM5zZA3xz956pfahV24mHDIHKhSsBLUAEZA17OXg2vZBaQ5nGBcRxZBdpAOgZDZD';
   $verify_token = 'airline_bot';
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
  error_log('XXXXXmessage :  '. $message );
 	if($message==''){
 		return;
 	}

   $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://58.82.133.74:8070/VoxeoCXP/DialogMapping");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,
				    'VSN=testService@System&message='.$message.'&vsDriver=164&channel=facebook&sessionID=EAASvNkXVo7wBAAZCAZBU4dJBXMCWnoCF');
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			error_log('url_post : '.$ch);
			$xcpResult = curl_exec($ch);
			
			//$xcpResult = curl_exec($chcxp);
			curl_close($ch);
			error_log($xcpResult);	

    //API Url
    $url = 'https://graph.facebook.com/v2.6/me/messages';
    $message_to_reply = $xcpResult;
    error_log('url reply'.$url);
    //Initiate cURL.
    $ch = curl_init($url);

    error_log('XXXX:'.substr($xcpResult,0,27).'');
		
			if(substr($xcpResult,0,1) == "1"){
			    error_log("----- ark departure ----");
				$aaa = explode(":",$xcpResult);
				$messages = [
						'text' => $aaa[1]
					];
			}
			else if(substr($xcpResult,0,1) == "2"){
			    error_log("----- ark date ----");
				$aaa = explode(":",$xcpResult);
				$messages = [
						'text' => $aaa[1]
					];
			}
			else if(substr($xcpResult,0,27) == "https://www.picz.in.th/imag"){
			    error_log("Send image only");
				$messages=[
  				'attachment' =>['type' => 'template',
 						'payload' => ['template_type' => 'generic',
 							      	'elements' => [
                               [
                               'title' => 'เที่ยวบิิน',
                              'image_url'=> 'https://www.picz.in.th/images/2017/11/13/air_promotion.jpg2.jpg',
                               'subtitle' => 'คุ้มทุกที่ ประหยัดทุุกเทีี่ยว',
                               'buttons' => [
                                ['type' => 'web_url',
                                'title' => 'ดูเพิ่มเติม',
                                'url' => 'https://www.airasia.com/th/th/promotion.page'
                                ]
                               ]
                              ]
                              ]

                                 ]
                           ]
                         ];
				
			}else{
    $messages = [
						'text' => $xcpResult
					];
			}

   //The JSON data.
    $jsonData = [
        'access_token'=>$access_token,
        'recipient'=>[
     'id'=> $sender
          ],
        'message'=> $messages

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
        $resultMes = curl_exec($ch);
    }
 
 ?>
