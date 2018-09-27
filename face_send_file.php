<?php
    $access_token = "EAAEpELvd68ABAA3FhOcxX8b7vXkZCfHHgZCiZBwrTmE7ZBoDxJinM9fiqWKrGLi4fDyAFS24ZByNrwzo2U4YQHXu804OFvElc9VZChu9I4ve9Pb2gib21gVTnWpVxnVCnImClnt1b9XZB9fOKcPNZB0OqMOGZC70ivUY5RPrZBfh2ZB1WxzNToGISZBzLcAGsZCt9VWsZD";
    $verify_token = "deves_poc";
    $hub_verify_token = null;
    if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
    }
    if ($hub_verify_token === $verify_token) {
    echo $challenge;
    }
    
     $my_file = './Chat/'.$_GET["type"];
     $agentid = "";
    if(file_exists($my_file)){
        $line = file($my_file);
        $agentid = $line[0];
    } else {
        $agentid = $_GET["userid"];
    }
    # Message Pushback 
    if(!empty($_GET["type"])){
        echo $_GET["text"];
        echo $agentid;
        if(strpos($_GET["text"], 'ขอบคุณ') !== false && file_exists($my_file)){
            unlink($my_file);
        }
    }
        $message_to_reply = $_GET["text"];
        $message_to_type = 'file';
    if ($message_to_type == 'text') {
        $jsonData = '{
        "recipient":{
        "id":"'.$agentid.'"
        },
        "message":{
        "text":"'.$message_to_reply.'"
        }
        }';
    }
    if ($message_to_type == 'file') {
        $jsonData = '{
           "recipient":{
           "id":"'.$sender.'"
           },
           "message": {
           "attachment": {
           "type": "file",
           "payload": {
           "url": "'.$message_to_reply.'"
                  }
               }
           }
         }';
    }
    //API Url
    $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
    //Initiate cURL.
    $ch = curl_init($url);
    //Encode the array into JSON.
    $jsonDataEncoded = $jsonData;
    //Tell cURL that we want to send a POST request.
    curl_setopt($ch, CURLOPT_POST, 1);
   //Attach our encoded JSON string to the POST fields.
   curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
   //Set the content type to application/json
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
   //Execute the request
   $result = curl_exec($ch);
?>
