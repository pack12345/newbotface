<?php
$accessToken = "amWOrMDAoxuXE6n6QKFElpeBrFaopmhBM8JRT99+ZuYp2OvVgja6R/cw2eV2ilPLcLnQtHdklOyBNn+IkkZaoHj/3fH5oJxxsRn3pQln0dY6wUKqQFsS+jY83m63WHD+iWKoOD1U6TH93Exe2/bAGQdB04t89/1O/w1cDnyilFU=";
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
    //รับ user id ของผู้ใช้
    $id = $arrayJson['events'][0]['source']['userId'];

    # Message Pushback 
    if(!empty($_GET["userid"])){
       echo $_GET["userid"];
        echo $_GET["text"];
        $arrayPostData['to'] = $_GET["userid"];
          $arrayPostData['messages'][0]['type'] = "text";
          $arrayPostData['messages'][0]['text'] = $_GET["text"];
          pushMsg($arrayHeader,$arrayPostData);
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
