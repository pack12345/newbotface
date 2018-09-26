<?php
#echo('facebook hook');

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
$input = json_decode(file_get_contents('php://input'), true);
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];
$postback = $input['entry'][0]['messaging'][0]['postback']['payload'];
$message_to_reply = '';
$message_to_type = 'none';
$postback_stat = 'flase';
$file_url = 'https://phpfacechatbot.herokuapp.com';
/**
 * Some Basic rules to validate incoming messages
 */
/* 
$api_key= "<mLAP API KEY>"; #"9b1a3a86e454415915b2a9dd8f275428";
$url = 'https://api.mlab.com/api/1/databases/duckduck/collections/linebot?apiKey='.$api_key.'';
$json = file_get_contents('https://api.mlab.com/api/1/databases/duckduck/collections/linebot?apiKey='.$api_key.'&q={"question":"'.$message.'"}');
$data = json_decode($json);
$isData=sizeof($data);
*/
if (!empty($postback)) {
$message = $postback;
}

if (strpos($message, 'สวัสดี') !== false) {
   $arrayPostData = array(
        "recipient" => array(
            "id" => $sender
        ),
        "message" => array(
            "attachment" => array(
             "type" => "template",
             "payload" = > array(
              "template_type" => "button",
              "text" => "Deves Admin ยินดีให้บริการค่ะ วันนี้ให้ทางเทเวศดูแลเรื่องอะไรดีค่ะ",
              "buttons" => [ array(
               "type" => "postback",
               "title" => "1. สอบถามอู่/ศูนย์จัดซ่อม",
               "payload" => "M_1"
               ), array(
               "type" => "postback",
               "title" => "2. สอบถามขั้นตอน/เอกสารที่ใช้ตั้งเบิก/คุมราคาจัดซ่อม",
               "payload" => "M_2"
               ), array(
               "type" => "postback",
               "title" => "3. สอบถามข้อมูลอื่นๆ",
               "payload" => "M_3"
               )]
             )
            )
        )
     );
} else if (strpos($message, 'M_1') !== false) {
    $message_to_reply = 'สวัสดี 1';
    $message_to_type = 'text';
} else if (strpos($message, 'M_2') !== false) {
    $message_to_reply = 'สวัสดี 2';
    $message_to_type = 'text';
} else {
    $message_to_reply = $message;
    $message_to_type = 'text';
}

if ($message_to_type == 'text') {
    $arrayPostData = array(
        "recipient" => array(
            "id" => $sender
        ),
        "message" => array(
            "text" => $message_to_reply
        )
    );
} else if ($message_to_type == 'file') {
    $arrayPostData = array(
        "recipient" => array(
            "id" => $sender
        ),
        "message" => array(
            "attachment" => array(
                "type" => 'file',
                "payload" => array(
                    "url" => $file_url.$message_to_reply
                    )
                )
            )
    );
} else if ($message_to_type == 'button') {
     $arrayPostData = array(
        "recipient" => array(
            "id" => $sender
        ),
        "message" => array(
            "attachment" => array(
             "type" => "template",
             "payload" = > array(
              "template_type" => "button",
              "text" => "Deves Admin ยินดีให้บริการค่ะ วันนี้ให้ทางเทเวศดูแลเรื่องอะไรดีค่ะ",
              "buttons" => [ array(
               "type" => "postback",
               "title" => "1. สอบถามอู่/ศูนย์จัดซ่อม",
               "payload" => "DEVELOPER_DEFINED_PAYLOAD_1"
               ), array(
               "type" => "postback",
               "title" => "2. สอบถามขั้นตอน/เอกสารที่ใช้ตั้งเบิก/คุมราคาจัดซ่อม",
               "payload" => "DEVELOPER_DEFINED_PAYLOAD_2"
               ), array(
               "type" => "postback",
               "title" => "3. สอบถามข้อมูลอื่นๆ",
               "payload" => "DEVELOPER_DEFINED_PAYLOAD_3"
               )]
             )
            )
        )
     );
 
}
    

    replyMsg($access_token,$arrayPostData);



// comment start by mee
/*
if (strpos($message, 'สอนเป็ด') !== false) {
    if (strpos($message, 'สอนเป็ด') !== false) {
        $x_tra = str_replace("สอนเป็ด","", $message);
        $pieces = explode("|", $x_tra);
        $_question=str_replace("[","",$pieces[0]);
        $_answer=str_replace("]","",$pieces[1]);
        //Post New Data
        $newData = json_encode(
            array(
                'question' => $_question,
                'answer'=> $_answer
            )
        );
        $opts = array(
            'http' => array(
                'method' => "POST",
                'header' => "Content-type: application/json",
                'content' => $newData
            )
        );
        $context = stream_context_create($opts);
        $returnValue = file_get_contents($url,false,$context);
        $message_to_reply = 'ขอบคุณที่สอนเป็ด';
    }
} else {
    if($isData >0){
        foreach($data as $rec){
            $message_to_reply = $rec->answer;
        }
    } else {
        $message_to_reply = 'ก๊าบบ คุณสามารถสอนให้ฉลาดได้เพียงพิมพ์: สอนเป็ด[คำถาม|คำตอบ]';
    }
}
}
//API Url
$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
//Initiate cURL.
$ch = curl_init($url);
//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "text":"'.$message_to_reply.'"
    }
}';
//Encode the array into JSON.
$jsonDataEncoded = $jsonData;
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
*/ //comment end by mee

function replyMsg($access_token,$arrayPostData){
        $strUrl = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
exit; 
?>
