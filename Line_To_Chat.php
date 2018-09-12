<?php

$accessToken = "GKTmRxPtlSGanBv4pz7OE3Kckxs93EKKpTzUJ/BfEu32CFq+d0N6dkup/3LgN8m+wLiaimWdqOXYECwLirSjbKa5fewj3uPpnBgb1yCeiEpF0ICEXBm465sagEWT6V1q9YKSYUEKjpN1PuPuVQ+V4wdB04t89/1O/w1cDnyilFU=";

    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
#ตัวอย่าง Message Type "Text"
    if($message == "สวัสดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "Credit"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "บัตรเครดิต เรามีให้เลือกหลายอย่าง";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Sticker"
    else if($message == "ฝันดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "2";
        $arrayPostData['messages'][0]['stickerId'] = "46";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Image"
    else if($message == "รูปน้องแมว"){
        $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Location"
    else if($message == "พิกัดสยามพารากอน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
        $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
        $arrayPostData['messages'][0]['longitude'] = "100.532752";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
    else if($message == "ลาก่อน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "131";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "Card"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "imagemap";
        $arrayPostData['messages'][0]['baseUrl'] = "https://github.com/pack12345/BOTCHAT/blob/master/immapcard";
        $arrayPostData['messages'][0]['altText'] = "This is an imagemap";
        $arrayPostData['messages'][0]['baseSize']['width'] = 1040;
        $arrayPostData['messages'][0]['baseSize']['height'] = 1040;
        $arrayPostData['messages'][0]['actionCount'] = 6;
        
        $arrayPostData['messages'][0]['actions'][0]['type'] = "message";
        $arrayPostData['messages'][0]['actions'][0]['area']['x'] = 17;
        $arrayPostData['messages'][0]['actions'][0]['area']['y'] = 93;
        $arrayPostData['messages'][0]['actions'][0]['area']['width'] = 322;
        $arrayPostData['messages'][0]['actions'][0]['area']['height'] = 324;
        $arrayPostData['messages'][0]['actions'][0]['area']['text'] = "GSB PREMIUM";
        
        $arrayPostData['messages'][0]['actions'][1]['type'] = "message";
        $arrayPostData['messages'][0]['actions'][1]['area']['x'] = 351;
        $arrayPostData['messages'][0]['actions'][1]['area']['y'] = 93;
        $arrayPostData['messages'][0]['actions'][1]['area']['width'] = 322;
        $arrayPostData['messages'][0]['actions'][1]['area']['height'] = 324;
        $arrayPostData['messages'][0]['actions'][1]['area']['text'] = "GSB PRECIOUS";
        
        $arrayPostData['messages'][0]['actions'][2]['type'] = "message";
        $arrayPostData['messages'][0]['actions'][2]['area']['x'] = 687;
        $arrayPostData['messages'][0]['actions'][2]['area']['y'] = 93;
        $arrayPostData['messages'][0]['actions'][2]['area']['width'] = 322;
        $arrayPostData['messages'][0]['actions'][2]['area']['height'] = 324;
        $arrayPostData['messages'][0]['actions'][2]['area']['text'] = "GSB PRESTIGE";
        
        $arrayPostData['messages'][0]['actions'][3]['type'] = "message";
        $arrayPostData['messages'][0]['actions'][3]['area']['x'] = 17;
        $arrayPostData['messages'][0]['actions'][3]['area']['y'] = 431;
        $arrayPostData['messages'][0]['actions'][3]['area']['width'] = 322;
        $arrayPostData['messages'][0]['actions'][3]['area']['height'] = 324;
        $arrayPostData['messages'][0]['actions'][3]['area']['text'] = "บัตรเงินสด";
        
        $arrayPostData['messages'][0]['actions'][4]['type'] = "message";
        $arrayPostData['messages'][0]['actions'][4]['area']['x'] = 351;
        $arrayPostData['messages'][0]['actions'][4]['area']['y'] = 431;
        $arrayPostData['messages'][0]['actions'][4]['area']['width'] = 322;
        $arrayPostData['messages'][0]['actions'][4]['area']['height'] = 324;
        $arrayPostData['messages'][0]['actions'][4]['area']['text'] = "บัตรออมสินวีซ่า";
        
        $arrayPostData['messages'][0]['actions'][5]['type'] = "message";
        $arrayPostData['messages'][0]['actions'][5]['area']['x'] = 687;
        $arrayPostData['messages'][0]['actions'][5]['area']['y'] = 431;
        $arrayPostData['messages'][0]['actions'][5]['area']['width'] = 322;
        $arrayPostData['messages'][0]['actions'][5]['area']['height'] = 324;
        $arrayPostData['messages'][0]['actions'][5]['area']['text'] = "บัตรออมสินสมาร์ทแคร์";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "เมนู"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "template";
        $arrayPostData['messages'][0]['altText'] = "this is a buttons template";
        $arrayPostData['messages'][0]['template']['type'] = "BUTTONS";
        $arrayPostData['messages'][0]['template']['height'] = 1040;
        $arrayPostData['messages'][0]['template']['title'] = "GSB Main menu";
        $arrayPostData['messages'][0]['template']['text'] = "ยินดีตอนรับสู่บริการของเราค่ะ";
        
        $arrayPostData['messages'][0]['template']['actions'][0]['type'] = "message";
        $arrayPostData['messages'][0]['template']['actions'][0]['label'] = "บัตรเครดิต";
        $arrayPostData['messages'][0]['template']['actions'][0]['text'] = "บัตรเครดิต";
        
        replyMsg($arrayHeader,$arrayPostData);
    }
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>
