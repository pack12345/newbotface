<?php
$accessToken = "GKTmRxPtlSGanBv4pz7OE3Kckxs93EKKpTzUJ/BfEu32CFq+d0N6dkup/3LgN8m+wLiaimWdqOXYECwLirSjbKa5fewj3uPpnBgb1yCeiEpF0ICEXBm465sagEWT6V1q9YKSYUEKjpN1PuPuVQ+V4wdB04t89/1O/w1cDnyilFU=";
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";

    $my_file = './Chat/'.$_GET['type'];
    $agentid = $_GET['userid'];
        echo $agentid;
        echo $my_file;
        echo $_GET['text'];
    # Message Pushback 
    if(!empty($agentid){
        if($_GET["text"] == "ขอบคุณ" && file_exists($my_file)){
            unlink($my_file);
        }
     if($agentid != ""){
          //$arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
          $arrayPostData['to'] = $agentid;
          $arrayPostData['messages'][0]['type'] = "text";
          $arrayPostData['messages'][0]['text'] = $_GET["text"];
          pushMsg($arrayHeader,$arrayPostData);
     }
    }
function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   exit;
?>
