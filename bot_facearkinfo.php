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
$input = json_decode(file_get_contents('php://input'), true);
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];
$postback = $input['entry'][0]['messaging'][0]['postback']['payload'];
$message_to_reply = '';
$message_to_type = '';
$host_url = 'https://phpfacechatbot.herokuapp.com';

// Agent chat
$my_file = './Chat/Agent.txt';
//$sender_file = './'.$sender.'.txt';
$agentHold = "";
$agentType = "Agent.txt";


if(file_exists($my_file)){
    $line = file($my_file);
    if($line[0] == $sender){
        $agentHold = $line[0];
        $agentType = "Agent.txt";
    }
}
/**
 * Some Basic rules to validate incoming messages
 */
if (!empty($_GET["type"])) {
$my_file = './Chat/'.$_GET["type"];
     $agentid = "";
    if(file_exists($my_file)){
        $line = file($my_file);
        $agentid = $line[0];
    } else {
        $agentid = $_GET["userid"];
    }
    # Message Pushback 
    
        if(strpos($_GET["text"], 'ขอบคุณ') !== false && file_exists($my_file)){
            unlink($my_file);
        }
    
        $message_to_reply = $_GET["text"];
        $message_to_type = 'text';
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
// add
} else {

if ($agentHold != $sender) {
	
 if (!empty($postback)) {
     $message = $postback;
 }
 if (strpos($message, 'สวัสดี') !== false) {
 	$message_to_type = 'buttonMain';
 } else if ($message == 'MENU_1') {
	$message_to_type = 'button1';
		//$myfile = fopen($sender_file, "w") or die("Unable to open file!");
		//$txt = "1. สอบถามอู่/ศูนย์จัดซ่อม \n";
		//fwrite($myfile, $txt);
		//fclose($myfile);
 } else if ($message == 'MENU_2') {
	$message_to_type = 'button2';
	 	//$myfile = fopen($sender_file, "w") or die("Unable to open file!");
		//$txt = "2. สอบถามขั้นตอน/เอกสารที่ใช้ตั้งเบิก/คุมราคาจัดซ่อม \n";
		//fwrite($myfile, $txt);
		//fclose($myfile);
 } else if ($message == 'MENU_3') {
	$message_to_reply = 'กรุณารอสักครู่นะค่ะ ';
	$message_to_type = 'text';
	 	//$myfile = fopen($sender_file, "w") or die("Unable to open file!");
		//$txt = "3. สอบถามข้อมูลอื่นๆ";
		//fwrite($myfile, $txt);
		//fclose($myfile);	 
 } else if (strpos($message, 'MENU_1_1') !== false) {
	$message_to_reply = 'พิมพ์ชื่อ อำเภอ/เขต ที่ลูกค้าต้องการสอบถามได้เลยค่ะ เช่น บางกอกใหญ่, บางนา เป็นต้น';
	$message_to_type = 'text';
	 	//$myfile = fopen($sender_file, "w") or die("Unable to open file!");
		//$txt = "1 \n";
		//fwrite($myfile, $txt);
		//fclose($myfile);
} else if (strpos($message, 'MENU_1_') !== false) {
	$message_to_reply = 'พิมพ์ชื่อ จังหวัด ที่ลูกค้าต้องการสอบถามได้เลยค่ะ';
	$message_to_type = 'text';
	        //$myfile = fopen($sender_file, "w") or die("Unable to open file!");
		//$txt = substr($message, -1)." \n";
		//fwrite($myfile, $txt);
		//fclose($myfile);
} else if (strpos($message, 'บาง') !== false) {
	$message_to_reply = 'อู่ยงค์การช่าง 70/1 ม.2 ถ.งามวงศ์วาน ต.บางเขน อ.เมือง จ.นนทบุรี 11000 0-2589-5190,0-2591-3237';
	$message_to_type = 'text';
	        //$myfile = fopen($sender_file, "w") or die("Unable to open file!");
		//$txt = $message." \n";
		//fwrite($myfile, $txt);
		//fclose($myfile);
} else if (strpos($message, 'นคร') !== false) {
	$message_to_reply = 'อู่'.$message.' อ.เมือง จ.'.$message;
	$message_to_type = 'text';
	        //$myfile = fopen($sender_file, "w") or die("Unable to open file!");
		//$txt = $message." \n";
		//fwrite($myfile, $txt);
		//fclose($myfile);
} else if (strpos($message, 'บุรี') !== false) {
	$message_to_reply = 'อู่'.$message.' อ.เมือง จ.'.$message;
	$message_to_type = 'text';
	        //$myfile = fopen($sender_file, "w") or die("Unable to open file!");
		//$txt = $message." \n";
		//fwrite($myfile, $txt);
		//fclose($myfile);
} else if ($message == 'FILE_1') {
	$message_to_reply = "https://www.dropbox.com/s/8g0tdtsxc1c2p3w/file1.pdf";
	$message_to_type = 'text';
	        //$myfile = fopen($sender_file, "w") or die("Unable to open file!");
		//$txt = "1. เอกสารการตั้งเบิกอู่นอกเครือ \n";
		//fwrite($myfile, $txt);
		//fclose($myfile);
} else if (strpos($message, 'FILE_2') !== false) {
	$message_to_reply = "https://www.dropbox.com/s/4l1t79tbi1qd259/file2.pdf";
	$message_to_type = 'text';
	        //$myfile = fopen($sender_file, "w") or die("Unable to open file!");
		//$txt = "2. เอกสารประกอบการตั้งเบิกคืนลูกค้า (รถคู่กรณี) \n";
		//fwrite($myfile, $txt);
		//fclose($myfile);
} else if (strpos($message, 'FILE_3') !== false) {
	$message_to_reply = "https://www.dropbox.com/s/akkvbzocqrs0ffh/file3.pdf";
	$message_to_type = 'text';
	        //$myfile = fopen($sender_file, "w") or die("Unable to open file!");
		//$txt = "3. เอกสารประกอบการตั้งเบิกคืนลูกค้า (รถประกัน) \n";
		//fwrite($myfile, $txt);
		//fclose($myfile);
} 
 
 /*
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
}else{
  if($isData >0){
   foreach($data as $rec){
     $message_to_reply = $rec->answer;
   }
  }else{
    $message_to_reply = 'ก๊าบบ คุณสามารถสอนให้ฉลาดได้เพียงพิมพ์: สอนเป็ด[คำถาม|คำตอบ]';
  }
}
*/
//The JSON data.
if ($message_to_type == 'text') {
 $jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "text":"'.$message_to_reply.'"
    }
}';
} else if ($message_to_type == 'buttonMain') {
 $jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "attachment": {
        "type": "template",
        "payload": {
          "template_type": "button",
          "text": "Deves Admin ยินดีให้บริการค่ะ วันนี้ให้ทางเทเวศดูแลเรื่องอะไรดีค่ะ",
          "buttons":[{
          "type": "postback",
            "title": "1. สอบถามอู่/ศูนย์จัดซ่อม",
            "payload": "MENU_1"
          }, {
            "type": "postback",
            "title": "2. สอบถามขั้นตอน/เอกสารที่ใช้ตั้งเบิก/คุมราคาจัดซ่อม",
            "payload": "MENU_2"
          }, {
            "type": "postback",
            "title": "3. สอบถามข้อมูลอื่นๆ",
            "payload": "MENU_3"
          }]
        }
      }
    }
}';
} else if ($message_to_type == 'button1') {
 $jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "attachment": {
        "type": "template",
        "payload": {
          "template_type": "generic",
	  "elements": [{
          "title": "พื้นที่อู่ ที่ลูกค้าต้องการสอบถามอยู่ภาคใดค่ะ",
          "buttons":[{
            "type": "postback",
            "title": "1. กรุงเทพมหานคร",
            "payload": "MENU_1_1"
          }, {
            "type": "postback",
            "title": "2. ปริมณฑล",
            "payload": "MENU_1_2"
          }, {
            "type": "postback",
            "title": "3. ภาคกลาง",
            "payload": "MENU_1_3"
          }]}, {
	  "title": "เลื่อนด้าน ซ้าย หรือ ขวา สำหรับตัวเลือกอื่น",
          "buttons":[{
            "type": "postback",
            "title": "4. ภาคตะวันออก",
            "payload": "MENU_1_4"
          }, {
            "type": "postback",
            "title": "5. ภาคอีสาน",
            "payload": "MENU_1_5"
          }, {
            "type": "postback",
            "title": "6. ภาคเหนือ",
            "payload": "MENU_1_6"
          }]}, {
	  "title": "เลื่อนด้าน ซ้าย หรือ ขวา สำหรับตัวเลือกอื่น",
          "buttons":[{
            "type": "postback",
            "title": "7. ภาคใต้",
            "payload": "MENU_1_7"
          }]}
          ]
        }
      }
    }
}';
}  else if ($message_to_type == 'button2') {
 $jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "attachment": {
        "type": "template",
        "payload": {
          "template_type": "button",
          "text": "เลือกหัวข้อที่ต้องการสอบถามข้อมูลค่ะ",
          "buttons":[{
          "type": "postback",
            "title": "1. เอกสารการตั้งเบิกอู่นอกเครือ",
	    "payload": "FILE_1"
          }, {
            "type": "postback",
            "title": "2. เอกสารประกอบการตั้งเบิกคืนลูกค้า (รถคู่กรณี)",
	    "payload": "FILE_2"
          }, {
            "type": "postback",
            "title": "3. เอกสารประกอบการตั้งเบิกคืนลูกค้า (รถประกัน)",
	    "payload": "FILE_3"
          }]
        }
      }
    }
}';
} else if ($message_to_type == 'file') {
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
  //replyMsg($access_token,$jsonDataEncoded)
//Tell cURL that we want to send a POST request.
  curl_setopt($ch, CURLOPT_POST, 1);
//Attach our encoded JSON string to the POST fields.
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
//Set the content type to application/json
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
//Execute the request
if(!empty($message_to_type)){
    $result = curl_exec($ch);
}
 if ($message == 'MENU_3') {
    //if(file_exists($sender_file)){
	    //$line = file($sender_file);
		//    $strUrl = "https://phpfacechatbot.herokuapp.com/Chat/lineToChat.php?userid=".$sender."&text=".$line[0]."&type=".$agentType;
		//    $ch = curl_init();
		//    curl_setopt($ch, CURLOPT_URL, $strUrl);
		//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		//    $result = curl_exec($ch);  
	   // unlink($sender_file);
    //} else {
	$strUrl = "https://phpfacechatbot.herokuapp.com/Chat/lineToChat.php?userid=".$sender."&text=ลูกค้าต้องการติดต่อพนักงาน&type=".$agentType;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $strUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($ch);
    //}
 }
	
} else {
        $strUrl = 'https://phpfacechatbot.herokuapp.com/Chat/lineToChat.php?userid='.$sender.'&text="'.$message.'"&type='.$agentType;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $strUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if (!empty($message)) {
	$result = curl_exec($ch);
        //curl_close ($ch);
	}
    }
}
/*function replyMsg($access_token,$arrayPostData){
        $strUrl = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
        $ch = curl_init($strUrl);
        //curl_setopt($ch, CURLOPT_URL,$strUrl);
        //curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));    
        //curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_POSTFIELDS,$arrayPostData);
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    } */

?>
